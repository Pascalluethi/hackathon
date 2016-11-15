<?php
	/* *******************************************************************************************************
	/* data.php regelt die DB-Verbindung und fast den gesammten Datenverkehr der Site.
	/* So ist die gesammte Datenorganisation an einem Ort, was den Verwaltungsaufwand erheblich verringert.
	/*
	/* *******************************************************************************************************/

require_once('secretdata.php');

	/* *******************************************************************************************************
	/* get_result($sql)
	/*
	/* Führt die SQL-Anweisung $sql aus, liefert das Ergebnis zurück und schliesst die DB-Verbindung
	/* Alle Weiteren Funktionen rufen get_result() direkt oder indirekt auf.
	/* *******************************************************************************************************/
	function get_result($sql)
	{
		$db = get_db_connection();
    // echo $sql ."<br>";
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
		return $result;
	}


	/* *********************************************************
	/* Login
	/* ****************************************************** */

	function login($email , $password){
		$sql = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."';";
		return get_result($sql);
	}

	function register($email, $password, $name, $age, $gender){
    $sql = "INSERT INTO user (email, password, name, age, gender) VALUES ('$email', '$password', '$name', '$age', '$gender');";
		return get_result($sql);
	}


	/* *********************************************************
	/* Home
	/* ****************************************************** */

	function write_post($posttext, $owner, $image){
    $sql = "INSERT INTO posts (text, owner, post_img) VALUES ('$posttext', '$owner', '$image');";
		return get_result($sql);
	}

	function get_posts($user_id){
    $sql = "SELECT * FROM posts p, user u WHERE p.owner = $user_id AND u.`user_id` = $user_id ;";
		return get_result($sql);
	}

	function get_friends_and_my_posts($user_id){
    $sql = "SELECT * FROM posts p, user u WHERE p.owner IN
              (SELECT friend FROM userrelations WHERE user = $user_id)
              AND u.`user_id` = p.owner
              OR p.owner = $user_id AND u.`user_id` = $user_id
              ORDER BY p.posttime DESC;";
		return get_result($sql);
	}

	function delete_post($post_id){
    $sql = "DELETE FROM posts WHERE post_id = $post_id ;";
		return get_result($sql);
	}


	/* *********************************************************
	/* Profil
	/* ****************************************************** */

	function get_user($user_id){
    $sql = "SELECT * FROM user WHERE user_id = $user_id;";
		return get_result($sql);
	}

	function get_user_image($user_id){
    $sql = "SELECT img_src FROM user WHERE user_id = $user_id;";
		return get_result($sql);
	}

  function update_user($user_id, $email, $password, $confirm_password, $gender, $name, $age){
  	$sql_ok = false;
  	$sql = "UPDATE user SET ";
  	if($email != ""){
  		$sql .= "email = '$email', ";
  		$sql_ok = true;
    }
    if($password != "" && $password == $confirm_password) {
      $sql .= "password = '$password', ";
  		$sql_ok = true;
    }
    if($gender != ""){
      $sql .= "gender = '$gender', ";
  		$sql_ok = true;
    }
    if($name != ""){
      $sql .= "name = '$name', ";
  		$sql_ok = true;
    }
    if($age != ""){
      $sql .= "age = '$age', ";
  		$sql_ok = true;
    }

    // Das Komma an der vorletzten Position des $sql-Strings durch ein Leerzeichen ersetzen
    $sql = substr_replace($sql, ' ', -2, 1); // (Aus welchem String soll etwas entfernt werden, welcher Wert soll eingesetz werden, Wo soll das ersetzt werden -2 = vorletzte Stelle, Wiviele Stellen sollen entfernt werden)

    // $sql-String vervollständigen
    $sql .= " WHERE user_id = $user_id ;";

  	if($sql_ok){
  	  return get_result($sql);
  	}else{
  		return false;
  	}
  }


	/* *********************************************************
	/* Friends
	/* ****************************************************** */

	function get_user_list(){
    $sql = "SELECT * FROM user;";
		return get_result($sql);
	}

	function get_no_friend_list($user_id){
    $sql = "SELECT * FROM user WHERE user_id NOT in
              (SELECT friend FROM userrelations WHERE user = $user_id)
              AND  NOT user_id = $user_id;";
		return get_result($sql);
	}

	function get_friend_list($user_id){
    $sql = "SELECT * FROM user WHERE user_id in
              (SELECT friend FROM userrelations WHERE user = $user_id)
              AND  NOT user_id = $user_id;";
		return get_result($sql);
	}

  function add_friends($user_id, $friend_list){
		foreach($friend_list as $friend_id){
			$sql = "INSERT INTO userrelations (`user`, `friend`) VALUES ($user_id, $friend_id);";
			get_result($sql);
		}
	}
	/*
  function add_friends($user_id, $friend_list){
    $sql = "INSERT INTO userrelations (`user`, `friend`) VALUES ";
		foreach($friend_list as $friend_id){
			$sql .= "($user_id, $friend_id),";
		}
		$sql = substr_replace($sql, ';', -1, 1);
		get_result($sql);
	}
	*/

  function remove_friends($user_id, $friend_list){
		foreach($friend_list as $friend_id){
			$sql = "DELETE FROM userrelations WHERE user = $user_id AND friend = $friend_id;";
			get_result($sql);
		}
	}

?>
