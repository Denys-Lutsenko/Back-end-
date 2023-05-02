<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function saveComment($name, $email, $comment) {
    $fp = fopen('comment.csv', 'a');
    fputcsv($fp, array($name, $email, $comment));
    fclose($fp);
}

// TODO 2: ROUTING

// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Validate email
    if (!validateEmail($email)) {
        echo "Invalid email address";
        exit();
    }

    // Save comment
    saveComment($name, $email, $comment);
}

// TODO 4: RENDER: 1) view (html) 2) data (from php)

?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>

    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

                    <!-- guestBook html form   -->
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

                    <!-- render guestBook comments   -->
                    <?php
                    $comments = array_map('str_getcsv', file('comment.csv'));
                    foreach ($comments as $comment) {
                        echo '<p><strong>Name:</strong> ' . $comment[0] . '</p>';
                        echo '<p><strong>Email:</strong> ' . $comment[1] . '</p>';
                        echo '<p><strong>Comment:</strong> ' . $comment[2] . '</p>';
                        echo '<hr>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>