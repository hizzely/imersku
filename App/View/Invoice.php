<div class="subhead">
    <div class="container">
        <h2 style="margin-bottom: 0; font-weight: 400;">
                <b>Step 3/3</b> - Done!
        </h2>
    </div>
</div>
<div class="container">

<?php
    if(isset($_SESSION['redir-referer'])){
?>
    <br/>
    
    <div class="row">
        <div class="col-8">
            <h2 style="margin-bottom: 0;">
                Invoice Details <b style="color: #3498db;">#<?php echo $_SESSION['redir-referer']; ?></b>
            </h2>
            <span style="font-size: 15px;">Pesanan anda akan segera kami proses kurang dari 1x24 jam setelah konfirmasi pembayaran telah kami terima.</span><br/><br/>

        </div>
        <div class="col-4">

        </div>
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