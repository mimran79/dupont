<?php

namespace Models;

class Posts
{
    private function connectDB(): \PDO
    {
        $conn = new \PDO("mysql:host=localhost;dbname=xxxxxx", "xxxxxxxx", "xxxxxxxxx");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function getAllPosts()
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT id, title, excerpt, date FROM posts ORDER BY date DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPostById($id)
    {
        $pdo = $this->connectDB();
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveNewPost($title, $excerpt, $imageName, $content)
    {
        $pdo = $this->connectDB();
        $post = $pdo->prepare("INSERT INTO posts (title, excerpt, image, content, date) VALUES (?, ?, ?, ?, NOW())");
        return $post->execute([$title, $excerpt, $imageName, $content]);
    }

    public function updatePost($id, $title, $excerpt, $imageName, $content)
    {
        $pdo = $this->connectDB();
        $update = $pdo->prepare("UPDATE posts SET title = ?, excerpt = ?, image = ?, content = ?, date = NOW() WHERE id = ?");
        return $update->execute([$title, $excerpt, $imageName, $content, $id]);
    }

    public function deletePost($id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        return $request->execute([$id]);
    }
}
