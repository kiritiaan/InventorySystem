

<?php
session_start();

include_once "./Model/dashbrd.php";

$dash =  new dashbrd();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $dash->id = $_POST['id'];
    $dash->user = $_POST['user'];
    $dash->name = $_POST['fname'];
    $dash->pass2 = $_POST['pass'];
    $dash->lastName = $_POST['lname'];
    $dash->add = $_POST['add'];
    $dash->email = $_POST['email'];
    $dash->phone = $_POST['phone'];
    if ($dash->UpdateMeStaff()) {
        $_SESSION['success'] = '';
        header("location: Dashboard.php");
    }
}


?>