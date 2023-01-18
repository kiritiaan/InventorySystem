<?php
$page = "staff";
include 'site/protected.php';

require_once "./Model/Stff.php";
$staff = new Stff();
$profile = $staff->showCustomer();
$role = $staff->role();


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
    <link rel="stylesheet" href="./styles/loader.css">

    <?php
    require_once "styles/stylish.php";
    ?>
</head>

<body>



    <?php include 'site/hamburger.php' ?>
    <?php include 'site/sidebar.php' ?>
    <?php include 'site/loads.php' ?>
    <?php include_once "./site/dataUser.php" ?>

    <div class="red">

        <section class="con">
            <a href="SecurityCheck.php" class="btn btn-danger">LOG - OUT</a>
            <h2>STAFF</h2>
            <div>

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>LastName</th>
                            <th>Address</th>
                            <th>PhoneNumber</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($profile as $value) : extract($value) ?>
                            <tr>



                                <td><?php echo $STAFF_FNAME ?></td>
                                <td><?php echo $STAFF_LNAME ?></td>
                                <td><?php echo $STAFF_ADDRESS ?></td>
                                <td><?php echo $STAFF_PHONENUM ?></td>
                                <td class=" text-danger text-center text-uppercase text-bold"><?php echo $roles ?></td>
                                <td class="butt">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getId(<?php echo $STAFF_ID ?>)"><i class="fa-regular fa-pen-to-square"></i></a></i>

                                    <a href="" data-bs-toggle="modal" data-bs-target="#View">
                                        <i class="fa-sharp fa-solid fa-eye-slash" onclick="viewSingle(<?php echo $STAFF_ID ?>)"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="sideBtn">

                    <!-- Button trigger modal -->

                    <div id="addBtn">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-plus"></i>ADD STAFF
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD STAFF</h1>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>


                                <div class="modal-body">

                                    <div class=" mb-3">
                                        <label class="form-label">First name:</label>
                                        <input type="text" class="form-control" placeholder="Name" id="Fname" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Last name:</label>
                                        <input type="text" class="form-control" placeholder="Lastname" id="Lname" name="lastname">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone number:</label>
                                        <input type="number" class="form-control" placeholder="Phone number" id="Pnum" name="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Location:</label>
                                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Select role:</label>
                                        <select class="form-select" id="roles">
                                            <option selected disabled="">Choose...</option>
                                            <?php foreach ($role as $value) : extract($value) ?>
                                                <option value="<?php echo $role_id ?>"><?php echo $roles ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <div class="border border-secondary p-3">
                                        <div class=" form-floating mb-3">
                                            <input type="email" class="form-control" placeholder="Username" id="User" name="name">
                                            <label for="floatingInput">Username</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" placeholder="Password" id="Pass" name="name">
                                            <label for="floatingPassword">Password</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary save" onclick="saveBtn()">Save</button>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
        </section>



    </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="ViewUpdate">


            </div>
        </div>
    </div>





    <!-- View -->
    <div class="modal fade" id="View" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMATION</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="expand">
                        <div class="card-body" id="ViewPage">

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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

        function saveBtn() {

            var $user = $('#User').val();
            var $pass = $('#Pass').val();
            var $name = $('#Fname').val();
            var $last = $('#Lname').val();
            var $phone = $('#Pnum').val();
            var $email = $('#email').val();
            var $add = $('#address').val();
            var $role = $('#roles').val();



            if ($name == "" || $last == "" || $phone == "" || $email == "" || $add == "" || $role == "") {
                swal({
                    title: "Warning!",
                    text: "Please input all fields",
                    icon: "error",
                    button: "OK",
                });
            } else {

                $.post('operation.php', {
                    user: $user,
                    pass: $pass,
                    name: $name,
                    lastname: $last,
                    address: $add,
                    email: $email,
                    phone: $phone,
                    role: $role,
                    action: 'insertStaff'
                }, function(data, status) {

                    location.reload();
                    $('#User').val("");
                    $('#Pass').val("");
                    $('#Fname').val("");
                    $('#Lname').val("");
                    $('#Pnum').val("");
                    $('#email').val("");
                    $('#address').val("");

                    var flag = true;
                    swal({
                        title: "Good job!",
                        text: "Staff is added successfully!",
                        icon: "success",
                        button: "Done",
                    });


                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                })

            }





        }

        $('#notch').on('click', function() {
            $('#pendings').hide();
        })



        function deleteOne(id) {

            $.post('operation.php', {

                Cus_id: id,
                action: 'deleteStaff'
            }, function(data, status) {

                location.reload();
                console.log(status);
            })
        }

        function getId(id) {


            var thing = $('#ViewUpdate');

            $.get('operation.php', {

                Cus_id: id,
                action: 'getSingleStaff'
            }, function(data, status) {

                thing.html(data);
            })
        }

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


        function viewSingle(id) {


            var thing = $('#ViewPage');

            $.get('operation.php', {

                id: id,
                action: 'viewSingleStaff'
            }, function(data, status) {

                thing.html(data);
            })
        }

        function updateME(id) {

            var $name = $('#fname').val();
            var $last = $('#lname').val();
            var $add = $('#add').val();
            var $email = $('#emls').val();
            var $phone = $('#nums').val();




            $.post('operation.php', {
                id: id,
                name: $name,
                lastname: $last,
                address: $add,
                email: $email,
                phone: $phone,
                action: 'updatingStaff'
            }, function(data, status) {

                var flag = true;
                swal({
                    title: "Good job!",
                    text: "Updated successfully!",
                    icon: "success",
                    button: "Done",
                });


                setTimeout(function() {
                    location.reload();
                }, 1000);


            })
        }
    </script>




</body>

</html>