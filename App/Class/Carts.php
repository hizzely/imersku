<?php
    class Carts extends Databases {
        /*
            Cart v1.2

            Parameters
            $id     = product id
            $qty    = product quantity

            Usage:
            $cart       = new Cart; // Buat Objek "Cart" baru
            $keranjang  = $a->{function}; // Panggil Fungsi Objek

            Function:
            - Menambah item ke cart                 = additem(product_id, quantity)
            - Diskon Harga dari Kupon               = discount(coupon_code)
            - Hapus sebuah item dari cart           = removeitem(product_id)
            - Menghapus seluruh item di cart        = clear()

        */

        public function additem($id, $qty)
        {
            $product_id     = intval($id);
            $product_qty    = intval($qty);

            $konek  = Databases::PDO();  
            $query  = "SELECT id,
                              name,
                              price
                       FROM products
                       WHERE id = $product_id
                       AND available = 1";
            $exec   = $konek->query($query)->fetch();

            if (!isset($_SESSION['mycart'][$product_id])) {
                if (count($exec) === 1){
                    $product = array(
                        'id'    => $exec->id,
                        'name'  => $exec->name,
                        'qty'   => $qty,
                        'price' => $exec->price * $qty
                    );
                    $_SESSION['mycart'][$exec->id] = $product;
                
                }
                else {
                    echo "Produk yang anda minta saat ini tidak tersedia dalam daftar kami!";
                }
            }
            else {
                $_SESSION['mycart'][$exec->id]['qty'] = $_SESSION['mycart'][$exec->id]['qty'] + $product_qty;
                $_SESSION['mycart'][$exec->id]['price'] = $exec->price * $_SESSION['mycart'][$exec->id]['qty'];
            } 
        }

        public function discount($couponid)
        {
            $konek  = Databases::PDO();
            $query  = "SELECT code,
                              discount
                       FROM coupons
                       WHERE code = $couponid
                       AND active = 1";
            $exec   = $konek->query($query)->fetch();

            if ($exec == true && !isset($_SESSION['coupons'][$exec->code])){
                $discount = 0;
                foreach($_SESSION['mycart'] as $data){
                    foreach(array_keys($_SESSION['mycart']) as $k){
                        $_SESSION['mycart'][$k]['price'] = $_SESSION['mycart'][$k]['price'] * $exec->discount * 0.01;      
                    } 
                }
                $_SESSION['coupons'][$exec->code]=array('used' => 1);
                return $exec->discount;
            }else {
                return "fail";
            }
        }

        public function removeitem($id)
        {
            $product_id     = intval($id);
            unset($_SESSION['mycart'][$id]);
            return 'ok';
        }

        public function clear()
        {
            unset($_SESSION['mycart']);
            return 'ok';
        }
    }
?>