<?php

// declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (isset($_GET['id'])) {
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM posts WHERE id =:id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);

    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
}
?>
<!-- <article> -->
<form class="storeComment" action="/app/comments/store.php" method="post">
    <input type="hidden" id="postId" name="postId" value="<?php echo $postId; ?>">
    <textarea rows="4" cols="50" class="form-control" name="comment" id="comment" placeholder="Write here..." required></textarea>
    <small class="form-text text-muted"> Add a comment!</small>


    <button type="submit" name="submit">submit</button>
</form>

<!-- </article> -->

<?php require __DIR__ . '/views/footer.php'; ?>
