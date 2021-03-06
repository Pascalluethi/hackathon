<?php

require_once('secretdata.php');
require_once('data.php');
require_once('security.php');

  /*
  * Create a random string
  * @author	XEWeb <>
  * @param $length the length of the string to create
  * @return $str the string
  * https://www.xeweb.net/2011/02/11/generate-a-random-string-a-z-0-9-in-php/
  */
  function randomString($length = 8) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
    	$rand = mt_rand(0, $max);
    	$str .= $characters[$rand];
    }
    return $str;
  }

/*

  // Bildupload
  function upload_image($image_file, $user_id){

    $uploadOk = true;
  	$upload_path = "user_img/";   // Zielverzeichnis für hochzuladene Datei
    $max_file_size = 1000000;      // max. Dateigrösse in KB
    $result = get_user($user_id);
    $user = mysqli_fetch_assoc($result);
    $image = $user['img_src']; // bisheriger gespeicherter Dateiname

    // Filetype kontrollieren
  	if ( ($image_file['name']  != "")){
  		$filetype = $image_file['type'];
  		switch($filetype){
  			case "image/jpeg":
  				$file_extension = "jpg";
  				break;
  			case "image/gif":
  				$file_extension = "gif";
  				break;
  			case "image/png":
  				$file_extension = "png";
  				break;
  		}
  		// Dateigrösse kontrollieren
  		$upload_filesize = $image_file["size"];
      if ( $upload_filesize > $max_file_size) {
        echo "Leider ist die Datei mit $upload_filesize KB zu gross. <br> Sie darf nicht grösser als $max_file_size sein. ";
        $uploadOk = 0;
      }

      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        $image = time() . randomString() . "." . $file_extension;
        move_uploaded_file ( $image_file['tmp_name'] , $upload_path . $image );
  	  }
  	}

  	return $image;

  }

  */

  // Bildupload
  function upload_post_image($image_file, $kategorie){

    $uploadOk = true;
  	$upload_path = "post_img/";   // Zielverzeichnis für hochzuladene Datei
    $max_file_size = 1000000;      // max. Dateigrösse in KB
    $image = NULL;
    $user_id = $_SESSION['id'];

    // Filetype kontrollieren
  	if ( ($image_file['name']  != "")){
  		$filetype = $image_file['type'];
  		switch($filetype){
  			case "image/jpeg":
  				$file_extension = "jpg";
  				break;
  			case "image/gif":
  				$file_extension = "gif";
  				break;
  			case "image/png":
  				$file_extension = "png";
  				break;
  		}
  		// Dateigrösse kontrollieren
  		$upload_filesize = $image_file["size"];
      if ( $upload_filesize > $max_file_size) {
        echo "Leider ist die Datei mit $upload_filesize KB zu gross. <br> Sie darf nicht grösser als $max_file_size sein. ";
        $uploadOk = 0;
      }

      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        $image = "post_" . time() . randomString() . "." . $file_extension;
        move_uploaded_file (
  			  $image_file['tmp_name'] ,
          $upload_path . $image );

            $filename = $upload_path . $image;

            $exif = exif_read_data($filename);
            $lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
            $lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);

            $degreeslon = $lon['degrees'];
            $minuteslon = ($lon['minutes'] / 60);
            $secondslon = ($lon['seconds'] / 3600);

            $degreeslat = $lat['degrees'];
            $minuteslat = ($lat['minutes'] / 60);
            $secondslat = ($lat['seconds'] / 3600);

            $latitude = $degreeslat + $minuteslat + $secondslat;
            $longitude = $degreeslon + $minuteslon + $secondslon;



            $sql = "INSERT INTO image (user_id, x_coordinates, y_coordinates, categories, image) VALUES ('$user_id', '$latitude', '$longitude', '$kategorie', '$image');";
        		return get_result($sql);
    	  }
    	}


  	return $image;

  }

?>
