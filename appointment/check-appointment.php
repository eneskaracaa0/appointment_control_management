<?php
 define('AppointmentMng.1',true);
session_start();
error_reporting(0);
include('doctor/includes/dbconnection.php');
 
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Doctor Appointment Management System || Home Page</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
        <script>
function getdoctors(val) {
     alert(val);
$.ajax({

type: "POST",
url: "get_doctors.php",
data:'sp_id='+val,
success: function(data){
$("#doctorlist").html(data);
}
});
}
</script>
    </head>
    
    <body id="top">
    
        <main>

            <?php include_once('includes/header.php');?>

          
       
            

            

            <section class="section-padding" id="booking">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-lg-12 col-12 mx-auto">
                            <div class="booking-form">
                                
                                <h5 class="text-center mb-lg-3 mb-2">Randevu Geçmişini Randevu Numarasına/Cep Numarasına Göre Arayın</h5>
                                <form role="form" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Randevu No./İsim/Telefon Numarası.">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6 mx-auto">
                                            <button type="submit" class="form-control" name="search" id="submit-button">Kontrol</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <?php
                    if(isset($_POST['search']))
                    { 
                    $sdata=$_POST['searchdata'];
  ?>
  <h4 align="center"> <?php  echo strtoupper($sdata);?>'adlı hastaya ait randevu sonuçları </h4>
                    
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Randevu Numarası</th>
                                        <th>Hasta Adı</th>
                                        <th>Telefon Numarası</th>
                                        <th>Email</th>
                                    <th>Durum</th>
                                        <th>Açıklama</th>
                                        
                                    </tr>
                                </thead>
                            
                                <tbody>
                  <?php
            $sql="SELECT * from tblappointment where AppointmentNumber like '$sdata%' ||  MobileNumber like '$sdata%'";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);

            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $row)
            {               ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->AppointmentNumber);?></td>
                                        <td><?php  echo htmlentities($row->Name);?></td>
                                        <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                        <td><?php  echo htmlentities($row->Email);?></td>
                                        <?php if($row->Status==""){ ?>

                     <td><?php echo "Henüz Güncellenmedi"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>             
                                        <?php if($row->Remark==""){ ?>

                     <td><?php echo "Henüz Güncellenmedi"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
                                        
                                    </tr>
                                
    
                                </tbody>
             
                <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> Üzgünüm sonuç bulunamadı.</td>

  </tr>
  <?php } }?>
                            </table>
                        </div>

                    </div>
                </div>
            </section>
             
        </main>
        <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
      