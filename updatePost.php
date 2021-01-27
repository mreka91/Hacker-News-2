<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM posts WHERE id =:id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<article>

    <form class="PostUpdate" style="margin-top: 40px; " action="app/posts/update.php" method="post">

        <input type="hidden" id="id" name="id" value="<?php echo $post['id']; ?>">

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
            <small class="form-text text-muted">Please write the title*</small>
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="link" name="link" id="link" value="<?php echo $post['link']; ?>">
            <small class="form-text text-muted">Please write the link*</small>
        </div>

        <div class="description">
            <label for="description">Description </label>
            <textarea rows="20" cols="50" class="form-control" name="description" id="description"><?php echo $post['description']; ?></textarea>
            <small class="form-text text-muted"> Tell us what do your think!*</small>
        </div>

        <button type="submit" name="submit">Update</button>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
