<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../../views/header.php';

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    if (isset($_POST['comment'], $_POST['commentId'])) {
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
        $commentId = filter_var($_POST['commentId'], FILTER_SANITIZE_NUMBER_INT);

        $query = 'UPDATE comments
              SET comment = :comment,
                  createdAt = datetime()
              WHERE commentId = :commentId';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }


        $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();
        // die(var_dump($statement));
    }
}


redirect('/');
