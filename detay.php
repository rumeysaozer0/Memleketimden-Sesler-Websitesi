<?php include 'header.php';
include 'config/CrudPDO.php';
$db = new CrudPDO();

$sql = $db->qSql("SELECT * FROM sehirler INNER JOIN muzikler ON sehirler.s_id = muzikler.m_s_id WHERE m_id = '" . htmlspecialchars($_GET['music']) . "'");
$rows = $sql->fetch(PDO::FETCH_ASSOC);


$sql = $db->qSql("SELECT * FROM istatistik WHERE  i_m_id = '" . htmlspecialchars($_GET['music']) . "' ");
$istatistik = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() < 1 ){
    $sql = $db->qSql("INSERT INTO istatistik SET  i_m_id ='".$rows['m_id']."' ,  i_s_id ='".$rows['s_id']."' , i_gunluk = 1, i_haftalik = 1, i_aylik = 1, i_toplam =1");
    $sql = $db->qSql("SELECT * FROM istatistik WHERE  i_m_id = '" . htmlspecialchars($_GET['music']) . "' ");
    $istatistik = $sql->fetch(PDO::FETCH_ASSOC);
}
else{
    
    $sql = $db->qSql("UPDATE istatistik SET  i_gunluk = i_gunluk + 1, i_haftalik = i_haftalik + 1, i_aylik = i_aylik +  1, i_toplam = i_toplam + 1  WHERE i_m_id = '" . htmlspecialchars($_GET['music']) . "'");
    $sql = $db->qSql("SELECT * FROM istatistik WHERE  i_m_id = '" . htmlspecialchars($_GET['music']) . "' ");
    $istatistik = $sql->fetch(PDO::FETCH_ASSOC);
}

?>
<style>

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        height: 900px;
    }



    .header .overlay {
        width: 100%;
        height: 100%;
        padding: 50px;
        color: #FFF;
        text-shadow: 1px 1px 1px #333;
        background: linear-gradient(135deg, #6833a5 10%, #9d614a 100%);

    }

    h1 {
        font-size: 30px;
    }


    .courses-container {
        cursor: pointer;
    }
    .course {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        max-width: 100%;
        margin: 0 0 10px  0;
        overflow: hidden;
        width: 700px;

    }

    .course h6 {
        opacity: 0.6;
        font-size: 1rem;
    }

    .course h2 {
        font-size: 1.4rem;
    }

    .course-preview {
        background: linear-gradient(135deg, #6833a5 10%, #9d614a 100%);
        color: #fff;
        padding: 30px;
        max-width: 250px;
    }

    .course-preview a {
        color: #fff;
        display: inline-block;
        font-size: 12px;
        opacity: 0.6;
        margin-top: 30px;
        text-decoration: none;
    }

    .course-info {
        padding-top: 15px;
        padding-left: 10px;
        position: relative;
        width: 100%;
    }

    .badge-light{
float:right;
    }



</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <div class="container-fluid">
                <br>

                <center>

                    <div class="header">
                        <div class="overlay">
                            <h1><?php echo $rows['m_adi'] ?></h1>
                            <h3>🎤 <?php echo $rows['m_sanatci'] ?></h3>
                            <br>
                            <button class="btn btn-light"><?php echo $rows['s_adi'] ?></button>
                            <button class="btn btn-light"><img src="images/graph.svg" style="width: 20px"><?php echo $istatistik['i_toplam']; ?></button>

                        </div>
                    </div>


                </center>
                <table id="table1" class="center" style="width:100%; margin-top: 25px;">
                    <thead>
                    <tr>
                        <th>
                            <center>🎼 ŞARKI SÖZLERİ 🎼</center>
                            
                            
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <tr>
                        <th>
                            <center><?php 
                            if(strlen($rows['m_sozler']) ==0 ){
                                echo "<br><br>Bu şarkıya ait söz bulunmamaktadır...<br><br>";
                            }
                            else{

                         
                            echo nl2br($rows['m_sozler']); }  ?></center>
                            
                        </th>
                       
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>
            <h1><center>Aynı Yöreye Ait Diğer Müzikler</center></h1>
            <div class="row" style="margin: 5px">
            <?php
               $sql = $db->qSql("SELECT * FROM muzikler  INNER JOIN sehirler ON muzikler.m_s_id = sehirler.s_id INNER JOIN istatistik ON muzikler.m_id = istatistik.i_m_id WHERE s_id = '" . htmlspecialchars($rows['s_id']) . "' AND m_durum = 1 Order By rand()  LIMIT 4");
               $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($row as $video) {
                    ?>
            <div class="col-md-6">
                    <div class="courses-container" onclick="location.href='detay.php?music=<?php echo $video['m_id']; ?>'">
                        <div class="course">
                            <div class="course-preview">
                            <center><h2><img src="images/graph2.svg" style="width: 20px;"><?php echo $video['i_gunluk']; ?> </h2></center>
                            </div>
                            <div class="course-info">
                                <h6><?php echo $video['m_sanatci']; ?></h6>
                                <h2><?php echo $video['m_adi']; ?></h2>
                                <span class="badge badge-light"><?php echo $video['s_adi'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
      <?php }  ?>
            </div></div>
        <div class="col-md-4">
            <div id="musicoynat">
                <div class="container-audio" style="margin-top: 25px; margin-bottom: 10px; padding-left: 30px">
                    <center>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                        <div class="colum1">
                            <div class="row"></div>
                        </div>
                    </center>

                </div>
                <div class="container-audio">
                    <audio controls loop autoplay>
                        <source src="muzikler/<?php echo $rows['m_video_id']; ?>.mp3" type="audio/ogg">
                        Your browser dose not Support the audio Tag
                    </audio>
                </div>
            </div>


            <button class="btn btn-info mt-3 mb-3" style="width: 100%;  font-size: 20px"><b>En Çok Dinlenenler</b></button>
                <?php
               $sql = $db->qSql("SELECT * FROM istatistik INNER JOIN muzikler ON istatistik.i_m_id = muzikler.m_id INNER JOIN sehirler ON istatistik.i_s_id = sehirler.s_id Order By i_gunluk DESC Limit 7");
               $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($row as $video) {
                    ?>
                    <div class="courses-container" onclick="location.href='detay.php?music=<?php echo $video['m_id']; ?>'">
                        <div class="course">
                            <div class="course-preview">
                                <center><h2><img src="images/graph2.svg" style="width: 20px;"><?php echo $video['i_gunluk']; ?> </h2></center>
                            </div>
                            <div class="course-info">
                                <h6><?php echo $video['m_sanatci']; ?></h6>
                                <h2><?php echo $video['m_adi']; ?></h2>
                                <span class="badge badge-light"><?php echo $video['s_adi']; ?></span>
                            </div>
                        </div>
                    </div>

                <?php } ?>

        </div>
    </div>
</div>
<script>
    function play(ID) {
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {oynat: ID},
            success: function (result) {
                $("#musicoynat").html(result);
            }

        });
    }
</script>
<div id="sehir">
</div>


<?php include'footer.php';?>