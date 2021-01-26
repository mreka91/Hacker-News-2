<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Here we add new comments to the replies table

if (isset($_POST['reply'])) {
    $commentId = filter_var($_POST['commentId'], FILTER_SANITIZE_NUMBER_INT);
    $postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);
    $content = filter_var($_POST['reply'], FILTER_SANITIZE_SPECIAL_CHARS);
    $userId = $_SESSION['user']['id'];


    $query = 'INSERT INTO replies (comment_id, user_id, post_id, content, created_at) VALUES (:commentId, :userId, :postId, :content, datetime())';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($database->errorInfo()));
    }

    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);

    $statement->execute();

    //show a success message and redirect back to the same page
    if ($statement) {
        successMessage("Reply successfully posted!");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
