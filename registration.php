<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php" ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>




<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = ['username' => "", 'email' => "", 'password' => ""];

    if (strlen($username) < 4) {
        $error['username'] = 'The username is too short';
    }
    if ($username == '') {
        $error['username'] = 'The username cannot be empty';
    }
    if (username_exists($username)) {
        $error['username'] = "The username Already exists, <a href='index.php'>Click here to login</a> ";
    }

    if ($email == '') {
        $error['email'] = 'The Email cannot be empty';
    }
    if (email_exists($email)) {
        $error['email'] = 'The email Already exists, Try another one';
    }
    if ($password == '') {
        $error['password'] = 'The password cannot be empty';
    }
    if (strlen($password) < 6) {
        $error['password'] = 'The Password is too short';
    }
    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    } //foreach
    if (empty($error)) {
        Register_user($username, $email, $password);
        login_user($username, $password);
    }
}
?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?> ">
                                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                            </div>
                            <div class=" form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>