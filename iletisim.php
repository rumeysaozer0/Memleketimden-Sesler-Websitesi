<?php include 'header.php'; 
include 'config/CrudPDO.php';
$db = new CrudPDO();
?>
<div class="container">

    <div class="row kutu ">
        <div class="col-2"></div>
        <div class="col-8">
            <center>
                <br><br>
                <h1><b>Memleketim'den Sesler'e Ulaşın</b></h1>
                <p>Tüm soru ve önerileriniz için bizimle iletişime geçebilirsiniz</p></center>

            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ad Soyad</label>
                    <input class="form-control form-control-lg" type="text" name="adisoyadi">
                    <div class="form-group">
                        <label for="exampleInputPassword1">E-Posta</label>
                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="e-mail"
                               aria-describedby="emailHelp">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Başlık</label>
                        <input class="form-control form-control-lg" type="text" name="baslik"
                               placeholder="Mesajınızı özetleyen bir başlık atın">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Mesaj</label>
                        
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="mesaj"
                                  placeholder="Mesajınızı yazın" rows="4"></textarea>
                    </div>
                    <br>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Kullanım Koşullarını ve gizlilik
                            politikasını okudum onaylıyorum</label>
                    </div>
                    <br>
                    <button type="submit" float-right class="btn btn-primary" name="iletisim">Gönder</button>
            </form>
            <br><br><br>
        </div>
    </div>
</div></div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
if(isset($_POST['iletisim'])){

    $ad_soyad =htmlspecialchars( $_POST["adisoyadi"]);
    $email = htmlspecialchars($_POST["e-mail"]);
    $baslik = htmlspecialchars($_POST["baslik"]);
    $mesaj = htmlspecialchars($_POST["mesaj"]);
    $sql = $db->qSql("INSERT INTO iletisim Set iletisim_ad_soyad = '".$ad_soyad."' ,  iletisim_email = '".$email."' , iletisim_baslik = '".$baslik."', iletisim_mesaj = '".$mesaj."' , iletisim_durum =1");
    echo '<script>swal({
        title: "Gönderme Başarılı!",
        text: "Mesajınız bize ulaşmıştır...",
        icon: "success",
        button: "Tamam",
      });</script>';
}

include 'footer.php'; 
?>
