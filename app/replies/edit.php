<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Here we edit the replies

if (isset($_POST['id'], $_POST['content'])) {
    $replyId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $commentId = filter_var($_POST['commentId'], FILTER_SANITIZE_NUMBER_INT);

    $editedContent = filter_var($_POST['content'], FILTER_SANITIZE_STRING);



    $userId = $_SESSION['user']['id'];

    $query = 'UPDATE replies
    SET content = :editedContent
    WHERE id = :replyId AND comment_id = :commentId  AND user_id = :userId';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':editedContent', $editedContent, PDO::PARAM_STR);
    $statement->bindParam(':replyId', $replyId, PDO::PARAM_INT);
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);

    $statement->execute();

    //show a success message and redirect back to the page
    if ($statement) {
        successMessage("Reply successfully edited!");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
