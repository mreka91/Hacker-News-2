<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_GET['commentId'])) {
    $commentId = filter_var($_GET['commentId'], FILTER_SANITIZE_NUMBER_INT);


    $query = 'DELETE FROM comments
       WHERE commentId = :commentId';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);


    $statement->execute();
}

redirect('/');
