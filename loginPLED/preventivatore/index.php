
	<?php

		session_start();

		// If session variable is not set it will redirect to login page
		if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		  header("location: ../login.php");
		  exit;
		}else{
		  $utente = $_SESSION['username'];
		  echo "<h2>Benvenuto ".$utente."!</h1>";
		  if ($_SESSION['username'] == "manrico"){
		    header("location: manrico.php");
		  }
		}
		/*
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
	*/
		require_once '../configUsers.php';
		$table    = "users"; // MySql table name
		$sql = "SELECT * FROM $table";
		$result = $link->query($sql);
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
			echo "var array_id_utenti = " . json_encode($id) . ";";
			echo "var array_username = " . json_encode($username) . ";";
			echo "var array_password = " . json_encode($password) . ";";
			echo "var array_createdAt = " . json_encode($createdAt) . ";";
			echo "</script>";
		} else {
		    echo "0 results users";
		}
		//mysql_close($link);

		$table    = "leds"; // MySql table name
		$sql = "SELECT * FROM $table";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			$id=array();
			$modello=array();
			$descrizione=array();
			$id_foto=array();
			$prezzo=array();
			$gruppo_modello=array();
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        //echo "id: " . $row["id"]. " - modello: " . $row["username"]. "password" . $row["password"]."-crated at" . $row["created_at"] ."<br>";
					$id[] = $row['id'];
					$modello[] = $row["modello"];
					$descrizione[] = $row["descrizione"];
					$id_foto[] = $row["id_foto"];
					$prezzo[] = $row["prezzo"];
					$gruppo_modello[] = $row["group_modello"];
			}
			echo "<script>";
			echo "var array_id_leds = " . json_encode($id) . ";";
			echo "var array_modello = " . json_encode($modello) . ";";
			echo "var array_descrizione = " . json_encode($descrizione) . ";";
			echo "var array_id_foto = " . json_encode($id_foto) . ";";
			echo "var array_prezzo = " . json_encode($prezzo) . ";";
			echo "var array_gruppo_modello = " . json_encode($gruppo_modello) . ";";
			echo "</script>";
		} else {
		    echo "0 results leds";
		}

		$table = "img"; // MySql table name
		$sql = "SELECT * FROM $table";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			$id=array();
			$foto=array();
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "_foto: " . $row["id"]. " - foto: " . $row["content"]."<br>";
					$id[] = $row['id'];
					$foto[] = $row["content"];
			}
			echo "<script>";
			echo "var array_id_foto = " . json_encode($id) . ";";
			echo "var array_foto = " . json_encode($foto) . ";";
			echo "</script>";
		} else {
		    echo "0 results leds";
		}
		//mysql_close($link);

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

				.flex-containerPLED {
				  display: flex;
					margin: auto;
	    		width: 50%;
				}

				.container {
				  flex-direction: column ;
				  margin: 1rem;
					background-color: #88d0f7;
				}

				.flex-container > div {
				  padding: 20px;
				}

				.flex-containerPLED > div {
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

				.buttonAddItem {
						background-color: #2da024;
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

				.buttonRemoveItem {
						background-color: #b2151d;
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
			var N_analogic_bulb = 1;
			var nome_azienda = "";
			var costoKWH = 0 ;
			var StatoAttualeArray;
			var SolPLEDArray;



				function inc_PuntiLuce_SOL_PLED(indice){
					var i = indice.substring(10);
					var PuntiLuceLED = document.getElementById("PuntiLuceLED"+i);
					PuntiLuceLED.innerHTML++;
				}

				function dec_PuntiLuce_SOL_PLED(indice){
					var i = indice.substring(10);
					var PuntiLuceLED = document.getElementById("PuntiLuceLED"+i);
					if (PuntiLuceLED.innerHTML > 0 ){
						PuntiLuceLED.innerHTML--;
					}
				}

				function updateNameStandard(){
					for (var i = 0 ; i < N_analogic_bulb ; i++){
						var modello = document.getElementById("modelloStandard"+i).value;
						var titolo = document.getElementById("titoloLampadaStandard"+i);
						var consumo = document.getElementById("standardSpanConsumo"+i);
						var durata = document.getElementById("standardSpanDurata"+i);
						var PL = document.getElementById("standardSpanPL"+i);
						var GG = document.getElementById("standardSpanGG"+i);
						var HH = document.getElementById("standardSpanHH"+i);

						if(modello != ""){
							titolo.innerHTML = "Lampada modello: "+modello;
							consumo.innerHTML = "Consumo reale del modello [" + modello+"] (in Watt)";
							durata.innerHTML = "Durata del modello [" + modello+ "] (in ore)";
							PL.innerHTML = "Punti luce del modello [" + modello + "]";
							GG.innerHTML = "Giorni di funzionamento del modello [" + modello+ "] all'anno";
							HH.innerHTML = "Ore di funzionamento del modello ["+modello +"] al giorno";
						}

					}
				}

				function removeOneToStatoAttuale(){
					var indice_id = N_analogic_bulb - 1;
					var elemento = document.getElementById("elemento"+indice_id);
					elemento.parentNode.removeChild(elemento);
					N_analogic_bulb--;

					var html = "";

					html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
					html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Aggiungi una lampada</button></div>";
					html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
					html += "</div>";
					html += "<hr>";
					html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";

					step2.innerHTML += html;

				}

				function addOneToStatoAttuale(){

					var indice_id = N_analogic_bulb - 1;

					//var indice_id_prev = indice_id - 1;

					//----------------------------SALVO I VALORI INSERITI PRECEDENTEMENTE-----------------------
					var modello_span = document.getElementById("modelloStandard"+indice_id).value;
					var titolo_span = document.getElementById("titoloLampadaStandard"+indice_id).innerHTML;
					var consumo_span = document.getElementById("standardSpanConsumo"+indice_id).innerHTML;
					var durata_span = document.getElementById("standardSpanDurata"+indice_id).innerHTML;
					var PL_span = document.getElementById("standardSpanPL"+indice_id).innerHTML;
					var GG_span = document.getElementById("standardSpanGG"+indice_id).innerHTML;
					var HH_span = document.getElementById("standardSpanHH"+indice_id).innerHTML;

					var modello = document.getElementById("modelloStandard"+indice_id).value;
					var consumo = document.getElementById("consumoStandard"+indice_id).value;
					var durata = document.getElementById("durataStandard"+indice_id).value;
					var PL = document.getElementById("puntiluceStandard"+indice_id).value;
					var GG = document.getElementById("GGStandard"+indice_id).value;
					var HH = document.getElementById("HHStandard"+indice_id).value;


					//----------------------------ELIMINO I VALORI INSERIRI PRECEDENTEMENTE-------------------
					var elemento = document.getElementById("elemento"+indice_id);
					elemento.parentNode.removeChild(elemento);

					var html = "";

					//-------------------------SCRITTURA DEI CAMPI INSERITI PRECEDENTEMENTE-------------------
					html += "<div id='elemento"+indice_id+"'>";
					html += "<hr>";
					html += "<h3 id='titoloLampadaStandard"+indice_id+"'>"+titolo_span+ "</h3>";
					html += "<div><span>Modello: "+modello_span+"</span></div>";
					html += "<div><input id='modelloStandard"+indice_id+ "' onkeyup='updateNameStandard()' value='"+modello+"'> </input></div>";
					html += "<div><span id='standardSpanConsumo"+indice_id+"'>"+consumo_span+ " (in Watt)</span></div>";
					html += "<div><input id='consumoStandard"+indice_id+"' value='"+consumo+"'></input></div>";
					html += "<div><span id='standardSpanDurata"+indice_id+"'>"+durata_span+"</span></div>";
					html += "<div><input id='durataStandard"+indice_id+"' value='"+durata+"'> </input></div>";
					html += "<div><span id='standardSpanPL"+indice_id+"'>"+PL_span+"</span></div>";
					html += "<div><input id='puntiluceStandard"+indice_id+"' value='"+PL+"'> </input></div>";
					html += "<div><span id='standardSpanGG"+indice_id+"'>"+GG_span+"</span></div>";
					html += "<div><input id='GGStandard"+indice_id+"' value='"+GG+"'> </input></div>";
					html += "<div><span id='standardSpanHH"+indice_id+"'>"+HH_span+"</span></div>";
					html += "<div><input id='HHStandard"+indice_id+"' value='"+HH+"'> </input></div>";
					html += "<hr>";

					//------------------------------SCRITTURA DEI NUOVI CAMPI--------------------------------------------
					html += "<div id='elemento"+N_analogic_bulb+"'>";
					html += "<hr>";
					html += "<h3 id='titoloLampadaStandard"+N_analogic_bulb+"'>Lampada Standard "+(N_analogic_bulb+1)+ "</h3>";
					html += "<div><span>Inserire modello"+(N_analogic_bulb+1)+ "</span></div>";
					html += "<div><input id='modelloStandard"+N_analogic_bulb+ "' onkeyup='updateNameStandard()'> </input></div>";
					html += "<div><span id='standardSpanConsumo"+N_analogic_bulb+"'>Consumo reale del modello "+(N_analogic_bulb+1)+ " (in Watt)</span></div>";
					html += "<div><input id='consumoStandard"+N_analogic_bulb+"'></input></div>";
					html += "<div><span id='standardSpanDurata"+N_analogic_bulb+"'>Durata del modello "+(N_analogic_bulb+1)+ " (in ore)</span></div>";
					html += "<div><input id='durataStandard"+N_analogic_bulb+"'> </input></div>";
					html += "<div><span id='standardSpanPL"+N_analogic_bulb+"'>Punti luce del modello "+(N_analogic_bulb+1)+ "</span></div>";
					html += "<div><input id='puntiluceStandard"+N_analogic_bulb+"'> </input></div>";
					html += "<div><span id='standardSpanGG"+N_analogic_bulb+"'>Giorni di funzionamento del modello "+(N_analogic_bulb+1)+ " all'anno</span></div>";
					html += "<div><input id='GGStandard"+N_analogic_bulb+"'> </input></div>";
					html += "<div><span id='standardSpanHH"+N_analogic_bulb+"'>Ore di funzionamento del modello "+(N_analogic_bulb+1)+ " al giorno</span></div>";
					html += "<div><input id='HHStandard"+N_analogic_bulb+"'> </input></div>";
					html += "<hr>";

					html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
					html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Aggiungi una lampada</button></div>";
					html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
					html += "</div>";
					html += "<hr>";
					html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";

					html += "</div>"

					N_analogic_bulb++;

					step2.innerHTML += html;
				}

					function cambiaOpzioniLED(id){
						var id = id.substring(9);
						var modelliLed = document.getElementById("modelliLED"+id);
						var selezionato = document.getElementById("gruppiLED"+id).selectedIndex;
						modelliLed.options.length = 0;
						if (selezionato > 0){
							for (var i = 0; i < array_gruppo_modello.length ; i++){
								alert(array_gruppo_modello[i] + " sel: "+selezionato);
								if (array_gruppo_modello[i] == "Case" && selezionato == "1"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Panel Led" && selezionato == "2"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Plafo4k" && selezionato == "3"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
							}
						}
					}

					function toStatoAttuale(){
						nome_azienda = document.getElementById("nomeAzienda").value;
						tel_azienda = document.getElementById("telAzienda").value;
						nome_referente = document.getElementById("nomeReferente").value;
						mail_referente = document.getElementById("mailReferente").value;
						costoKWH = document.getElementById("costoKWH").value;
						costoKWH = costoKWH.replace(',','.');
						costoKWH = parseFloat(costoKWH);
						var control = false;


						if (nome_azienda != "" && tel_azienda != "" && nome_referente != "" && mail_referente != "" && mail_referente.includes("@",".") && costoKWH != "" && !isNaN(costoKWH)){
							control = true;
						}else{

							if (nome_azienda == ""){
								alert("Devi inserire il nome dell'azienda!");
							}

							if (nome_referente == ""){
								alert("Devi inserire il nome dell'azienda!");
							}

							if (tel_azienda == ""){
								alert("Devi inserire il numero telefonico dell'azienda!");
							}

							if (mail_referente == ""){
								alert("Devi inserire la mail per il referente!");
							}

							if (!mail_referente.includes("@",".")){
								alert("Formato mail non valido (@ o . mancanti)!");
							}

							if (costoKWH == 0){
								alert("Devi inserire il costo Kw/h!");
							}

							if (isNaN(costoKWH)){
								alert("Il costo Kw/h deve essere un numero!");
							}
						}

						if (control){
							var step1 = document.getElementById("step1");
							step1.parentNode.removeChild(step1);

							var step2 = document.createElement("div");
							step2.id="step2";

							var html = "";

							var indice_id = N_analogic_bulb - 1;

							html += "<h2>STATO ATTUALE</h2>";


							html += "<div id='elemento"+indice_id+"'>";
							html += "<hr>";
							html += "<h3 id='titoloLampadaStandard"+indice_id+"'>Lampada Standard "+(indice_id+1)+ "</h3>";
							html += "<div><span>Inserire modello"+(indice_id+1)+ "</span></div>";
							html += "<div><input id='modelloStandard"+indice_id+ "' onkeyup='updateNameStandard()'> </input></div>";
							html += "<div><span id='standardSpanConsumo"+indice_id+"'>Consumo reale del modello "+(indice_id+1)+ " (in Watt)</span></div>";
							html += "<div><input id='consumoStandard"+indice_id+"'></input></div>";
							html += "<div><span id='standardSpanDurata"+indice_id+"'>Durata del modello "+(indice_id+1)+ " (in ore)</span></div>";
							html += "<div><input id='durataStandard"+indice_id+"'> </input></div>";
							html += "<div><span id='standardSpanPL"+indice_id+"'>Punti luce del modello "+(indice_id+1)+ "</span></div>";
							html += "<div><input id='puntiluceStandard"+indice_id+"'> </input></div>";
							html += "<div><span id='standardSpanGG"+indice_id+"'>Giorni di funzionamento del modello "+(indice_id+1)+ " all'anno</span></div>";
							html += "<div><input id='GGStandard"+indice_id+"'> </input></div>";
							html += "<div><span id='standardSpanHH"+indice_id+"'>Ore di funzionamento del modello "+(indice_id+1)+ " al giorno</span></div>";
							html += "<div><input id='HHStandard"+indice_id+"'> </input></div>";
							html += "<hr>";

							html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
							html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Aggiungi una lampada</button></div>";
							html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
							html += "</div>";
							html += "<hr>";
							html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";

							html += "</div>"
							step2.innerHTML += html;

							//document.body.appendChild(step2);


							//step2.innerHTML += "<p>"+array_id_foto[0]+" "+array_foto[i]+"</p>"

							document.getElementById("container").appendChild(step2);

/*
							for(var i = 0; i < array_id_leds.length; i++) {
	   						alert(array_id_leds[i] + " " + array_modello[i] + " " + array_descrizione[i] + " " + array_id_foto[i] + " " + array_prezzo[i]);
							}

							for(var i = 0; i < array_id_foto.length; i++) {
	   						alert(array_id_foto[i] + " " + array_foto[i] );
							}
*/
						}else{
							alert("Non hai inserito tutti i dati correttamente");
						}
					}

					function toSoluzionePLED(){
						StatoAttualeArray = new Array(N_analogic_bulb);

						var control = 0;

						for (var i = 0 ; i < N_analogic_bulb ; i++){
							var modello = document.getElementById("modelloStandard"+i).value;
							var consumo = document.getElementById("consumoStandard"+i).value;
							var durata = document.getElementById("durataStandard"+i).value;
							var PL = document.getElementById("puntiluceStandard"+i).value;
							var GG = document.getElementById("GGStandard"+i).value;
							var HH = document.getElementById("HHStandard"+i).value;



							if(modello != "" && consumo != "" && !isNaN(consumo) && durata != "" && !isNaN(durata)  && PL != "" && !isNaN(PL) && GG != "" && !isNaN(GG) && HH != "" && !isNaN(HH)){
								StatoAttualeArray[i] = new Array(modello,consumo,durata,PL,GG,HH);
								control ++;
							}else {
								if (modello == ""){
									alert("Nome Modello "+(i+1)+" mancante!");
								}
								if (consumo == "" || isNaN(consumo)){
									alert("Consumo del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
								if (durata == "" || isNaN(durata)){
									alert("Durata del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
								if (PL == "" || isNaN(PL)){
									alert("Punti luce del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
								if (GG == "" || isNaN(GG)){
									alert("Giorni di funzionamento del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
								if (HH == "" || isNaN(HH)){
									alert("Ore di funzionamento del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
							}
					}

					if (control == N_analogic_bulb){

						var step2 = document.getElementById("step2");
						step2.parentNode.removeChild(step2);

						var step3 = document.createElement("div");
						step3.id="step3";
						step3.innerHTML += "<h2>SOLUZIONE PLED</h2>";

						var html = "";

						for (var i = 0; i < N_analogic_bulb; i++){
							alert(StatoAttualeArray[i][0]);
							html += "<hr>";
							html += "<div><span>La lampada "+(i+1)+" dello stato attuale MODELLO["+StatoAttualeArray[i][0]+"] con "+StatoAttualeArray[i][3]+" punti luce</span></div>";
							html += "<div><h3>E' DA SOSTITUIRE CON</h3></div>";
							html += "<div><span>Selezionare modello"+(i+1)+ ":     </span><select id='gruppiLED"+i+"' size='1' onChange='cambiaOpzioniLED(this.id);'>";
							html += "<option value='0'>Scegli un gruppo</option>";
							html += "<option value='Case'>Case</option>";
							html += "<option value='Panel Led'>Panel Led</option>";
							html += "<option value='Plafo4k'>Plafo4k</option>";
							html += "</select><select id='modelliLED"+i+"' size='1'></select></div>";
								html += "<div class='flex-containerPLED'>";
								html += "<div><span>Inserire punti luce: </span></div>";
								html += "<div><button id='dec_button"+i+"' onclick='dec_PuntiLuce_SOL_PLED(this.id)' class='buttonLess'> - </button></div>";
								html += "<div><label id='PuntiLuceLED"+i+"'>0</label></div>";
								html += "<div><button id='inc_button"+i+"' onclick='inc_PuntiLuce_SOL_PLED(this.id)' class='buttonPlus'> + </button></div>";
								html += "</div>";
							html += "<hr>";
						}
						html += "<br><button class='buttonStep' onclick='toStampaPDF()'>Prosegui</button>";
						step3.innerHTML += html;
						document.getElementById("container").appendChild(step3);
					}
				}

				function toStampaPDF(){
					SolPLEDArray = new Array(N_analogic_bulb);
					var control = 0;
					for (var i = 0 ; i < N_analogic_bulb ; i++){
						var modello = document.getElementById("modelliLED"+i).value;
						var PL = document.getElementById("PuntiLuceLED"+i).innerHTML;

						if(modello != "" && PL != "0" ){
							control++;
							SolPLEDArray[i] = new Array(modello,PL);
						}else if (modello == ""){
							alert("Nome Modello "+(i+1)+" mancante!");
						}else if (PL == "0"){
							alert("Punti luce del modello "+(i+1)+ " uguale a zero!")
						}
				}
				if (control == N_analogic_bulb){
					var step3 = document.getElementById("step3");
					step3.parentNode.removeChild(step3);

					var step4 = document.createElement("div");
					step4.id="step4";
					step4.innerHTML += "<h2>PDF da stampare</h2>";

					alert(StatoAttualeArray);
					alert(SolPLEDArray);

					document.getElementById("container").appendChild(step4);
				}
			}

			</script>

		</header>

		<body style="background-color:#110e33">

			<center>
				<div class="container" id="container">
					<h2><big><strong>Preventivatore online</strong></big></h2>

					<div id="step1" >
						<p>Inserisci i dati per iniziare</p>
						<p>Tutti i valori inseriti andranno in stampa così come sono scritti. Fai attenzione!</p>

						<div class="flex-container">
							<div><span>Inserisci il nome dell'azienda</span></div>
							<div><input placeholder="Questo sarà il nome che andrà in stampa" id="nomeAzienda"> </input></div>
							<div><span>Inserire N. telefonico dell'azienda</span></div>
							<div><input placeholder="051/123456" id="telAzienda"> </input></div>
						</div>

						<div class="flex-container">
							<div><span>Inserire nome del referente dell'azienda</span></div>
							<div><input placeholder="Mario Rossi" id="nomeReferente"> </input></div>
							<div><span>Inserire mail del referente dell'azienda</span></div>
							<div><input placeholder="mario.rossi@gmail.com" id="mailReferente"> </input></div>
						</div>

						<div class="flex-container ">
							<div><span>Inserisci il costo dell'energia elettrica in Kw/h stimato per questa azienda</span></div>
							<div><input id="costoKWH" placeholder="es. 0.3"> </input></div>
						</div>

						<br>


						<br><br>
						<button class="buttonStep" onclick="toStatoAttuale()">Prosegui</button>
					</div>
					<br>
				</div>
			</center>




		</body>
	</html>
