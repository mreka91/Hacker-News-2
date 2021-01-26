<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete the user profile.
if ($_POST['delete'] === "delete") {
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM posts WHERE userId = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM likes WHERE userId = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM comments WHERE userId = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM replies WHERE user_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();


    unset($_SESSION['user']);

    redirect('../../index.php');
} else {
    successMessage("Please type in delete");
    redirect('../../editProfile.php');
}
