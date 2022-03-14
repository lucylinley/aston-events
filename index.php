<!DOCTYPE html>
<html lang="en">
<?php session_start(); include_once 'header.html' ?>
<body>
<?php include_once 'nav.html' ?>
<?php
    $events = [];
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location:login.php');
        exit();
    }
    include_once 'database-operations.php';

    if (isset($_POST['interest_rating_id'])) {
        increase_interest_rating($_POST['interest_rating_id']);
    }
    if (isset($_GET['mine'])) {
//        print_r($_SESSION);
//        exit();
        $events =  organiser_events($_SESSION['id']);
    }else if (isset($_POST['category_filter']) && $_POST['category_filter'] != null){
        $events = filtered_events($_POST['category_filter']);
    }
    else{
        $events = all_events();
    }

?>
    <div class="container">
        <h2>Available events</h2>


        <div>
            <form class="form-inline" method="post" action="index.php">
               <label>Filter by category : </label> <select class=" form-control-sm" name="category_filter">
                    <option>---</option>
                    <option value="Sport">Sports</option>
                    <option value="Culture">Culture</option>
                    <option value="Other">Others</option>
                </select>
                <button class="btn btn-sm btn-primary">Search</button>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Place</th>
                <th scope="col">Time</th>
                <th scope="col">Interest Rating</th>
                <th scope="col">Organiser</th>
                <th>Interest</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
            <tr>
                <th scope="row"><?=$event['id']?></th>
                <td><?=$event['name']?></td>
                <td><?=$event['category']?></td>
                <td><?=$event['description']?></td>
                <td><?=$event['place']?></td>
                <td><?=$event['date_time']?></td>
                <td><?=$event['interest_rating']?></td>
                <td><?=$event['organiser_name']?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="number" hidden name="interest_rating_id" value="<?=$event['id']?>">
                        <button type="submit" class="btn btn-sm btn-primary">Show Interest</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
