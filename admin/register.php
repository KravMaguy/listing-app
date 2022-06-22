<?php 
require_once('../scripts/pdocon.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Create an account on Listing App</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body class="bg-gradient-primary">
    <div class="container">

      <?
      if(isset( $_GET['error']) &&  $_GET['error']!=''){
         if($_GET['error']==1){
          echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;'> 
          An error has occured while trying to create your account. Please try again
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
         }
         if($_GET['error']==2){
          echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;'> 
          Some fields are empty. Please try again!!!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
         }
         if($_GET['error']=="password_missmatch"){
          echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;'> 
          Password missmatch. Please try again!!!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
         }
         if($_GET['error']=="user_exists"){
          echo "<div class='alert alert-danger alert-dismissible fade show' style='text-align:center;margin: 10px 0px 0px 0px;'> 
          A user with that email address is already register!!!
          <br><br>
          Already have an account? <a href='login.php'>Click here to login</a>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
         }
      }				
      ?>

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an account to list your spaces!</h1>
                </div>
                <form action="./scripts/register_handler.php" method="post" class="needs-validation user" novalidate>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input
                        type="text"
                        class="form-control form-control-user"
                        id="fname"
                        name="fname"
                        placeholder="First Name"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                      <div class="invalid-feedback">enter first name</div>
                    </div>
                    <div class="col-sm-6">
                      <input
                        type="text"
                        class="form-control form-control-user"
                        id="lname"
                        name="lname"
                        placeholder="Last Name"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                      <div class="invalid-feedback">enter last name</div>
                    </div>
                  </div>

                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control form-control-user"
                      id="email"
                      name="email"
                      placeholder="Email Address"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">enter a valid email adress</div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input
                        type="password"
                        class="form-control form-control-user"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">enter a password</div>
                    </div>
                    <div class="col-sm-6">
                      <input
                        type="password"
                        class="form-control form-control-user"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Repeat Password"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">confirm your password</div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="invalidCheck"
                        required
                      />
                      <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                      </label>
                      <div class="invalid-feedback">
                        You must agree before submitting.
                      </div>
                    </div>
                  </div>
                  <button
                    class="btn btn-primary btn-user btn-block"
                    type="submit"
                    value="register account"
                    name="submit"
                    id="submit"
                  >
                    Register Account
                  </button>

                  <hr/>
                  <a href="https://listing-app.com/admin/scripts/callback.php?provider=Facebook" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                        </a>
                                        <a href="https://listing-app.com/admin/scripts/callback.php?provider=LinkedIn"
                                        style="background-color: #0077b5;" class="btn btn-primary btn-user btn-block">
                                            <i class="fab fa-linkedin fa-fw"></i> Register with linkedIn
                                        </a>
                                        <a href="https://listing-app.com/admin/scripts/callback.php?provider=MicrosoftGraph" style="background-color: #F25022;" class="btn btn-secondary btn-user btn-block">
                                            <i class="fab fa-microsoft fa-fw"></i> Register with Microsoft
                                        </a>
                  <!-- <hr />
                  <a
                    href="index.html"
                    class="btn btn-google btn-user btn-block"
                  >
                    <i class="fab fa-google fa-fw"></i> Register with Google
                  </a>
                  <a
                    href="index.html"
                    class="btn btn-facebook btn-user btn-block"
                  >
                    <i class="fab fa-facebook-f fa-fw"></i> Register with
                    Facebook
                  </a> -->
                </form>
                <hr />
                <div class="text-center">
                  <a class="small" href="forgot-password.html"
                    >Forgot Password?</a
                  >
                </div>
                <div class="text-center">
                  <a class="small" href="login.php"
                    >Already have an account? Login!</a
                  >
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
