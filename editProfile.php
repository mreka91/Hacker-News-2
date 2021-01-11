<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
$msgs = [];
$errors = [];
if (isset($_SESSION['user']['id'])) {
    $user = $_SESSION['user'];
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id =:id');


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
}

?>
<article>
    <h2>Edit your profile!</h2>

    <!-- /form-group -->
    <form class="avatarForm" action="app/users/editAvatar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="avatar">
            <?php if (!$user['avatar']) : ?>
                <img src="/assets/img/avatar.png" alt="default profile image">
            <?php else : ?>
                <?php if (file_exists(__DIR__ . '/app/users/uploads/' . $user['avatar'])) : ?>
                    <img src=" <?php echo '/app/users/uploads/' . $user['avatar']; ?>" alt="user's profile image">
                <?php endif; ?>
            <?php endif; ?>
            <input type="file" accept=".jpg, .jpeg, .png" name="avatar" class="avatar" id="avatar">
        </div>

        <button type="submit">Upload</button>
    </form>
    <!-- /form-group -->
    <form action="app/users/profile.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="firstName">First name</label>
            <input class="form-control" type="text" name="firstName" id="firstName" value="<?php echo $user['firstName']; ?>">
            <small class="form-text text-muted">Edit your first name*</small>

        </div>

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['lastName']; ?>">
            <small class="form-text text-muted">Edit your last name*</small>

        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
            <small class="form-text text-muted">Edit your email*</small>

        </div>

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea class="form-control" type="text" name="biography" id="biography"><?php echo $user['biography']; ?></textarea>
            <small class="form-text text-muted">Edit your biography*</small>

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
            <small class="form-text text-muted">Edit your password (passphrase)*</small>
        </div>

        <div class="form-group">
            <label for="confirmPassword"> Confirm Password</label>
            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" required>
            <small class="form-text text-muted">Please re-write your password (passphrase)*</small>
        </div>

        <button type="submit" name="submit">Edit profile </button>
    </form>
</article>