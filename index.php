<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


$msgs = [];
$errors = [];



$statement = $pdo->query('SELECT * FROM posts ');
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement = $pdo->query('SELECT * FROM users');
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <article>

        <h1><?php echo $config['title']; ?></h1>

        <?php if (isset($_SESSION['user'])) : ?>
            <p>Welcome
                <?php echo $_SESSION['user']['firstName']; ?>
                !
            </p>
        <?php endif; ?>

        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>

        <?php if (isset($message)) : ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>

        <ul>
            <li>
                <a href="newestPosts.php"> Newest</a>
            </li>
            <li>
                <a href="mostPopular.php"> Most popular</a>
            </li>
            <li class="createPost">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a href="createPost.php"> Create your own post!</a>
                <?php endif; ?>
            </li>
        </ul>


        <div class="posts">
            <ol class="olPosts">
                <?php foreach ($posts as $post) : ?>
                    <li class="li">
                        <div class="title">
                            <a href="<?php echo $post['link']; ?>"> <?php echo $post['title']; ?></a>
                        </div>
                        <div class="description">
                            <p><?php echo $post['description']; ?></p>
                        </div>
                        <div class="time">
                            <?php echo $post['createdAt']; ?>
                        </div>
                        <input type="hidden" value="<?php $postId = $post['id']; ?>">

                        <div class="post">
                            <div class="content">
                                <div class="postSection">
                                    <div class="likeSection" ?>
                                        <div class="likeCounter">
                                            <?php if ($post['likes'] > 1) : ?>
                                                <?php echo $post['likes'] . ' ' . "likes"; ?>
                                            <?php else : ?>
                                                <?php echo $post['likes'] . ' ' . "like"; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (isset($_SESSION['user']['id'])) : ?>

                                            <?php $user = $_SESSION['user'];

                                            $userId = $_SESSION['user']['id'];

                                            $statement = $pdo->query('SELECT id FROM likes WHERE userId = :userId AND postId = :postId;');

                                            if (!$statement) {
                                                die(var_dump($pdo->errorInfo()));
                                            }
                                            $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
                                            $statement->bindParam(':postId', $postId, PDO::PARAM_STR);


                                            $statement->execute();

                                            $like = $statement->fetch(PDO::FETCH_ASSOC); ?>



                                            <div class="likeButton">
                                                <?php if ($like) : ?>
                                                    <!-- user already likes post -->
                                                    <form class="unlike" action="unlike.php" method="POST">
                                                        <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
                                                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                                        <input type="hidden" name="id" value="<?php echo $like['id']; ?>">
                                                        <button type="submit" class="unlike" name="unlike"> unlike </button>
                                                    </form>
                                                <?php else : ?>
                                                    <!-- user has not yet liked post -->
                                                    <form class="like" action="like.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                                        <button type="submit" class="like" name="like"> like </button>
                                                    </form>

                                                <?php endif; ?>
                                            <?php endif; ?>

                                            </div>
                                    </div>
                                    <!-- Add comment -->
                                    <?php if (isset($_SESSION['user']['id'])) : ?>
                                        <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                        <div class="commentAndChangePost">
                                            <div class="addComment">
                                                <a href="createComment.php?id=<?php echo $post['id']; ?>">Comment</a>
                                            </div>
                                        <?php endif; ?>

                                        <!-- edit and delete post -->
                                        <?php if (isset($_SESSION['user']['id'])) : ?>
                                            <?php if ($post['userId'] == $_SESSION['user']['id']) : ?>
                                                <!-- <div class="changePost"> -->
                                                <div class="editPost">
                                                    <a href="updatePost.php?id=<?php echo $post['id']; ?>"> Edit</a>
                                                </div>
                                                <div class="deletePost">
                                                    <a href="app/posts/delete.php?id=<?php echo $post['id']; ?>">Delete</a>
                                                </div>
                                                <!-- </div> -->
                                                <!-- </div> -->

                                            <?php endif; ?>
                                        <?php endif; ?>

                                        </div>
                                </div>

                                <div class="ulComments">
                                    <!-- <ul class="ulComments"> -->

                                    <?php $statement = $pdo->query('SELECT * FROM comments WHERE postId = :postId;'); ?>
                                    <?php
                                    if (!$statement) {
                                        die(var_dump($pdo->errorInfo()));
                                    } ?>

                                    <?php $statement->bindParam(':postId', $postId, PDO::PARAM_INT); ?>

                                    <?php $statement->execute(); ?>

                                    <?php $comments = $statement->fetchAll(PDO::FETCH_ASSOC); ?>


                                    <?php foreach ($comments as $comment) : ?>
                                        <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">

                                        <?php $statement = $pdo->prepare('SELECT *  FROM users
                                                                        INNER JOIN comments ON users.id = comments.userId;');
                                        ?>

                                        <?php if (!$statement) {
                                            die(var_dump($pdo->errorInfo()));
                                        } ?>
                                        <?php $statement->execute(); ?>
                                        <?php $user = $statement->fetch(PDO::FETCH_ASSOC); ?>


                                        <div class="author">
                                            <div class="userImage">
                                                <?php if (!$user['avatar']) : ?>
                                                    <img src="/assets/img/avatar.png" alt="default profile image">
                                                <?php else : ?>
                                                    <?php if (file_exists(__DIR__ . '/app/users/uploads/' . $user['avatar'])) : ?>
                                                        <img src=" <?php echo '/app/users/uploads/' . $user['avatar']; ?>" alt="user's profile image">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="user">
                                                <?php echo $user['firstName'] . ' ' . $user['lastName']; ?>
                                            </div>
                                        </div>
                                        <!-- <li class="liComment"> -->
                                        <div class="commentContent">
                                            <?php echo $comment['comment']; ?>
                                        </div>
                                        <div class="commentTime">
                                            <?php echo $comment['createdAt']; ?>
                                        </div>
                                        <div class="commentEdit">
                                            <?php if (isset($_SESSION['user']['id'])) : ?>
                                                <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                                                <input type="hidden" name="userId" value="<?php echo $userId; ?>">

                                                <?php if ($comment['userId'] == $_SESSION['user']['id']) : ?>
                                                    <a href="app/comments/delete.php?id=<?php echo $comment['id']; ?>">Delete</a>
                                                    <a href="updateComment.php?id=<?php echo $comment['id']; ?>">Edit</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <!-- </li> -->
                                    <?php endforeach; ?>
                                    <!-- </ul> -->
                                    <!-- <button class="moreComments">Show more comments</button> -->
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>

        </div>


    </article>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>
