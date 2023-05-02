<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$aConfig = require_once 'config.php';


function saveComment($name, $email, $comment) {
    $aConfig = require 'config.php';
    $db = mysqli_connect($aConfig['host'], $aConfig['user'], $aConfig['pass'], $aConfig['name']);
    mysqli_query($db, "INSERT INTO comments (email, name, text) VALUES ('$email', '$name', '$comment')");
    mysqli_close($db);
}


function getComments(){
    $aConfig = require 'config.php';
    $db = mysqli_connect($aConfig['host'], $aConfig['user'], $aConfig['pass'], $aConfig['name']);
    $dbpull = mysqli_query($db, 'SELECT * FROM comments');
    $comments = mysqli_fetch_all($dbpull, MYSQLI_ASSOC);
    mysqli_close($db);
    return $comments;
}
function render($comments){
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            echo '<p><strong>Name:</strong> ' . $comment['name'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $comment['email'] . '</p>';
            echo '<p><strong>Comment:</strong> ' . $comment['text'] . '</p>';
            echo '<hr>';
        }
    }

}

// TODO 2: ROUTING

// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    if (empty($name)) {
        $errors[] = 'Name is required';
    }

    if (empty($comment)) {
        $errors[] = 'Comment is required';
    }

    if (!validateEmail($email)) {
        $errors[] = 'Invalid email address';
    }

    if (empty($errors)) {
        saveComment($name, $email, $comment);
        $name = '';
        $email = '';
        $comment = '';
    }
}

// TODO 4: RENDER: 1) view (html) 2) data (from php)

?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <?php require_once 'sectionNavbar.php' ?>
    <br>

    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

                    <form method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <div class="error">
                            <label for="error"><?php if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo '<p><strong>Error:</strong> ' . $error . '</p>';
                                }
                            }?></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Сomments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">

                    <?php
                    render(getComments());
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>