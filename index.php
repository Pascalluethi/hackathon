<?php



require_once('system/data.php');
require_once('system/security.php');


$error = false;
$error_msg = "";
$success = false;
$success_msg = "";


if(isset($_POST['login-submit'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
      $email = filter_data($_POST['email']);
      $password = filter_data($_POST['password']);

      $result = login($email, $password);

      $row_count = mysqli_num_rows($result);

      if($row_count == 1){
        $user = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['id'] = $user['user_id'];


      }else {
        $error = true;
        $error_msg .= "Leider konnten wir ihre E-Mailadresse oder ihr Passwort nicht finden.";


      }
    }else {
      $error = true;
      $error_msg .= "Bitte füllen Sie beide Felder aus.<br/>";
    }
    if(login($email, $password)){
             $success = true;
             $success_msg .= "Sie haben sich erfolgreich eingeloggt.";
  }
}

//Registrierung
  if(isset($_POST['register-submit'])){
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password']) && !empty($_POST['name'])  && !empty($_POST['age'])&& !empty($_POST['gender'])){
    $email = filter_data($_POST['email']);
  $password = filter_data($_POST['password']);
  $confirm_password = filter_data($_POST['confirm-password']);

  $name = filter_data($_POST['name']);
    $age = $_POST['age'];
      $gender = filter_data($_POST['gender']);



  if($password == $confirm_password){
           if(register($email, $password, $name, $age, $gender)){
                    $success = true;
                    $success_msg .= "Sie haben erfolgreich registriert.</br>
                    Bitte loggen Sie sich jetzt ein.</br>";


  }else{
        $error = true;
        $error_msg .= "Es gibt ein Problem mit der Datenbankverbindung.";
      }

    }else{
    $error = true;
    $error_msg .= "Die Passwörter stimmen nicht überein.";
    }
}else{
  $error = true;
  $error_msg .= "Bitte füllen Sie alle Felder aus.";
}
}

?>


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
  <title>PicMap Leslie</title>

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
    <div class="col-md-12">

      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading"> Deine Map</div>
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
                      name="email">
            </div>
          </div>
          <div class="form-group row">
            <label for="Passwort" class="col-sm-12 form-control-label">Password</label>
            <div class="col-sm-12">
              <input type="password" class="form-control form-control-sm" id="Passwort" placeholder="Passwort" name="password">
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-6">
                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-info" value="einloggen">
              </div>
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
              <h4 class="modal-title" id="myModalLabelregister">Registrieren</h4>
          </div>
        </div>


        <div class="modal-body">

  <div class="form-group row">
    <label for="Gender" class="col-xs-12 form-control-label">Geschlecht</label>
    <div class="col-sm-5">
      <select class="form-control form-control-sm" id="Gender" name="gender">
        <option value="">bitte anwählen</option>
        <option value="w">weiblich</option>
        <option value="m">männlich</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="Name" class="col-xs-12 form-control-label">Name</label>
    <div class="col-sm-10">
      <input  type="text" class="form-control form-control-sm"
              id="Name" placeholder="Name"
              name="name">
    </div>
  </div>

  <div class="form-group row">
    <label for="date" class="col-xs-12 form-control-label">Geburtsdatum</label>
    <div class="col-sm-10">
      <input  type="date" id="date" placeholder="tt.mm.jjjj" name="age" class="form-control form-control-sm" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
    </div>
  </div>



  <div class="form-group row">
    <label for="Email" class="col-sm-12 form-control-label">E-Mail</label>
    <div class="col-sm-10">
      <input  type="email" class="form-control form-control-sm"
              id="Emailregister" placeholder="E-Mail"
              name="email" value="">
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


  <div class="form-group">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-6">
        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-info" value="Registrieren">
      </div>
    </div>
  </div>

      </form>

    </div>
  </div>
</div>

</div>
<!-- / Registrieren -->




<?php
if(!empty($success_msg)) {     //wenn erfolgreich eingeloggt führe echo aus (bezieht sich auf Variable die true ist)
  echo '<script type="text/javascript">alert("' . $success_msg . '");</script>';
  }
  else {
    if(!empty($error_msg)) {
      echo '<script type="text/javascript">alert("' . $error_msg . '");</script>';
    }
  }
?>




  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



</body>
</html>
