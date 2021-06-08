<?php include 'header.php'; 
include 'config/CrudPDO.php';
$db = new CrudPDO();
$sql = $db->qSql("SELECT * FROM sehirler INNER JOIN bilgiler ON sehirler.s_id = bilgiler.b_s_id WHERE s_id = '" . htmlspecialchars($_GET['sehir']) ."' AND b_durum = '1'");
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            
                $sql = $db->qSql("SELECT * FROM istatistik WHERE  i_b_id = '" . htmlspecialchars($_GET['sehir']) . "' ");
                $istatistik = $sql->fetch(PDO::FETCH_ASSOC);
                if($sql->rowCount() < 1 ){
                    $sql = $db->qSql("INSERT INTO istatistik SET  i_b_id ='".$row['s_id']."' , i_gunluk = 1, i_haftalik = 1, i_aylik = 1, i_toplam =1");
                  
                }
                else{
                    
                    $sql = $db->qSql("UPDATE istatistik SET  i_gunluk = i_gunluk + 1, i_haftalik = i_haftalik + 1, i_aylik = i_aylik +  1, i_toplam = i_toplam + 1  WHERE i_b_id = '" . htmlspecialchars($_GET['sehir']) . "'");
                   
                }
?>
<div class="container">
    <div class="row kutu">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="">
               <center><h1><?php echo $row['s_adi'] ?></h1><center>
               <p><?php echo nl2br($row['b_dosya']); ?></p>
             
            </div>
        </div>
        <div class="col-md-2">
        
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>