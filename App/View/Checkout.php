<div class="subhead">
    <div class="container">
        <h2 style="margin-bottom: 0; font-weight: 400;">
                <b>Step 2/3</b> - Shipping &amp; Checkout
        </h2>
    </div>
</div>
<div class="container">

<?php
    if(isset($_SESSION['mycart'])){
?>
    <br/>
    <div class='informasi-biru' id='notifikasi'>
        Kosong
    </div>
    
    <div class="row">
        <div class="col-8">
            <h2 style="margin-bottom: 0;">
                Shipping Address
            </h2>
            <span style="font-size: 15px;">Masukkan detail alamat anda.</span><br/><br/>
            <form id='shippingaddress' action='Commands.php?cc=invoice&amp;generate'method='post'>
                <div class="form-group">
                    <input type='text' class="form-input" style="width: 95%; margin-bottom: 10px;" name='fullname' id='fullname' placeholder='Nama Lengkap' required/>
                    <input type='text' class="form-input" style="width: 95%; margin-bottom: 10px;" name='address' id='address' placeholder='Alamat Lengkap' required />
                    <input type='text' class="form-input" style="width: 95%; margin-bottom: 10px;" name='contact' id='contact' placeholder='Kontak' required />
                    <input type='text' class="form-input" style="width: 95%; margin-bottom: 10px;" name='email' id='email' placeholder='Email Aktif' required />
                </div>
        </div>
        <div class="col-4">
            <h2 style="margin-bottom: 0;">
                Payment
            </h2>
            <span style="font-size: 15px;">Pilih salah satu cara pembayaran.</span><br/><br/>
            <div style="width: 100%; border: 2px #ddd solid; padding: 15px; background-color: #fff; ">
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment1' value='bca' required/>
                        <label for='payment'>Bank BCA</label>
                    </div>
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment2' value='bri' required/>
                        <label for='payment'>Bank BRI</label>
                    </div>
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment3' value='mandiri' required/>
                        <label for='payment'>Bank Mandiri</label>
                    </div>
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment4' value='cc' required/>
                        <label for='payment'>Credit Card</label>
                    </div>
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment5' value='paypal' required/>
                        <label for='payment'>PayPal</label>
                    </div>
                    <div class="form-group">
                        <input type='radio' name='payment' id='payment6' value='bitcoin' required/>
                        <label for='payment'>Bitcoin</label>
                    </div>
            </div>
        </div>
    </div>


    <br/><br/><hr>
    <div align='right'>
        <button type='submit'>Selesai!</button>
    </div>
    </form>
<?php
    }
    else{
        echo "<div align='center'><br/><h1>Maaf!</h1>Anda belum memilih barang kedalam keranjang belanja anda!</div>";
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
</script>