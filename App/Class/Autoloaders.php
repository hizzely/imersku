<?php
    /*
        Class Autoloader v1.0

        Class ini berfungsi me-load semua file class yang ada.
        Sehingga kita tidak perlu meng-include satu persatu.
    */
    
    spl_autoload_register(function($class_name) {
        include ('./App/Class/' . $class_name . '.php');
    });
?>