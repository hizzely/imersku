<?php
    session_start();
    include('./App/Class/Autoloaders.php');
    $p_home     = './App/View/Home.php';
    $p_cart     = './App/View/Cart.php';
    $p_checkout = './App/View/Checkout.php';
    $p_invoice  = './App/View/Invoice.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Imersku</title>
        <link href="./Public/style/market-main.css" rel="stylesheet" />
        <link href="./Public/style/simple-grid.css" rel="stylesheet" />
        <link href="./Public/style/fonts/roboto.css" rel="stylesheet" />
        <script src="./Public/style/jquery.min.js"></script>
    </head>
    <body>
        <div class="navbar">
            <div class="navbar-title">
                <b>Imersku</b>
            </div>  
            <a href="index.php">Home</a>

            <div class="navbar-right">
                <a href="index.php?cart">Shopping Cart (<span id="cartcount"><?php if(isset($_SESSION['mycart'])){ echo count($_SESSION['mycart']); } else { echo 0; } ?></span>)</a>
                <a href="#" class="active">Masuk / Daftar</a>
            </div>
        </div>

        <?php

            // List Web Route
            if(isset($_GET['home']) && file_exists($p_home)){
                include($p_home);
            }
            elseif(isset($_GET['cart']) && file_exists($p_cart)){
                include($p_cart);
            }
            elseif(isset($_GET['checkout']) && file_exists($p_checkout)){
                include($p_checkout);
            }
            elseif(isset($_GET['invoice']) && file_exists($p_checkout)){
                include($p_invoice);
            }
            // Page fallback
            else{
                include($p_home);
            }
        ?>

        <div class="footerbox">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <p style="border-bottom: 2px #fff solid; font-weight: 700;">PT. IMERS CYBERMEDIA</p>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
                    </div>
                    <div class="col-4">
                        <p style="border-bottom: 2px #fff solid; font-weight: 700;">TAUTAN</p>
                        <a href="#">Buyer's Guide</a>
                        <a href="#">Payment Processing</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Guarantee</a>
                    </div>
                    <div class="col-3">
                        <p style="border-bottom: 2px #fff solid; font-weight: 700;">SOSIAL MEDIA</p>
                        TBA.
                    </div>
                </div>
            </div>
            <div class="footerbox-copyright" align="center">
                &copy; 2017 Fajar Ru. Licensed under MIT
            </div>
        </div>

    </body>
</html>