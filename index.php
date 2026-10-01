<?php
session_start();

use Controllers\UserController;
use Controllers\ScheduleController;
use Controllers\ServiceController;
use Controllers\BookingController;
use Controllers\PostController;

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

set_exception_handler(function ($exception) {
    echo "<pre style='font-size: 15px; background: #1e1e1e; color: #f8f8f2; padding: 12px; font-family: monospace;'>";
    echo "<strong>Fatal error:</strong> " . htmlspecialchars($exception->getMessage()) . "\n\n";
    echo "<strong>Stack trace:</strong>\n" . htmlspecialchars($exception->getTraceAsString());
    echo "</pre>";
});

require 'Controllers/UserController.php';
require 'Controllers/ScheduleController.php';
require 'Controllers/ServiceController.php';
require 'Controllers/BookingController.php';
require 'Controllers/PostController.php';

$userController = new UserController();
$scheduleController = new ScheduleController();
$serviceController = new ServiceController();
$bookingController = new BookingController();
$postController = new PostController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = str_replace('/dupont', '', $path);
$route = str_replace('.php', '', $route);

// Protect all admin routes: redirect to home page if not an admin
if (strpos($route, '/admin') === 0) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = "You do not have permission to access this page.";
        header('Location: /dupont/');
        exit;
    }
}

if ($route === '' || $route === '/' || $route === '/index') {
    require 'views/home.php';
} else if (($route === '/about')) {
    require 'views/about.php';
} else if (($route === '/services')) {
    $services = $serviceController->checkServices();
    require 'views/services.php';
} else if (($route === '/news')) {
    $posts = $postController->getAllPosts();
    require 'views/posts.php';
} else if (($route === '/post')) {
    $postId = $_GET['id'];
    $post = $postController->getPostById($postId);
    require 'views/singlePost.php';
} else if (($route === '/login')) {
    require 'views/login.php';
} else if (($route === '/register')) {
    require 'views/register.php';
} else if ($route === '/register-user') {
    $userController->register();
} else if (($route === '/login-verify')) {
    $userController->loginVerify();
} else if ($route === '/logout') {
    $userController->logout();
}

//Patients Routes
elseif ($route === '/patient-dashboard') {
    if (!$_SESSION["name"]) {
        $_SESSION['error'] = "You must login to get access to this page!";
        header('Location:login');
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $bookingController = new BookingController();
    $appointments = $bookingController->getAppointments($user_id);

    require 'views/patient-dashboard.php';
} else if (($route === '/book')) {
    if ($_SESSION['role'] === 'patient') {
        $services = $serviceController->checkServices();
        require 'views/book.php';
    } else {
        $_SESSION['error'] = "You must register to book an apppointment";
        header('Location:login');
        exit;
    }
}
//Process Appointment Request
else if ($route === '/process-appointment') {
    if ($_SESSION['role'] === 'patient') {
        $userId = $_SESSION['user_id'];
        $serviceId = $_POST['service_id'];
        $appointmentDate = $_POST['date'];
        $appointmentTime = $_POST['appointment-time'];
        $bookingController = new BookingController();
        $bookingController->bookAppointment(
            $userId,
            $serviceId,
            $appointmentDate,
            $appointmentTime
        );
    } else {
        $_SESSION['error'] = "You must register to book an apppointment";
        header('Location:login');
        exit;
    }
} else if ($route === '/cancel-appointment') {
    if ($_SESSION['role'] === 'patient') {
        $appointmentId = $_GET['id'];
        $bookingController = new BookingController();
        $bookingController->deleteAppointment($appointmentId);
    } else {
        $_SESSION['error'] = "You must register to cancel an apppointment";
        header('Location:login');
        exit;
    }
} else if ($route === '/modify-appointment-form') {
    if ($_SESSION['role'] === 'patient') {
        $appointmentId = $_GET['id'];
        $bookingController = new BookingController();
        //Get appointment & Service details
        $appointmentDetails = $bookingController->getAppointmentById($appointmentId);
        $services = $serviceController->checkServices();
        require 'views/modify-appointment-form.php';
    } else {
        $_SESSION['error'] = "You must register to modify an apppointment";
        header('Location:login');
        exit;
    }
} else if ($route === '/process-modify-appointment') {
    if ($_SESSION['role'] === 'patient') {
        $appointmentId = $_POST['id'];
        $serviceId = $_POST['service_id'];
        $appointmentDate = $_POST['date'];
        $appointmentTime = $_POST['time'];

        $bookingController = new BookingController();
        $bookingController->modifyAppointment($appointmentId, $serviceId, $appointmentDate, $appointmentTime);
    } else {
        $_SESSION['error'] = "You must register to modify an apppointment";
        header('Location:login');
        exit;
    }
}
// Admin Routes
//Admin Dashboard Page
else if ($route === '/admin/index') {
    $totalPatients = $userController->countPatients();
    $totalAppointments = $bookingController->countAppointments();
    require 'views/admin/index.php';
}
//Admin Logout Function
else if ($route === '/admin/logout') {
    $userController->logout();
} else if ($route === '/admin/schedule') {
    $data = $scheduleController->checkSchedule();
    require 'views/admin/schedule.php';
}
//Confirm Appointment
else if ($route === '/admin/confirm-appointment') {
    $appointmentId = $_GET['id'];
    $bookingController->confirmAppointment($appointmentId);
    $_SESSION['success'] = "Appointment confirmed successfully!";
    header('Location: appointments');
    exit;
}
//Open & Closing Hours of the Clinic
else if ($route === '/admin/manage-schedule') {
    $schedule = $scheduleController->checkSchedule();
    require 'views/admin/manage-schedule.php';
    // Change schedule 
} else if ($route === '/admin/update-schedule') {
    $scheduleController->updateSchedule();
    //Services Routes
} else if ($route === '/admin/services') {
    $services = $serviceController->checkServices();
    require 'views/admin/services.php';
    //to display add service form
} else if ($route === '/admin/add-service-form') {
    require 'views/admin/add-service-form.php';
}
//To process/validate the add service form
else if ($route === '/admin/process-service') {
    $serviceController->processService();
} else if ($route === '/admin/delete-service') {
    $serviceController->deleteService();
} else if ($route === '/admin/update-service') {
    $serviceId = $_GET['id'] ?? null;
    $serviceModel = new \Models\Services();
    $service = $serviceModel->getServiceById($serviceId);
    require 'views/admin/edit-service-form.php';
} else if ($route === '/admin/process-update-service') {
    $serviceController->updateService();
}
///Patient Management Routes
else if ($route === '/admin/patients') {
    $patients = $userController->getAllPatients();
    require 'views/admin/patients.php';
} else if ($route === '/admin/delete-patient') {
    $id = $_GET['id'];
    $userController->deletePatient($id);
} else if ($route === '/admin/edit-patient-form') {
    $patientId = $_GET['id'] ?? null;
    $patient = $userController->getPatientById($patientId);
    require 'views/admin/edit-patient-form.php';
} else if ($route === '/admin/process-update-patient') {
    $userController->updatePatient();
}
//Appointments Management Routes
else if ($route === '/admin/appointments') {
    $appointments = $bookingController->getAllAppointments();
    require 'views/admin/appointments.php';
} else if ($route === '/admin/modify-appointment-form') {
    $appointmentId = $_GET['id'];
    $appointmentDetails = $bookingController->getAppointmentById($appointmentId);
    $services = $serviceController->checkServices();
    require 'views/admin/modify-appointment-form.php';
} else if ($route === '/admin/process-modify-appointment') {
    $appointmentId = $_POST['id'];
    $serviceId = $_POST['service_id'];
    $appointmentDate = $_POST['date'];
    $appointmentTime = $_POST['time'];

    $bookingController->modifyAppointment($appointmentId, $serviceId, $appointmentDate, $appointmentTime);
} else if ($route === '/admin/cancel-appointment') {
    $appointmentId = $_GET['id'];
    $bookingController->deleteAppointment($appointmentId);
}
//Admin Post Routes
else if ($route === '/admin/news') {
    $posts = $postController->getAllPosts();
    require 'views/posts.php';
} else if ($route === '/admin/post') {
    $postId = $_GET['id'];
    $post = $postController->getPostById($postId);
    require 'views/singlePost.php';
} else if ($route === '/admin/add-post-form') {
    require 'views/admin/add-post-form.php';
} else if ($route === '/admin/process-post') {
    $postController->processPost();
} elseif ($route === '/admin/edit-post') {
    $id = $_GET['id'];
    $post = $postController->getPostById($id);
    require 'views/admin/edit-post-form.php';
} else if ($route === '/admin/update-post') {
    $postController->UpdatePost();
} else if ($route === '/admin/delete-post') {
    $postId = $_GET['id'];
    $postController->deletePost($postId);
}

// Another page which does not exist

else {
    header('Location:/dupont/');
    exit;
}
