<?php
    session_start();
    include('./App/Class/Autoloaders.php');
    $gcmds_set      = 'cc';
    $response_ok    = json_encode(array('result' => true));

    if( isset($_GET[$gcmds_set]) ){

        /* ===========================================================
            Cart Commands
        */

            if( $_GET[$gcmds_set] == 'cart'){
                $newcart    = new Carts;

                // Add Item
                if ( isset($_GET['additem']) && isset($_GET['qty']) ){
                    $additem    = $newcart->additem($_GET['additem'], $_GET['qty']);
                    echo $response_ok;
                }

                // Price Discount from Coupon Code
                if ( isset($_GET['coupon']) && isset($_SESSION['mycart']) ){
                    $disc   = $newcart->discount($_GET['coupon']);
                    if ($disc == 'fail'){
                        echo json_encode(array('discount' => null));
                    }
                    else{
                        echo json_encode(array('discount' => $disc));
                    }
                }

                // Remove an Item
                if ( isset($_GET['removeitem']) ){
                    $removeitem  = $newcart->removeitem($_GET['removeitem']);
                    if (count($_SESSION['mycart']) === 0){
                        $newcart->clear();
                    }
                    echo $response_ok;
                }

                // Clear Shopping Cart
                if ( isset($_GET['clear']) && isset($_SESSION['mycart']) ){
                    $newcart->clear();
                    echo $response_ok;
                }

                // Count current items
                if ( isset($_GET['count']) && isset($_SESSION['mycart']) ){
                    echo count($_SESSION['mycart']);
                }

                // Count total current bills
                if ( isset($_GET['totalbill']) && isset($_SESSION['mycart']) ){
                    $totalbill = 0;
                    foreach( $_SESSION['mycart'] as $getbill){
                        $totalbill += $getbill['price'];
                    }
                    echo number_format($totalbill, 0, '', '.');
                }

            } else {
                
            }

        /* --------------------------------------------------------- */

        /* ===========================================================
            Invoice Commands
        */

        if( $_GET[$gcmds_set] == 'invoice'){
                $invoice    = new Invoices;

                // Generate Invoice
                if ( isset($_GET['generate']) && isset($_SESSION['mycart'])){
                    $generate    = $invoice->generate($_POST['fullname'], $_POST['email'], $_POST['contact'], $_POST['address'], $_POST['payment']);
                    $_SESSION['redir-referer'] = $generate;
                    Header('Location: index.php?invoice');
                }

                // Get Invoice
                if ( isset($_GET['get']) ){
                    $getinvoice  = $invoice->getinvoice($_GET['get']);
                    print_r($getinvoice);
                }
                
            } else {

            }
    }

?>