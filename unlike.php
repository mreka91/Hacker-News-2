<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

if (isset($_POST['unlike'], $_POST['id'], $_POST['postId'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
    $postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);


    $query = 'DELETE FROM likes WHERE id = :id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    // $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    // die(var_dump($id));
    $statement->execute();
    // die(var_dump($n));



    $statement = $pdo->prepare('SELECT * FROM posts WHERE  id = :postId');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);


    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    // add +1 like to the existed likes
    $likes = $post['likes'];
    $n = $likes - 1;

    // update the number of likes
    $query = 'UPDATE posts
    SET likes = :n
    WHERE id = :postId ';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':n', $n, PDO::PARAM_INT);

    $statement->execute();
    // die(var_dump($n));
    // delete from likes table

}
// }


redirect('/');
