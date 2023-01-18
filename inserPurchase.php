<?php


require_once "./Model/Ordr.php";
$order = new Ordr();

echo $_POST['Code'];


if ($_GET['action'] === "insert") {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if (isset($_POST['save'])) {


            $staffId = $_POST['staff'];
            $order->Item_id = $_POST['Code'];
            $order->Staff_id = $staffId;
            $order->quan = $_POST['Quantity'];

            if ($order->inserted()) {
                header("Location: Order.php");
            };
        }
    }
}
