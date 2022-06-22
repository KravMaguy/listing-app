<?php
require_once 'inc/header.php'; //include the header file
require_once 'scripts/pdocon.php'; //include the db connector
require_once 'scripts/functions.php'; //include the functions file
?>
<?
if (isset($_GET['success']) && $_GET['success'] == 1) {
  echo "<div class='alert alert-success alert-dismissable fade show custom-alert' role='alert'>
	  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
	    You have successfully signed up please check your emailf or confirmation details
		</div>";
}
?>
<script src="gsap/TweenMax.min.js"></script>
<script src="gsap/DrawSVGPlugin.min.js"></script>
<div id="drawsvg_content">
    <?php include './svgloaders/LA_logo.svg'?>
</div>
<script src="jscontrols/splashsvg.js">
</script>
<?php include 'inc/navbar.php'?>
<script src='jscontrols/redstyle.js'></script>
<?php include 'modals.php' ?>
<div id="map"></div>
<div id="myOverlay" onclick="closeSearch()" class="overlay">
    <span class="closebtn" title="Close Overlay">×</span>
    <div class="overlay-content">
        <input id="pac-input" onclick="event.stopPropagation();" type="text" placeholder="Search.." name="search">
    </div>
</div>
<?
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $results = getAllBuildingsByUserId($_GET['id']);
    ?>
<script type="text/javascript">
isFinished = <?php echo true; ?>;
</script>

<?php
foreach ($results as $row) {
        $image = getFeaturedImage($row['building_id']);
        $locations[] = array('name' => $row['name'], 'lat' => $row['lat'], 'lng' => $row['lng'], 'description' => $row['short_description'], 'id' => $row['building_id'], 'image' => $image);
    }
    if (empty($results)) {
        echo '<div class="alert alert-danger" role="alert">Oops! user not found!</div>';
        return;
    } else {
        $markers = json_encode($locations);
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Oops! id is not set. Please try again!</div>';
}
?>
<script>
<?php echo "var markers=$markers;\n"; ?>
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="jscontrols/mapfunctions.js"></script>
<script src="jscontrols/homePageFunctions.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2K_KUrF4oY_1jK1le1fGcnRsxgjDSFNc&libraries=places&callback=initAutocomplete"
    async defer></script>
<script>
if (isFinished) {
    setTimeout(function() {
        $('#drawsvg_content').fadeOut()
    }, 00);
}
</script>
</body>

</html>