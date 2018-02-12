
<div class="container">
    <div class='informasi-biru' id='notifikasi'>
        Kosong
    </div>

    <p class="left-border-blue">
        PRODUK UNGGULAN KAMI
    </p>
    <div class="row">
        <?php
            $fpget = new Products;

            foreach ($fpget->getFeatured() as $fp){  
            echo "    
            <div class='col-3'>
                <div class='fp-box'>
                    <div class='fp-box-content'>
                        Gambar disini
                    </div>
                    <div class='fp-box-footer'>
                        ". $fp->name ."<br/>
                        <small>Rp". number_format($fp->price, 0, '', '.') ."</small>
                        <button type='button' class='btn btn-blue' id='cart-itemadd' data-id='". $fp->id ."' align='right'>Beli</a>
                    </div>
                </div>
            </div>";
            }
        ?>


    </div>
    
</div>


<br/><br/><br/>

<div style="margin-top: 25px; padding: 10px; background-color: #fff; " align="center">
    <div class="container">
        <h3 style="font-weight: 300;">
            Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an.
            <br/>&#8213; <b>Fajar Ru</b> (http://hizzely.github.io)
        </h3>
    </div>
</div>

<script>
    $('#notifikasi').hide();
    $(document).on('click', '#cart-itemadd', function(){
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'Commands.php',
            data: {
                cc: 'cart',
                additem: id,
                qty: 1
                },
            dataType: 'json',
            success: function(msg){
                if(msg.result === true){
                    console.log('[ok] item added');
                    //$('#product-' + id).remove()
                    $('#notifikasi').slideDown();
                    $('#notifikasi').delay(2000).slideUp();
                    $('#notifikasi').html('1 Item Produk <b><?php echo $fp->name; ?></b> telah berhasil ditambahkan ke Shopping Cart!');
                    $('#cartcount').load('Commands.php?cc=cart&count');
                }
            }
        });
    });
</script>