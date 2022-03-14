<!DOCTYPE html>
<html lang="en">
<?php session_start(); include_once 'header.html' ?>
<body>
<?php include_once 'nav.html' ?>

<?php
    if (!isset($_SESSION['id'])) {
        header('Location:login.php');
        exit();
    }
    include_once 'database-operations.php';

    if (isset($_POST['name']) && isset($_POST['category'])) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $place = $_POST['place'];
        $date_time = $_POST['date_time'];
        create_event($name, $description, $date_time, $category, $place, '', 0, $_SESSION['id']);
        header('Location:index.php');
        exit();
    }
?>
<div class="mx-auto auth-form">
    <form name="create-event-form" action="create-event.php" method="post">
        <h3>Create Event</h3>

        <div class="form-group row">
            <div class="col-6">
                <label>Create Event </label>
                <input class="form-control" type="name" name="name" id="name" placeholder="Event name">
                <small class="text-danger"></small>
            </div>
            <div class="col-6">
                <label>Event Category </label>
                <select class="form-control" name="category">
                    <option disabled>--</option>
                    <option value="Sport">Sport</option>
                    <option value="Culture">Culture</option>
                    <option value="Other">Other</option>
                </select>
                <small class="text-danger"></small>
            </div>
        </div>

        <div class="form-group">
            <label>Event description </label>
             <textarea class="form-control" name="description"></textarea>
            <small class="text-danger"></small>
        </div>



        <div class="form-group">
            <label>Event place </label>
            <input class="form-control" type="text" name="place" id="place" placeholder="Place">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label>Event time</label>
            <input class="form-control" type="datetime-local" name="date_time" id="date_time" >
            <small class="text-danger"></small>
        </div>


        <button class="btn btn-primary mt-3" type="submit">Create Event</button>

    </form>
</div>
</body>
</html>
