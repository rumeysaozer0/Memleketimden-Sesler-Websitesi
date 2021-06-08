<?php include 'header.php'; 
include 'config/CrudPDO.php';
$db = new CrudPDO();


            $sql = $db->qSql("SELECT * FROM sehirler  WHERE s_id = '" . htmlspecialchars($_GET['sehir']) . "'");
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            
            $sql = $db->qSql("SELECT * FROM istatistik WHERE  i_r_id = '" . htmlspecialchars($_GET['sehir']) . "' ");
$istatistik = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() < 1 ){
    $sql = $db->qSql("INSERT INTO istatistik SET  i_r_id ='".$row['s_id']."' , i_gunluk = 1, i_haftalik = 1, i_aylik = 1, i_toplam =1");
  
}
else{
    
    $sql = $db->qSql("UPDATE istatistik SET  i_gunluk = i_gunluk + 1, i_haftalik = i_haftalik + 1, i_aylik = i_aylik +  1, i_toplam = i_toplam + 1  WHERE i_r_id = '" . htmlspecialchars($_GET['sehir']) . "'");
   
}
             
?>
  
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
  <style>
.container.gallery-container {
    background-color: #fff;
    color: #35373a;
    min-height: 100vh;
    border-radius: 20px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.06);
}

.gallery-container h1 {
    text-align: center;
    margin-top: 70px;
}


.tz-gallery {
    padding: 40px;
}

.tz-gallery .lightbox img {
    width: 100%;
    margin-bottom: 30px;
    transition: 0.2s ease-in-out;
    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}


.tz-gallery .lightbox img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
}

.tz-gallery img {
    border-radius: 4px;
}

.baguetteBox-button {
    background-color: transparent !important;
}


</style>


</head>
<body>
<div>
<div class="container gallery-container">


    <h1><?php echo $row['s_adi'] ?> Resimleri</h1>
    
    <div class="tz-gallery">
        <div class="row">
        <?php
            $sql = $db->qSql("SELECT * FROM sehirler INNER JOIN resim ON sehirler.s_id = resim.r_s_id WHERE s_id = '" . htmlspecialchars($_GET['sehir']) . "' AND r_durum = 1");
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            {   
            foreach ($rows as $row) {
            ?>
            <div class="col-sm-6 col-md-4">
            
                <a class="lightbox" href="<?php echo $row['r_dosya'] ?>" width="323" height="215">
                    <img src="<?php echo $row['r_dosya'] ?>" alt="<?php echo $row['s_adi'] ?>">
                </a>
               
            </div>  
            <?php } ?>
        </div>
    </div>
    <?php }  ?>
</div></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script><br><br>
<?php include 'footer.php'; ?>
