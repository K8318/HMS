<?php
include_once('include/config.php');
if(isset($_POST['submit']))
{
$fname=$_POST['full_name'];
$address=$_POST['address'];
$city=$_POST['city'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(fullname,address,city,gender,email,password) values('$fname','$address','$city','$gender','$email','$password')");
if($query)
{
	echo "<script>alert('Successfully Registered. You can login now');</script>";
	//header('location:user-login.php');
}
}
?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<title>User Registration</title>
		
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
		
		<script type="text/javascript">
function valid()
{
 if(document.registration.password.value!= document.registration.password_again.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.registration.password_again.focus();
return false;
}
return true;
}
</script>
		
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
            position: relative;
        }
        .center-container {
            width: 100vw;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .login-bg-anim {
            position: absolute;
            left: 0; top: 0; width: 100vw; height: 100vh;
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
        .main-login {
            background: rgba(243,239,227,0.92);
            border-radius: 32px;
            box-shadow: 0 8px 40px #76938255;
            padding: 48px 40px 36px 40px;
            max-width: 540px;
            min-width: 340px;
            width: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .logo h2, .logo a {
            color: var(--main-accent) !important;
            font-weight: 900;
            letter-spacing: 1px;
            font-family: 'Segoe UI', Arial, sans-serif;
            text-align: center;
        }
        .box-register {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px #76938222;
            padding: 28px 18px 18px 18px;
            border: 1px solid #e0e0e0;
        }
        .box-register legend {
            color: var(--main-accent) !important;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 12px;
            padding-bottom: 4px;
        }
        .box-register p, .form-actions p, .checkbox label {
            color: var(--main-accent);
            font-size: 1rem;
        }
        .form-control {
            background: var(--main-white) !important;
            border: 1.5px solid var(--main-accent) !important;
            color: var(--main-dark) !important;
            border-radius: 12px !important;
            font-size: 1.08rem !important;
            margin-bottom: 18px;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--main-accent) !important;
            box-shadow: 0 0 0 2px var(--main-accent) !important;
            background: #fff !important;
            color: var(--main-dark) !important;
        }
        .input-icon > i, .fa, .fa-lock, .fa-envelope {
            color: var(--main-accent) !important;
        }
        .btn-primary, .btn-primary:active, .btn-primary:focus {
            background: var(--main-accent) !important;
            border: none !important;
            color: #fff !important;
            font-weight: 700;
            border-radius: 24px !important;
            padding: 10px 28px !important;
            box-shadow: 0 2px 12px #76938233;
            transition: background 0.2s, color 0.2s;
            font-size: 1.1rem;
        }
        .btn-primary:hover {
            background: var(--main-dark) !important;
            color: #fff !important;
        }
        .form-actions a {
            color: var(--main-accent) !important;
            font-weight: 600;
            transition: color 0.2s;
        }
        .form-actions a:hover {
            color: var(--main-dark) !important;
            text-decoration: underline;
        }
        .checkbox input[type="checkbox"]:checked + label {
            color: var(--main-accent) !important;
        }
        ::-webkit-input-placeholder { color: #355144; opacity: 0.8; }
        ::-moz-placeholder { color: #355144; opacity: 0.8; }
        :-ms-input-placeholder { color: #355144; opacity: 0.8; }
        ::placeholder { color: #355144; opacity: 0.8; }
    </style>
	</head>

	<body class="login">
		<div class="login-bg-anim">
			<div class="login-pill"></div>
			<div class="login-capsule"></div>
		</div>
		<!-- start: REGISTRATION -->
		<div class="center-container">
			<div class="main-login">
				<div class="logo margin-top-30">
				<a href="../index.php"><h2>HealTrack | Patient Registration</h2></a>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<form name="registration" id="registration"  method="post" onSubmit="return valid();">
						<fieldset>
							<legend>
								Sign Up
							</legend>
							<p>
								Enter your personal details below:
							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" placeholder="Address" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city" placeholder="City" required>
							</div>
							<div class="form-group">
								<label class="block">
									Gender
								</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="gender" value="female" >
									<label for="rg-female">
										Female
									</label>
									<input type="radio" id="rg-male" name="gender" value="male">
									<label for="rg-male">
										Male
									</label>
								</div>
							</div>
							<p>
								Enter your account details below:
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control"  id="password_again" name="password_again" placeholder="Password Again" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="agree" value="agree" checked="true" readonly=" true">
									<label for="agree">
										I agree
									</label>
								</div>
							</div>
							<div class="form-actions">
								<p>
									Already have an account?
									<a href="user-login.php">
										Log-in
									</a>
								</p>
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

					

				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>