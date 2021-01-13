<nav class="navbar ">
    <a class="navbar-brand" href="index.php"><?php echo $config['title']; ?></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <?php if (!isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/create.php">Sign up</a>
            <?php endif; ?>
        </li><!-- /nav-item -->
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
        </li><!-- /nav-item-->

        <li class="nav-item">
            <a class="nav-link" href="/about.php">About</a>
        </li>
        <!--/nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/app/users/logout.php"> Log out </a>
            <?php else : ?>
                <a class="nav-link" href="/login.php">Log in</a>
            <?php endif; ?>
        </li>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/../editProfile.php">Edit Profile</a>
            <?php endif; ?>
        </li><!-- /nav-item -->
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/../personalPage.php">Your profile</a>
            <?php endif; ?>
        </li><!-- /nav-item -->

    </ul>
    <!--/navbar-nav -->
    <span class="open-slide">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a> </span>
    <div id="side-menu" class="side-nav">
        <a href="#" class="btn-close">&times;</a>
        <a class="nav-link" href="/index.php">Home</a>
        <a class="nav-link" href="/about.php">About</a>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="nav-link" href="/app/users/logout.php"> Log out </a>
        <?php else : ?>
            <a class="nav-link" href="/login.php">Log in</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="nav-link" href="/../editProfile.php">Edit Profile</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="nav-link" href="/../personalPage.php">Your profile</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user'])) : ?>
            <a class="nav-link" href="/create.php">Sign up</a>
        <?php endif; ?>
    </div>

</nav><!-- /navbar -->
