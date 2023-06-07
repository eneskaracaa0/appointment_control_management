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
  if(isset($_POST['blog_content'])){
    $title=$_POST['blog_title'];
    $text=$_POST['blog_text'];
    if($_FILES['myFile']['type']=="image/jpeg"){
        $tmpname=$_FILES['myFile']['tmp_name'];
        $filename=$_FILES['myFile']['name'];
        $number=rand(1000,9999);
        $newname="images/blogimg/".$number.$filename;
       if (move_uploaded_file($tmpname,$newname)){
        echo 'dosya başarıyla yüklendi';
        $query=$dbh->prepare('INSERT INTO blog SET blog_img=?,blog_title=?,blog_text=? ');
        $query->execute(array(
            $newname,$title,$text
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
            <h5>BLOG İÇERİK YÜKLEME</h5>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
           <form method="POST" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">İçerik Başlık</label>
    <input type="text" class="form-control" name="blog_title" placeholder="Blog Title">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">İçerik Yazı</label>
    <textarea class="form-control" name="blog_text" rows="3"></textarea>
  </div>
   <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">İçerik Resim </label>
                <input type="file" class="form-control" name="myFile" id="inputGroupFile01">
                </div>
  <input type="submit" name="blog_content" class="btn btn-info">
</form>
            </div>
            
          </div>
  </hr>
  </div>
  </div>
  </div>
  </section>
  </div>




  </main>

   









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