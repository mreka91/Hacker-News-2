<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Here we delete the replies

if (isset($_POST['id'])) {
    $replyId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userId = $_SESSION['user']['id'];


    $query = 'DELETE FROM replies
       WHERE id = :replyId AND user_id = :userId';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':replyId', $replyId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);


    $statement->execute();

    //show a success message and redirect back to the page
    if ($statement) {
        successMessage("Reply successfully deleted!");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
