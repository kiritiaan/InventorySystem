

<?php

include_once "./Model/sqlnotification.php";

$notify = new sqlnotification();


if (isset($_POST['view'])) {

    $depleted = '';
    if (count($notify->showdepleted()) > 0) {
        $r = $notify->showdepleted();


        foreach ($r as $val) {
            extract($val);

            $depleted .= '
            <li>
            <a class="dropdown-item" href="Product.php">
<strong class="text text-primary">' . $ITEM_NAME . '</strong> <em> is <small class="text text-success">depleted </small> product.</a>
            </li></em> 
            ';
        }
    }

    $pending = '';
    if (count($notify->showdepleted()) > 0) {
        $s = $notify->showPending();


        foreach ($s as $val) {
            extract($val);

            $pending .= '
            <li>
            <a class="dropdown-item" href="pendingProduct.php"><strong class="text text-success">' . $ITEM_NAME . '</strong><em> is a <small class="text text-danger"> pending </small> product. </a>
            </li></em> 
            ';
        }
    }

    $inactive = '';
    if (count($notify->showInactive()) > 0) {
        $s = $notify->showInactive();


        foreach ($s as $val) {
            extract($val);

            $inactive .= '
            <li>
            <a class="dropdown-item" href="InactiveProduct.php"><strong class="text text-pink">' . $ITEM_NAME . '</strong><em> is an <small class="text text-danger"> inactive </small> product. </a>
            </li></em> 
            ';
        }
    }


    $count = $notify->count();

    $data = array(
        'depleted' => $depleted,
        'pending' => $pending,
        'inactive' => $inactive,
        'unseen' => $count
    );
    echo json_encode($data);
}

?>

