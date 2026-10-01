<?php

namespace Controllers;

use Models\Users;

require 'Models/Users.php';

class UserController
{
    public function register()
    {
        if (isset($_POST['submit'])) {
            $name = ucwords(trim($_POST["name"]));
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $password = trim($_POST["password"]);

            if (empty($name) || empty($email) || empty($password) || empty($phone)) {
                $_SESSION['error'] = "All fields are required";
                header('Location:register');
                exit;
            }

            if (strlen($phone) < 10) {
                $_SESSION['error'] = "The phone number must be more than 10 characters";
                header('Location:register');
                exit;
            }

            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                $_SESSION['error'] = "Password must be at least 8 characters and include letters, numbers, and special characters";
                header('Location:register');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email address is not valid!";
                header('Location:register');
                exit;
            }

            $userModel = new Users();
            $existingUser = $userModel->getEmail($email);
            if ($existingUser) {
                $_SESSION['error'] = "This email is already registered";
                header('Location:register');
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $isSaved = $userModel->saveUser($name, $email, $phone, $hashedPassword);

            if ($isSaved) {
                $_SESSION['success'] = "Patient registered successfully!";
                header('Location:login');
                exit;
            } else {
                $_SESSION['error'] = "Registration failed. Please try again.";
                header('Location:register');
                exit;
            }
        }
    }

    public function loginVerify()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new Users();
            $user = $userModel->getEmail($email);

            if (!$user) {
                $_SESSION['error'] = "No account found with this email.";
                header('Location:login');
                exit;
            }

            $user = $userModel->verify($email, $password);
            if (!$user) {
                $_SESSION['error'] = "Credentials are incorrect.";
                header('Location:login');
                exit;
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'patient') {
                    header('Location:patient-dashboard');
                    exit;
                } else {
                    header('Location:admin/index');
                    exit;
                }
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location:/dupont');
        exit;
    }

    public function getAllPatients()
    {
        $userModel = new Users();
        return $userModel->getAllPatients();
    }

    public function deletePatient($id)
    {
        $userModel = new Users();
        $userModel->deletePatient($id);
        $_SESSION['success'] = "Patient deleted successfully!";
        header('Location: patients');
        exit;
    }

    public function getPatientById($id)
    {
        $userModel = new Users();
        return $userModel->getPatientById($id);
    }

    public function updatePatient()
    {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        if (empty($name) || empty($email) || empty($phone)) {
            $_SESSION['error'] = "All fields are required";
            header('Location: edit-patient-form?id=' . $id);
            exit;
        }

        $userModel = new Users();
        $userModel->updatePatient($id, $name, $email, $phone);

        $_SESSION['success'] = "Patient updated successfully!";
        header('Location: patients');
        exit; // Added missing exit statement
    }

    public function countPatients()
    {
        $userModel = new Users();
        return $userModel->countPatients();
    }
}
