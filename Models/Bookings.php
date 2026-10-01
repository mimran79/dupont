<?php

namespace Models;

class Bookings
{
    private function connectDB(): \PDO
    {
        $conn = new \PDO("mysql:host=localhost;dbname=xxxxxx", "xxxxxxxx", "xxxxxxxxx");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function bookAppointment($userId, $serviceId, $appointmentDate, $appointmentTime)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("INSERT INTO appointments (user_id, service_id, status, appointmentDate, appointmentHour) VALUES (?, ?, ?, ?, ?)");
        return $request->execute([$userId, $serviceId, 'Pending', $appointmentDate, $appointmentTime]);
    }

    public function getAppointmentsByUserId($userId)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT a.id as id, a.status, a.appointmentDate, a.appointmentHour, s.name AS service_name, s.duration as service_duration
                               FROM appointments a
                               JOIN services s ON a.service_id = s.id
                               WHERE a.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteAppointment($id)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAppointmentById($id)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT a.id as id, a.service_id, a.appointmentDate, a.appointmentHour, s.name AS service_name, s.duration as service_duration
                               FROM appointments a
                               JOIN services s ON a.service_id = s.id
                               WHERE a.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function modifyAppointment($id, $serviceId, $appointmentDate, $appointmentTime)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("UPDATE appointments SET service_id = ?, status = ?, appointmentDate = ?, appointmentHour = ? WHERE id = ?");
        $stmt->execute([$serviceId, 'Pending', $appointmentDate, $appointmentTime, $id]);
    }

    public function countAppointments()
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM appointments");
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getAllAppointments()
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT a.id as id, a.status, a.appointmentDate, a.appointmentHour, s.name AS service_name, s.duration as service_duration, u.name as patient_name, u.email as patient_email
                               FROM appointments a
                               JOIN services s ON a.service_id = s.id
                               JOIN users u ON a.user_id = u.id 
                               WHERE a.appointmentDate >= CURDATE()
                               ORDER BY a.appointmentDate ASC, a.appointmentHour ASC"); // Fixed double semicolon here
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function confirmAppointment($id)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $stmt->execute(['Confirmed', $id]);
    }
    public function checkServiceById($serviceId)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE service_id = ?");
        $stmt->execute([$serviceId]);
        $hasAppointments = $stmt->fetchColumn() > 0;
        return $hasAppointments;
    }
    public function checkUserById($userId)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() > 0;
    }
}
