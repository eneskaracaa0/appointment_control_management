<?php

session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');
 define('AppointmentMng.1',true);  //Erişim kısıtlama



  
?>
<!doctype html>
<html lang="en">
    <head>
       
        <title>Doctor Appointment Management System || Home Page</title>

        <!-- <link rel="stylesheet" href="doctor/libs/bower/font-awesome/css/font-awesome.min.css"> -->
        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="css/all.css" rel="stylesheet">
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">
        
       

    </head>
    
    <body id="top">
   
    
        <main>

            <?php include_once('includes/header.php');?>
            <?php
             $blog_id=$_GET['blog_id'];
            $query=$dbh->prepare('SELECT * FROM blog WHERE blog_id=?');
            $query->execute([$blog_id]);
            $result=$query->fetch(PDO::FETCH_ASSOC);            
            ?>
           
            <div class="container-fluid">
               
               <div class="card mb-3" style="max-width: 100%;">
               <div class="row g-0">
                <div class="card">
                    <section
             class="d-flex justify-content-between p-4"
             style="background-color: #4682b4"
             >
      <!-- Left -->
      <div class="me-5 justify-content-center">
       
      </div>
      <!-- Left -->
 <span style="color:white;font-size:18px;">Blog Yazıları >> <?php echo $result['blog_title'];?></span>
      <!-- Right -->
      <div>
       
      </div>
      <!-- Right -->
    </section>
                </div>
               </div>
        <div class="row g-0">
            
            <div class="col-md-4">
            <img src="doctor/<?php echo $result['blog_img'];?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo $result['blog_title']?></h5>
                <p class="card-text"><?php echo $result['blog_text'];?></p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
            </div>
        </div>
        </div>
            </div>
           

           
            
        </main>
        <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
       
        <script>
            $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
        </script>
    </body>
</html>