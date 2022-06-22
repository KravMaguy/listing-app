<?
require_once 'inc/header.php';
require_once 'scripts/pdocon.php';
require_once 'scripts/functions.php';
echo '<style>';
include 'css/blur.css';
echo '</style>';
include 'inc/navbar.php';
?>
<link href="css/gallery2.css" rel="stylesheet">



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


        <div class="lightbox text-right fixed-top">
            <label>✖</label>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Download Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Images are property of this site, by downloading images you agree to only use for personal use
                        and not
                        to post on any other third party listing sites i.e. loopnet
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="" type="button" class="btn btn-primary download-photo-byid" download="">Agree</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards">
            <?
if (isset($_GET['id'])) {
    $buildingId = $_GET['id'];
    $picArray = getImages($buildingId);
    if (sizeOf($picArray[0]) <= 1 && $picArray[0]['photos'] === '63720.svg') {
        ?>
            <script>
            setTimeout(function() {
                window.location.href = './all_buildings.php';
            }, 5000);
            </script>
            <?php
echo '<h1>there are no available units in this building</h1>';
        // exit;
    }
    foreach ($picArray as $pic) {
        if (file_exists('images/' . $pic['photos'])) {
            ?>
            <div class="card-item">
                <div class="card-body">
                    <img class="card-img" src="images\<?=$pic['photos']?>" alt="" />
                    <h2 class="card-title center">Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, eveniet.
                        Lorem
                        ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, eveniet. Lorem ipsum dolor sit
                        amet,
                        consectetur adipisicing elit. Distinctio, eveniet.</p>
                    <div class="card-footer center">
                        <a class="btn downloadConf" type="button" data-toggle="modal"
                            data-target="#exampleModal">download <i class="fas fa-download"></i></a>
                    </div>
                </div>
            </div>
            <?
        }
    }
} else {
    echo 'id is not set';
}
?>
        </div>

    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/slide.min.js"></script>
<script src="gsap/TweenMax.min.js"></script>
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
<script>
var lightbox = 0;
$('.card-item img').click(function() {
    if (lightbox == 0) {
        lightbox += 1;
        $(this).attr('id', 'imgactive');
        $('.lightbox').show();
    }
});

$('.lightbox').click(function() {
    if (lightbox == 1) {
        lightbox -= 1;
        $('.card-item img').removeAttr('id', 'imgactive');
        $('.lightbox').fadeOut();
    }
});

$(".downloadConf").click(function(e) {
    console.log('download conf')
    let grandparentsImgchild = $(this).parents("div")[1].children[0].src;
    console.log(grandparentsImgchild)
    $("a.download-photo-byid").attr("href", grandparentsImgchild);
})

$("body").on("contextmenu", "img", function(e) {
    return false;
});
</script>


<?php
// require_once('inc/footer.php');
?>