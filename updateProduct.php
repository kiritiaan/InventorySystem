

<?php
session_start();
require_once "./Model/Prduct.php";
$prod = new Prduct();



if ($_GET['action'] === "update") {


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $prod->id = $_POST['id'];
        $val = $prod->getSingle();


        if (isset($_POST['save'])) {


            if (!is_dir("images")) {
                mkdir("images");
            }

            function randoms($n)
            {
                $charac = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $str = "";
                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($charac) - 1);
                    $str .= $charac[$index];
                }
                return $str;
            }



            $image = $_FILES['image'] ?? null;
            $fullpath = $val['ITEM_IMAGE'];


            if ($image && $image['tmp_name']) {


                if ($val['ITEM_IMAGE']) {
                    unlink($val['ITEM_IMAGE']);
                }

                $path = "images/";
                $folder = randoms(8) . "/";
                $ImName = $image['name'];

                $fullpath = $path . $folder . $ImName;
                mkdir(dirname($fullpath));

                move_uploaded_file($image['tmp_name'], $fullpath);
            }

            $prod->id = $_POST['ids'];
            $prod->prod = $_POST['prod'];
            $prod->price = $_POST['price'];
            $prod->desc = $_POST['desc'];
            $prod->img = $fullpath;

            if ($prod->UpdateMe()) {
                $_SESSION['updated'] = "PRODUCT IS UPDATED SUCCESSFULL!";
                header("Location: Product.php");
            };
        }
    }
}

?>