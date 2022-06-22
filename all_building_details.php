<?php 
require_once('inc/header.php'); //include the header file
require_once('scripts/pdocon.php'); //include the db connector
require_once('scripts/functions.php'); //include the functions file
?>

<script src="gsap/TweenMax.min.js"></script>
	<script src="gsap/DrawSVGPlugin.min.js""></script>
	<div id="drawsvg_content">
  <?php include './svgloaders/LA_logo2.svg'?>
  </div>
<script src="jscontrols/splashsvg.js"></script>
<?php include 'inc/navbar.php'?>

<div style="display:inline;" class="wrap-container push">
<nav aria-label="menu-nav" style="z-index:1;position:relative;" class="shadow" id="top-menu-nav">
<a href="#menu" id="menu-link">
<svg id="burger" width="30" class="openmenu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
  <path class="top" d="M0 9h30v2H0z"/>
  <line class="mid" x1="0" y1="15" x2="30" y2="15" stroke="black" stroke-width="2" vector-effect="non-scaling-stroke"/>
  <path class="bot" d="M0 19h30v2H0z"/>
</svg>
</a>
</nav>
<div class="map-canvas shadow">



<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <?
				$results = getAllBuildings();
				foreach($results as $row) {
				$picArray= getImages($row["building_id"]); 
				// echo getFeaturedImage($row["building_id"]); 
				// echo $row['name'];
				// echo $row['address'];
				// echo $row['short_description'];
				// echo $row['building_id'];
				// echo $row['building_id'];
				?>
        <script type="text/javascript"> isFinished = <?php echo true; ?>;</script>

            <div class="container">
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0">
                        <img src="admin/images/<?= getFeaturedImage($row["building_id"]); ?>"
                            style="width: 300px; height: 200px;" alt="">
                    </div>
                    <div class="card-body">

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
            <?}	?>
        </div>
    </div>
</div>



</div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/slide.min.js"></script>
<script src="gsap/TweenMax.min.js"></script>


<script>
$(document).ready(function () {
  // $('.menu-link').bigSlide({easyClose:true,});

  let menuWidth = "15.6em";
  const screenWidth = window.innerWidth;
  if (screenWidth < 475) {
    menuWidth = "35vw";
  } else if (screenWidth < 535) {
    menuWidth = "11em";
  } else if (screenWidth < 600) {
    menuWidth = "12em";
  }

  const menuState={
    isOpen:false
  }
  const menuLink=$("#menu-link");

  menuLink.bigSlide({
    // easyClose: true,
    menuWidth,
    saveState: true,
    state: 'closed',
    beforeOpen: function() {
      menuToggle.restart()
    },
    beforeClose: function() {
      menuToggle.reverse()
    },
  });


  var controlit = $("#burger");
  var menuToggle = new TimelineMax({ paused: true, reversed: true });
  menuToggle
    .set("", { className: "-=closemenu" })
    .set("", { className: "+=openmenu" })
    .to(".top", 0.2, { y: "-9px", transformOrigin: "50% 50%" }, "burg")
    .to(".bot", 0.2, { y: "9px", transformOrigin: "50% 50%" }, "burg")
    .to(".mid", 0.2, { scale: 0.1, transformOrigin: "50% 50%" }, "burg")
    .to(controlit, 0.2, { fill:"rgb(244, 98, 58)"}, "burg")
    .add("rotate")
    .to(".top", 0.2, { y: "5" }, "rotate")
    .to(".bot", 0.2, { y: "-5" }, "rotate")
    .to(".top", 0.2, { rotationZ: 45, transformOrigin: "50% 50%" }, "rotate")
    .to(".bot", 0.2, { rotationZ: -45, transformOrigin: "50% 50%" }, "rotate")
    .set("#burger .mid", { opacity: 0 }); //temp fix for stupid iOS rotate y bug

  if (isFinished) {
    setTimeout(function () {
      $("#drawsvg_content").fadeOut();
    }, 1000);
  }
});

</script>


<?php
// require_once('inc/footer.php');
?>