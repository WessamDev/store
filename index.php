<?php
//fixing header problem
ob_start();
//starting the session
session_start();
//page title tag
$pagetitle = 'Home';

// includes the confgrition file
include 'init.php';
?>
<body>
<!-- Slider  -->
<?php include $inc . 'slider.php';?>


<!-- All Categories -->
<div class="py-5">
	<div class="container">
		<div class="row">
			<h3 class="mb-4 fw-bold"><a href="categories.php"> Our Collections </a>< </h3>
				<?php
$collection = get_all('*', 'categories', 'cat_status', 1);
foreach ($collection as $row) {?>
				<div class="col-md-4">
					<div class="card shadow mb-3">
						<div class="card-body">
							<img
									class="w-100 img-thumbnail img-fluid"
									src="admin/uploads/img/<?php echo $row['cat_avatar']; ?>"
									alt="categories"
									style="height:400px;"
									/>
							<h4 class="text-center mt-4"> <?=$row['cat_name'];?> </h4>
						</div>
					</div>
				</div>
				<?php }?>

		</div>
	</div>
</div>


<?php
include 'inc/footer.php';
ob_end_flush();
?>