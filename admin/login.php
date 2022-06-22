<?php 
require_once('../scripts/pdocon.php');
include 'vendor/autoload.php';
include 'scripts/config.php';

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);
$adapters = $hybridauth->getConnectedAdapters();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login to your real estate on Listing-App</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php
if(!isset($_COOKIE['email'])||!isset($_COOKIE['provider'])){
    echo 'not currently logged in';
} else {
    print_r($_COOKIE['email']);
}
?>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
        <?
        if(isset( $_GET['error']) &&  $_GET['error']!=''){
                if($_GET['error']==1){
                echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;' > 
                Invalid username/password. Please try again
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
                }
                if($_GET['error']==2){
                echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;' > 
                One or more empty fields. Please try again
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
                }
        }	
        if (isset($_GET['success'])&& $_GET['success']==1){
            echo "<div class='alert alert-success alert-dismissible fade' > 
            you've successfully registered please check your email to confirm your registration
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }			
		?>
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login to list your buildings and spaces!</h1>
                                    </div>
                                    <form class="needs-validation user" action="scripts/login_handler.php" method="post" novalidate>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email"
                                                required/>
                                                <div class="invalid-feedback"> Enter valid email</div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password"
                                                required
                                                />
                                                <div class="invalid-feedback"> Enter password</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="submit"
                                            value="Log in!" id="submit">Log in with email and password!</button>
                                        <hr>

                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        -->
                                        <a href="https://listing-app.com/admin/scripts/callback.php?provider=Facebook" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        <a href="https://listing-app.com/admin/scripts/callback.php?provider=LinkedIn" style="background-color: #0077b5;"
                                        class="btn btn-primary btn-user btn-block">
                                            <i class="fab fa-linkedin fa-fw"></i> Login with linkedIn
                                        </a>
                                        <a href="https://listing-app.com/admin/scripts/callback.php?provider=MicrosoftGraph" style="background-color: #F25022;" class="btn btn-secondary btn-user btn-block">
                                            <i class="fab fa-microsoft fa-fw"></i> Login with Microsoft
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function () {
        "use strict";
        window.addEventListener(
          "load",
          function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(
              forms,
              function (form) {
                form.addEventListener(
                  "submit",
                  function (event) {
                    if (form.checkValidity() === false) {
                      console.log(form, 'form')
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                  },
                  false
                );
              }
            );
          },
          false
        );
      })();
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>