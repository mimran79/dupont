<?php

namespace Controllers;

use Models\Schedules;

require 'Models/Schedules.php';

class ScheduleController
{
    public function updateSchedule()
    {
        if (isset($_POST['submit'])) {
            $weekOpening      = $_POST['weekdayOpening'];
            $weekClosing      = $_POST['weekdayClosing'];
            $saturdayOpening  = $_POST['saturdayOpening'];
            $saturdayClosing  = $_POST['saturdayClosing'];
            $lunchStart       = $_POST['lunchStart'];
            $lunchEnd         = $_POST['lunchEnd'];
            $scheduleId       = $_POST['scheduleId'];

            if (empty($scheduleId) || empty($weekOpening) || empty($weekClosing) || empty($saturdayOpening) || empty($saturdayClosing) || empty($lunchStart) || empty($lunchEnd)) {
                $_SESSION['error'] = "All fields are required";
                header('Location: /dupont/admin/manage-schedule');
                exit;
            }

            $schedule = new Schedules();
            $schedule->update($scheduleId, $weekOpening, $weekClosing, $saturdayOpening, $saturdayClosing, $lunchStart, $lunchEnd);

            $_SESSION['success'] = "Schedule updated successfully!";
            header('Location: /dupont/admin/schedule');
            exit;
        }
    }

    public function checkSchedule()
    {
        $schedule = new Schedules();
        return $schedule->read();
    }
}
