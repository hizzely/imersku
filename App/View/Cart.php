<div class="subhead">
    <div class="container">
        <h2 style="margin-bottom: 0; font-weight: 400;">
                <b>Step 1/3</b> - Cek Keranjang Belanja
        </h2>
    </div>
</div>
<div class="container">
    <br/>
    <div class='informasi-biru' id='notifikasi'>
        Kosong
    </div>
    <?php
        if( isset($_SESSION['mycart']) ) {
    ?>

    <div class="row">
        <div class="col-12">
            <h2 style="margin-bottom: 0;">
                Cart Review
            </h2>
            <span style="font-size: 15px;">Cek kembali barang anda sebelum melakukan Checkout.</span>

            <div class="cart-wrapper">
                <table cellpadding="5px;">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>Opsi</th>
                    </tr>

                    <?php
                        $no = 1;
                        $sum = 0;
                        foreach($_SESSION['mycart'] as $mycart){
                            echo "
                                <tr id='product-". $mycart['id'] ."'>
                                    <td>". $no++ ."</td>
                                    <td>". $mycart['name'] ."</td>
                                    <td>". $mycart['qty'] ."</td>
                                    <td>Rp". number_format($mycart['price'], 0, '', '.') ."</td>
                                    <td><button type='submit' class='btn btn-blue btn-xs' id='cart-hapusitem' data-id='". $mycart['id'] ."'>HAPUS</button></td>
                                </tr>";
                            
                            $sum += $mycart['price'];
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="box-kupon">
                <input type="text" class="form-input" name='couponcode' id='couponcode' placeholder="Kode Kupon" />
                <button type='submit' class="btn btn-blue btn-lg" id='usecoupon'>Pakai</button>
            </div>
        </div>       
        <div class="col-8" align="right">
            <p id='totalprice'>Billing Total: <b style="color: #3498db;">Rp<span id='totalbill'><?php echo number_format($sum, 0, '', '.'); ?></span>,-</b></p>
            <p style="margin: 0;">Gunakan Kode Kupon untuk mendapat potongan harga!</p>
        </div>
    </div>

    <br/><br/><hr>
    <div align='right'>
        <a href="index.php?checkout" class="btn btn-blue"><b>Checkout</b></a>
    </div>

    <?php
        }
        else {
            echo "<h1>Keranjang Belanja Kosong!</h1>Anda belum memasukkan barang ke Keranjang Belanja.";
        }
    ?>

</div>

<div style="padding-bottom: 200px;"></div>

<script>
    $("#notifikasi").hide();
    $(document).on('click', '#usecoupon', function(){
        var code = $('#couponcode').val();
        $.ajax({
            type: 'GET',
            url: 'Commands.php',
            data: {
                cc: 'cart',
                coupon: code
                },
            dataType: 'json',
            success: function(msg){
                if(msg.discount !== null){
                    console.log('[ok] ' + msg.discount + '% discount coupon used');
                    location.reload();
                }else{
                    $('#notifikasi').slideDown();
                    $('#notifikasi').delay(3000).slideUp();
                    $('#notifikasi').html('<b>Error!</b> Kupon yang anda pakai sudah pernah digunakan atau tidak valid!');
                }
            }
        });
    });

    $(document).on('click', '#cart-hapusitem', function(){
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'Commands.php',
            data: {
                cc: 'cart',
                removeitem: id
                },
            dataType: 'json',
            success: function(msg){
                if(msg.result === true){
                    console.log('remove ok');
                    $('#product-' + id).remove()
                    $('#cartcount').load('Commands.php?cc=cart&count');
                    $('#totalbill').load('Commands.php?cc=cart&totalbill');
                }
            }
        });
    });
</script>