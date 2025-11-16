<?php
include_once('hms/include/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$dscrption=$_POST['description'];
$query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
echo "<script>alert('Your information succesfully submitted');</script>";
echo "<script>window.location.href ='index.php'</script>";

} ?>
<!doctype html>
<html lang="en">
    <?php
// Include the chatbot widget
include_once('chatbot_widget.php');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> HealTrack </title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <style>
        /* ===== Custom Aesthetic Color Palette ===== */
        :root {
            --sage: #769382;
            --linen: #c0c3b9;
            --sage-dark: #5a6e5c;
            --offwhite: #F3EFE3;
            --primary: var(--sage);
            --secondary: var(--linen);
            --accent: var(--sage-dark);
            --light: var(--offwhite);
            --footer-gradient: linear-gradient(90deg, var(--sage) 0%, var(--linen) 100%);
            --button: var(--sage);
            --button-hover: var(--sage-dark);
            --main-bg: #c0c3b9; /* Use your main color for everything */
            --main-text: #355144;
            --main-accent: #769382;
            --main-white: #f3efe3;
        }
        body {
            background: var(--main-bg) !important;
            color: var(--main-text) !important;
        }
        .chatbot-widget {
    z-index: 99999;
}

/* Mobile adjustments for your existing layout */
@media (max-width: 768px) {
    .chatbot-container {
        width: calc(100vw - 20px);
        height: calc(100vh - 100px);
        bottom: 10px;
        right: 10px;
        left: 10px;
    }
}

/* Integration with your color scheme */
.chatbot-header {
    background: var(--footer-gradient) !important;
}

.bot-message .message-content {
    background: var(--linen) !important;
    color: var(--accent) !important;
    border: 1px solid var(--sage) !important;
}

.user-message .message-content {
    background: var(--sage) !important;
}

.quick-btn:hover {
    background: var(--sage) !important;
    color: white !important;
}

        .header-nav, #nav-head {
            background: var(--footer-gradient);
            color: #fff;
            box-shadow: 0 2px 8px rgba(118,147,130,0.08);
        }
        .header-nav ul li a {
            color: var(--accent) !important;
            font-weight: 600;
            transition: color 0.2s;
        }
        .header-nav ul li a:hover {
            color: var(--primary) !important;
            text-decoration: underline;
        }
        .appoint .btn-success {
            background: var(--button);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(118,147,130,0.08);
        }
        .appoint .btn-success:hover {
            background: var(--button-hover);
        }
        .carousel-caption h5 {
            color: var(--primary);
            text-shadow: 2px 2px 8px var(--offwhite);
            font-weight: bold;
        }
        .carousel-cover {
            background: rgba(118,147,130,0.10);
        }
        .key-features .single-key {
            background: var(--linen);
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(192,195,185,0.08);
            margin-bottom: 30px;
            padding: 30px 0;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .key-features .single-key:hover {
            box-shadow: 0 6px 24px rgba(118,147,130,0.18);
            background: var(--offwhite);
        }
        .key-features .single-key i {
            color: var(--sage);
            font-size: 36px;
            margin-bottom: 10px;
        }
        .about-us {
            background: var(--linen);
        }
        .about-us h3 {
            color: var(--sage);
            font-weight: bold;
        }
        .gallery-filter .btn-default {
            background: var(--sage);
            color: #fff;
            border: none;
            margin: 0 5px 10px 0;
            border-radius: 20px;
            transition: background 0.2s;
        }
        .gallery-filter .btn-default:hover, .gallery-filter .btn-default.active {
            background: var(--linen);
            color: var(--accent);
        }
        .gallery_product img {
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(192,195,185,0.08);
            transition: transform 0.2s;
            background: var(--offwhite);
        }
        .gallery_product img:hover {
            transform: scale(1.04);
            box-shadow: 0 6px 24px rgba(118,147,130,0.18);
        }
        .contact-us-single {
            background: var(--linen);
            padding: 40px 0;
        }
        .contact-us-single h2 {
            color: var(--sage);
            font-weight: bold;
        }
        .contact-us-single .btn-success {
            background: var(--button);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: background 0.2s;
        }
        .contact-us-single .btn-success:hover {
            background: var(--button-hover);
        }
        .form-control {
            background: var(--offwhite);
            border: 1px solid var(--linen);
            color: var(--accent);
        }
        .form-control:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 2px var(--linen);
        }
        /* ===== Footer ===== */
        .footer-section {
            background: var(--footer-gradient);
            color: var(--accent);
            padding: 0;
            margin-top: 40px;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .footer-section .container {
            padding-top: 48px;
            padding-bottom: 24px;
        }
        .footer-section h2, .footer-section h5 {
            color: var(--accent);
        }
        .footer-section .brand-logo {
            background: var(--offwhite);
            border-radius: 18px 50% 50% 18px;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(192,195,185,0.18);
            margin-bottom: 18px;
            border: 4px solid var(--sage);
            transition: box-shadow 0.2s;
        }
        .footer-section .brand-logo img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
        .footer-section .brand-logo:hover {
            box-shadow: 0 8px 32px rgba(118,147,130,0.28);
        }
        .footer-section .social a {
            color: var(--sage);
            background: var(--offwhite);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: background 0.2s, color 0.2s;
        }
        .footer-section .social a:hover {
            background: var(--sage);
            color: #fff;
        }
        .footer-section hr {
            background: var(--sage);
        }
        @media (max-width: 767px) {
            .footer-section .container {
                padding-top: 32px;
                padding-bottom: 12px;
            }
            .footer-section .brand-logo {
                margin: 0 auto 18px auto;
            }
        }
        .carousel-caption.vdg-cur {
            left: 7%;
            top: 18%;
            bottom: auto;
            right: auto;
            text-align: left;
            background: rgba(192, 195, 185, 0.92); /* linen color with opacity */
            border-radius: 28px;
            padding: 48px 56px 40px 56px;
            min-width: 340px;
            max-width: 440px;
            box-shadow: 0 8px 32px rgba(118,147,130,0.13);
            backdrop-filter: blur(2px);
            animation: fadeInDown 1s;
        }
        .carousel-caption.vdg-cur h5 {
            color: #769382;
            font-size: 2.6rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            margin-bottom: 10px;
            text-shadow: none;
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.1;
            animation: fadeInLeft 1.2s;
        }
        .carousel-caption.vdg-cur .subtitle {
            color: #5a6e5c;
            font-size: 1.15rem;
            margin-bottom: 22px;
            font-weight: 500;
            animation: fadeInLeft 1.5s;
        }
        .carousel-caption.vdg-cur .cta-btn {
            background: #769382;
            color: #fff;
            border: none;
            border-radius: 24px;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 700;
            box-shadow: 0 2px 12px rgba(118,147,130,0.13);
            transition: background 0.2s, transform 0.2s;
            margin-top: 10px;
            animation: fadeInUp 1.7s;
        }
        .carousel-caption.vdg-cur .cta-btn:hover {
            background: #5a6e5c;
            color: #fff;
            transform: translateY(-2px) scale(1.04);
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: drop-shadow(0 0 6px #769382);
            width: 48px;
            height: 48px;
            background-size: 48px 48px;
        }
        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            filter: drop-shadow(0 0 12px #769382);
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-40px);}
            to { opacity: 1; transform: translateY(0);}
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px);}
            to { opacity: 1; transform: translateX(0);}
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px);}
            to { opacity: 1; transform: translateY(0);}
        }

        /* Animated medicine background for header/footer */
        .animated-bg-bar {
            position: absolute;
            left: 0; top: 0; width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .pill, .capsule, .tablet {
            position: absolute;
            opacity: 0.7;
            animation: float-move-bar linear infinite;
        }
        .pill {
            width: 22px; height: 22px;
            background: linear-gradient(135deg, #769382 60%, #fff 100%);
            border-radius: 50%;
            box-shadow: 0 2px 8px #c0c3b9;
        }
        .capsule {
            width: 32px; height: 12px;
            background: linear-gradient(90deg, #c0c3b9 50%, #769382 100%);
            border-radius: 12px 12px 12px 12px / 20px 20px 20px 20px;
            box-shadow: 0 2px 8px #769382;
        }
        .tablet {
            width: 16px; height: 16px;
            background: #fff;
            border-radius: 50%;
            border: 2px solid #c0c3b9;
            box-shadow: 0 2px 8px #c0c3b9;
        }
        @keyframes float-move-bar {
            0% {
                transform: translateY(0) scale(1) rotate(0deg);
                opacity: 0.7;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                transform: translateY(40px) scale(1.1) rotate(360deg);
                opacity: 0.7;
            }
        }
        /* Ensure header/footer content is above animation */
        .header-nav, .footer-section {
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .header-nav > .container, .footer-section > .container {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

    <body>

    <!-- ################# Header Starts Here#######################--->
    
      <header id="menu-jk">

    <div id="nav-head" class="header-nav">
        <div class="animated-bg-bar" id="header-animated-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-12 d-flex align-items-center" style="font-weight:bold; font-size:21px; margin-top: 1% !important;">
                    <div class="brand-logo" style="width:70px; height:70px; margin-bottom:0; margin-right:10px; background: var(--offwhite); border-radius: 18px 50% 50% 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(192,195,185,0.18); border: 4px solid var(--sage);">
                            <img src="assets/images/HealTrack.png" alt="HealTrack Logo" style="width:48px; height:48px; border-radius:50%; object-fit:cover;">
                        </div>
                        HealTrack
                        <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                </div>
                <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about_us">About Us</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#contact_us">Contact Us</a></li>
                        <li><a href="#logins">Logins</a></li>  
                    </ul>
                </div>
                <div class="col-sm-2 d-none d-lg-block appoint">
                    <a class="btn btn-success" href="hms/user-login.php">Book an Appointment</a>
                </div>
            </div>
        </div>
    </div>
</header>
    
     <!-- ################# Slider Starts Here#######################--->

    <div class="slider-detail">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>


   


            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/slider_3.jpg" alt="First slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5>HealTrack</h5>
                        <div class="subtitle">Your Health, Our Track</div>
                        <div class="subtitle" style="font-size:1rem; color:#769382;">
                Track prescriptions, schedule visits, and manage your health records with ease.
            </div>
                        <a href="#logins" class="cta-btn">Get Started</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/images/slider/slider_2.jpg" alt="Second slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5>Easy Appointment Booking</h5>
                        <div class="subtitle">Book your doctor visits in seconds, anytime.</div>
                        <a href="#logins" class="cta-btn">Book Appointment</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </div>
    
  <!--  ************************* Logins ************************** -->
    
    
     <section id="logins" class="our-blog container-fluid">
        <div class="container">
        <div class="inner-title">

                <h2>Logins</h2>
            </div>
            <div class="col-sm-12 blog-cont">
                <div class="row no-margin">
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                                <img src="assets/images/patient.jpg" alt="">

                            <div class="blog-single-det">
                                <h6>Patient Login</h6>
                                <a href="hms/user-login.php" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                                <img src="assets/images/doctor.jpg" alt="">

                            <div class="blog-single-det">
                                <h6>Doctors login</h6>
                                <a href="hms/doctor" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                                <img src="assets/images/admin.jpg" alt="">

                            <div class="blog-single-det">
                                <h6>Admin Login</h6>
                    
                                <a href="hms/admin" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    

                    
                    
                </div>
            </div>
            
        </div>
    </section>  







    <!-- ################# Our Departments Starts Here#######################--->


    <section id="services" class="key-features department">
        <div class="container">
            <div class="inner-title">

                <h2>Our Key Features</h2>
                <p>Take a look at some of our key features</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-heartbeat"></i>
                        <h5>Cardiology</h5>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-ribbon"></i>
                        <h5>Orthopaedic</h5>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                       <i class="fab fa-monero"></i>
                        <h5>Neurologist</h5>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-capsules"></i>
                        <h5>Pharma Pipeline</h5>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <h5>Pharma Team</h5>
                    </div>
                </div>



                <div class="col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="far fa-thumbs-up"></i>
                        <h5>High Quality treatments</h5>

                    </div>
                </div>
            </div>






        </div>

    </section>
    
    
  
    
    <!--  ************************* About Us Starts Here ************************** -->
        
    <section id="about_us" class="about-us">
        <div class="row no-margin">
            <div class="col-sm-6 no-padding">
    <img src="assets/images/k.jpg" alt="About Us" style="width:100%; height:auto;">
</div>

            <div class="col-sm-6 abut-yoiu">
                <h3>Who We Are</h3>
<?php
$ret=mysqli_query($con,"select * from tblpage where PageType='aboutus' ");
while ($row=mysqli_fetch_array($ret)) {
?>

    <p><?php  echo $row['PageDescription'];?>.</p><?php } ?>
            </div>
        </div>
    </section>    
    
    
            <!--  ************************* Gallery Starts Here ************************** -->
        <div id="gallery" class="gallery">    
           <div class="container">
              <div class="inner-title">

                <h2>Our Gallery</h2>
                <p>View Our Gallery</p>
            </div>
              <div class="row">
                

        <div class="gallery-filter d-none d-sm-block">
            <button class="btn btn-default filter-button" data-filter="all">All</button>
            <button class="btn btn-default filter-button" data-filter="hdpe">Dental</button>
            <button class="btn btn-default filter-button" data-filter="sprinkle">Cardiology</button>
            <button class="btn btn-default filter-button" data-filter="spray"> Neurology</button>
            <button class="btn btn-default filter-button" data-filter="irrigation">Laboratry</button>
        </div>
        <br/>



            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="assets/images/gallery/gallery_01.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="assets/images/gallery/gallery_02.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="assets/images/gallery/gallery_03.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="assets/images/gallery/gallery_04.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="assets/images/gallery/gallery_05.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="assets/images/gallery/gallery_06.jpg" class="img-responsive">
            </div>

        </div>
    </div>
       
       
       </div>
        <!-- ######## Gallery End ####### -->
    
    
     <!--  ************************* Contact Us Starts Here ************************** -->
   
    <section id="contact_us" class="contact-us-single">
        <div class="row no-margin">

            <div  class="col-sm-12 cop-ck">
                <form method="post">
                <h2 >Contact Form</h2>
                    <div class="row cf-ro">
                        <div  class="col-sm-3"><label>Enter Name :</label></div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Enter Name" name="fullname" class="form-control input-sm" required >
                        </div>
                    </div>


                    <div  class="row cf-ro">
                        <div  class="col-sm-3"><label>Email Address :</label></div>
                        <div class="col-sm-8"><input type="text" name="emailid" placeholder="Enter Email Address" class="form-control input-sm"  required></div>
                    </div>
                     <div  class="row cf-ro">
                        <div  class="col-sm-3"><label>Mobile Number:</label></div>
                        <div class="col-sm-8"><input type="text" name="mobileno" placeholder="Enter Mobile Number" class="form-control input-sm" required ></div>
                    </div>
                     <div  class="row cf-ro">
                        <div  class="col-sm-3"><label>Enter  Message:</label></div>
                        <div class="col-sm-8">
                          <textarea rows="5" placeholder="Enter Your Message" class="form-control input-sm" name="description" required></textarea>
                        </div>
                    </div>
                     <div  class="row cf-ro">
                        <div  class="col-sm-3"><label></label></div>
                        <div class="col-sm-8">
                         <button class="btn btn-success btn-sm" type="submit" name="submit">Send Message</button>
                        </div>
                </div>
            </form>
            </div>
     
        </div>
    </section>
    
    
    
    
    
    <!-- ################# Footer Starts Here#######################--->

    <footer class="footer-section" style="padding-top: 18px; padding-bottom: 10px;">
        <div class="animated-bg-bar" id="footer-animated-bg"></div>
        <div class="container">
            <div class="row align-items-center">
                <!-- Brand and Mission -->
                <div class="col-md-6 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start text-center text-md-left">
                    <div class="brand-logo" style="width:70px; height:70px; margin-bottom:10px;">
                        <img src="assets/images/HealTrack.png" alt="HealTrack Logo" style="width:48px; height:48px;">
                    </div>
                    <h2 style="font-weight:900; letter-spacing:2px; margin-bottom:6px; font-size:1.3rem; text-shadow: 1px 2px 8px #5685c4ff;">HealTrack</h2>
                    <p style="font-size:13px; max-width: 260px; margin-bottom:0;">
                        <span style="font-weight:600; color:#ffe082;">Empowering Healthier Lives</span><br>
                        Advanced technology meets compassionate care.<br>
                        <span style="color:#b2dfdb;">Your health, our priority.</span>
                    </p>
                </div>
                <!-- Contact & Social -->
                <div class="col-md-6 d-flex flex-column align-items-center align-items-md-end text-center text-md-right">
                    <h5 style="font-weight:bold; margin-bottom:10px; font-size:1rem;">Contact Us</h5>
                    <p style="margin-bottom:4px; font-size:13px;"><i class="fas fa-map-marker-alt"></i> 123, Main Street, Your City</p>
                    <p style="margin-bottom:4px; font-size:13px;"><i class="fas fa-envelope"></i> info@healtrack.com</p>
                    <p style="margin-bottom:8px; font-size:13px;"><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <div class="social" style="margin-bottom: 4px;">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr style="margin: 10px 0;">
            <div class="row">
                <div class="col-12 text-center" style="padding-bottom:0;">


