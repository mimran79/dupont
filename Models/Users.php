<?php

namespace Models;

class Users
{
    private function connectDB(): \PDO
    {
        $conn = new \PDO("mysql:host=localhost;dbname=xxxxxx", "xxxxxxxx", "xxxxxxxxx");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function getEmail(string $email)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('SELECT email FROM users WHERE email = ?');
        $request->execute([$email]);
        $user = $request->fetch(\PDO::FETCH_ASSOC);
        return $user ? true : false;
    }

    public function saveUser(string $name, string $email, string $phone, string $password)
    {
        try {
            $pdo = $this->connectDB();
            $request = $pdo->prepare('INSERT INTO users(name, role, email, phone, password) VALUES(?, ?, ?, ?, ?)');
            return $request->execute([$name, "patient", $email, $phone, $password]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function verify(string $email, string $password)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $request->execute([$email]);
        $user = $request->fetch(\PDO::FETCH_ASSOC);

        // Check if user exists first to prevent array error on false
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getAllPatients()
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM users WHERE role = 'patient'");
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletePatient(int $id)
    {
        $bookingModel = new Bookings();
        $hasAppointments = $bookingModel->checkUserById($id);

        if ($hasAppointments) {
            $_SESSION['error'] = "Cannot delete this patient, he has existing appointment/s.";
            header('Location: patients');
            exit;
        }

        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $request->execute([$id]);
    }

    public function getPatientById(int $id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $request->execute([$id]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePatient(int $id, string $name, string $email, string $phone)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        return $request->execute([$name, $email, $phone, $id]);
    }

    public function countPatients()
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE role = 'patient'");
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
