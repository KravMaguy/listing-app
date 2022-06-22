<!doctype html>
<html lang="en">
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta charset="utf-8">
    <title>Industrial Listing App</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome FOr popup Addbuilding search -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font Awesome Icons -->
    <link href="assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic'
        rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="assets/css/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <!-- <link href="assets/css/theme-files/creative.min.css" rel="stylesheet"> -->

    <link href="assets/css/jquery-ui.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/gallery.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <link rel="manifest" href="webmanifest/manifest.json">

    <!-- You can use Open Graph tags to customize link previews.
		Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url" content="https://www.your-domain.com/your-page.html" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Your Website Title" />
    <meta property="og:description" content="Your description" />
    <meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />

    <style>
    <?php include 'css/fullscreensearch.css';
    ?><?php include 'gsap/gsapcss.css';
    ?><?php include 'css/blur.css';
    ?>
    </style>
    <link href="assets/css/bootstrap-tour-standalone.min.css" rel="stylesheet"/>
</head>

<body id="page-top">
    <!-- Load Facebook SDK for JavaScript -->

    <!-- Navigation
		<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
			<div class="container">
				<a class="navbar-brand" href="index.php">Industrial Listing App</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto my-2 my-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="add_building.php">Add Building</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="add_units.php">Add Units</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="view_buildings.php">View Buildings</a>
						</li>
						<?
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    ?>
							<li class="nav-item">
								<a class="nav-link" href="login.php">Login</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="Signup.php">Sign Up</a>
							</li>
						<?}?>
						<?
if (isset($_SESSION["email"]) || !empty($_SESSION["email"])) {
    ?>
							<li class="nav-item">
								<a class="nav-link" href="logout.php">Logout</a>
							</li>
						<?}?>

						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="index.php#services">Services</a>
						</li>
					</ul>
				</div>
			</div>
		</nav> -->