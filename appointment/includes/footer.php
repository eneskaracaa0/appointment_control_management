<?php echo !defined('AppointmentMng.1')  ? die('YETKİSİZ ERİŞİM YASAKLANDI') : ''; ?>

  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white"
          style="background-color: #1c2331"
          >
    <!-- Section: Social media -->
    <section
             class="d-flex justify-content-between p-4"
             style="background-color: #6351ce"
             >
      <!-- Left -->
      <div class="me-5">
        <span></span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
      <i class="bi bi-facebook"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="bi bi-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="bi bi-github"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="bi bi-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
       
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <?php
            $sql="SELECT * from tblpage where PageType='İletişim'";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);

                $cnt=1;
                if($query->rowCount() > 0)
                {
                foreach($results as $row)
                {               ?>
            
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">  <?php echo $row->PageTitle ?></h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
             <?php echo $row->PageDescription ?>
            </p>
            <?php $cnt=$cnt+1; }}?>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Sayfalar</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">Anasayfa</a>
            </p>
            <p>
              <a href="#about" class="text-white">Hakkımızda</a>
            </p>
            <p>
              <a href="#booking" class="text-white">Randevu Kontrol</a>
            </p>
            <p>
              <a href="check-appointment.php" class="text-white">Online Randevu</a>
            </p>
              <p>
              <a href="#contact" class="text-white">İletişim</a>
            </p>
          </div>
          <!-- Grid column -->

          
      

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">İletişim</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i>Ataşehir/Kozyatağı İstanbul/Türkiye </p>
            <p><i class="fas fa-envelope mr-3"></i> <?php
            echo $row->Email?></p>
            <p><i class="fas fa-phone mr-3"></i> <?php echo $row->MobileNumber ?></p>
            
          </div>
          <!-- Grid column -->


           <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
           <div class="app">
        <div class="header">
            <h1>Hava Durumu</h1>
            <input type="text" id="searchBar" Placeholder="Şehir giriniz..">
        </div>
        <div class="content">
            <div class="city">ıstanbul, TR</div>
            <div class="temp">15°C</div>
            <div class="desc">Gunesli</div>
            <div class="minmax">14°C / 19°C</div>
        </div>
    </div>
            
          </div>
          <!-- Grid column -->
          
        
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2023 Copyright:
      <a class="text-white" href="http://localhost/appointment_control_management/appointment"
         >Online Randevu Takip Sistemi</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
        <script>
        const url = "https://api.openweathermap.org/data/2.5/"
const key = "7d25eb467a5e851f9de46d590290c795"
const setQuery = (e) => {
    if (e.keyCode == "13") {
        getResult(searchBar.value)
    }
}
const getResult = (cityName) => {
    let query = `${url}weather?q=${cityName}&appid=${key}&units=metric&lang=tr`
    fetch(query)
    .then(weather => {
        return weather.json()
    })
    .then(displayResult)
}
const displayResult = (result) => {
    let city = document.querySelector(".city");
    city.innerText = `${result.name}, ${result.sys.country}`
    let temp = document.querySelector(".temp")
    temp.innerText = `${Math.round(result.main.temp)}°C`
    let desc = document.querySelector(".desc")
    desc.innerText = result.weather[0].description
    let minmax = document.querySelector(".minmax")
    minmax.innerText = `${Math.round(result.main.temp_min)}°C / ${Math.round(result.main.temp_max)}°C`
}
const searchBar = document.getElementById("searchBar")
searchBar.addEventListener("keypress", setQuery)
        </script>
      
        <script>
        $('.personel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
        </script>
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


