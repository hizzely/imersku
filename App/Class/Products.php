<?php
    
    class Products extends Databases
    /* 
        Class Product v1.0

    */
    {
        public function getAll()
        {
            $konek    = Databases::PDO();
            $query    = "SELECT id,
                                category_id,
                                name,
                                price,
                                description,
                                available,
                                created_at
                        FROM products
                        ORDER BY created_at DESC";
            $exec       = $konek->query($query)->fetchAll();
            
            return $exec;
        }

        public function getId($id)
        {
            $konek      = Databases::PDO();
            $query      = "SELECT id,
                                  category_id,
                                  name,
                                  price,
                                  description,
                                  available,
                                  created_at
                           FROM products
                           WHERE id = $id
                           ORDER BY created_at DESC";
            $exec       = $konek->query($query)->fetch();
            
            return $exec;
        }

        public function getFeatured()
        {
            $konek      = Databases::PDO();
            $query      = "SELECT id,
                                  category_id,
                                  name,
                                  price,
                                  description,
                                  available,
                                  created_at
                           FROM products
                           WHERE featured = 1
                           ORDER BY created_at DESC";
            $exec       = $konek->query($query)->fetchAll();

            return $exec;
        }
    }
?>