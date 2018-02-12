<?php

    class Invoices extends Databases 
    /*
        Class Invoices v1.0

        Class untuk fungsi dasar Invoice

        Usage:
            $invoice    = new Invoices;
            $invoices   = $invoice->function(parameter);

        Functions:
            -> generate( string $fullname, string $email, string $contact, string, $address, string $payment );
                Deskripsi: Fungsi ini membuat Invoice baru berdasarkan parameter yang diberikan beserta data Keranjang Belanja sekarang.
                Return: Kode Invoice
            -> getinvoice ( string $id );
                Deskripsi: Mengambil data Invoice dari database sesuai dengan ID Invoice yang diberikan.
                Return: Kode dan Data Invoice

    */
    {
        public function generate($fullname, $email, $contact, $address, $payment)
        {
            $rand_id = crc32(rand(1,100));
            $konek   = Databases::PDO();
            $query   = "INSERT INTO invoices
                        SET id          = :inv_id,
                            fullname    = :fullname,
                            email       = :email,
                            contact     = :contact,
                            address     = :address,
                            payment     = :payment,
                            totalbill   = :totalbill,
                            products    = :products";
            $prepare = $konek->prepare($query);
            $bill = 0;
            foreach($_SESSION['mycart'] as $data){
                $cart[] = array(
                    ':prod_id'    => $data['id'],
                    ':prod_qty'   => $data['qty'],
                    ':prod_price' => $data['price']
                );

                $bill += $data['price']; 
            }
            
            $dbin   = array(
                    ':inv_id'       => $rand_id,
                    ':fullname'     => $fullname,
                    ':email'        => $email,
                    ':contact'      => $contact,
                    ':address'      => $address,
                    ':payment'      => $payment,
                    ':totalbill'    => $bill,
                    ':products'     => json_encode($cart),
            );

            $prepare->execute($dbin);
            return $rand_id;
        }

        public function getinvoice($id)
        {
            $invoice_id = intval($id);
            $konek   = Databases::PDO();
            $query   = "SELECT id,
                               fullname,
                               email,
                               contact,
                               address,
                               products,
                               totalbill,
                               payment,
                               status
                        FROM invoices
                        WHERE id = $invoice_id";
            $exec   = $konek->query($query)->fetch();
            return $exec;

        }
    }
?>