<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if($_SESSION['username'] != "manrico"){
  header("location: login.php");
  exit;
}else{
  $utente = $_SESSION['username'];
  if ($utente == "manrico"){
    echo "<h2>Benvenuto Manrico </h2>";
    echo "<p>Solo tu hai accesso a questa area</p>";
  }else{
    echo "<h2>Non sei autoruizzato a visualizzare questa pagina. Premi su uscire</h2>";
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
      <button class="btn btn-primary" type="button" >Compilare un preventivo</button>
      <hr>
      <button class="btn btn-danger" type="button" onclick="register()">Registrare un nuovo utente</button>
      <hr>
      <button class="btn btn-info" type="button" onclick="iesAPP()">Modificare un file IES</button>
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

function register(){
  location.href = "./register.php";
}

function iesAPP(){
  location.href = "./iesAPP.php"
}

</script>
