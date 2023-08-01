<?php
//fixing header problem
ob_start();
//start the session
session_start();
$pagetitle = "Signup";
$nonav = '';

if (isset($_SESSION['username'])) {header('location: profile.php');}

//includes Configration file
include 'init.php';

?>
<body class="bg-signup">
		<div class="signup">
			<div class="container">
				<form class="signupform" action="code.php" method="POST" enctype="multipart/form-data">
					<h1 class="signup-title center-text mb-2 pt-2">Create New User</h1>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="text"
									name="fullname"
									id="fullname"
									placeholder="User fullname"
									onfocus="this.placeholder= ''"
									onblur="this.placeholder= 'User fullname'"
						/>
					</div>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="text"
									name="username"
									id="username"
									placeholder="User Name"
									onfocus="this.placeholder= ''"
									onblur="this.placeholder= 'User Name'"
						/>
					</div>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="email"
									name="email"
									id="email"
									placeholder="example@mail.com"
									onfocus="this.placeholder= ''"
									onblur="this.placeholder= 'example@mail.com'"
						/>
					</div>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="password"
									name="password"
									id="password"
									placeholder="Password"
									onfocus="this.placeholder= ''"
									onblur="this.placeholder= 'Password'"
						/>
					</div>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="password"
									name="repassword"
									id="repassword"
									placeholder="Confirm Password"
									onfocus="this.placeholder= ''"
									onblur="this.placeholder= 'Confirm Password'"
						/>
					</div>
					<div class="mb-2">
						<input
									class="form-control p-1"
									type="file"
									name="avatar"
									id="avatar_id"
						/>
					</div>
					<div class="mb-2">
						<input class="signup-btn" type="submit" name="signup_btn" value="Signup"/>
					</div>
					<div class="mb-2">
							<a class="signup-link" href="index.php">Just Login.....</a>
					</div>
					<div class="mb-2 ">
						<?php

if (!empty($sign_error)) {
    foreach ($sign_error as $error) {echo '<div class="alert alert-danger">' . $error . '</div>';}
}

if (isset($sign_success)) {echo '<div class="alert-success">' . $sign_success . '</div>';}
?>

						</div>
					</form>
				</div>
		</div>

		<!-- place footer here -->

	<?php
include 'inc/footer.php';
ob_end_flush();
?>