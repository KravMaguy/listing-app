<?
include('includes/header.php');
include('includes/navbar.php');
?>

<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include('includes/topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container">
        <div class="row justify-content-md-center">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<?
$results = getAllBuildingsByUserId($_SESSION["user_id"]);
if(!$results){
	echo '<strong>'.$_SESSION["fname"].'</strong>'.", you have no listings, click on 'Add Building' to go back to the main admin area and add a listing using the add building search box at the top of the navigation bar";
} else {
	foreach ($results as $row) {
		$picArray = getImages($row["building_id"]); // get building image
		?>
				<div class="container">
					<div class="card shadow flex-row flex-wrap">
						<div class="card-header border-0">
							<img src="images/<?= getFeaturedImage($row["building_id"]); ?>"
								style="width: 300px; height: 200px;" alt="">
						</div>
						<div class="card-body" style="margin-top:auto">
	
							<h3 class="card-title"><b><?=substr($row['name'],0,20)?></b></h3>
							<p class="card-text"><b>Description:</b> <?=$row['short_description']?></p>
							<div class="">
								<a href="#" class="btn mt-1 btn-primary">View Units</a>
								<a href="#" class="btn mt-1 btn-secondary">Building Details</a>
								<a href="#" class="btn mt-1 btn-info">Get Directions</a>
							</div>
	
						</div>
						<div class="w-100"></div>
						<div class="card-footer w-100 text-muted">
						<span class="badge badge-secondary">Industrial</span>
						<span class="badge badge-secondary">Commercial</span>
						<span class="badge badge-secondary">Flex</span>
						</div>
					</div>
				</div>
				<br>
				<?}	
			}?>
        </div>
    </div>
</div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>