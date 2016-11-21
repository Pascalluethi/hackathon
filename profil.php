<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:index.php");
}else{
  $user_id = $_SESSION['id'];
  $success = true;
}




require_once('system/data.php');
require_once('system/security.php');
require_once('system/secretdata.php');



if(isset($_POST['update-submit'])){
    $email = filter_data($_POST['email']);
    $password = filter_data($_POST['password']);
    $confirm_password = filter_data($_POST['confirm-password']);
    $gender = filter_data($_POST['gender']);
    $name = filter_data($_POST['name']);
    $age = $_POST['age'];


    $result = get_user($user_id);
    $user = mysqli_fetch_assoc($result);

    $result = update_user($user_id, $email, $password, $confirm_password, $gender, $name, $age);

    }




	// Abfrage der Userdaten
  $result = get_user($user_id);
  $user = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>p42 - Profil</title>

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
            <?php if ($success == true){?>
            <li><a href="posten.php">Bilder posten</a></li>
            <?php } ?>

            <?php if ($success == true){?>
          <li><a href="profil.php">Profil</a></li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav><!-- /Navigation -->

  <div class="container">

    <!-- Button trigger modal -->


    <div class="panel panel-default container-fluid"> <!-- fluid -->
      <div class="panel-heading row">
        <div class="col-sm-6">
            <h4>Persönliche Einstellungen</h4>
          </div>
      </div>
      <div class="panel-body">

<form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">

        <div class="form-group row">
          <label for="Gender" class="col-sm-2 form-control-label">Anrede</label>
          <div class="col-sm-5">
            <select class="form-control form-control-sm" id="Gender" name="gender">
              <option <?php if($user['gender']=="") echo "selected"; ?> value="">bitte anwählen</option>
              <option <?php if($user['gender']=="w") echo "selected"; ?> value="w">weiblich</option>
              <option <?php if($user['gender']=="m") echo "selected"; ?> value="m">männlich</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="Vorname" class="col-sm-2 col-xs-12 form-control-label">Name</label>
          <div class="col-sm-5 col-xs-6">
            <input  type="text" class="form-control form-control-sm"
                    id="name" placeholder="Name"
                    name="name" value="<?php echo $user['name']; ?>">
          </div>
          </div>
          <div class="form-group row">
            <label for="Vorname" class="col-sm-2 col-xs-12 form-control-label">Name</label>
          <div class="col-sm-5 col-xs-6">
            <input  type="text" class="form-control form-control-sm"
                    id="age" placeholder="age"
                    name="age" value="<?php echo $user['age']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="Email" class="col-sm-2 form-control-label">E-Mail</label>
          <div class="col-sm-10">
            <input  type="email" class="form-control form-control-sm"
                    id="Email" placeholder="E-Mail"
                    name="email" value="<?php echo $user['email']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="Passwort" class="col-sm-2 form-control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control form-control-sm" id="Passwort" placeholder="Passwort" name="password">
          </div>
        </div>
        <div class="form-group row">
          <label for="Passwort_Conf" class="col-sm-2 form-control-label">Passwort bestätigen</label>
          <div class="col-sm-10">
            <input type="password" class="form-control form-control-sm" id="Passwort_Conf" placeholder="Passwort" name="confirm-password">
          </div>
        </div>


        <div class="form-group">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
              <input type="submit" name="update-submit" id="update-submit" tabindex="4" class="form-control btn btn-info" value="Änderungen speichern">
            </div>
          </div>
        </div>

</form>

      </div>
    </div>





    <div class="panel panel-default container-fluid"> <!-- fluid -->
      <div class="panel-heading row">
        <div class="col-sm-6">
            <h4>Meine Bilder</h4>
          </div>
      </div>
      <div class="panel-body">

<form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">











  <div id="main_area">
          <!-- Slider -->
          <div class="row">
              <div class="col-sm-6" id="slider-thumbs">
                  <!-- Bottom switcher of slider -->
                  <ul class="hide-bullets">
                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-0">
                              <img src="http://placehold.it/150x150&text=zero">
                          </a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-1"><img src="http://placehold.it/150x150&text=1"></a>
                      </li>





                      <?php   while($post = mysqli_fetch_assoc($post_list)) { ?>

                          <?php if($post['post_img'] != NULL){  ?>
                                              <li class="col-sm-3">
                                                  <a class="thumbnail" id="carousel-selector-2"><img src="post_img/<?php echo $post['post_img']; ?>" alt="postimage"></a>
                                              </li>
                          <?php } ?>

                      <?php   } ?>







                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-3"><img src="http://placehold.it/150x150&text=3"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-4"><img src="http://placehold.it/150x150&text=4"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-5"><img src="http://placehold.it/150x150&text=5"></a>
                      </li>
                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-6"><img src="http://placehold.it/150x150&text=6"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-7"><img src="http://placehold.it/150x150&text=7"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-8"><img src="http://placehold.it/150x150&text=8"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-9"><img src="http://placehold.it/150x150&text=9"></a>
                      </li>
                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-10"><img src="http://placehold.it/150x150&text=10"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-11"><img src="http://placehold.it/150x150&text=11"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-12"><img src="http://placehold.it/150x150&text=12"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-13"><img src="http://placehold.it/150x150&text=13"></a>
                      </li>
                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-14"><img src="http://placehold.it/150x150&text=14"></a>
                      </li>

                      <li class="col-sm-3">
                          <a class="thumbnail" id="carousel-selector-15"><img src="http://placehold.it/150x150&text=15"></a>
                      </li>
                  </ul>
              </div>
              <div class="col-sm-6">
                  <div class="col-xs-12" id="slider">
                      <!-- Top part of the slider -->
                      <div class="row">
                          <div class="col-sm-12" id="carousel-bounding-box">
                              <div class="carousel slide" id="myCarousel">
                                  <!-- Carousel items -->
                                  <div class="carousel-inner">
                                      <div class="active item" data-slide-number="0">
                                          <img src="http://placehold.it/470x480&text=zero"></div>

                                      <div class="item" data-slide-number="1">
                                          <img src="http://placehold.it/470x480&text=1"></div>

                                      <div class="item" data-slide-number="2">
                                          <img src="http://placehold.it/470x480&text=2"></div>

                                      <div class="item" data-slide-number="3">
                                          <img src="http://placehold.it/470x480&text=3"></div>

                                      <div class="item" data-slide-number="4">
                                          <img src="http://placehold.it/470x480&text=4"></div>

                                      <div class="item" data-slide-number="5">
                                          <img src="http://placehold.it/470x480&text=5"></div>

                                      <div class="item" data-slide-number="6">
                                          <img src="http://placehold.it/470x480&text=6"></div>

                                      <div class="item" data-slide-number="7">
                                          <img src="http://placehold.it/470x480&text=7"></div>

                                      <div class="item" data-slide-number="8">
                                          <img src="http://placehold.it/470x480&text=8"></div>

                                      <div class="item" data-slide-number="9">
                                          <img src="http://placehold.it/470x480&text=9"></div>

                                      <div class="item" data-slide-number="10">
                                          <img src="http://placehold.it/470x480&text=10"></div>

                                      <div class="item" data-slide-number="11">
                                          <img src="http://placehold.it/470x480&text=11"></div>

                                      <div class="item" data-slide-number="12">
                                          <img src="http://placehold.it/470x480&text=12"></div>

                                      <div class="item" data-slide-number="13">
                                          <img src="http://placehold.it/470x480&text=13"></div>

                                      <div class="item" data-slide-number="14">
                                          <img src="http://placehold.it/470x480&text=14"></div>

                                      <div class="item" data-slide-number="15">
                                          <img src="http://placehold.it/470x480&text=15"></div>
                                  </div>
                                  <!-- Carousel nav -->
                                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left"></span>
                                  </a>
                                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right"></span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!--/Slider-->
          </div>

      </div>














</form>

      </div>
    </div>





  </div>


  <!--Javascript & Jquery für Gallerie-->
  <script>


  jQuery(document).ready(function($) {

        $('#myCarousel').carousel({
                interval: 5000
        });

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
  });

  </script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
