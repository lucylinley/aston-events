<!DOCTYPE html>
<html lang="en">
<?php session_start(); include_once  'header.html' ?>
<body>
<?php
    $message = null;

    if(isset($_POST['username'])) {
        include_once 'database-operations.php';
        if ($user = login($_POST['username'], $_POST['password'])) {
//            print_r($user);
//            exit();
            $_SESSION['id'] = $user['id'];
            header('Location:index.php');
            exit();
        }else{
            $message = 'Incorrect email or password';
        }
    }
?>
    <div class="mx-auto auth-form">
        <form name="login-form" action="login.php" method="post">
            <h3>Organiser Login</h3>
            <?php if($message) { ?>
                <div class="alert alert-danger"> <?php echo $message ?></div>
            <?php }?>
            <div class="form-group">
                <label>Enter email </label>
                <input class="form-control" type="email" name="username" id="username">
                <small class="text-danger"></small>
            </div>

            <div class="form-group">
                <label>Enter password</label>
                <input class="form-control" type="password" name="password" id="password">
                <small class="text-danger"></small>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Login</button>
            <a class="mr-5" href="register.php">Register here</a>
        </form>
    </div>
</body>
</html>
