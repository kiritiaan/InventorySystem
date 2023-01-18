
<?php

session_start();
require_once "./Model/Prduct.php";


$prod = new Prduct();

include_once './Model/dashbrd.php';
$dash = new dashbrd();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if ($_POST['action'] === 'filter') {


        $prod->id = $_POST['catId'] ?? 'No record! found!';
        $res = $prod->filterItem();

        foreach ($res as $value) {
            extract($value);

            echo '<tr>';
            echo '<td>' . $ITEM_CODE . '</td>';
            echo ' <td>
                                <img src="' . $ITEM_IMAGE . '" alt="" srcset="" style="width:100px; border-radius:10%;">
                            </td>';
            echo '<td>' . $ITEM_NAME . '</td>';
            echo '<td>' . $ITEM_PRICE . '</td>';
            echo '<td>' . $ITEM_DESC . '</td>';
            echo '<td>' . $ITEM_STATUS . '</td>';
            echo '<td class="butt">
                                <form action="ProductView.php" method="post">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getId(' . $ITEM_CODE . ')"><i class="fa-regular fa-pen-to-square"></i></a></i>
                                    <input type="hidden" value="' . $ITEM_CODE . '" name="id">
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-info" style="margin-right:10px ;"></i>DETAILS
                                    </button>
                                </form>
                   </td>';
            echo '</tr>';
        }
    }





    if ($_POST['action'] === 'getProdss') {


        $prod->supp_id = $_POST['catId'];
        $r = $prod->getITEM();

        echo '<option selected disabled="">Choose...</option>';
        foreach ($r as $val) {
            extract($val);
            echo '<option value="' . $ITEM_ID . '">' . $ITEM_NAME . '</option>';
        }
    }





    if ($_POST['action'] === 'updatingQuan') {


        $prod->supp_id = $_POST['supp_id'];
        $prod->item_id = $_POST['prod_id'];
        $prod->updateQuan = $_POST['quantity'];
        $prod->updateQuantity();
    }


    if ($_POST['action'] === 'placeProd') {


        $prod->place_id = $_POST['catId'];
        $r = $prod->placeInput();




        foreach ($r as $val) {

            extract($val);


            $div = '
            
        <div class="mb-3">
                                            <input type="hidden" class="form-control" value="' . $ITEM_ID . '"  id="prod_id">
                                            <input type="text" class="form-control" value="' . $ITEM_CODE . '" placeholder="Product Code" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control"  value="' . $ITEM_NAME . '" placeholder="Product Name" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="">QUANTITY ONHAND:</label>
                                            <input type="number" class="form-control total" placeholder="On Hand"   value="' . $ITEM_QUANTITY . '" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" class="form-control total" placeholder="INPUT QUANTITY" onkeyup="mykey()" name="ProdQuan" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="">TOTAL QUANTITY:</label>
                                            <input type="number" class="form-control " placeholder="Quantity" id="total_quan" name="ProdQuan" disabled>
                                        </div>

        ';

            echo $div;

            break;
        }
    }







    if ($_POST['action'] === 'delete') {


        $prod->id = $_POST['prodId'];
        $prod->deleteData();
    }




    if ($_POST['action'] === 'getSingleProd') {


        $prod->id = $_POST['ProdId'];
        $val = $prod->getSingle();

        extract($val);

        $div = '
       <form action="updateProduct.php?action=update" method="POST" rule="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE PRODUCT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="' . $ITEM_IMAGE . '" class="img-fluid rounded border border-secondary mb-3" alt="">
                    <div class="mb-3">
                         CHANGE PICTURE: 
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="form-control"  value="' . $ITEM_ID . '" name="ids" >
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="form-control"  value="' . $ITEM_CODE . '" name="id" >
                    </div>
                            
                    <div class="mb-3">
                         PRODUCT CODE: 
                        <input type="text" class="form-control"  value="' . $ITEM_CODE . '" disabled>
                    </div>
                    <div class="mb-3">
                         PRODUCT NAME: 
                        <input type="text" class="form-control" placeholder="Name" value="' . $ITEM_NAME . '" name="prod" id="prodName">
                    </div>
                    <div class="mb-3">
                        PRODUCT_PRICE
                        <input type="number" class="form-control" placeholder="Lastname" value="' . $ITEM_PRICE . '" name="price" id="prodPrice">
                    </div>
                    <div class="mb-3">
                        PRODUCT_DESC
                        <input type="text" class="form-control" placeholder="Phone number" value="' . $ITEM_DESC . '" name="desc" id="prodDesc">
                    </div>
                    <div class="mb-3">
                        PRODUCT_QUANTITY
                        <input type="email" class="form-control" placeholder="Email" value="' . $ITEM_CREATED_AT . '" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save">Save changes</button>
                </div>
      
            </form>
        

        ';

        echo $div;
    }


    if ($_POST['action'] === 'getCounting') {

        $d = $prod->getPending();
        echo  json_encode($d);
    }

    if ($_POST['action'] === 'getCounting2') {

        $d = $prod->getInactive();
        echo  json_encode($d);
    }
}








?>