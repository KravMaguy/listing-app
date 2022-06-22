<nav id="menu" class="slide-panel" arai-label="side-nav" role="navigation">
    <ul class="sidenav-ul">
        <li><a class="sidenav-link" href="index.html">Home</a></li>
        <?=checkUrlIs('all_building_details.php')?'<li><a class="sidenav-link" href="all_buildings.php">Map</a></li>':NULL;?>
        <li><a class="sidenav-link" id="all-buildings-link" href="all_building_details.php">All Buildings</a></li>
        <li><a class="sidenav-link" id="registration-link" href="./admin/">Register</a></li>
        <li><a class="sidenav-link" id="tour-link" href="#">Tour</a></li>

        <!-- <li><a class="sidenav-link" href="#">How it works?</a></li>
        <li><a class="sidenav-link" href="#">Get a private profile</a></li> -->
    </ul>
</nav>