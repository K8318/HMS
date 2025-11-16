<?php session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$puname=$_POST['username'];	
$ppwd=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM users WHERE email='$puname' and password='$ppwd'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$pid=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
// For stroing log if user login successfull
$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('$pid','$puname','$uip','$status')");
header("location:dashboard.php");
}
else
{
// For stroing log if user login unsuccessfull
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('$puname','$uip','$status')");

echo "<script>alert('Invalid username or password');</script>";
echo "<script>window.location.href='user-login.php'</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User-Login</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<style>
        :root {
            --main-bg: #c0c3b9;
            --main-accent: #769382;
            --main-dark: #355144;
            --main-white: #f3efe3;
        }
        body.login {
            min-height: 100vh;
            background: linear-gradient(120deg, #c0c3b9 0%, #769382 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(243,239,227,0.92);
            border-radius: 32px;
            box-shadow: 0 8px 40px #76938255;
            padding: 40px 36px 32px 36px;
            max-width: 480px;
            min-width: 340px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }
        .login-logo img {
            width: 54px;
            height: 54px;
            border-radius: 18px 50% 50% 18px;
            background: var(--main-bg);
            border: 3px solid var(--main-accent);
            margin-right: 14px;
            object-fit: contain;
        }
        .login-logo span {
            font-size: 2rem;
            font-weight: 900;
            color: var(--main-dark);
            letter-spacing: 1px;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .login-title {
            color: var(--main-accent);
            font-weight: 700;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 18px;
            letter-spacing: 1px;
        }
        .form-login input.form-control {
            background: #fff;
            border: 1.5px solid var(--main-accent);
            color: var(--main-dark);
            border-radius: 12px;
            font-size: 1.08rem;
            margin-bottom: 18px;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .form-login input.form-control:focus {
            border-color: var(--main-dark);
            box-shadow: 0 0 0 2px var(--main-accent);
            background: #fff;
            color: var(--main-dark);
        }
        .btn-primary {
            background: var(--main-accent) !important;
            border: none !important;
            color: #fff !important;
            font-weight: 700;
            border-radius: 18px;
            padding: 10px 0;
            width: 100%;
            box-shadow: 0 2px 12px #76938233;
            transition: background 0.2s, color 0.2s;
            font-size: 1.1rem;
        }
        .btn-primary:hover {
            background: var(--main-dark) !important;
            color: #fff !important;
        }
        .form-actions, .new-account {
            text-align: center;
            margin-top: 10px;
        }
        .form-actions a, .new-account a {
            color: var(--main-accent);
            font-weight: 600;
            transition: color 0.2s;
        }
        .form-actions a:hover, .new-account a:hover {
            color: var(--main-dark);
            text-decoration: underline;
        }
        .copyright {
            color: var(--main-accent);
            font-size: 0.98rem;
            margin-top: 18px;
            text-align: center;
        }
        /* Subtle floating pill animation in background */
        .login-bg-anim {
            position: absolute;
            left: 0; top: 0; width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .login-pill {
            position: absolute;
            opacity: 0.13;
            border-radius: 50%;
            background: linear-gradient(135deg, #769382 60%, #fff 100%);
            width: 60px; height: 60px;
            left: 80%; top: 10%;
            animation: float-login 7s linear infinite;
        }
        .login-capsule {
            position: absolute;
            opacity: 0.11;
            border-radius: 18px 18px 18px 18px / 30px 30px 30px 30px;
            background: linear-gradient(90deg, #c0c3b9 50%, #769382 100%);
            width: 90px; height: 36px;
            left: 10%; top: 70%;
            animation: float-login 8s linear infinite 2s;
        }
        @keyframes float-login {
            0% { transform: translateY(0) scale(1) rotate(0deg);}
            50% { transform: translateY(-18px) scale(1.08) rotate(15deg);}
            100% { transform: translateY(0) scale(1) rotate(0deg);}
        }
    </style>
	</head>
	<body class="login">
		<div class="login-bg-anim">
			<div class="login-pill"></div>
			<div class="login-capsule"></div>
		</div>
		<div class="login-container">
			<div class="login-logo">
				<img src="../assets/images/HealTrack.png" alt="HealTrack Logo">
				<span>HealTrack</span>
			</div>
			<div class="login-title">Patient Login</div>
			<div class="box-login" style="background:#fff; border-radius:12px; box-shadow:0 2px 12px #76938222; padding:28px 18px 18px 18px; border:1px solid #e0e0e0;">
    <form class="form-login" method="post">
        <div style="color:#769382; margin-bottom:14px; font-size:1rem;">
            Please enter your name and password to login.
        </div>
        <div style="position:relative; margin-bottom:18px;">
            <i class="fas fa-user" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#769382; opacity:0.9; font-size:1.1rem; z-index:2;"></i>
            <input type="text" name="username" class="form-control" placeholder="Email" required style="padding-left:38px; background:#f3efe3;">
        </div>
        <div style="position:relative; margin-bottom:18px;">
            <i class="fas fa-lock" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#769382; opacity:0.9; font-size:1.1rem; z-index:2;"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required style="padding-left:38px; background:#f3efe3;">
        </div>
        <div style="margin-bottom:18px;">
            <a href="forgot-password.php" style="color:#769382; font-weight:600; font-size:1rem;">Forgot Password ?</a>
        </div>
        <div style="text-align:right;">
            <button class="btn btn-success" type="submit" name="submit" style="border-radius:24px; padding:8px 32px; font-size:1.1rem; font-weight:700; background:#769382; color:#fff; border:none;">
                Login <i class="fas fa-sign-in-alt" style="margin-left:6px;"></i>
            </button>
        </div>
        <hr style="margin:18px 0 10px 0;">
        <div style="font-size:1rem; color:#769382;">
            Don't have an account yet? <a href="registration.php" style="font-weight:700; color:#769382;">Create an account</a>
        </div>
    </form>
</div>
			
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- <script src="vendor/jquery-validation/jquery.validate.min.js"></script> -->
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>