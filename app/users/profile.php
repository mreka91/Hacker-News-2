<?php

require __DIR__ . '/../autoload.php';

require __DIR__ . '/../../views/header.php';

$errors = [];

if (isset($_SESSION['user']['id'])) {
    $user = $_SESSION['user'];
    $id = $_SESSION['user']['id'];

    if (isset($_POST['biography'], $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['confirmPassword'])) {
        $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($password != $confirmPassword) {
            $msg = "Please Check Your Password!";
            redirect('/editProfile.php');
        }

        $query = 'UPDATE users
            SET email = :email,
             biography = :biography,
             firstName = :firstName,
             lastName = :lastName,
            password = :hash
            WHERE id =  :id ';


        $statement = $pdo->prepare($query);


        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindValue(':biography', $biography, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindValue(':hash', $hash, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute();
    }
}

redirect('/');
