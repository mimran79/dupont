<?php

namespace Controllers;

use Models\Services;
use Models\Bookings;

require 'Models/Services.php';


class ServiceController
{
    public function checkServices()
    {
        $serviceModel = new Services();
        return $serviceModel->getAllServices();
    }

    public function processService()
    {
        if (isset($_POST['submit'])) {
            $serviceType        = trim($_POST['serviceType'] ?? '');
            $serviceName        = trim($_POST['serviceName'] ?? '');
            $serviceDescription = trim($_POST['serviceDescription'] ?? '');
            $details            = $_POST['details'] ?? '';
            $servicePrice       = trim($_POST['servicePrice'] ?? '');
            $duration           = trim($_POST['duration'] ?? '');
            $timeBuffer         = trim($_POST['timeBuffer'] ?? '');

            if (empty($serviceType) || empty($serviceName) || empty($serviceDescription) || empty($details) || empty($servicePrice) || empty($duration) || empty($timeBuffer)) {
                $_SESSION['error'] = "All fields are required!";
                header('Location: add-service-form');
                exit;
            }

            $serviceModel = new Services();
            $serviceModel->saveService($serviceType, $serviceName, $serviceDescription, $details, $servicePrice, $duration, $timeBuffer);

            $_SESSION['success'] = "Service added successfully!";
            header('Location: services');
            exit;
        }
    }

    public function deleteService()
    {
        $serviceId = $_GET['id'] ?? null;
        if ($serviceId) {
            $bookingModel = new Bookings();
            $hasAppointments = $bookingModel->checkServiceById($serviceId);

            if ($hasAppointments) {
                $_SESSION['error'] = "Cannot delete service. There are existing appointments for this service.";
                header('Location: services');
                exit;
            }

            $serviceModel = new Services();
            $serviceModel->deleteService($serviceId);
            $_SESSION['success'] = "Service deleted successfully!";
            header('Location: services');
            exit;
        } else {
            $_SESSION['error'] = "Invalid service ID!";
            header('Location: services');
            exit;
        }
    }

    public function updateService()
    {
        if (isset($_POST['submit'])) {
            $serviceId          = $_POST['serviceId'] ?? null;
            $serviceType        = trim($_POST['serviceType'] ?? '');
            $serviceName        = trim($_POST['serviceName'] ?? '');
            $serviceDescription = trim($_POST['serviceDescription'] ?? '');
            $details            = $_POST['details'] ?? [];
            $servicePrice       = trim($_POST['servicePrice'] ?? '');
            $duration           = trim($_POST['duration'] ?? '');
            $timeBuffer         = trim($_POST['timeBuffer'] ?? '');

            if (empty($serviceType) || empty($serviceName) || empty($serviceDescription) || empty($details) || empty($servicePrice) || empty($duration) || empty($timeBuffer)) {
                $_SESSION['error'] = "All fields are required!";
                header('Location: update-service?id=' . urlencode($serviceId));
                exit;
            }

            $serviceModel = new Services();
            $serviceModel->updateService($serviceId, $serviceType, $serviceName, $serviceDescription, $details, $servicePrice, $duration, $timeBuffer);

            $_SESSION['success'] = "Service updated successfully!";
            header('Location: services');
            exit;
        }
    }
}
