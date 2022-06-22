<?
require_once('inc/header.php');
require_once('scripts/pdocon.php');
require_once('scripts/functions.php')
?>
<?php include 'inc/navbar.php'?>

<div style="display:inline;" class="wrap-container push">
    <nav aria-label="menu-nav" style="z-index:1;position:relative;" class="shadow" id="top-menu-nav">
        <a href="#menu" id="menu-link">
            <svg id="burger" width="30" class="openmenu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                <path class="top" d="M0 9h30v2H0z" />
                <line class="mid" x1="0" y1="15" x2="30" y2="15" stroke="black" stroke-width="2"
                    vector-effect="non-scaling-stroke" />
                <path class="bot" d="M0 19h30v2H0z" />
            </svg>
        </a>
    </nav>
    <div class="map-canvas shadow">

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <?
				if ( isset( $_GET['id'] ) && !empty( $_GET['id'])){
					$buildingId = $_GET['id'];					
					$stmt = $db->prepare("SELECT name FROM tbl_buildings WHERE building_id=:buildingId ");
					$stmt->execute(array(':buildingId' => $buildingId));
					$building = $stmt->fetch(PDO::FETCH_ASSOC);					
					echo '<h1>'.$building["name"].' Units</h1>';
					$stmt = $db->prepare("SELECT * FROM tbl_units WHERE building_id=:buildingId ");
					$stmt->execute(array(':buildingId' => $buildingId));
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$row_count = $stmt->rowCount();
					
					if ($row_count<1){
						echo '<h1>there are no available units in this building add units please:</h1>';
						echo "<a href='add_units.php?id=".$buildingId."'>Click here</a>";

					} else{ 
					foreach($results as $row) {
					?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200"
                                    src="admin/spaceplans/<?= getFeaturedImageUnit($row['unit_id']) ?>"
                                    data-holder-rendered="true" style="width: 200px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Unit Name:</b><span id="unit_name_<?=$row['unit_id']?>">
                                            <?=$row['unit_name']?></span></h5>
                                    <p class="card-text"><b>Unit Size:</b> <span id="unit_size_<?=$row['unit_id']?>">
                                            <?=$row['size']?></span></p>
                                    <p class="card-text"><b>Unit Price:</b><span id="unit_price_<?=$row['unit_id']?>">
                                            <?=$row['price']?></span></p>
                                    <a href="edit_unit.php?id=<?=$row['unit_id']?>" class="btn btn-primary">Edit
                                        Unit</a>
                                    <a href="scripts/delete_unit_handler.php?id=<?=$row['unit_id']?>"
                                        class="btn btn-primary delete_unit">Delete Unit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
					}//end for loop	
					}// end of else statement					
				} else {
					echo '<h1>This building does not exist, you have reached this page in error</h1>';
					header("Refresh:5; url=view_buildings.php");
					echo '<h1>click below if you are not redirected in 5 seconds :</h1>';
					echo '<a href= "view_buildings.php" class="btn btn-primary">view buildings </a>';
					
				}//end if else
				?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/slide.min.js"></script>
<script src="gsap/TweenMax.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function() {
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

    const menuState = {
        isOpen: false
    }
    const menuLink = $("#menu-link");

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
    var menuToggle = new TimelineMax({
        paused: true,
        reversed: true
    });
    menuToggle
        .set("", {
            className: "-=closemenu"
        })
        .set("", {
            className: "+=openmenu"
        })
        .to(".top", 0.2, {
            y: "-9px",
            transformOrigin: "50% 50%"
        }, "burg")
        .to(".bot", 0.2, {
            y: "9px",
            transformOrigin: "50% 50%"
        }, "burg")
        .to(".mid", 0.2, {
            scale: 0.1,
            transformOrigin: "50% 50%"
        }, "burg")
        .to(controlit, 0.2, {
            fill: "rgb(244, 98, 58)"
        }, "burg")
        .add("rotate")
        .to(".top", 0.2, {
            y: "5"
        }, "rotate")
        .to(".bot", 0.2, {
            y: "-5"
        }, "rotate")
        .to(".top", 0.2, {
            rotationZ: 45,
            transformOrigin: "50% 50%"
        }, "rotate")
        .to(".bot", 0.2, {
            rotationZ: -45,
            transformOrigin: "50% 50%"
        }, "rotate")
        .set("#burger .mid", {
            opacity: 0
        }); //temp fix for stupid iOS rotate y bug

    //   if (isFinished) {
    //     setTimeout(function () {
    //       $("#drawsvg_content").fadeOut();
    //     }, 000);
    //   }
});
</script>


<?php
// require_once('inc/footer.php');
?>