

  
   <?php

    require_once "./Model/Cstomer.php";
    require_once "./Model/Spplier.php";
    require_once "./Model/Stff.php";
    require_once "./Model/Ctegory.php";


    $cust = new Cstomer();
    $supp = new Spplier();
    $staff = new Stff();
    $cat =  new Ctegory();


    /* CUSTOMER OPERATION */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if ($_POST['action'] === 'insert') {


            $cust->name = $_POST['name'];
            $cust->lastName = $_POST['lastname'];
            $cust->add = $_POST['address'];
            $cust->email = $_POST['email'];
            $cust->phone = $_POST['phone'];
            $cust->inserted();
        }

        if ($_POST['action'] === 'delete') {


            $cust->id = $_POST['Cus_id'];
            $cust->deleteData();
        }

        if ($_POST['action'] === 'updating') {

            $cust->id = $_POST['id'];
            $cust->name = $_POST['name'];
            $cust->lastName = $_POST['lastname'];
            $cust->add = $_POST['address'];
            $cust->email = $_POST['email'];
            $cust->phone = $_POST['phone'];
            $cust->UpdateMe();
        }


        /* Supplier function */

        if ($_POST['action'] === 'insertSupp') {


            $supp->name = $_POST['name'];
            $supp->lastName = $_POST['lastname'];
            $supp->add = $_POST['address'];
            $supp->company = $_POST['comp'];
            $supp->phone = $_POST['phone'];
            $supp->inserted();
        }

        if ($_POST['action'] === 'deleteSupp') {


            $supp->id = $_POST['Cus_id'];
            $supp->deleteData();
        }

        if ($_POST['action'] === 'updatingSupp') {

            $supp->id = $_POST['id'];
            $supp->name = $_POST['name'];
            $supp->lastName = $_POST['lastname'];
            $supp->add = $_POST['address'];
            $supp->company = $_POST['company'];
            $supp->phone = $_POST['phone'];
            $supp->UpdateMe();
        }




        /* Staff function */

        if ($_POST['action'] === 'insertStaff') {


            $staff->Username = $_POST['user'];
            $staff->password = $_POST['pass'];
            $staff->name = $_POST['name'];
            $staff->lastName = $_POST['lastname'];
            $staff->add = $_POST['address'];
            $staff->email = $_POST['email'];
            $staff->phone = $_POST['phone'];
            $staff->role = $_POST['role'];
            $staff->inserted();
        }

        if ($_POST['action'] === 'deleteStaff') {


            $staff->id = $_POST['Cus_id'];
            $staff->deleteData();
        }

        if ($_POST['action'] === 'updatingStaff') {

            $staff->id = $_POST['id'];
            $staff->name = $_POST['name'];
            $staff->lastName = $_POST['lastname'];
            $staff->add = $_POST['address'];
            $staff->email = $_POST['email'];
            $staff->phone = $_POST['phone'];
            $staff->UpdateMe();
        }



        /*Category function */


        if ($_POST['action'] === 'insertCategory') {

            $cat->cname = $_POST['catn'];
            $cat->insertCat();
        }

        if ($_POST['action'] === 'deleteCat') {


            $cat->id = $_POST['id'];
            $cat->deleteData();
        }

        if ($_POST['action'] === 'updatingCat') {

            $cat->id = $_POST['id'];
            $cat->cname = $_POST['name'];
            $cat->UpdateMe();
        }
    }
    /* ----------------------------GET METHOD-------------------------------- */

    if ($_GET['action'] === 'getSingle') {


        $cust->id = $_GET['Cus_id'];
        $prof = $cust->getSingle();

        extract($prof);

        $div = '

        <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE CUSTOMER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        FIRSTNAME: 
                        <input type="text" class="form-control" placeholder="Name" value="' . $CUS_FNAME . '" id="fname">
                    </div>
                    <div class="mb-3">
                         LASTNAME:
                        <input type="text" class="form-control" placeholder="Lastname" value="' . $CUS_LNAME . '" id="lname">
                    </div>
                    <div class="mb-3">
                         LOCATION:
                        <input type="text" class="form-control" placeholder="Phone number" value="' . $CUS_ADDRESS . '" id="add">
                    </div>
                    <div class="mb-3">
                         EMAIL:
                        <input type="email" class="form-control" placeholder="Email" value="' . $CUS_EMAIL . '" id="emls">
                    </div>
                    <div class="mb-3">
                         PHONE-NUM:
                        <input type="text" class="form-control" placeholder="Address" value="' . $CUS_PHONENUM . '" id="nums">
                    </div>
                     <div class="mb-3">
                         ADDED DATE:
                        <input type="text" class="form-control" placeholder="Address" value="' . $CUS_CREATED_AT . '" id="nums" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateME(' . $CUS_ID . ')">SAVE CHANGES</button>
                </div>
        

        ';

        echo $div;
    }

    if ($_GET['action'] === 'viewSingle') {


        $cust->id = $_GET['id'];
        $prof = $cust->getSingle();

        extract($prof);

        $div = '


          <p class="card-text" style="display: flex; justify-content: center; align-items: center; gap:10px; flex-direction: column;">
                                <label>NAME: ' . $CUS_FNAME . '</label>
                                <label>LASTNAME:' . $CUS_LNAME . '</label>
                                <label>ADDRESS: ' . $CUS_ADDRESS . '</label>
                                <label>EMAIL: ' . $CUS_EMAIL . '</label>
                                <label>PHONE-NUMBER: ' . $CUS_PHONENUM . '</label>
                                <label>DATE CREADTED: ' . $CUS_CREATED_AT . '</label>
                                <label>DATE UPDATED: ' . $CUS_UPDATED_AT . '</label>

        </p>

        ';

        echo $div;
    }


    /* SUPPLIER OPERATION */

    if ($_GET['action'] === 'getSingleSupp') {


        $supp->id = $_GET['Cus_id'];
        $prof = $supp->getSingle();

        extract($prof);

        $div = '

        <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE CUSTOMER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        FIRSTNAME:
                        <input type="text" class="form-control" placeholder="Name" value="' . $SUPPLIER_FNAME . '" id="fname">
                    </div>
                    <div class="mb-3">
                        LASTNAME:
                        <input type="text" class="form-control" placeholder="Lastname" value="' . $SUPPLIER_LNAME . '" id="lname">
                    </div>
                    <div class="mb-3">
                        ADDRESS:
                        <input type="text" class="form-control" placeholder="Phone number" value="' . $SUPPLIER_ADDRESS . '" id="add">
                    </div>
                    <div class="mb-3">
                        COMPANY NAME:
                        <input type="text" class="form-control" id="compa" value="' . $SUPPLIER_COMPANY . '">
                    </div>
                    <div class="mb-3">
                        PHONE-NUM:
                        <input type="text" class="form-control" placeholder="Address" value="' . $SUPPLIER_PHONENUM . '" id="nums">
                    </div>
                     <div class="mb-3">
                        CREATED DATE:
                        <input type="text" class="form-control" placeholder="Address" value="' . $SUPPLIER_CREATED_AT . '" id="nums" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateME(' . $SUPPLIER_ID . ')">SAVE CHANGES</button>
                </div>
        

        ';

        echo $div;
    }

    if ($_GET['action'] === 'viewSingleSupp') {


        $supp->id = $_GET['id'];
        $prof = $supp->getSingle();

        extract($prof);

        $div = '


          <p class="card-text" style="display: flex; justify-content: center; align-items: center; gap:10px; flex-direction: column;">
                                <label>NAME: ' . $SUPPLIER_FNAME . '</label>
                                <label>LASTNAME:' . $SUPPLIER_LNAME . '</label>
                                <label>ADDRESS: ' . $SUPPLIER_ADDRESS . '</label>
                                <label>COMPANY NAME: ' . $SUPPLIER_COMPANY . '</label>
                                <label>PHONE-NUMBER: ' . $SUPPLIER_PHONENUM . '</label>
                                <label>DATE ADDED: ' . $SUPPLIER_CREATED_AT . '</label>


        </p>

        ';

        echo $div;
    }



    /* STAFF OPERATION */

    if ($_GET['action'] === 'getSingleStaff') {


        $staff->id = $_GET['Cus_id'];
        $prof = $staff->getSingle();

        extract($prof);

        $div = '

        <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE CUSTOMER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    
                    <div class="mb-3">
                         FIRSTNAME:
                        <input type="text" class="form-control" placeholder="Name" value="' . $STAFF_FNAME . '" id="fname">
                    </div>
                    <div class="mb-3">
                         LASTNAME:
                        <input type="text" class="form-control" placeholder="Lastname" value="' . $STAFF_LNAME . '" id="lname">
                    </div>
                    <div class="mb-3">
                         ADDRESS:
                        <input type="text" class="form-control" placeholder="Phone number" value="' . $STAFF_ADDRESS . '" id="add">
                    </div>
                    <div class="mb-3">
                         EMAIL:
                        <input type="email" class="form-control" placeholder="Email" value="' . $STAFF_EMAIL . '" id="emls">
                    </div>
                    <div class="mb-3">
                        PHONE-NUM:
                        <input type="text" class="form-control" placeholder="Address" value="' . $STAFF_PHONENUM . '" id="nums">
                    </div>
                     <div class="mb-3">
                        ADDED DATE:
                        <input type="text" class="form-control" placeholder="Address" value="' . $STAFF_CREATED_AT . '" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateME(' . $STAFF_ID . ')">Save changes</button>
                </div>
        

        ';

        echo $div;
    }

    if ($_GET['action'] === 'viewSingleStaff') {


        $staff->id = $_GET['id'];
        $prof = $staff->getSingle();

        extract($prof);

        $div = '


          <p class="card-text" style="display: flex; justify-content: center; align-items: center; gap:10px; flex-direction: column;">
                                <label>NAME: ' . $STAFF_FNAME . '</label>
                                <label>LASTNAME:' . $STAFF_LNAME . '</label>
                                <label>ADDRESS: ' . $STAFF_ADDRESS . '</label>
                                <label>EMAIL: ' . $STAFF_EMAIL . '</label>
                                <label>PHONE-NUMBER: ' . $STAFF_PHONENUM . '</label>

        </p>

        ';

        echo $div;
    }



    /* CATEGORY OPERATION */

    if ($_GET['action'] === 'getSingleCat') {


        $cat->id = $_GET['Cus_id'];
        $prof = $cat->getSingle();

        extract($prof);

        $div = '

        <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE CATEGORY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                         CATEGORY NAME:
                        <input type="text" class="form-control" placeholder="Name" value="' . $CATEGORY_NAME . '" id="name">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateME(' . $CATEGORY_ID . ')">Save changes</button>
                </div>
        

        ';

        echo $div;
    }

    if ($_GET['action'] === 'viewSingleCat') {


        $cat->id = $_GET['id'];
        $prof = $cat->getSingle();

        extract($prof);

        $div = '


          <p class="card-text" style="display: flex; justify-content: center; align-items: center; gap:10px; flex-direction: column;">
                                <label>CATEGORY: ' . $CATEGORY_NAME . '</label>
                                

        </p>

        ';

        echo $div;
    }




    ?>



