<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!--Slider İnsert -->
  <?php
  if(isset($_POST['insertslider'])){
    $title=$_POST['web_baslik'];
    if($_FILES['myFile']['type']=="image/jpeg"){
        $tmpname=$_FILES['myFile']['tmp_name'];
        $filename=$_FILES['myFile']['name'];
        $number=rand(1000,9999);
        $newname="images/sliderimg/".$number.$filename;
       if (move_uploaded_file($tmpname,$newname)){
        echo 'dosya başarıyla yüklendi';

        $query=$dbh->prepare('INSERT INTO web SET web_image=?,web_baslik=? ');
        $query->execute(array(
            $newname,$title
        ));
        if($query){
            header('Location:webcontrol-management.php');
            
        }else{
            echo '<div class="alert alert-danger">hata</div>';
        }

       }

        

    }
  }
  
  ?>
  <!--END Slider İnsert -->



<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>DAMS - WebCMS</title>
	
	<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.css">
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
  <section class="app-content">
    <div class="row">
     
      <div class="col-md-6">
        <div class="widget">
          <header class="widget-header">
            <h5>Slider Resim Ekleme Ayarları</h5>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
            <form action="" method="POST" enctype="multipart/form-data">
              
                 <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Slide Resim Ekle</label>
                <input type="file" class="form-control" name="myFile" id="inputGroupFile01">
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Başık Ekle</label>
                <input type="text" class="form-control" name="web_baslik">
                </div>
               
                <input type="submit" class="btn btn-info" name="insertslider"></input>
            </form>
            </div>
            
          </div>
  </hr>
  </div>
  </div>
  </div>
  </section>
  </div>
<div class="wrap">
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
            <input class="form-check-input" type="radio" name="PageType" value="Hakkımızda" id="exampleRadios1"  checked>
            <label class="form-check-label" for="exampleRadios1">
              Hakkımızda
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="PageType" value="İletişim"  id="exampleRadios2" >
            <label class="form-check-label" for="exampleRadios2">
              İletişim
            </label>
          </div>
              
                <div class="mb-3">
              <label for="aboutitle" class="form-label"> Başlık</label>
              <input type="text" class="form-control" name="PageTitle" id="PageTitle" placeholder="Başlık Giriniz">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"> Açıklama</label>
              <textarea class="form-control" id="PageDescription" name="PageDescription" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="Email" name="Email" ></input>
            </div>
             <div class="mb-3">
              <label for="mobilenumber" class="form-label">Telefon Numarası</label>
              <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" ></input>
            </div>
               
              <button class="btn btn-primary mb-3" name="insertabout" type="submit">Ekle</button>
             
            </form>
            
          </div>
  </hr>
  </div>
  </div>
  </div>
 










  </section>




   <section class="app-content">
    <div class="row">
     
      <div class="col-md-8">
        <div class="widget">
          <header class="widget-header">
            <h3 class="widget-title">Bölüm Güncelleme</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Bölüm</th>
      <th scope="col">Başlık</th>
      <th scope="col">Açıklama</th>
      <th scope="col">Email</th>
      <th scope="col">Telefon Numarası</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query=$dbh->prepare('SELECT * FROM tblpage');
    $query->execute();
    foreach($query as $page){

   

    ?>
    <tr>
      <th scope="row"><?php echo $page['ID'];?></th>
      <td><?php echo $page['PageType'];?></td>
      <td><?php echo $page['PageTitle'];?></td>
      <td><?php echo $page['PageDescription'];?></td>
        <td><?php echo $page['Email'];?></td>
      <td><?php echo $page['MobileNumber'];?></td>
      <td>
        <a href="pageupdate.php?ID=<?php echo $page['ID'] ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
										<a href="pageupdate.php?sil=sil&ID=<?php echo $page['ID'] ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
            
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