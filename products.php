<!-- Header Sections -->
<?php
//fixing header problem
ob_start();
//starting the session
session_start();
//page title tag
$pagetitle = 'Makka';

// includes the confgrition file
include 'init.php';
// get category value from url
$slug = $_GET['category'];
// get active category form table by slug
$cats = get_category_slug_active($slug);

foreach ($cats as $row) {

    $cid = $row['cat_id'];
    $cat_name = $row['cat_name'];
}

?>
<body>

<!-- Our Collections Sections -->
<div class="py-5">
	<div class="container">
		<div class="row">
			<h3 class="mb-4 fw-bold"><a href="categories.php"> Our Collections </a> &nbsp;/ &nbsp; <a href=""><?=$cat_name?></a> </h3>
				<?php
// view products belongs to one category by category id
$products = get_product_by_category_id($cid);
foreach ($products as $row) {?>
				<div class="col-md-4">
					<div class="card shadow mb-3 rounded-circle">
						<div class="card-body">
							<a class="" href="products.php?category=<?=trim($row['product_slug']);?>">
								<img
										class="w-100 img-thumbnail img-fluid rounded-circle"
										src="admin/uploads/img/<?php echo $row['product_image']; ?>"
										alt="Product"
										style="height:400px;"
										/>
								<h4 class="text-center mt-4"> <?=$row['product_name'];?> </h4>
							</a>
						</div>
					</div>
				</div>
				<?php }?>

		</div>
	</div>
</div>

<!-- Footer Section -->
<?php
include 'inc/footer.php';
ob_end_flush();
?>