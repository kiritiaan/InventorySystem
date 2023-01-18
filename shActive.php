<?php

require_once "./Model/Prduct.php";
$prod = new Prduct();






// if ($_SERVER['REQUEST_METHOD'] === 'POST') {


//     if ($_POST['action'] === 'viewInactivity') {

//         $viewProd = $prod->showProductActive();

//         foreach ($viewProd as $val) {

//             extract($val);

//             if ($ITEM_QUANTITY <= 0 && $ITEM_STATUS == "ACTIVE") {
//                 $stats = "INACTIVE";
//                 $prod->id = $ITEM_ID;
//                 $prod->status = $stats;
//                 $prod->updateToPending();
//             };
//         }
//     }
// }
