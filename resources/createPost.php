<?php

// declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

?>

<!-- <article> -->
<form class="createPost" action="/app/posts/store.php" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" required>
        <small class="form-text text-muted">Please write the title*</small>
    </div>
    <!-- /form-group -->
    <div class="form-group">
        <label for="link">Link</label>
        <input class="form-control" type="link" name="link" id="link" required>
        <small class="form-text text-muted">Please write the link*</small>
    </div>

    <div class="description">
        <textarea rows="20" cols="42" class="form-control" name="description" id="description" placeholder="Write here..." required></textarea>
        <small class="form-text text-muted"> Tell us what do your think!*</small>
    </div>
    <button type="submit" name="submit">submit</button>
</form>

<!-- </article> -->


<?php require __DIR__ . '/views/footer.php'; ?>
