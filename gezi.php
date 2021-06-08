<?php include 'header.php'; 
include 'config/CrudPDO.php';
$db = new CrudPDO();

$sql = $db->qSql("SELECT * FROM sehirler INNER JOIN gezii ON sehirler.s_id = gezii.g_s_id WHERE s_id = '" . htmlspecialchars($_GET['sehir']) . "' AND g_durum = 1");
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $db->qSql("SELECT * FROM istatistik WHERE  i_g_id = '" . htmlspecialchars($_GET['sehir']) . "' ");
$istatistik = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() < 1 ){
    $sql = $db->qSql("INSERT INTO istatistik SET  i_g_id ='".$rows[0]['s_id']."' , i_gunluk = 1, i_haftalik = 1, i_aylik = 1, i_toplam =1");
  
}
else{
    
    $sql = $db->qSql("UPDATE istatistik SET  i_gunluk = i_gunluk + 1, i_haftalik = i_haftalik + 1, i_aylik = i_aylik +  1, i_toplam = i_toplam + 1  WHERE i_g_id = '" . htmlspecialchars($_GET['sehir']) . "'");
   
}
?>
<div class="container">

    <div class="row kutu">
    <center><h1><?php echo $rows[0]['s_adi']?> Gezilecek Yerler Listesi</h1><center>
            
    <?php
            
            foreach ($rows as $row) { 
            ?>
        <div class="col-md-2"></div>
        <div class="col-md-8">
     
            <div class="">
             <h2><?php echo $row['g_baslik'] ?></h2><br>
              <img src="<?php echo $row['g_resim'] ?>" ><br>
               <p><?php echo nl2br($row['g_dosya']); ?></p><br>
            </div> 
        </div>
        <div class="col-md-2">
        </div>
        <?php } ?>
    </div>
</div>
<style>
img {
    max-width: 100%;
    display: block;
    height: auto;
}
</style>


<?php include 'footer.php'; ?>
