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
    <?php include './svgloaders/LA_logo2.svg'?>
</div>
<script src="jscontrols/splashsvg.js">
</script>
<?php include 'inc/navbar.php'?>
<!-- <script src='jscontrols/redstyle.js'></script> -->
<div class="modal-includes">
    <?php include 'inc/modals.php' ?>
</div>
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
        <div id="map" class="map"></div>

    </div>
</div>

<div id="myOverlay" onclick="closeSearch()" class="overlay">
    <span class="closebtn" title="Close Overlay">×</span>
    <div class="overlay-content">
        <input id="pac-input" onclick="event.stopPropagation();" type="text" placeholder="Search.." name="search">
    </div>
</div>
<?php $results = getAllBuildings() ?>
<script type="text/javascript">
isFinished = <?php echo true; ?>;
</script>
<?php
foreach ($results as $row) {
    $image = getFeaturedImage($row['building_id']);
    $locations[] = array('name' => $row['name'], 'lat' => $row['lat'], 'lng' => $row['lng'], 'description' => $row['short_description'], 'id' => $row['building_id'], 'image' => $image, 'user_id' => $row['user_id']);
}
$markers = json_encode($locations);
?>
<script>
<?php echo "var markers=$markers;\n"; ?>
</script>
<script src="assets/js/jquery.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap-tour-standalone.min.js"></script>

<script src="assets/js/slide.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="jscontrols/drawOutline.js"></script>

<script src="jscontrols/mapfunctions.js"></script>
<!-- <script src="jscontrols/homePageFunctions.js"></script> -->

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
        state: 'closed',
        saveState: false,
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
        .to(".top", 0.25, {
            y: "-9px",
            transformOrigin: "50% 50%"
        }, "burg")
        .to(".bot", 0.25, {
            y: "9px",
            transformOrigin: "50% 50%"
        }, "burg")
        .to(".mid", 0.25, {
            scale: 0.1,
            transformOrigin: "50% 50%"
        }, "burg")
        .to(controlit, 0.25, {
            fill: "rgb(244, 98, 58)"
        }, "burg")
        .add("rotate")
        .to(".top", 0.25, {
            y: "5"
        }, "rotate")
        .to(".bot", 0.25, {
            y: "-5"
        }, "rotate")
        .to(".top", 0.25, {
            rotationZ: 45,
            transformOrigin: "50% 50%"
        }, "rotate")
        .to(".bot", 0.25, {
            rotationZ: -45,
            transformOrigin: "50% 50%"
        }, "rotate")
        .set("#burger .mid", {
            opacity: 0
        }); //temp fix for stupid iOS rotate y bug

    const runShorttour = () => {
        var tour = new Tour({
            steps: [{
                element: "#tour-link",
                title: "Tour",
                content: `Ok, well come back to here anytime if you change your mind`,
                placement: "right",
                onShow: function() {
                    $("#menu-link").trigger("click");
                },
            }, ],
            keyboard: true,
            storage: false,
            backdrop: true,
            backdropPadding: 5,
        });
        tour.start();
    }

    const runLongtour = () => {
        var tour = new Tour({
            steps: [{
                    element: "#map",
                    title: "Map Area",
                    content: `the Map area is where you can search for buildings, get directions, see building units, see your listings, get directions, or contact an owner to get more information about a particular building`,
                    placement: "top",
                    onShow: function() {
                        $("#map").addClass("noClick");
                    },
                    onNext: function() {
                        $("#map").removeClass("noClick");
                    },
                },
                {
                    element: "#open-search",
                    title: "Area Search",
                    content: `you can type an adress in here to add a building and the search functionality will return the number of buildings found in your specified search area`,
                    placement: "bottom",
                    onShow: function() {
                        $("#open-search").addClass("noClick");
                    },
                    onNext: function() {
                        $("#open-search").removeClass("noClick");
                    },
                },
                {
                    element: "#menu-link",
                    title: "Side Menu",
                    content: `The side menu will show you various options, here you can register for a new account to list your buildings, or see a list of everything for lease`,
                    placement: "right",
                    onShow: function() {
                        $("#menu-link").trigger("click");
                        $("#menu-link").addClass("noClick");
                    },
                    onNext: function() {
                        $("#menu-link").removeClass("noClick");
                    },
                },
                {
                    element: "#all-buildings-link",
                    title: "see everyones buildings",
                    content: `here you can see everyones buildings`,
                    placement: "right",
                },
                {
                    element: "#registration-link",
                    title: `Register or Login`,
                    content: `Register an account with us to start listing your buildings and properties for lease`,
                    placement: "right",
                },
                {
                    element: "#tour-link",
                    title: "Tour",
                    content: "Come back here anytime to see the tour again",
                    placement: "right",
                },
            ],
            keyboard: true,
            storage: false,
            backdrop: true,
            backdropPadding: 5,
            onEnd: function() {
                $("#menu-link").removeClass("noClick");
                $("#open-search").removeClass("noClick");
                $("#map").removeClass("noClick");
            },
        });
        tour.start();
    };

    $("#tour-link").click(() => runLongtour())

    if (isFinished) {
        setTimeout(function() {
            $("#drawsvg_content").fadeOut();
            setTimeout(() => {
                if (!localStorage['firstVist']) {
                    localStorage['firstVist'] = 'yes';
                    swal({
                        title: "Getting Started",
                        text: "First time visitor? Would you like us to give you a a brief tour of the listing-app?",
                        type: "info",
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        cancelButtonText: 'No',
                        cancelButtonAriaLabel: "No thanks",
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!, Show me',
                        confirmButtonAriaLabel: "Thumbs up, great!",
                    }).then((result) => {
                        console.log(result, "result");
                        if (result.value) {
                            runLongtour();
                        } else {
                            console.log("he cancelled");
                            runShorttour();
                        }
                    });
                }
            }, 1600);
        }, 800);
    }
});
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2K_KUrF4oY_1jK1le1fGcnRsxgjDSFNc&libraries=places&callback=initAutocomplete"
    async defer></script>
</body>

</html>