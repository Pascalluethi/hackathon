<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>p42 - Home</title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="css/stylesheet.css">

</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">MapPic</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModallogin">Login</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModalregister">Registrieren</a></li>
          <li><a href="posten.php">Bilder posten</a></li>
          <li><a href="profil.php">Profil</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav><!-- /Navigation -->




  <div class="container">
    <div class="row">
      <div class="col-md-12"> <!-- Hauptinhalt -->

        <!-- Map -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">Deine Map</div>
              <div class="panel-body">

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43575.2603146001!2d7.398644734376583!3d46.9527738085928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478e39c0d43a1b77%3A0xcb555ffe0457659a!2sBern!5e0!3m2!1sde!2sch!4v1478786902973" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

              </div>
            </div>
          </div>
        </div> <!-- /Post hinzufügen -->
      </div> <!-- /Hauptinhalt -->
    </div>
  </div>

<!-- /Map -->





<!-- Anmelden -->

<div class="modal fade" id="myModallogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabellogin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">


        <div class="modal-header">
          <div class="col-sm-12">
              <h4 class="modal-title" id="myModalLabellogin">Login</h4>
          </div>
        </div>


        <div class="modal-body">



          <div class="form-group row">
            <label for="Email" class="col-sm-12 form-control-label">E-Mail</label>
            <div class="col-sm-12">
              <input  type="email" class="form-control form-control-sm"
                      id="Email" placeholder="E-Mail"
                      name="email" value="<?php echo $user['email']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="Passwort" class="col-sm-12 form-control-label">Password</label>
            <div class="col-sm-12">
              <input type="password" class="form-control form-control-sm" id="Passwort" placeholder="Passwort" name="password">
            </div>
          </div>



      </form>
    </div>
  </div>
</div>

</div>
<!-- / Anmelden -->






<!-- Registrieren -->

<div class="modal fade" id="myModalregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabelregister">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">


        <div class="modal-header">
          <div class="col-sm-12">
              <h4 class="modal-title" id="myModalLabelregister">Registreieren</h4>
          </div>
        </div>


        <div class="modal-body">

  <div class="form-group row">
    <label for="Gender" class="col-xs-12 form-control-label">Anrede</label>
    <div class="col-sm-5">
      <select class="form-control form-control-sm" id="Gender" name="gender">
        <option <?php if($user['gender']=="") echo "select"; ?> value="">--</option>
        <option <?php if($user['gender']=="Frau") echo "select"; ?> value="Frau">Frau</option>
        <option <?php if($user['gender']=="Herr") echo "select"; ?> value="Herr">Herr</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="Vorname" class="col-xs-12 form-control-label">Vorname</label>
    <div class="col-sm-10">
      <input  type="text" class="form-control form-control-sm"
              id="Vorname" placeholder="Vorname"
              name="firstname" value="<?php echo $user['firstname']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="Nachname" class="col-xs-12 form-control-label">Nachname</label>
    <div class="col-sm-10">
      <input  type="text" class="form-control form-control-sm"
              id="Nachname" placeholder="Nachname"
              name="lastname" value="<?php echo $user['lastname']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="Email" class="col-sm-12 form-control-label">E-Mail</label>
    <div class="col-sm-10">
      <input  type="email" class="form-control form-control-sm"
              id="Emailregister" placeholder="E-Mail"
              name="email" value="<?php echo $user['email']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="Passwort" class="col-sm-12 form-control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control form-control-sm" id="Passwortregister" placeholder="Passwort" name="password">
    </div>
  </div>
  <div class="form-group row">
    <label for="Passwort_Conf" class="col-sm-12 form-control-label">Passwort bestätigen</label>
    <div class="col-sm-10">
      <input type="password" class="form-control form-control-sm" id="Passwort_Conf" placeholder="Passwort" name="confirm-password">
    </div>
  </div>




      </form>

    </div>
  </div>
</div>

</div>
<!-- / Registrieren -->




  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



</body>
</html>
