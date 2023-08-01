<?php
//fixing header problem
ob_start();
//starting the session
session_start();
//page title tag
$pagetitle = 'Login';
// includes the confgrition file
include 'init.php';
?>
<div class="container">
	<div class="col-md-8 m-auto">
		<div class="card text-white my-5">
			<h4 class="card-header bg-primary">Login Form</h4>
		<div class="card-body">
			<!-- place Login Form Here -->
			<form class="" action="code.php" method="POST" enctype="multipart/form-data">
				<div class="input-group mb-3">
				<span class="input-group-text" id="username">
					<i class="fas fa-user-alt fa-2x"></i>
				</span>
					<input
												class="form-control"
												type="text"
												name="username"
												placeholder="User name To Login"
												onfocus="this.placeholder= ''"
												onblur="this.placeholder= 'Usern ame To Login'"
												autofocus="true"
												required="required"
												aria-label="Username"
												aria-describedby="username"
					/>
					<span class="astrik astrik-username">*</span>
				</div>
				<div class="mb-3 input-group">
				<span class="input-group-text" id="password">
					<i class="fas fa-key fa-2x"></i>
				</span>
					<input
													class="form-control"
													type="password"
													name="password"
													placeholder="Password To Login"
													onfocus="this.placeholder= ''"
													onblur="this.placeholder= 'Password To Login'"
													autocomplete="new-password"
													required="required"
													aria-label="Password"
													aria-describedby="password"
				/>
				<span class="astrik astrik-password">*</span>
			</div>
			<div class="mb-3">
				<input class="form-control-horizontal btn btn-primary" type="submit" name="login" value="Login"/>
			</div>
			<a class="btn btn-warning" role="button" href="signup.php">Create New Accoount..</a>
			<div class="pb-2 mt-2">
<?php
if (!empty($login_error)) {
    foreach ($login_error as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
}
?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php

include $inc . 'footer.php';
?>