
<?php

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
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "login";
	$table    = "users"; // MySql table name
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM $table";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$id=array();
		$username=array();
		$password=array();
		$createdAt=array();
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - username: " . $row["username"]. "password" . $row["password"]."-crated at" . $row["created_at"] ."<br>";
				$id[] = $row['id'];
				$username[] = $row["username"];
				$password[] = $row["password"];
				$createdAt[] = $row["created_at"];
		}
		echo "<script>";
		echo "var array_id = " . json_encode($id) . ";";
		echo "var array_username = " . json_encode($username) . ";";
		echo "var array_password = " . json_encode($password) . ";";
		echo "var array_createdAt = " . json_encode($createdAt) . ";";
		echo "</script>";
	} else {
	    echo "0 results";
	}


?>
<!DOCTYPE html>
<html>
	<header>
		<script src="./jspdf.debug.js"></script>
		<script src="./jspdf.plugin.autotable.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<meta charset="UTF-8">
		<title>Preventivatore</title>

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<style>

			.body{
				background-color: #88d0f7;
			}

			.flex-container {
			  display: flex;
			}

			.container {
			  flex-direction: column ;
			  margin: 1rem;
				background-color: #88d0f7;
			}

			.flex-container > div {
			  margin: 10px;
			  padding: 20px;
			}

			.buttonStep {
			    background-color: #4286f4;
			    border: none;
					border-radius: 12px;
			    color: white;
			    padding: 15px 32px;
			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;
			    margin: 4px 2px;
					margin-bottom: 1rem;
			    cursor: pointer;
			}

			.buttonPlus {
			    background-color: #2da024;
			    border: none;
					border-radius: 20px;
			    color: black;

			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;

			    cursor: pointer;
			}

			.buttonLess {
			    background-color: #b2151d;
			    border: none;
					border-radius: 20px;
			    color: black;

			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;

			    cursor: pointer;
			}
		</style>

		<script>

		var N_analogic_bulb = 0 , N_LED_bulb = 0;

				function inc_analogic(){
						document.getElementById("N_analogic_bulb").innerHTML++;
				}
				function dec_analogic(){
					if (document.getElementById("N_analogic_bulb").innerHTML > 0)
						document.getElementById("N_analogic_bulb").innerHTML--;
				}
				function inc_LED(){
					document.getElementById("N_LED_bulb").innerHTML++;
				}
				function dec_LED(){
					if (document.getElementById("N_LED_bulb").innerHTML > 0)
						document.getElementById("N_LED_bulb").innerHTML--;
				}

				function fetchArray(){
					N_analogic_bulb = document.getElementById("N_analogic_bulb").innerHTML;
					N_LED_bulb = document.getElementById("N_LED_bulb").innerHTML;
					if (N_analogic_bulb > 0 && N_LED_bulb > 0){
						var step1 = document.getElementById("step1");
						step1.parentNode.removeChild(step1);
						for(var i = 0; i < array_id.length; i++) {
   						alert(array_id[i] + " " + array_username[i] + " " + array_password[i] + " " + array_createdAt[i]);
						}
					}else{
						alert("Devi inserire almeno un modello per lampadine standard ed uno per lampadine LED!");
					}
				}
		</script>

	</header>

	<body style="background-color:#110e33">

		<center>
			<div class="container">
				<h2>Preventivatore online</h2>

				<div id="step1" >
					<p>Inserisci i dati per iniziare</p>

					

					<div class="flex-container ">
						<div><span>Quanti modelli di lampadine standard vuoi inserire?</span></div>
						<div><button onclick="dec_analogic()" class="buttonLess">-</button></div>
						<div><label id="N_analogic_bulb">0</label></div>
						<div><button onclick="inc_analogic()"class="buttonPlus">+</button></div>
					</div>

					<br>

					<div class="flex-container ">

						<div><span>Quanti modelli di lampadine LED vuoi inserire?</span></div>
						<div><button onclick="dec_LED()" class="buttonLess" >-</button></div>
						<div><label id="N_LED_bulb">0</label></div>
						<div><button onclick="inc_LED()"class="buttonPlus">+</button></div>
					</div>

					<br><br>
					<button class="buttonStep" onclick="fetchArray()">Prosegui</button>
				</div>
				<br>
			</div>
		</center>




	</body>
</html>
