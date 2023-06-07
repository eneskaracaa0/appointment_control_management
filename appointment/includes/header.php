<?php echo !defined('AppointmentMng.1')  ? die('YETKİSİZ ERİŞİM YASAKLANDI') : ''; ?>
<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
                <div class="container">
                    <a class="navbar-brand mx-auto d-lg-none" href="index.php">
                        Doctor Appointment
                        <strong class="d-block">Management System</strong>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Anasayfa</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#about">Hakkımızda</a>
                            </li>

                           

                            <a class="navbar-brand d-none d-lg-block" href="index.php">
                                Randevu Takip
                                <strong class="d-block">Control Management System</strong>
                            </a>

                            <li class="nav-item">
                                <a class="nav-link" href="check-appointment.php">Randevu Kontrol</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#booking">Randevu Al</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#contact">İletişim</a>
                            </li>
                             <li class="nav-item active">
                                <a class="nav-link" href="doctor/login.php">Doktor</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>