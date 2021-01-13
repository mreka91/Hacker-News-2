<?php

// declare(strict_types=1);
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
// require __DIR__ . '/app/users/avatar.php';


?>
<article>
    <h1>Sign up</h1>

    <form class="signUp" action="app/users/create.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <small class="form-text text-muted">Please provide your email address*</small>
        </div>
        <!-- /form-group -->
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Please write your password (passphrase)*</small>
        </div>
        <!-- /form-group -->
        <div class="form-group">
            <label for="confirmPassword"> Confirm Password</label>
            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" required>
            <small class="form-text text-muted">Please re-write your password (passphrase)*</small>
        </div>
        <!-- /form-group -->

        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
