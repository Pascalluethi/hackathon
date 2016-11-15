<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:index.php");
}else{
  $user_id = $_SESSION['id'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>p42 - Freunde finden</title>

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
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
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

     <h3>Hier kannst du deine Bilder posten</h3><hr />

     <!-- Bild hinzufügen -->
            <div class="row">
              <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading">Was machst du gerade?</div>
                  <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <div class="collapse" id="upload_container">

                        <div class="well">
                            <input type="file" name="post_img" id="post_img">
                        </div>

                      </div>
                      <a class="btn btn-default" role="button" data-toggle="collapse" href="#upload_container" aria-expanded="false" aria-controls="collapseExample">
                        Bild hinzufügen
                      </a>

<br><br>

                      <div class="form-group row">
                        <label for="Gender" class="col-xs-12 form-control-label">Wähle eine Kategorie für dein Bild</label>

                        <div class="col-sm-5">
                          <select class="form-control form-control-sm" id="Gender" name="gender">
                            <option value="">--</option>
                            <option value="Museum">Museum</option>
                            <option value="Kultur">Kultur</option>
                            <option value="Essen">Essen</option>
                            <option value="Sport">Sport</option>
                            <option value="Sehenswürdigkeiten">Sehenswürdigkeiten</option>
                          </select>
                        </div>

                      </div>

                      <button type="submit" name="post-submit" class="btn btn-primary">posten</button>
                    </form>
                  </div>
                </div>
              </div>
            </div> <!-- /Post hinzufügen -->


  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
