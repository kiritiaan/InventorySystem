<?php

$page = "Order";
include 'site/protected.php';
?>


<?php


include_once './config/Database/Database.php';
$dt = new Database();
$conn = $dt->getConnect();

$role = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    $role = $_POST['role'];
    $pass = $_POST['password'];

    $statement = $conn->prepare("SELECT * FROM staff WHERE staff_pass = :staff_pass AND role_id = :role_id");
    $statement->bindValue(':role_id', $role);
    $statement->bindValue(':staff_pass', $pass);
    $statement->execute();
    $arr = $statement->fetch(PDO::FETCH_ASSOC);

    if (empty($arr)) {
        $arr = [];
        $message = 'Invalid Credintials';
    } else {
        if ($arr['role_id'] === $role || $arr['staff_pass'] === $pass) {

            $_SESSION['adminId'] = $role;
            header('location: Order.php');
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once "./site/title.php" ?>
    <link rel="stylesheet" href="styles/Cust.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./styles/security.css">

    <?php
    require_once "styles/stylish.php";
    ?>
</head>

<body>
    <?php include 'site/hamburger.php' ?>
    <?php include 'site/sidebar.php' ?>
    <?php include_once "./site/dataUser.php" ?>


    <div class="parent">

        <form action="" method="post">
            <div class="Box">

                <img src="Img/Logo.png" srcset="" width="400px">
                INPUT PASSWORD TO OPEN
                <input type="hidden" value="1" name="role">
                <input type="password" placeholder="PASSWORD" name="password">
                <div class="messages">
                </div>
                <button type="submit">SUBMIT</button>
            </div>

        </form>

    </div>



    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <?php require_once "./styles/updateAccount.php" ?>
    <?php require_once "scripts/jquaryScript.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
    <script src="./scripts/sweetalert.min.js"></script>

    <?php if (isset($message)) : ?>

        <script>
            swal({
                title: "Invalid Credintials!",
                text: "Only admin can access this site, Thank you!",
                icon: "error",
                button: "OK",
            });
        </script>



    <?php endif; ?>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                select: true
            });

            notify();

            function load() {
                document.querySelector('.load').classList.add('loader--hidder');
            }
            var c = setInterval(load, 2000);

            document.querySelector('.load').addEventListener("transitionend", () => {
                document.body.removeChild(document.querySelector('.load'));


                clearInterval(c);
            })
        });

        $('#notch').on('click', function() {
            $('#pendings').hide();
        })



        function saveBtn() {

            var $staff = $('#staff').val();
            var $supp = $('#supplr').val();
            var $code = $('#prod_id').val();
            var $quan = $('#quan').val();

            $.post('orderOperation.php', {
                staff: $staff,
                code: $code,
                quan: $quan,
                supp: $supp,
                action: 'insertOrder'
            }, function(data, status) {

                location.reload();

            })

        }


        $('#supplr').change(function() {
            var $op = $('#supplr option:selected').val();
            var $fill = $('#placehere');

            $.post('orderOperation.php', {
                catId: $op,
                action: 'getProductss'
            }, function(data, status) {
                $fill.html(data);
                document.getElementById('placehere').removeAttribute('disabled');
            })


        })


        $('#placehere').change(function() {
            var $op = $('#placehere option:selected').val();
            var $fill = $('#placeme');

            $.post('orderOperation.php', {
                catId: $op,
                action: 'placeProd'
            }, function(data, status) {
                $fill.html(data);



            })


        })









        function saveBtn2() {

            var $staff = $('#staff2').val();
            var $code = $('#prod_id2').val();
            var $quan = $('#quan2').val();
            var $supp = $('#supplr2').val();
            var $fill = $('#placehere2').val();


            $.post('orderOperation.php', {
                staff: $staff,
                code: $code,
                quan: $quan,
                supp: $supp,
                action: 'insertOrder2'
            }, function(data, status) {
                location.reload();

            })


        }


        $('#supplr2').change(function() {
            var $op = $('#supplr2 option:selected').val();
            var $fill = $('#placehere2');

            $.post('orderOperation.php', {
                catIds: $op,
                action: 'getMetheProduct'
            }, function(data, status) {
                console.log($fill.html(data));
                document.getElementById('placehere2').removeAttribute('disabled');
            })


        })


        $('#placehere2').change(function() {
            var $op = $('#placehere2 option:selected').val();
            var $fill = $('#placeme2');

            $.post('orderOperation.php', {
                catId: $op,
                action: 'placeProd2'
            }, function(data, status) {
                $fill.html(data);



            })


        })




        function mykey(value) {

            var $onhand = $('#onhand').val();
            var $price = $('#price').val();
            var sum, prod;

            if (value != 0) {
                sum = parseInt($onhand) + parseInt(value);
                prod = parseInt($price) * parseInt(sum);
            }



            $('#total_quan').val(sum);
            $('#total_quan2').val(prod);




        }




        $('#pashere').change(function() {
            var $op = $('#pashere option:selected').val();
            var $fill = $('#pashere2');
            $.post('orderOperation.php', {
                code: $op,
                action: 'fillOut'
            }, function(data, status) {
                $fill.html(data);

            })

        })

        function notify(view = "") {

            $.ajax({
                url: 'notification.php',
                method: 'post',
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data, status) {

                    $('.dropdown-menu').html(data.depleted + data.pending + data.inactive);
                    if (data.unseen != 0) {
                        $('#pendings').text(data.unseen);

                    } else {
                        $('#pendings').hide();
                    }


                }
            })
        }

        function getId(id) {


            var thing = $('#ViewUpdate');

            $.post('ProdOperation.php', {

                ProdId: id,
                action: 'getSingleProd'
            }, function(data, status) {

                thing.html(data);
            })
        }



        function returns() {
            location.reload();
        }
    </script>


</body>


</html>