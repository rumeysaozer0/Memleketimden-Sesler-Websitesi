<?php include 'header.php';
include 'config/CrudPDO.php';
$db = new CrudPDO();
?>
<div class="container">

    <div class="row kutu" style="height:800px">

        <div class="col-md-2"></div>
        <div class="col-md-8">
     
            <div class="">
            <h1>Bize Gönder!!</h1>
           <p>Bize şehrinizle ilgili sitemizde yer almasını istediğiniz muzik,resim, bilgi ve gezi mekanlarını aşağıdaki butonlara tıklayarak gönderebilirsiniz. </p>
            <button class="btn btn-danger" onclick="bizeGonder(1)">Müzik Gönder</button>
            <button class="btn btn-danger" onclick="bizeGonder(2)">Resim Gönder</button>
            <button class="btn btn-danger" onclick="bizeGonder(3)">Bilgi Gönder</button>
            <button class="btn btn-danger" onclick="bizeGonder(4)">Gezi mekanı Gönder</button>
           <br><br>
            </div> 

<div id="gonder"></div>

        <div class="col-md-2">
        </div>
    </div>
</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function bizeGonder(ID){
    $.ajax({
        url:"ajax.php",
        type:"POST",
        data:{bizeGonder:ID},
        success :function(result){
            $("#gonder").html(result);
        }

    });}
</script>



<?php

if(isset($_POST['muzik'])){

    $madi =htmlspecialchars( $_POST["madi"]);
    $sanatci = htmlspecialchars($_POST["sanatci"]);
    $dosya = htmlspecialchars($_POST["dosya"]);
    $sozler = htmlspecialchars($_POST["sozler"]);
    $msehir = htmlspecialchars($_POST["msehir"]);
    $sql = $db->qSql("INSERT INTO muzikler Set m_adi = '".$madi."' ,  m_sanatci = '".$sanatci."' , m_dosya = '".$dosya."', m_sozler = '".$sozler."' , m_s_id = '".$msehir."' , m_durum = '0'");
    echo '<script>swal({
        title: "Gönderme Başarılı!",
        text: "Gönderiniz bize ulaşmıştır uygun bulunduğu takdirde web sitemizde yayınlanacaktır.",
        icon: "success",
        button: "Tamam",
      });</script>';
}

if(isset($_POST['resim'])){

  $link =htmlspecialchars( $_POST["link"]);
  $rsehir =htmlspecialchars( $_POST["rsehir"]);
  $sql = $db->qSql("INSERT INTO resim Set r_dosya = '".$link."' , r_s_id = '".$rsehir."' , r_durum = '0' ");
  echo '<script>swal({
      title: "Gönderme Başarılı!",
      text: "Gönderiniz bize ulaşmıştır uygun bulunduğu takdirde web sitemizde yayınlanacaktır.",
      icon: "success",
      button: "Tamam",
    });</script>';
}

if(isset($_POST['bilgi'])){

  $bilgi =htmlspecialchars( $_POST["bilgi"]);
  $bsehir =htmlspecialchars( $_POST["bsehir"]);
  $sql = $db->qSql("INSERT INTO bilgiler Set b_dosya = '".$bilgi."', b_s_id = '".$bsehir."' , b_durum = '0'");
  echo '<script>swal({
      title: "Gönderme Başarılı!",
      text: "Gönderiniz bize ulaşmıştır uygun bulunduğu takdirde web sitemizde yayınlanacaktır.",
      icon: "success",
      button: "Tamam",
    });</script>';
}


if(isset($_POST['gezi'])){

  $baslik =htmlspecialchars( $_POST["baslik"]);
  $gresim = htmlspecialchars($_POST["gresim"]);
  $gbilgi = htmlspecialchars($_POST["gbilgi"]);
  $gsehir = htmlspecialchars($_POST["gsehir"]);
  $sql = $db->qSql("INSERT INTO gezii Set g_baslik = '".$baslik."' ,  g_resim = '".$gresim."' , g_bilgi = '".$gbilgi."', g_s_id = '".$gsehir."' , g_durum = '0'");
  echo '<script>swal({
      title: "Gönderme Başarılı!",
      text: "Gönderiniz bize ulaşmıştır uygun bulunduğu takdirde web sitemizde yayınlanacaktır.",
      icon: "success",
      button: "Tamam",
    });</script>';
}

?>
<?php include 'footer.php';?>