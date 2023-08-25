<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<style>
        .button-container {
            text-align: center;
            margin-top: 50px;
        }

        .button {
            margin-bottom: 51px;
            border: none;
            width: 186px;
            height: 46px;
            border-radius: 5px;
            background: #000;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display:inline-block;
            font-size: 18px;
            line-height: 46px;
        }

        .button:hover {
            background-color: #333;
        }

        .button a {
            color: #fff;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            height: 100%;
        }
	</style>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="button-container">
  	  <button type="submit" class="button" name="reg_user" target="_self">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

  <?php
  if (count($errors) == 0) {
    $user_id = mysqli_insert_id($db); 
    $_SESSION['user_id'] = $user_id;
  }
  ?>
</body>
</html>
