<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>

<?php

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "hivetohome"; 

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die('Could not connect to the database.');
    }

    $query = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        
        session_start();
        $_SESSION['user_id'] = $user_id;
        
        header('location: index.php');
    } else {
        echo "Login failed. Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
