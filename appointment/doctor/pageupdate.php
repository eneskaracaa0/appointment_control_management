<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

   
    
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
  } else{



  ?>




<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>DAMS - WebCMS</title>
	
	<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
	<!-- build:css assets/css/app.min.css -->
	<link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/core.css">
	<link rel="stylesheet" href="assets/css/app.css">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
  <!--Sweetalert-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--Sweetalert-->
	<script>
		Breakpoints();
	</script>
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->


 <?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>

<main id="app-main" class="app-main">
  <div class="wrap">
     <h3 class="widget-title" style="text-align:center;">WEB CONTROL MANAGEMENT</h3>
 
     <?php
       $ID=$_GET['ID'];
     $query=$dbh->prepare('SELECT * FROM tblpage WHERE ID=?');
      $query->execute([$ID]);
      $result=$query->fetch(PDO::FETCH_ASSOC);

      if(isset($_POST['updatepage'])){
        $PageType=$_POST['PageType'];
        $PageTitle=$_POST['PageTitle'];
        $PageDescription=$_POST['PageDescription'];
        $Email=$_POST['Email'];
        $MobileNumber=$_POST['MobileNumber'];
        $updatepage=$dbh->prepare('UPDATE tblpage SET PageType=?,PageTitle=?,PageDescription=?, Email=?,MobileNumber=? WHERE ID=?');
        $updatepage->execute(array($PageType,$PageTitle,$PageDescription,$Email,$MobileNumber,$ID));
        
        if($updatepage){
            
            echo "<script>Swal.fire(
          'Başarılı!',
          'Başarıyla Güncellendi',
          'success')
          </script>";
        }else{
             echo "<script>Swal.fire(
          'Hata Oluştu',
          'Lütfen Tekrar Deneyiniz',
          'danger')
          </script>";
        }
      }
     ?>




    <section class="app-content">
    <div class="row">
     
      <div class="col-md-6">
        <div class="widget">
          <header class="widget-header">
            <h3 class="widget-title">Sayfa Ayarları</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
            <form action="" method="POST">
               <label for="checktitle" class="form-label">Kategori Seçimi</label>
              <div class="form-check">
            <input class="form-check-input" type="radio" name="PageType" value="Hakkımızda" <?php  echo ($result['PageType'] == 'Hakkımızda') ? 'checked' : ' '  ?> id="exampleRadios1"  checked>
            <label class="form-check-label" for="exampleRadios1">
              Hakkımızda
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="PageType" value="İletişim" <?php echo ($result['PageType'] == 'İletişim') ? 'checked' : ' '  ?> id="exampleRadios2" >
            <label class="form-check-label" for="exampleRadios2">
              İletişim
            </label>
          </div>
              
                <div class="mb-3">
              <label for="aboutitle" class="form-label"> Başlık</label>
              <input type="text" class="form-control" name="PageTitle" value="<?php echo $result['PageTitle'];?>" id="PageTitle" placeholder="Başlık Giriniz">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"> Açıklama</label>
              <input type="text" class="form-control" id="PageDescription" name="PageDescription" value="<?php echo $result['PageDescription']; ?>" ></input>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $result['Email']?>" ></input>
            </div>
             <div class="mb-3">
              <label for="mobilenumber" class="form-label">Telefon Numarası</label>
              <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo $result['MobileNumber']?>" ></input>
            </div>
               
              <button class="btn btn-primary mb-3" name="updatepage" type="submit">Güncelle</button>
            </form>
            
          </div>
  </hr>
  </div>
  </div>
  </div>
 










  </section>





  </main>

    <!--ABOUT PAGE INSERT-->
  <?php
  if(isset($_POST['insertabout'])){
    $pagetype=$_POST['PageType'];
    $pagetitle=$_POST['PageTitle'];
    $pagedescription=$_POST['PageDescription'];
    $email=$_POST['Email'];
    $mobilenumber=$_POST['MobileNumber'];
    if(empty($pagetitle) & empty($pagedescription)){
       echo "<script>Swal.fire(
          'Hata Oluştu',
          'Lütfen Boş Bırakmayınız',
          'warning')
          </script>";
    }else{

    
     $query=$dbh->prepare('INSERT INTO
                          tblpage SET
    PageType=?,
    PageTitle=?,
    PageDescription=?,
    Email=?,
    MobileNumber=? 
     ');
     $query->execute(array(
      $pagetype,$pagetitle,$pagedescription,$email,$mobilenumber
     ));
   
     if($query){
     echo "<script>Swal.fire(
          'Başarılı!',
          'Başarıyla Kaydedildi',
          'success')
          </script>";
     }else{
      echo "<script>Swal.fire(
          'Hata Oluştu',
          'Lütfen Tekrar Deneyiniz',
          'danger')
          </script>";
     }
     }

    
  }
  
  ?>
    <!--END ABOUT PAGE INSERT-->








  <!-- APP FOOTER -->
 <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->



<?php include_once('includes/customizer.php');?>
	
	

	<!-- build:js assets/js/core.min.js -->
	<script src="libs/bower/jquery/dist/jquery.js"></script>
	<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="libs/bower/PACE/pace.min.js"></script>
	<!-- endbuild -->

	<!-- build:js assets/js/app.min.js -->
	<script src="assets/js/library.js"></script>
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/app.js"></script>
	<!-- endbuild -->
	<script src="libs/bower/moment/moment.js"></script>
	<script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="assets/js/fullcalendar.js"></script>
</body>
</html>
<?php }  ?>