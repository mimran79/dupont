<?php

namespace Models;

class Services
{
    private function connectDB(): \PDO
    {
        $conn = new \PDO("mysql:host=localhost;dbname=xxxxxx", "xxxxxxxx", "xxxxxxxxx");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function getAllServices()
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('SELECT * FROM services');
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getServiceById($serviceId)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('SELECT * FROM services WHERE id = ?');
        $request->execute([$serviceId]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveService($serviceType, $serviceName, $serviceDescription, $details, $servicePrice, $duration, $timeBuffer)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('INSERT INTO services (type, name, description, details, price, duration, timeBuffer) VALUES (?, ?, ?, ?, ?, ?, ?)');
        // If details is an array, encode it here too for consistency: json_encode($details)
        $request->execute([$serviceType, $serviceName, $serviceDescription, is_array($details) ? json_encode($details) : $details, $servicePrice, $duration, $timeBuffer]);
    }

    public function updateService($serviceId, $serviceType, $serviceName, $serviceDescription, $details, $servicePrice, $duration, $timeBuffer)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('UPDATE services SET type = ?, name = ?, description = ?, details = ?, price = ?, duration = ?, timeBuffer = ? WHERE id = ?');
        $request->execute([$serviceType, $serviceName, $serviceDescription, is_array($details) ? json_encode($details) : $details, $servicePrice, $duration, $timeBuffer, $serviceId]);
    }

    public function deleteService($serviceId)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('DELETE FROM services WHERE id = ?');
        $request->execute([$serviceId]);
    }
}
