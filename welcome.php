<?php

// declare(strict_types=1);
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Welcome !</p>
    <h2> You have been registered successfully!</h2>
    <h5> You can log in now </h5>
</article>





<?php require __DIR__ . '/views/footer.php'; ?>
