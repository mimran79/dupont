<?php

namespace Controllers;

use Models\Posts;

require 'Models/Posts.php';

class PostController
{
    public function getAllPosts()
    {
        $postModel = new Posts();
        return $postModel->getAllPosts();
    }

    public function getPostById($id)
    {
        $postModel = new Posts();
        return $postModel->getPostById($id);
    }

    public function processPost()
    {
        $title = $_POST['title'];
        $excerpt = $_POST['excerpt'];
        $content = $_POST['content'];

        if (empty($title) || empty($excerpt) || empty($content)) {
            $_SESSION['error'] = "All fields are required except the image";
            header('Location: add-post-form');
            exit;
        }

        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];

            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and WEBP files are allowed.";
                header('Location: add-post-form');
                exit;
            }

            $maxFileSize = 2 * 1024 * 1024; // 2MB
            if ($fileSize > $maxFileSize) {
                $_SESSION['error'] = "File size exceeds the 2MB limit.";
                header('Location: add-post-form');
                exit;
            }

            $imageName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = './views/uploads/';
            $dest_path = $uploadFileDir . $imageName;

            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                $_SESSION['error'] = "There was an error moving the uploaded file.";
                header('Location: add-post-form');
                exit;
            }
        }

        $postModel = new Posts();
        $data = $postModel->saveNewPost($title, $excerpt, $imageName, $content);
        if ($data) {
            $_SESSION['success'] = "New Post successfully added";
            header('Location:news');
            exit;
        }
    }

    public function updatePost()
    {
        $id = $_POST['post_id'];
        $title = $_POST['title'];
        $excerpt = $_POST['excerpt'];
        $content = $_POST['content'];

        $postModel = new Posts();
        $existingPost = $postModel->getPostById($id);

        $imageName = $existingPost['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];

            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and WEBP files are allowed.";
                header("Location: edit-post?id=$id");
                exit;
            }

            $maxFileSize = 2 * 1024 * 1024; // 2MB
            if ($fileSize > $maxFileSize) {
                $_SESSION['error'] = "File size exceeds the 2MB limit.";
                header("Location: edit-post?id=$id");
                exit;
            }

            $imageName = md5(time() . $fileName) . '.' . $fileExtension;

            // Delete old image safely if it exists
            if (!empty($existingPost['image'])) {
                $oldFile = './views/uploads/' . $existingPost['image'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $uploadFileDir = './views/uploads/';
            $dest_path = $uploadFileDir . $imageName;
            move_uploaded_file($fileTmpPath, $dest_path);
        }

        $data = $postModel->updatePost($id, $title, $excerpt, $imageName, $content);
        if ($data) {
            $_SESSION['success'] = "Post updated successfully.";
            header('Location:news');
            exit;
        }
    }

    public function deletePost($id)
    {
        $postModel = new Posts();
        $postData = $postModel->getPostById($id);
        $postImage = $postData['image'] ?? '';

        // Delete image safely if it exists
        if (!empty($postImage)) {
            $filePath = './views/uploads/' . $postImage;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $result = $postModel->deletePost($id);
        if ($result) {
            $_SESSION['success'] = "Post successfully deleted";
            header('Location:news');
            exit;
        }
    }
}
