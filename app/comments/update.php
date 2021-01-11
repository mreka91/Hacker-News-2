<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../../views/header.php';

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    if (isset($_POST['comment'], $_POST['id'])) {
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        $query = 'UPDATE comments
              SET comment = :comment,
                  createdAt = datetime()
              WHERE id = :id';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }


        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();
        // die(var_dump($statement));
    }
}


redirect('/');
