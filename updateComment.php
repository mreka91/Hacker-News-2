<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM comments WHERE id =:id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $comment = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<article>

    <form action="app/comments/update.php" method="post">

        <input type="hidden" id="id" name="id" value="<?php echo $comment['id']; ?>">

        <textarea rows="4" cols="50" class="form-control" name="comment" id="comment"><?php echo $comment['comment']; ?></textarea>

        <button type="submit" name="update">Update</button>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
