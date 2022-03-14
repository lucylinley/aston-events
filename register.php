<!DOCTYPE html>
<html lang="en">
<?php include_once 'header.html' ?>
<body>
<div class="mx-auto auth-form">
    <?php
    $message = null;
        if(isset($_POST['name'])) {
            include_once 'database-operations.php';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $password1 = $_POST['confirm-password'];
            if ($password == $password1) {
                register_organiser($name, $email, $phone, $password, $password1);
                header('Location:login.php');
                exit();
            }else{
                $message = 'Passwords did not match';
            }
        }
    ?>
    <form name="register-form" action="register.php" method="post">
        <h3>Organiser Registration</h3>
        <?php if($message) { ?>
            <div class="alert alert-danger"> <?php echo $message ?></div>
        <?php }?>
        <div class="form-group">
            <label>Enter organiser name </label>
            <input class="form-control" type="name" name="name" id="name" placeholder="John Doe">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label>Enter email </label>
            <input class="form-control" type="email" name="email" id="email" placeholder="example@mail.com">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label>Enter phone number </label>
            <input class="form-control" type="text" name="phone" id="phone" placeholder="999-999-9999">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label>Enter password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Enter password">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label>Confirm password</label>
            <input class="form-control" type="password" name="confirm-password" id="confirm-password" placeholder="Re-enter the password">
            <small class="text-danger"></small>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Register</button>
        <a class="mr-5" href="login.php">Login here</a>
    </form>
</div>
</body>
</html>
