<?php
include('includes/header.php');
include('includes/navbar.php');

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include('includes/topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">        
    <!-- Modals go here -->
	<?php include 'includes/modals.php' ?>


	<!-- Modals end here -->

         <? print_r($_SESSION); ?>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="card shadow">
                        <div class="card-header">
                            <h3><?=$_SESSION['fname'].'\'s' ?> listings</h3>
                        </div>
                        <div class="card-body" id="admin-map-card">
                            <div id="map"></div>
                        </div>

                        <!-- <input id="pac-input" class="controls" type="text" placeholder="Search Box"> -->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
<?php
//get all buidlings

$results = getAllBuildingsByUserId($_SESSION["user_id"]);
if(!$results){
    $markers =json_encode([]);

} else {
    foreach ($results as $row) {
        $image = getFeaturedImage($row['building_id']);
        $locations[] = array('name' => $row['name'], 'lat' => $row['lat'], 'lng' => $row['lng'], 'description' => $row['short_description'], 'id' => $row['building_id'], 'image' => $image);
    }
    $markers = json_encode($locations);
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../assets/js/bootstrap-tour-standalone.min.js"></script>

    <script>
		<?php echo "var markers=$markers;\n";  ?>  
        let fname = "<?php echo $_SESSION["fname"]; ?>";     
    </script>
      <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
	<script src="js/adminMapfunctions.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2K_KUrF4oY_1jK1le1fGcnRsxgjDSFNc&libraries=places&callback=initAutocomplete"
        async defer></script>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>