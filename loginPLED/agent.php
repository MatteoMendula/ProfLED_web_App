<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}else{
  $utente = $_SESSION['username'];
  echo "<h2>Benvenuto ".$utente."!</h1>";
  if ($_SESSION['username'] == "manrico"){
    header("location: manrico.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
  <center>
    <div class="wrapper">
      <h3>Cosa vuoi fare?</h3>
      <hr>
      <button class="btn btn-danger" type="button" onclick="preventivatore()">Compilare un preventivo</button>
      <hr>
      <button class="btn btn-warining" type="button" onclick="logout()">Uscire</button>
    </div>
  </center>
</body>
</html>

<script>
function logout(){
  location.href = "./logout.php";
}
function preventivatore(){
  location.href = "./preventivatore/index.php";
}
</script>
