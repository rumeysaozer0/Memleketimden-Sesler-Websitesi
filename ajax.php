<?php
include 'config/CrudPDO.php';
$db = new CrudPDO();

if (isset($_POST['plaka'])) {

    $sql = $db->qSql("SELECT * FROM sehirler WHERE s_id = '" . htmlspecialchars($_POST['plaka']) . "'");
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $sql = $db->qSql("SELECT * FROM muzikler WHERE m_s_id = '" . $row['s_id'] . "' AND m_durum = 1");
    $muzikler = $sql->fetchAll(PDO::FETCH_ASSOC);

    $muzikSay = $sql->rowCount();
    if ($muzikSay == 0) {
        $muzikList = 'Bu şehre ait müzik veritabanında bulunmamaktadır.';
    } else {
        $muzikList = '';
    }


    foreach ($muzikler as $muzik) {
        $muzikList .= '<tr>

				<td>' . $muzik['m_adi'] . '</td>
                <td>' . $muzik['m_sanatci'] . '</td>
                <td><center><a href="detay.php?music=' . $muzik['m_id'] . '"><img src="https://image.flaticon.com/icons/png/128/1057/1057237.png" width="50" height="50"></a></center></td>
 </tr>';
    }
    echo '
     <div class="modal fade" id="sehirMuzikleriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <style>.modal-header{ background-color:purple; }</style>
                        <h5 class="modal-title" id="exampleModalLabel"><span style="color:white">🎶' . $row['s_adi'] . ' Müzikleri - ' . $row['s_plaka'] . '</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                     
                                   <table id="example" class="display" style="width:100%">
        <thead>
        <style>body {
  font: normal medium/1.4 sans-serif;

}
table {
  border-collapse: collapse;
  width: 100%;
  
}
th, td {
  padding: 0.25rem;
  text-align: left;
  border: 1px solid #ccc;
}
tbody tr:nth-child(odd) {
  background: #eee;
}</style>
            <tr>
                <th>Müzik Adı</th>
                <th>Sanatçı</th>
                <th>Oynat</th>
               
            </tr>
        </thead>
        <tbody>
           ' . $muzikList . '
        </tfoot>
       
    </table>
     
                    </div>
                    <div class="modal-footer">
                   <style> .modal-footer{ background-color:purple; }</style> 
                
                        <button type="button" class="btn btn-light" data-dismiss="modal">Kapat</button>
                      
                    </div>
                </div>
            </div>
        </div>
';
    echo '
<script>
     function haritaplay(ID) {
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: {haritaoynat: ID},
                success: function (result) {
                    $("#haritamusicoynat").html(result);
                }

            });
        }

</script>';

}
?>

<!--play ajax-->
<?php
if (isset($_POST['oynat'])) {

    $sql = $db->qSql("SELECT * FROM muzikler WHERE m_id = '" . htmlspecialchars($_POST['oynat']) . "'");
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container-audio" style="padding-left: 30px">
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
        </center>

    </div>
    <div class="container-audio">
        <audio controls loop autoplay>
            <source src="muzikler/.mp3" type="audio/ogg">
            Your browser dose not Support the audio Tag
        </audio>
    </div>


<?php } ?>
<!--rastgele muzik play ajax-->
<?php

if (isset($_POST['rastgele'])) {

$sql = $db->qSql("SELECT * FROM muzikler INNER JOIN sehirler ON muzikler.m_s_id = sehirler.s_id   WHERE m_s_id = '" . htmlspecialchars($_POST['rastgele']) . "' AND m_durum = 1 ORDER BY RAND() LIMIT 1");
$row = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->qSql("SELECT * FROM istatistik WHERE  i_m_id = '" . $row['m_id'] . "' ");
$istatistik = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() < 1 ){
    $sql = $db->qSql("INSERT INTO istatistik SET  i_m_id ='".$row['m_id']."' ,  i_s_id ='".$row['s_id']."' , i_gunluk = 1, i_haftalik = 1, i_aylik = 1, i_toplam =1");
  
}
else{

   
    $sql = $db->qSql("UPDATE istatistik SET  i_gunluk = i_gunluk + 1, i_haftalik = i_haftalik + 1, i_aylik = i_aylik +  1, i_toplam = i_toplam + 1  WHERE i_m_id = '" . $row['m_id']  . "'");
  
}

    echo'
    <div class="course-info"><br><center>
    <h1>~'.$row['s_adi'].'~</h1>
    <h6>'.$row['m_sanatci'].' 🎤</h6>
    <h2>🎶'.$row['m_adi'].'</h2>
   <center>
</div>
</div>
    <div class="col-md-6">
    <div class="courses-container" onclick="play('.$row['m_id'].')"> 
    </div>
   
</div><div class="container">
    <div id="rastgele" class="container-audio" style="padding-left: 30px">
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
        </center>
    </div>
    <div class="container-audio">
        <audio controls loop autoplay>
            <source src="muzikler/'.$row['m_video_id'].'.mp3" type="audio/ogg">
            Your browser dose not Support the audio Tag
        </audio>
    </div></div> <div class="course">
  
';

}?>

<!-- bize gönder ajax -->
<?php 
if(isset($_POST['bizeGonder'])){
    
  $sehirler = '';

  $sql = $db->qSql("SELECT * FROM sehirler");
  $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
  foreach($rows as $row){
  $sehirler .= '<option  value="'.$row['s_plaka'].'"> '.$row['s_adi'] .'</option>';
 } 

    if($_POST['bizeGonder'] == 1){
        echo '
        <h1>Müzik Gönderme Formu</h1><br>
  <form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Müzik Adı</label>
      <input type="text" class="form-control" id="muzik adi" name="madi">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Sanatçı Adı</label>
      <input type="text" class="form-control" id="sanatci" name="sanatci">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Dosya</label>
      <input type="text" class="form-control" id="dosya" name="dosya">
    </div>
    <div class="form-group col-md-6">
      <label for="sehir">Şehir</label>
      <select id="sehir" class="form-control" name="msehir">
        <option selected>Lütfen Şehri Seçiniz</option>
        '.$sehirler.'
      </select>
    </div>
  <div class="form-group col-md-11">
    <label for="sözler">Müziğin Sözleri</label>
    <textarea class="form-control" id="sozler" name="mesaj" placeholder="Müziğin Sözlerini Yazın" rows="4" name="sozler" ></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="muzik">Gönder</button></div>
</form><br>   
        ';
    }

    elseif($_POST['bizeGonder'] == 2){
echo'<h1>Resim Gönderme Formu</h1><br>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Resim Linki</label>
      <input type="text" class="form-control" id="dosya" name="link">
    </div>
    <div class="form-group col-md-6">
      <label for="sehir">Şehir</label>
      <select id="sehir" class="form-control" name="rsehir">
        <option selected>Lütfen Şehri Seçiniz</option>
        '.$sehirler.'
      </select>
    </div>
  <button type="submit" class="btn btn-primary" name="resim">Gönder</button></div>
</form><br>
<h1>Bilgi Gönderme Formu</h1><br>
<form>';
    }
    elseif($_POST['bizeGonder'] == 3){
echo'<h1>Bilgi Gönderme Formu</h1><br>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="sehir">Şehir</label>
      <select id="sehir" class="form-control" name="bsehir">
        <option selected>Lütfen Şehri Seçiniz</option>
        '.$sehirler.'
      </select>
    </div>
  <div class="form-group col-md-11">
    <label for="bilgi">Bilgi</label>
    <textarea class="form-control" id="sozler" name="mesaj" placeholder="Şeçili şehir hakkındaki bilgiyi buraya yazınız" rows="4" name="bilgi"></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="bilgi">Gönder</button></div>
</form><br>';
    }
    elseif($_POST['bizeGonder'] == 4){
        echo'
        <h1>Gezi Mekanı Gönderme Formu</h1><br>
          <form action="" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label >Başlık</label>
              <input type="text" class="form-control" name="baslik">
            </div>
            <div class="form-group col-md-6">
              <label>Resim Linki</label>
              <input type="text" class="form-control" name="gresim">
            </div>
            <div class="form-group col-md-6">
              <label>Şehir</label>
              <select class="form-control" name="gsehir">
                <option selected>Lütfen Şehri Seçiniz</option>
                '.$sehirler.'
              </select>
            </div>
          <div class="form-group col-md-11">
            <label for="sözler">Bilgi</label>
            <textarea class="form-control" id="sozler" name="gbilgi" placeholder="Gezi mekanı hakkında bilgi yazınız" rows="4"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="gezi">Gönder</button></div>
        </form><br>';

    }    
}

?>








