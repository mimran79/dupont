<?php

namespace Models;

class Schedules
{
    private function connectDB(): \PDO
    {
        $conn = new \PDO("mysql:host=localhost;dbname=xxxxxx", "xxxxxxxx", "xxxxxxxxx");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function update($scheduleId, $weekOpening, $weekClosing, $saturdayOpening, $saturdayClosing, $lunchStart, $lunchEnd)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE schedules SET weekOpening = ?, weekClosing = ?, saturdayOpening = ?, saturdayClosing = ?, lunchStart = ?, lunchEnd = ? WHERE id = ?");
        return $request->execute([$weekOpening, $weekClosing, $saturdayOpening, $saturdayClosing, $lunchStart, $lunchEnd, $scheduleId]);
    }

    public function read()
    {
        $pdo = $this->connectDB();
        $request = $pdo->query('SELECT * FROM schedules');
        return $request->fetch(\PDO::FETCH_ASSOC); // Added FETCH_ASSOC for clean array keys
    }
}
