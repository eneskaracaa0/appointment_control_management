<?php

session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');
 define('AppointmentMng.1',true);  //Erişim kısıtlama
    if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST")
  {
 $name=$_POST['name'];
  $mobnum=$_POST['phone'];
 $email=$_POST['email'];
 $appdate=$_POST['date'];
 $aaptime=$_POST['time'];
 $specialization=$_POST['specialization'];
  $doctorlist=$_POST['doctorlist'];
 $message=$_POST['message'];
 $aptnumber=mt_rand(100000000, 999999999);
 $cdate=date('Y-m-d');

if($appdate<=$cdate){
   echo '<div class="alert alert-danger">Randevu tarihi bugünün tarihinden ileri olmalıdır.</div>';
} else {
    $ishave = $dbh->prepare('SELECT * FROM tblappointment WHERE AppointmentDate = ? AND AppointmentTime = ?');
$rnd = $ishave->execute(array($appdate, $aaptime));
    if($rnd && $ishave->rowCount() > 0 ){

      echo '<div class="alert alert-warning">Seçmiş Olduğunuz randevu tarihi ve saati doludur lütfen başka bir randevu alınız</div>';
        
    }else{
        $sql="insert into tblappointment(AppointmentNumber,Name,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Doctor,Message)values(:aptnumber,:name,:mobnum,:email,:appdate,:aaptime,:specialization,:doctorlist,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':aptnumber',$aptnumber,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':appdate',$appdate,PDO::PARAM_STR);
$query->bindParam(':aaptime',$aaptime,PDO::PARAM_STR);
$query->bindParam(':specialization',$specialization,PDO::PARAM_STR);
$query->bindParam(':doctorlist',$doctorlist,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
   echo '<div class="alert alert-success">Randevunu< başarıyla oluşturuldu</div>';
// header('Location:includes/emailsend.php');
  }
  else
    {
        echo '<div class="Üzgünüm bir hata oluştu"';
    
    }
}

    }

}
?>
<!doctype html>
<html lang="en">
    <head>
       
        <title>Online Randevu</title>

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
        <link rel="stylesheet" href="css/style.css">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
        
        <script>
function getdoctors(val) {
  //  alert(val);
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

            <div class="container my-5 academic">
               <div class="owl-carousel owl-theme personel">
                <?php 
                $slider=$dbh->prepare('SELECT * FROM web ');
                $slider->execute();
                foreach($slider as $slide)
                {


                ?>
                <div class="row item">
                    <div class="card">
                        <img src="doctor/<?php echo $slide['web_image'];?>" style="height:300px;" class="img-fluid">
                   </div>
                   
                   <div class="card-text">
                    <a><?php echo $slide['web_baslik']; ?></a>
                   </div>
                </div>
                <?php } ?>
            </div>
                
            </div>

            <section class="section-padding" id="about">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-12">
                            <?php
$sql="SELECT * from tblpage where PageType='Hakkımızda'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <h2 class="mb-lg-3 mb-3"><?php  echo htmlentities($row->PageTitle);?></h2>

                            <p><?php  echo ($row->PageDescription);?>.</p>

                           <?php $cnt=$cnt+1;}} ?>
                        </div>

                        <div class="col-lg-4 col-md-5 col-12 mx-auto">
                            <div class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                                <p class="featured-text"><span class="featured-number">12</span> Yıl<br>    Deneyim</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="gallery">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-6 ps-0">
                            <img src="images/gallery/medium-shot-man-getting-vaccine.jpg" class="img-fluid galleryImage" alt="get a vaccine" title="get a vaccine for yourself">
                        </div>

                        <div class="col-lg-6 col-6 pe-0">
                            <img src="images/gallery/female-doctor-with-presenting-hand-gesture.jpg" class="img-fluid galleryImage" alt="wear a mask" title="wear a mask to protect yourself">
                        </div>

                    </div>
                </div>
            </section>
 <h5 class="text-center mt-5">BLOG YAZILARI</h5>
            <section class="section-padding" >
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
 <div class="owl-carousel owl-theme">
        <?php
                $query=$dbh->prepare('SELECT * FROM blog');
                $query->execute();
                if($query->rowCount() >0){

                    foreach($query as $blog){

                  
                
                ?>
              
            <div class="item">
               
                <div class="card mx-auto" style="width: 18rem;">
        <img src="doctor/<?php echo $blog['blog_img'];?>" class="card-img-top" style="height:200px;" alt="...">
        <div class="card-body">
            <h5 class="card-title"></h5><?php echo substr($blog['blog_title'],0,20,).'' ?></h5>
            <p class="card-text" style="font-size:12px"></p><?php echo substr($blog['blog_text'],0,100).'..' ?></p>
            <a href="blog_content.php?blog_id=<?php echo $blog['blog_id'];?>" class="btn btn-primary btn-sm btn-blog">Devamını Oku</a>
        </div>
                </div>
                </div>
           
           <?php   } }?>
           
        </div>

                </div>

            </div>
         
        </div>
        </section>

            

            

            <section class="section-padding " id="booking">
                <div class="container" >
                    <div class="row ">
                    
                        <div class="col-lg-8 col-12 mx-auto">
                            <div class="booking-form">
                                
                                <h5 class="text-center mb-lg-3 mb-2">Online Randevu Al</h5>
                            
                                <form role="form" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Ad Soyad" required='true'>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email Adres" required='true'>
                                        </div>
                                   
                                        <div class="col-lg-6 col-12">
                                            <input type="telephone" name="phone" id="phone" class="form-control" placeholder="Telefon Numarası" maxlength="10">
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <input type="date" name="date" id="date" value="" class="form-control">
                                            
                                        </div>

                                            <div class="col-lg-6 col-12">
                                            <input type="time" name="time" id="time" value="" class="form-control">
                                            
                                        </div>

    <div class="col-lg-6 col-12">
<select onChange="getdoctors(this.value);"  name="specialization" id="specialization" class="form-control" required>
<option value="">Bölüm Seç</option>
<!--- Fetching States--->
<?php
$sql="SELECT * FROM tblspecialization";
$stmt=$dbh->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row =$stmt->fetch()) { 
  ?>
<option value="<?php echo $row['ID'];?>"><?php echo $row['Specialization'];?></option>
<?php }?>
</select>
</div>


    <div class="col-lg-6 col-12">
<select name="doctorlist" id="doctorlist" class="form-control">
<option value="">Doktor Seç</option>
</select>
</div>



                                        <div class="col-12">
                                            <textarea class="form-control" rows="5" id="message" name="message" placeholder="Ek Mesaj"></textarea>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-6 mx-auto">
                                            <button type="submit" class="form-control" name="submit" id="submit-button">Randevu Oluştur</button>
                                           
                                           
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
        <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
       