<?php
    
    class Databases {
        /*
            Class Database v1.0

            Data login untuk akses aplikasi ke database.
         */
        public static function PDO()
        {
            $server         = '<db server>';
            $username       = '<db username>';
            $password       = '<db user pass';
            $dbname         = '<db imersku>';

            try 
            {
                $connect    = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $connect;
            }

            catch (PDOException $error)
            {
                echo $error->getMessage();
                die();
            }

        }
    }
?>