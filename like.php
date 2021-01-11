<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

if (isset($_POST['like'])) {



    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);

    // die(var_dump($userId));
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);


    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    // add +1 like to the existed likes
    $likes = $post['likes'];
    $n = $likes + 1;

    // update the number of likes
    $query = 'UPDATE posts
    SET likes = :n
    WHERE id =  :id ';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':n', $n, PDO::PARAM_INT);

    $statement->execute();

    // insert to likes table
    $query = 'INSERT INTO likes (userId , postId ) VALUES (:userId, :id)';
    // $id = $like['postId'];
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}
redirect('/');
// }
// if (isset($_POST['unlike'])) {


//     $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
//     $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);


//     $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');

//     if (!$statement) {
//         die(var_dump($pdo->errorInfo()));
//     }
//     $statement->bindParam(':id', $id, PDO::PARAM_INT);


//     $statement->execute();

//     $post = $statement->fetch(PDO::FETCH_ASSOC);
//     // add +1 like to the existed likes
//     $likes = $post['likes'];
//     $n = $likes - 1;

//     // update the number of likes
//     $query = 'UPDATE posts
// SET likes = :n
// WHERE id = :id ';

//     $statement = $pdo->prepare($query);

//     if (!$statement) {
//         die(var_dump($pdo->errorInfo()));
//     }

//     $statement->bindParam(':id', $id, PDO::PARAM_INT);
//     $statement->bindParam(':n', $n, PDO::PARAM_INT);

//     $statement->execute();

//     // delete from likes table
//     $query = 'DELETE FROM likes WHERE id = :id';

//     $statement = $pdo->prepare($query);

//     if (!$statement) {
//         die(var_dump($pdo->errorInfo()));
//     }
//     // $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
//     $statement->bindParam(':id', $id, PDO::PARAM_INT);
//     $statement->execute();
//     // die(var_dump($n));
// }
// // }



















// // if (isset($post['userId'], $post['postId'])) {
// //     $userId = filter_var($post['userId'], FILTER_SANITIZE_NUMBER_INT);
// //     $postId = filter_var($post['postId'], FILTER_SANITIZE_NUMBER_INT);

// //     die(var_dump($post['userId'], $post['postId']));
// //     // if (isset($_SESSION['user']['id'])) {

// //     //     $userId = $_SESSION['user']['id'];

// //     // if (isset($_POST['likesNumber'])) {
// //     //     $count = filter_var($_POST['likeButton'], FILTER_SANITIZE_NUMBER_INT);


// //     $query = 'INSERT INTO likes (userId, postId, likesNumber) VALUES (:userId, :postId, :likesNumber )';

// //     $statement = $pdo->prepare($query);

// //     if (!$statement) {
// //         die(var_dump($pdo->errorInfo()));
// //     }

// //     $statement->bindParam(':likesNumber', $likesNumber, PDO::PARAM_INT);
// //     $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
// //     $statement->bindParam(':postId', $postId, PDO::PARAM_INT);



// //     $statement->execute();
// // }
// // }
// // }
