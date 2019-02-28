<?php
  include "conn.php";
  @session_start();
  if(isset($_POST['login']))
  {
    $username  = mysql_escape_string(strip_tags(addslashes(trim($_POST['username']))));
    $password  = mysql_escape_string(strip_tags(addslashes(trim($_POST['password']))));
    $query=mysql_query("SELECT * FROM m_user where username='$username' AND password=md5('$password')");
    $data=mysql_fetch_array($query);
    if($data['username']){
    $_SESSION['username']=$_POST['username'];

    if($data['lvl'] == "admin"){
      $_SESSION['id'] = $data['id'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['lvl'] = $data['lvl'];
      $_SESSION['fullname'] = $data['fullname'];
      $_SESSION['ket'] = $data['ket'];

      echo "<script>alert ('Selamat Datang di Halaman Administrator');window.location.href='admin-menu.php';</script>";

    } else if ($data['lvl'] == "user") {
      $_SESSION['id'] = $data['id'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['lvl'] = $data['lvl'];
      $_SESSION['ket'] = $data['ket'];

      echo "<script>alert ('Selamat Datang di Halaman User Lvl1');window.location.href='#';</script>";
    }
  }
    else {
      echo "<script>alert ('Login Gagal Hubungi Developer !');window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Warehouse Application</title>
    <link rel="shortcut icon" href="img/DropBox.png">
        <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
	  @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

		body{
			margin: 0;
			padding: 0;
			background: #fff;

			color: #fff;
			font-family: Arial;
			font-size: 12px;
                        overflow: hidden;

		}

		.body{
			position: absolute;
			top: -20px;
			left: -20px;
			right: -40px;
			bottom: -40px;
			width: auto;
			height: auto;
			background-image: url(img/wh.jpg);
			background-size: cover;
			-webkit-filter: blur(5px);
			z-index: 0;
		}

		.grad{
			position: absolute;
			top: -20px;
			left: -20px;
			right: -40px;
			bottom: -40px;
			width: auto;
			height: auto;
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
			z-index: 1;
			opacity: 0.7;
		}

		.header{
			position: absolute;
			top: calc(50% - 35px);
			left: calc(50% - 255px);
			z-index: 2;
		}

		.header div{
			float: left;
			color: #fff;
			font-family: 'Exo', sans-serif;
			font-size: 35px;
			font-weight: 200;
		}

		.header div span{
			color: #1FA3CF !important;
		}

		.login{
			position: absolute;
			top: calc(50% - 75px);
			left: calc(50% - 50px);
			height: 150px;
			width: 350px;
			padding: 10px;
			z-index: 2;
		}

		.login input[type=text]{
			width: 250px;
			height: 30px;
			background: transparent;
			border: 1px solid rgba(255,255,255,0.6);
			border-radius: 2px;
			color: #fff;
			font-family: 'Exo', sans-serif;
			font-size: 16px;
			font-weight: 400;
			padding: 4px;
		}

		.login input[type=password]{
			width: 250px;
			height: 30px;
			background: transparent;
			border: 1px solid rgba(255,255,255,0.6);
			border-radius: 2px;
			color: #fff;
			font-family: 'Exo', sans-serif;
			font-size: 16px;
			font-weight: 400;
			padding: 4px;
			margin-top: 10px;
		}

		button{
			width: 260px;
			height: 35px;
			background: #fff;
			border: 1px solid #fff;
			cursor: pointer;
			border-radius: 2px;
			color: #a18d6c;
			font-family: 'Exo', sans-serif;
			font-size: 16px;
			font-weight: 400;
			padding: 6px;
			margin-top: 10px;
		}

		button:hover{
			opacity: 0.8;
		}

		button:active{
			opacity: 0.6;
		}

		.login input[type=text]:focus{
			outline: none;
			border: 1px solid rgba(255,255,255,0.9);
		}

		.login input[type=password]:focus{
			outline: none;
			border: 1px solid rgba(255,255,255,0.9);
		}

		button:focus{
			outline: none;
		}

		::-webkit-input-placeholder{
		   color: rgba(255,255,255,0.6);
		}

		::-moz-input-placeholder{
		   color: rgba(255,255,255,0.6);
		}

		a:link {
		color: #1FA3CF;
		}

		a:visited {
		color: #1FA3CF;
		}

		a:hover {
		color: #5F04B4;
		}
		</style>
        <script src="js/prefixfree.min.js"></script>
  </head>

  <body>

    <div class="body"></div>
		<div class="grad"></div>

		<div class="header">
			<div>WAREHOUSE<span></span></div>
			<br>
			<div><span>APPLICATION</span></div>
		</div>

		<br>
		<div class="login">
			<form action="" method="post">
				<input name="username" type="text" placeholder="username" required><br>
				<input name="password" type="password" placeholder="password" required><br>
				<button class="button" name="login">login</button>		
			</form>
			<div><br><span> Copyright &copy; 2016 <a href="https://www.facebook.com/muhammad.cholismalik.3" target="_blank">Col</a> All rights
       			 reserved.</span></div>
		</div>
   	 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>    
  </body>   
</html>
