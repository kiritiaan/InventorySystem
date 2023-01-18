

<?php

require_once "./Model/Ordr.php";
$ord = new Ordr();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['save'])) {

        $ord->id = $_POST['id'];

        if ($ord->deleteData()) {
            header("Location: Order.php");
        };
    }
}


?>