<?php

namespace Controllers;

use Models\Bookings;

require 'Models/Bookings.php';

class BookingController
{
    public function bookAppointment()
    {
        $userId = $_POST['user_id'];
        $serviceId = $_POST['service_id'];
        $appointmentDate = $_POST['date'];
        $appointmentTime = $_POST['appointment-time'];

        $bookingModel = new Bookings();
        $success = $bookingModel->bookAppointment($userId, $serviceId, $appointmentDate, $appointmentTime);

        if ($success) {
            $_SESSION['success'] = "Your appointment request has been sent. Our secretary will check the time slots and confirm the apppointment via email.";
            header('Location:patient-dashboard');
            exit;
        } else {
            $_SESSION['error'] = "There was an error processing your appointment request. Please try again.";
            header('Location:book');
            exit;
        }
    }

    public function getAppointments($userId)
    {
        $bookingModel = new Bookings();
        return $bookingModel->getAppointmentsByUserId($userId);
    }

    public function deleteAppointment($id)
    {
        $bookingModel = new Bookings();
        $bookingModel->deleteAppointment($id);
        $_SESSION['success'] = "Appointment canceled successfully!";
        header('Location: patient-dashboard');
        exit;
    }

    public function getAppointmentById($id)
    {
        $bookingModel = new Bookings();
        return $bookingModel->getAppointmentById($id);
    }

    public function modifyAppointment($id, $serviceId, $appointmentDate, $appointmentTime)
    {
        $bookingModel = new Bookings();
        $bookingModel->modifyAppointment($id, $serviceId, $appointmentDate, $appointmentTime);
        $_SESSION['success'] = "Appointment modified successfully!";
        header('Location: patient-dashboard');
        exit;
    }

    public function countAppointments()
    {
        $bookingModel = new Bookings();
        return $bookingModel->countAppointments();
    }

    public function getAllAppointments()
    {
        $bookingModel = new Bookings();
        return $bookingModel->getAllAppointments();
    }

    public function confirmAppointment($id)
    {
        $bookingModel = new Bookings();
        return $bookingModel->confirmAppointment($id);
    }
}
