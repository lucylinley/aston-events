<?php
    function connect(): mysqli
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "aston-events";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function run_update($sql) {
        if($conn = connect()) {
            $conn->query($sql);
            $conn->close();
        }
    }

    function register_organiser($name, $email, $phone, $password, $password1) {
        $sql = "insert into organisers(name , email, phone, password) value ('$name','$email','$phone','$password')";
        run_update($sql);
    }

    function create_event($name, $description, $date_time, $category, $place, $picture, $interest_rating, $organiser) {
        $sql = "insert into events(name, description, date_time, category, place, picture, interest_rating, organiser ) ".
            "values('$name', '$description', '$date_time', '$category', '$place', '$picture', $interest_rating, $organiser)";
        run_update($sql);
    }

    function increase_interest_rating($id) {
        run_update("update events set interest_rating = interest_rating + 1 where id = $id");
    }

    function run_query($sql , $one = false) {
//        echo $sql;
        if ($conn = connect()) {
            $result = $conn -> query($sql);
            if (!$one) {
                $rows = [];
                while ($row = $result->fetch_assoc()) {
                    array_push($rows, $row);
//                    echo $row;
                }
                $result -> free_result();
                $conn->close();
                return $rows;
            }else{
                $row = $result->fetch_assoc();
                $result -> free_result();
                $conn->close();
                return $row;
            }
        }
        return null;
    }

    function all_organisers() {
        return run_query("select * from organisers");
    }

    function all_events() {
        return run_query("select events.*, organisers.name as organiser_name from events inner join organisers on events.organiser = organisers.id");
    }


    function login($username, $password) {
        return run_query("select * from organisers where email = '$username' and password = '$password'", true);
    }

    function organiser_events($id) {

        return run_query("select events.*, organisers.name as organiser_name from events inner join organisers on events.organiser = organisers.id where events.organiser = $id ");
    }

    function filtered_events($category) {
        return run_query("select events.*, organisers.name as organiser_name from events inner join organisers on events.organiser = organisers.id where events.category = '$category' ");

    }


//print_r(organiser_events(1));
