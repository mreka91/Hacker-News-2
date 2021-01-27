<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../../views/header.php';
// In this file we store/insert new posts in the database.


if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];


    $statement = $pdo->query('SELECT users.id FROM users
                              INNER JOIN posts
                              ON users.id = posts.userId');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);


    if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

        $query = 'INSERT INTO posts (userId, title, link, description,createdAt, likes) VALUES (:userId, :title, :link, :description, datetime(), 0)';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':link', $link, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);



        $statement->execute();
    }
}

redirect('/');
