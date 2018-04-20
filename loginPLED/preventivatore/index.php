
	<?php

		session_start();

		// If session variable is not set it will redirect to login page
		if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		  header("location: ../login.php");
		  exit;
		}else{
		  $utente = $_SESSION['username'];
		  echo "<h2 style='color:green'>Benvenuto ".$utente."!</h1>";
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
	        //echo "id: " . $row["id"]. " - username: " . $row["username"]. "password" . $row["password"]."-crated at" . $row["created_at"] ."<br>";
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
			$consumo=array();
			$durata=array();
			$nome_lungo=array();
			$marca=array();
			$lumen=array();
			$note=array();
			$kelvin=array();
			$garanzia=array();
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        //echo "id: " . $row["id"]. " - modello: " . $row["username"]. "password" . $row["password"]."-crated at" . $row["created_at"] ."<br>";
					$id[] = $row['id'];
					$modello[] = $row["modello"];
					$id_foto[] = $row["id_foto"];
					$prezzo[] = $row["prezzo"];
					$gruppo_modello[] = $row["group_modello"];
					$consumo[] = $row["consumo"];
					$durata[] = $row["durata"];
					$nome_lungo[] = $row["nome_lungo"];
					$marca[] = $row["marca"];
					$lumen[] = $row["marca"];
					$note[] = $row["note"];
					$kelvin[] = $row["kelvin"];
					$garanzia[] = $row["garanzia"];
			}
			echo "<script>";
			echo "var array_id_leds = " . json_encode($id) . ";";
			echo "var array_modello = " . json_encode($modello) . ";";
			echo "var array_id_foto = " . json_encode($id_foto) . ";";
			echo "var array_prezzo = " . json_encode($prezzo) . ";";
			echo "var array_gruppo_modello = " . json_encode($gruppo_modello) . ";";
			echo "var array_consumo = " . json_encode($consumo) . ";";
			echo "var array_durata = " . json_encode($durata) . ";";
			echo "var array_nome_lungo = " . json_encode($nome_lungo) . ";";
			echo "var array_marca = " . json_encode($marca) . ";";
			echo "var array_lumen = " . json_encode($lumen) . ";";
			echo "var array_note = " . json_encode($note) . ";";
			echo "var array_kelvin = " . json_encode($kelvin) . ";";
			echo "var array_garanzia = " . json_encode($garanzia) . ";";

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
	        //echo "_foto: " . $row["id"]. " - foto: " . $row["content"]."<br>";
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

			/*---------------------------------------
    Preloader section
-----------------------------------------*/
.loading_screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 99999;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  background: none repeat scroll 0 0 #000000;
}

.sk-rotating-plane {
  width: 70px;
  height: 70px;
  background-color: #222;
	background-image: url("./logo.jpg");
  -webkit-animation: sk-rotatePlane 1.2s infinite ease-in-out;
          animation: sk-rotatePlane 1.2s infinite ease-in-out; }

@-webkit-keyframes sk-rotatePlane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

@keyframes sk-rotatePlane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }




			/*   radio button style */
					.control {
		    font-family: arial;
		    display: block;
		    position: relative;
		    padding-left: 30px;
		    margin-bottom: 5px;
		    padding-top: 3px;
		    cursor: pointer;
		    font-size: 16px;
		}
		    .control input {
		        position: absolute;
		        z-index: -1;
		        opacity: 0;
		    }
				.control_indicator {
				    position: absolute;
				    top: 2px;
				    left: 0;
				    height: 20px;
				    width: 20px;
				    background: #e6e6e6;
				    border: 0px solid #000000;
				}
				.control-radio .control_indicator {
				    border-radius: 50%;
				}

				.control:hover input ~ .control_indicator,
				.control input:focus ~ .control_indicator {
				    background: #cccccc;
				}

				.control input:checked ~ .control_indicator {
				    background: #2aa1c0;
				}
				.control:hover input:not([disabled]):checked ~ .control_indicator,
				.control input:checked:focus ~ .control_indicator {
				    background: #0e6647d;
				}
				.control input:disabled ~ .control_indicator {
				    background: #e6e6e6;
				    opacity: 0.6;
				    pointer-events: none;
				}
				.control_indicator:after {
				    box-sizing: unset;
				    content: '';
				    position: absolute;
				    display: none;
				}
				.control input:checked ~ .control_indicator:after {
				    display: block;
				}
				.control-radio .control_indicator:after {
				    left: 7px;
				    top: 7px;
				    height: 6px;
				    width: 6px;
				    border-radius: 50%;
				    background: #ffffff;
				}
				.control-radio input:disabled ~ .control_indicator:after {
				    background: #7b7b7b;
				}
				/* other styles*/

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
					border: 2px solid green;
			    border-radius: 25px;
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

				.input{
					text-align: center;
				}
			</style>

			<script>

			(function(){
			  if (window.addEventListener)
			  {
			    window.addEventListener("load", nascondi_loading_screen, false);
			  }else{
			    window.attachEvent("onload", nascondi_loading_screen);
			  }
			})();
			function mostra_loading_screen()
			{
			  document.getElementById("loading_screen").style.display = 'block';
			}
			function nascondi_loading_screen()
			{
			  document.getElementById("loading_screen").style.display = 'none';
			}

			var N_analogic_bulb = 1;

			var nome_azienda;
			var nome_referente;
			var tel_azienda;
			var mail_referente;
			var cap_azienda;
			var indirizzo_azienda;

			var costo_smaltimento;
			var numero_preventivo;

			var costoKWH = 0 ;
			var controlButton = true;
			var attrezzature;
			var risparmio_manutenzione;
			var controlButtonRemove = false;
			var StatoAttualeArray;
			var SolPLEDArray;

			var spesa_annua_attuale;
			var spesa_annua_attuale_totale;
			var spesa_annua_led;
			var risparmio_annuo_con_led;
			var risparmio_percentuale;


			var selezionati_nome_lungo;
			var selezionati_consumo;
			var selezionati_durata;
			var selezionati_marca;
			var selezionati_lumen;
			var selezionati_note;
			var selezionati_kelvin;
			var selezionati_garanzia;
			var selezionati_prezzo;
			var consumi_led_selezionati;
			var prezzo_led_selezionati;
			var selezionati_foto;

			var acquisto_totale;
			var spesa_annua_led_totale;
			var risparmio_annuo_con_led_totale;
			var risparmio_percentuale_totale;

			var imgLogo = "data:image/png;base64,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";


				function inc_PuntiLuce_SOL_PLED(indice){
					var i = indice.substring(10);
					var PuntiLuceLED = document.getElementById("PuntiLuceLED"+i);
					PuntiLuceLED.stepUp(1);
				}

				function dec_PuntiLuce_SOL_PLED(indice){
					var i = indice.substring(10);
					var PuntiLuceLED = document.getElementById("PuntiLuceLED"+i);
					if (PuntiLuceLED.value > 0 ){
						PuntiLuceLED.stepDown(1);
					}
				}

				function updateNameStandard(id){
					//var id = id.substring(15);
					var id = id.replace( /^\D+/g, '');
					//alert(id);
					var modello_input = document.getElementById("modelloStandard"+id).value;
					var consumo_input = document.getElementById("consumoStandard"+id).value;
					var durata_input = document.getElementById("durataStandard"+id).value;
					var puntiL_input = document.getElementById("puntiluceStandard"+id).value;
					var GG_input = document.getElementById("GGStandard"+id).value;
					var HH_input = document.getElementById("HHStandard"+id).value;

					var titolo_span = document.getElementById("titoloLampadaStandard"+id);
					var consumo_span = document.getElementById("standardSpanConsumo"+id);
					var durata_span = document.getElementById("standardSpanDurata"+id);
					var PL_span = document.getElementById("standardSpanPL"+id);
					var GG_span = document.getElementById("standardSpanGG"+id);
					var HH_span = document.getElementById("standardSpanHH"+id);

					modello_input.value = modello_input;
					consumo_input.value = consumo_input;
					durata_input.value = durata_input;
					puntiL_input.value = puntiL_input;
					GG_input.value = GG_input;
					HH_input.value = HH_input;



					if(modello_input != ""){
						titolo_span.innerHTML = "Lampada modello: "+modello_input;
						consumo_span.innerHTML = "Consumo reale del modello [" + modello_input+"] (in Watt)";
						durata_span.innerHTML = "Durata del modello [" + modello_input+ "] (in ore)";
						PL_span.innerHTML = "Punti luce del modello [" + modello_input + "]";
						GG_span.innerHTML = "Giorni di funzionamento del modello [" + modello_input+ "] all'anno";
						HH_span.innerHTML = "Ore di funzionamento del modello ["+modello_input +"] al giorno";
					}
				}

				function removeOneToStatoAttuale(){
					if (N_analogic_bulb > 1){
						var indice_id = N_analogic_bulb - 1;
						var elemento = document.getElementById("elemento"+indice_id);
						elemento.parentNode.removeChild(elemento);
						N_analogic_bulb--;
						controlButton = false;
						var html = "";

						if (controlButton == false){
							controlButtonRemove = true;
							html += "<div id='bottoniRemove'>";
							html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
							html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Salva ultimo ed aggiungi una lampada</button></div>";
							html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
							html += "</div>";
							html += "<hr>";
							html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";
							html += "</div>";
						}

						step2.innerHTML += html;
					}
					else{
						alert("Impossibile eliminare l'unico elemento!");
					}


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
					controlButton = false;

					if (controlButtonRemove == true){
						var bottoniRemove = document.getElementById("bottoniRemove");
						bottoniRemove.parentNode.removeChild(bottoniRemove);
						controlButtonRemove = false;
					}

					var html = "";

					//-------------------------SCRITTURA DEI CAMPI INSERITI PRECEDENTEMENTE-------------------
					html += "<div id='elemento"+indice_id+"'>";
					html += "<hr>";
					html += "<h3 id='titoloLampadaStandard"+indice_id+"'>"+titolo_span+ "</h3>";
					html += "<div><span>Modello: "+modello_span+"</span></div>";
					html += "<div><input id='modelloStandard"+indice_id+ "' onkeyup='updateNameStandard(this.id)' value='"+modello+"' readonly> </input></div>";
					html += "<div><span id='standardSpanConsumo"+indice_id+"'>"+consumo_span+ " (in Watt)</span></div>";
					html += "<div><input id='consumoStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)' value='"+consumo+"' readonly></input></div>";
					html += "<div><span id='standardSpanDurata"+indice_id+"'>"+durata_span+"</span></div>";
					html += "<div><input id='durataStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)' value='"+durata+"' readonly> </input></div>";
					html += "<div><span id='standardSpanPL"+indice_id+"'>"+PL_span+"</span></div>";
					html += "<div><input id='puntiluceStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)' value='"+PL+"' readonly> </input></div>";
					html += "<div><span id='standardSpanGG"+indice_id+"'>"+GG_span+"</span></div>";
					html += "<div><input id='GGStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)' value='"+GG+"' readonly> </input></div>";
					html += "<div><span id='standardSpanHH"+indice_id+"'>"+HH_span+"</span></div>";
					html += "<div><input id='HHStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)' value='"+HH+"' readonly> </input></div>";
					html += "<hr>";
					html += "</div>";

					//------------------------------SCRITTURA DEI NUOVI CAMPI--------------------------------------------
					html += "<div id='elemento"+N_analogic_bulb+"'>";
					html += "<hr>";
					html += "<h3 id='titoloLampadaStandard"+N_analogic_bulb+"'>Lampada Standard "+(N_analogic_bulb+1)+ "</h3>";
					html += "<div><span>Inserire modello"+(N_analogic_bulb+1)+ "</span></div>";
					html += "<div><input id='modelloStandard"+N_analogic_bulb+ "' onkeyup='updateNameStandard(this.id)'> </input></div>";
					html += "<div><span id='standardSpanConsumo"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'>Consumo reale del modello "+(N_analogic_bulb+1)+ " (in Watt)</span></div>";
					html += "<div><input id='consumoStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'></input></div>";
					html += "<div><span id='standardSpanDurata"+N_analogic_bulb+"'>Durata del modello "+(N_analogic_bulb+1)+ " (in ore)</span></div>";
					html += "<div><input id='durataStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
					html += "<div><span id='standardSpanPL"+N_analogic_bulb+"'>Punti luce del modello "+(N_analogic_bulb+1)+ "</span></div>";
					html += "<div><input id='puntiluceStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
					html += "<div><span id='standardSpanGG"+N_analogic_bulb+"'>Giorni di funzionamento del modello "+(N_analogic_bulb+1)+ " all'anno</span></div>";
					html += "<div><input id='GGStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
					html += "<div><span id='standardSpanHH"+N_analogic_bulb+"'>Ore di funzionamento del modello "+(N_analogic_bulb+1)+ " al giorno</span></div>";
					html += "<div><input id='HHStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
					html += "<hr>";

					//alert(controlButton);

					if (controlButton == false){
						html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
						html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Salva ultimo ed aggiungi una lampada</button></div>";
						html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
						html += "</div>";
						html += "<hr>";
						html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";
					}
					html += "</div>"

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
						indirizzo_azienda = document.getElementById("addrAzienda").value;
						cap_azienda = document.getElementById("CAPAzienda").value;
						nome_referente = document.getElementById("nomeReferente").value;
						mail_referente = document.getElementById("mailReferente").value;
						costoKWH = document.getElementById("costoKWH").value;
						costoKWH = costoKWH.replace(',','.');
						costoKWH = parseFloat(costoKWH);
						var control = false;


						if (nome_azienda != "" && tel_azienda != "" && indirizzo_azienda != "" && indirizzo_azienda != "" && cap_azienda != "" && mail_referente != "" && mail_referente.includes("@",".") && costoKWH != "" && !isNaN(costoKWH)){
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

							if (indirizzo_azienda == ""){
								alert("Devi inserire il l'indirizzo dell'azienda!");
							}

							if (cap_azienda == ""){
								alert("Devi inserire il cap e la città!");
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
							html += "<div><input id='modelloStandard"+indice_id+ "' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div><span id='standardSpanConsumo"+indice_id+"'>Consumo reale del modello "+(indice_id+1)+ " (in Watt)</span></div>";
							html += "<div><input id='consumoStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'></input></div>";
							html += "<div><span id='standardSpanDurata"+indice_id+"'>Durata del modello "+(indice_id+1)+ " (in ore)</span></div>";
							html += "<div><input id='durataStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div><span id='standardSpanPL"+indice_id+"'>Punti luce del modello "+(indice_id+1)+ "</span></div>";
							html += "<div><input id='puntiluceStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div><span id='standardSpanGG"+indice_id+"'>Giorni di funzionamento del modello "+(indice_id+1)+ " all'anno</span></div>";
							html += "<div><input id='GGStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div><span id='standardSpanHH"+indice_id+"'>Ore di funzionamento del modello "+(indice_id+1)+ " al giorno</span></div>";
							html += "<div><input id='HHStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<hr>";

							html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
							html += "<div><button class='buttonAddItem' onclick='addOneToStatoAttuale()'>Salva ultimo ed aggiungi una lampada</button></div>";
							html += "<div><button class='buttonRemoveItem' onclick='removeOneToStatoAttuale()'>Rimuovi una lampada (l'ultima)</button></div>";
							html += "</div>";
							html += "<hr>";
							html += "<br><button id='bottone_prosegui_stato_attuale' class='buttonStep' onclick='toSoluzionePLED()'>Prosegui</button>";

							html += "</div>" //chiusura div elementoN
							html += "</div>" //chiusura div step2
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
							html += "<hr>";
							html += "<div><span>La lampada "+(i+1)+" dello stato attuale MODELLO["+StatoAttualeArray[i][0]+"] con "+StatoAttualeArray[i][3]+" punti luce</span></div>";
							html += "<div><h3>E' DA SOSTITUIRE CON</h3></div>";
							html += "<div><span>Selezionare modello"+(i+1)+ ":     </span><select id='gruppiLED"+i+"' size='1' onChange='cambiaOpzioniLED(this.id);'>";
							html += "<option value='0'>Scegli un gruppo</option>";
							html += "<option value='Case'>Case</option>";
							html += "<option value='Panel Led'>Panel Led</option>";
							html += "<option value='Plafo4k'>Plafo4k</option>";
							html += "</select><select id='modelliLED"+i+"' size='1'></select></div>";
							html += "<div><label>Dimmerabile </label><input type='checkbox' value='0'></div>";
							html += "<div class='flex-containerPLED'>";
								html += "<div><span>Inserire punti luce: </span></div>";
								html += "<div><button id='dec_button"+i+"' onclick='dec_PuntiLuce_SOL_PLED(this.id)' class='buttonLess'> - </button></div>";
								html += "<div><input type='number' value='0' id='PuntiLuceLED"+i+"' style='text-align:center'></div>";
								html += "<div><button id='inc_button"+i+"' onclick='inc_PuntiLuce_SOL_PLED(this.id)' class='buttonPlus'> + </button></div>";
							html += "</div>";
							html += "<hr>";
						}
						html += "<br><button class='buttonStep' onclick='toOtherInfo()'>Prosegui</button>";
						step3.innerHTML += html;
						document.getElementById("container").appendChild(step3);
					}
				}

				function toOtherInfo(){
					SolPLEDArray = new Array(N_analogic_bulb);
					var control = 0;
					for (var i = 0 ; i < N_analogic_bulb ; i++){
						var modello = document.getElementById("modelliLED"+i).value;
						var PL = document.getElementById("PuntiLuceLED"+i).value;

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

					var html = "";

					html += "<h2>Informazioni aggiuntive</h2>";
					html += "<br>"

					html += "<h3>Sono necessarie attrezzature speciali per l'installazione?</h3>";
					html += "<div class='flex-containerPLED'>";
						html += "<div style='width:50%'><label class='control control-radio'>Si";
						html += "<input type='radio' name='radio' id='radioInstallation1' checked='checked'/>";
						html += "<div class='control_indicator'></div>";
						html += "</label></div>";

						html += "<div style='width:50%'><label class='control control-radio'>No";
						html += "<input type='radio' id='radioInstallation2' name='radio'/>";
						html += "<div class='control_indicator'></div>";
						html += "</label></div>";
					html += "</div>";

					html += "<hr>";
					html += "<div class='flex-containerPLED'>";
						html += "<p>Inserire il risparmio manutenzione (in euro)</p>";
						html += "<div><input type='number' value='0' id='risparmioManutenzione' style='text-align:center'></div>";
					html += "</div>";
					html += "<div class='flex-containerPLED'>";
						html += "<p>Smaltimento vecchi apparecchi illuminotecnici in Isola Ecologica (in euro)</p>";
						html += "<div><input type='number' value='0' id='costoSmaltimento' style='text-align:center'></div>";
					html += "</div>";
					html += "<div class='flex-containerPLED'>";
						html += "<p>Inserire il numero del preventivo</p>";
						html += "<div><input type='number' value='0' id='NPreventivo' style='text-align:center'></div>";
					html += "</div>";

					html += "<br><button class='buttonStep' onclick='toCheckValues()'>Prosegui</button>";

					step4.innerHTML += html;

					document.getElementById("container").appendChild(step4);
				}
			}

			function toCheckValues(){
				var radio1 = document.getElementById("radioInstallation1");
				var radio2 = document.getElementById("radioInstallation2");
				var risparmio_manutenzione_temp = document.getElementById("risparmioManutenzione").value;
				var smaltimento = document.getElementById("costoSmaltimento").value;
				var numPrev = document.getElementById("NPreventivo").value;
				var control = 0;
				if (radio1.checked){
					attrezzature = true;
					control++;
				}else if (radio2.checked){
					attrezzature = false;
					control++;
				}else{
					alert("Errore in selezione opzioni installazione");
				}

				if (risparmio_manutenzione_temp != "" && risparmio_manutenzione_temp != "0"){
					risparmio_manutenzione = risparmio_manutenzione_temp;
					risparmio_manutenzione = risparmio_manutenzione.replace(',','.');
					risparmio_manutenzione = parseFloat(risparmio_manutenzione).toFixed(2);
					control++;
				}else{
					alert("Non hai inserito il risparmio manutenzione!");
				}

				if (smaltimento != "" && smaltimento != "0"){
					smaltimento = smaltimento.replace(',','.');
					costo_smaltimento = parseFloat(smaltimento).toFixed(2);
					control++;
				}else{
					alert("Non hai inserito il costo di smaltimento!");
				}

				if (numPrev != "" && numPrev != "0"){
					numPrev = numPrev.replace(',','.');
					numero_preventivo = parseFloat(numPrev).toFixed(2);
					control++;
				}else{
					alert("Non hai inserito il risparmio manutenzione!");
				}

			if (control == 4){

				var step4 = document.getElementById("step4");
				step4.parentNode.removeChild(step4);

				var step5 = document.createElement("div");
				step5.id="step5";

				var html = "";

				html += "<h2>Controlla i valori inseriti</h2>";
				html += "<br>"

				html += "<h3>Dati azienda</h3>";
				html += "<div><span>Nome dell'azienda: "+nome_azienda+"<span></div>";
				html += "<div><span>Numero Telefonico dell'azienda: "+tel_azienda+"</span></div>";
				html += "<div><span>Indirizzo dell'azienda: "+indirizzo_azienda+"</span></div>";
				html += "<div><span>CAP e città dell'azienda: "+cap_azienda+"</span></div>";
				html += "<div><div><span>Nome del referente dell'azienda: "+nome_referente+"</span></div>";
				html += "<div><span>Mail del referente dell'azienda: "+mail_referente+"</span></div>";
				html += "<div><span>Costo della corrente in Kw/h: "+costoKWH+"</span></div>";

				html += "<hr>";
				html += "<h3>Dati prodotti</h3>";
				html += "<ul>";
				for (var i = 0; i < N_analogic_bulb; i++){
					html += "<li>Lampada [model:"+StatoAttualeArray[i][0];
					html += " - consumo: "+StatoAttualeArray[i][1];
					html += " - durata: "+StatoAttualeArray[i][2];
					html += " - punti luce: "+StatoAttualeArray[i][3];
					html += " - GG funzionamento: "+StatoAttualeArray[i][4];
					html += " - HH funzionamento: "+StatoAttualeArray[i][5]+"]";
					html += " <strong>sostituita con</strong> [model: "+SolPLEDArray[i][0];
					html += " - punti luce: "+SolPLEDArray[i][1]+"]";
					html += "<br>";
					html += " </li>"
				}
				html += "</ul>";

				html += "<hr>";
				html += "<h3>Dati aggiuntivi</h3>";
				if (attrezzature){
					html += "<p>Sono previsti costi aggiuntivi per l'installazione</p>";
				}else{
					html += "<p>Non sono previsti costi aggiuntivi per l'installazione</p>";
				}
				html += "<p>Hai inserito "+risparmio_manutenzione+"euro come risparmio manutenzione</p>";
				html += "<hr>";

				html += "<h3>Se i dati inseriti risultano corretti clicca su Calcola per calcolare il preventivo</h3>";
				html += "<p>altrimenti clicca su ricarica per reinserire i dati</p>";

				html += "<div class='flex-containerPLED'>";
				html += "<hr>";
				html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
				html += "<div><button class='buttonAddItem' onclick='toCheckCalcolo()'>Calcola</button></div>";
				html += "<div><button class='buttonRemoveItem' onclick='window.location.reload()'>Ricarica</button></div>";
				html += "</div>";
				html += "<hr>";

				step5.innerHTML += html;

				document.getElementById("container").appendChild(step5);
			}else{
				alert("Error: Non hai inserito tutti i valori correttamente!");
			}
		}

			function toCheckCalcolo(){
				calcoli();

				var step5 = document.getElementById("step5");
				step5.parentNode.removeChild(step5);

				var step6 = document.createElement("div");
				step6.id="step6";

				var html = "";
				html += "<h2>Eventuali modifiche e sconti</h2>";
				html += "<br>";
				html += "<hr>";
				html += "<h3>Prodotti PLED</h3>";
				for (var i = 0; i < N_analogic_bulb;i++){
					html += "<p>Modello "+SolPLEDArray[i][0]+" con "+SolPLEDArray[i][1]+" punti luce: costo unitario di listino = "+selezionati_prezzo[i]+"</p>";
				}
				html += "<hr>";
				html += "<h3>Totali</h3>";
				html += "<div id='riassuntoCalcoli'>"
					html += "<p>Il totale degli acquisti risulta:  € "+Number(acquisto_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
					html += "<p>La spesa attuale totale risulta:  € "+Number(spesa_annua_attuale_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
					html += "<p>La spesa con LED totale risulta:  € "+Number(spesa_annua_led_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
					html += "<p>Il risparmio con LED in euro risulta:  € "+Number(risparmio_annuo_con_led_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
					html += "<p>Il risparmio con LED in percentuale risulta:  € "+Number(risparmio_percentuale_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"%</p>";
				html += "</div>";
				html += "<hr>";
				html += "<h3>Se vuoi modificare qualche valore riempi i campi sottostanti altrimenti vai ai PDF generati</h3>";
				html += "<h3>Prodotti("+N_analogic_bulb+")</h3>"
				for (var i = 0; i < N_analogic_bulb;i++){
					var prezzo = selezionati_prezzo[i];
					html += "<div class='flex-container'>";
						html += "<div><span>Prezzo unitario del modello "+SolPLEDArray[i][0]+":</span></div>";
						html += "<div><input placeholder='"+prezzo+"' id='costo_unitario_changed"+i+"' style='text-align:center' onkeyup='cambiaRiassuntoCalcoli(this.id)'> </input></div>";
					html += "</div>";
				}
				html += "<hr>";
				html += "<h3>Totali</h3>"
				html += "<div class='flex-container'>";
					html += "<div><span>Prezzo di acquisto totale:</span></div>";
					html += "<div><input id='acquisto_totale_changed' style='text-align:center' onkeyup='cambiaRiassuntoCalcoli(this.id)'> </input></div>";
					html += "<div><span>Spesa attuale annua totale:</span></div>";
					html += "<div><input id='attuale_totale_changed' style='text-align:center' onkeyup='cambiaRiassuntoCalcoli(this.id)'> </input></div>";
				html += "</div>";

				html += "<div class='flex-container'>";
					html += "<div><span>Risparmio annuo totale:</span></div>";
					html += "<div><input id='risparmio_totale_changed' style='text-align:center' onkeyup='cambiaRiassuntoCalcoli(this.id)'> </input></div>";
					html += "<div><span>Risparmio annuo percentuale totale:</span></div>";
					html += "<div><input id='risparmio_totale_percentuale_changed' style='text-align:center' onkeyup='cambiaRiassuntoCalcoli(this.id)'> </input></div>";
				html += "</div>";


				html +="<center>";
					html +="<div class='wrapper'>";
						html +="<hr>";
						html +="<div><button class='buttonStep' onclick='toStampaPDF()'>Ai PDF generati</button></div>";
					html +="</div>";
				html +="</center>";

				step6.innerHTML += html;

				document.getElementById("container").appendChild(step6);

			}

			function cambiaRiassuntoCalcoli(id){
				var riassunto_calcoli = document.getElementById("riassuntoCalcoli");
				var html = "";
				var control = 0;

				for (var i = 0 ; i < N_analogic_bulb ; i++){
					var costo_unitario = document.getElementById("costo_unitario_changed"+i);
					if (costo_unitario.value == ""){
						control++;
					}else if (!isNaN(costo_unitario.value)){
						control++;
						selezionati_prezzo[i] = parseFloat(costo_unitario.value);
						//alert("debug: "+ selezionati_prezzo[i] + " - " + selezionati_prezzo);
					}else{
						alert("Error: Il prezzo inserito per il modello nr."+i+" ["+SolPLEDArray[i][0]+"] non è un numero!");
					}
				}
				var acquisto_totale_changed = document.getElementById("acquisto_totale_changed");
				var spesa_totale_attuale_changed = document.getElementById("attuale_totale_changed");
				var risparmio_totale_changed = document.getElementById("risparmio_totale_changed");
				var risparmio_totale_percentuale_changed = document.getElementById("risparmio_totale_percentuale_changed");


				if (spesa_totale_attuale_changed.value == ""){
					control++;
				}else if (!isNaN(spesa_totale_attuale_changed.value)) {
					control++;
					spesa_annua_attuale_totale=parseFloat(spesa_totale_attuale_changed.value);
				}else{
					alert("Error: la spesa annua totale non è un numero");
				}

				if (acquisto_totale_changed.value == ""){
					control++;
				}else if (!isNaN(acquisto_totale_changed.value)) {
					control++;
					acquisto_totale=parseFloat(acquisto_totale_changed.value);
				}else{
					alert("Error: l'acquisto totale non è un numero");
				}

				if (risparmio_totale_changed.value == ""){
					control++;
				}else if (!isNaN(risparmio_totale_changed.value)) {
					control++;
					risparmio_annuo_con_led_totale=parseFloat(risparmio_totale_changed.value);
				}else{
					alert("Error: il risparmio annuo totale non è un numero");
				}

				if (risparmio_totale_percentuale_changed.value == ""){
					control++;
				}else if (!isNaN(risparmio_totale_percentuale_changed.value)) {
					control++;
					risparmio_percentuale_totale=parseFloat(risparmio_totale_percentuale_changed.value);
				}else{
					alert("Error: il risparmio annuo totale percentuale non è un numero");
				}

				if (control == (N_analogic_bulb+4)){
					//alert("ok");
					if (id.startsWith("costo_unitario")){
						acquisto_totale = parseFloat(costo_smaltimento);
						for (var i = 0 ; i < N_analogic_bulb ; i++){
							acquisto_totale += SolPLEDArray[i][1] * selezionati_prezzo[i];
						}
					}
					html += "<div id='riassuntoCalcoli'>"
						html += "<p>Il totale degli acquisti risulta:  € "+Number(acquisto_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
						html += "<p>La spesa attuale totale risulta:  € "+Number(spesa_annua_attuale_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
						html += "<p>La spesa con LED totale risulta:  € "+Number(spesa_annua_led_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
						html += "<p>Il risparmio con LED in euro risulta:  € "+Number(risparmio_annuo_con_led_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"</p>";
						html += "<p>Il risparmio con LED in percentuale risulta:  € "+Number(risparmio_percentuale_totale.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})+"%</p>";
					html += "</div>";
					riassunto_calcoli.innerHTML = html;
				}


			}

			function calcoli(){
				//------------------------CALCOLI PER STAMPA----------------------------
				spesa_annua_led = new Array(N_analogic_bulb);
				spesa_annua_attuale = new Array(N_analogic_bulb);
				risparmio_annuo_con_led = new Array(N_analogic_bulb);
				risparmio_percentuale = new Array(N_analogic_bulb);

				selezionati_nome_lungo = new Array(N_analogic_bulb);
				selezionati_prezzo = new Array(N_analogic_bulb);
				selezionati_foto = new Array(N_analogic_bulb);
				selezionati_note = new Array(N_analogic_bulb);
				selezionati_lumen = new Array (N_analogic_bulb);
				selezionati_marca = new Array (N_analogic_bulb);
				selezionati_lumen = new Array (N_analogic_bulb);
				selezionati_kelvin = new Array (N_analogic_bulb);
				selezionati_garanzia = new Array (N_analogic_bulb);
				selezionati_durata = new Array (N_analogic_bulb);
				selezionati_consumo = new Array (N_analogic_bulb);

				acquisto_totale = parseFloat(costo_smaltimento);
				spesa_annua_led_totale = 0;
				spesa_annua_attuale_totale = 0;
				risparmio_annuo_con_led_totale = 0;
				risparmio_percentuale_totale = 0;
				risparmio_manutenzione = parseFloat(risparmio_manutenzione);
				for (var i = 0; i < N_analogic_bulb; i++){
					var temp = StatoAttualeArray[i][4] *StatoAttualeArray[i][5] * costoKWH / 1000;
					spesa_annua_attuale[i] = temp * StatoAttualeArray[i][1] * StatoAttualeArray[i][3];
					var modelloLED = SolPLEDArray[i][0];
					for (var j = 0; j < array_modello.length; j++){
						if (modelloLED == array_modello[j]){
							selezionati_consumo[i] = parseFloat(array_consumo[j]);
							selezionati_prezzo[i] = parseFloat(array_prezzo[j]);
							selezionati_foto[i] = array_id_foto[j];
							selezionati_note[i] = array_note[j];
							selezionati_durata[i] = array_durata[j];
							selezionati_kelvin[i] = array_kelvin[j];
							selezionati_garanzia[i] = array_garanzia;
							selezionati_nome_lungo[i] = array_nome_lungo[j];
							selezionati_lumen[i] = array_lumen[j];
							//alert("TRovato match "+consumi_led_selezionati[i]+" "+prezzo_led_selezionati[i]+" "+descrizioni_led_selezionati[i]+" "+foto_selezionati[i]+" "+durata_selezionati[i]);
						}
					}
					spesa_annua_led[i] = temp * SolPLEDArray[i][1] * selezionati_consumo[i];
					risparmio_annuo_con_led[i] = spesa_annua_attuale[i] - spesa_annua_led[i];
					risparmio_percentuale[i] = Math.floor(1 - (spesa_annua_led[i]/spesa_annua_attuale[i]));

					//totali
					spesa_annua_attuale_totale += spesa_annua_attuale[i];
					spesa_annua_led_totale += spesa_annua_led[i];
					risparmio_annuo_con_led_totale += risparmio_annuo_con_led[i];
					acquisto_totale += selezionati_prezzo[i] * SolPLEDArray[i][1];
				}
				risparmio_annuo_con_led_totale += risparmio_manutenzione;
				risparmio_annuo_con_led_totale = parseFloat(risparmio_annuo_con_led_totale);
				risparmio_percentuale_totale = Math.floor((spesa_annua_led_totale/spesa_annua_attuale_totale -1 )*100);

				//----------------------------------------------------------------------
			}

			function toStampaPDF(){

				var control = 0;

				for (var i = 0 ; i < N_analogic_bulb ; i++){
					var costo_unitario = document.getElementById("costo_unitario_changed"+i);
					if (costo_unitario.value == "" || !isNaN(costo_unitario.value))
						control++;
				}
				var acquisto_totale_changed = document.getElementById("acquisto_totale_changed");
				var spesa_totale_attuale_changed = document.getElementById("attuale_totale_changed");
				var risparmio_totale_changed = document.getElementById("risparmio_totale_changed");
				var risparmio_totale_percentuale_changed = document.getElementById("risparmio_totale_percentuale_changed");


				if (spesa_totale_attuale_changed.value == ""){
					control++;
				}else if (!isNaN(spesa_totale_attuale_changed.value)) {
					control++;
					spesa_annua_attuale_totale=spesa_totale_attuale_changed.value;
				}else{
					alert("Error: la spesa annua totale non è un numero");
				}

				if (acquisto_totale_changed.value == ""){
					control++;
				}else if (!isNaN(acquisto_totale_changed.value)) {
					control++;
					acquisto_totale=acquisto_totale_changed.value;
				}else{
					alert("Error: l'acquisto totale non è un numero");
				}

				if (risparmio_totale_changed.value == ""){
					control++;
				}else if (!isNaN(risparmio_totale_changed.value)) {
					control++;
					risparmio_annuo_con_led_totale=risparmio_totale_changed.value;
				}else{
					alert("Error: il risparmio annuo totale non è un numero");
				}

				if (risparmio_totale_percentuale_changed.value == ""){
					control++;
				}else if (!isNaN(risparmio_totale_percentuale_changed.value)) {
					control++;
					risparmio_percentuale_totale=risparmio_totale_percentuale_changed.value;
				}else{
					alert("Error: il risparmio annuo totale percentuale non è un numero");
				}


				if (control == (N_analogic_bulb+4)){


					var step6 = document.getElementById("step6");
					step6.parentNode.removeChild(step6);

					var step7 = document.createElement("step7");
					step7.id="step7";



					var html = "";

					html += "<h2>Clicca sul bottone corrispondente per visualizzare il file generato</h2>";
					html += "<br>"

					html +="<center>";
						html +="<div class='wrapper'>";
							html +="<hr>";
							html +="<button class='btn btn-primary' type='button' onclick='create_acquisto_listino()'>ACQUISTO listino</button>";
							html +="<hr>";
							html +="<button class='btn btn-success' type='button' onclick='create_acquisto_conti()'>RISPARMIO</button>";
							html +="<hr>";
							html +="<button class='btn btn-default' type='button' onclick='create_noleggio_listino()'>NOLEGGIO listino</button>";
							html +="<hr>";
							html +="<button class='btn btn-warining' type='button' onclick='create_noleggio_conti()'>FOGLIO4 </button>";
							html +="<hr>";
							html +="<button class='btn btn-info' type='button' onclick='create_payback()'>PAYBACK</button>";
							html +="<hr>";
							html +="<hr>";
							html +="<div><button class='buttonRemoveItem' onclick='window.location.reload()'>Ricarica</button></div>";
						html +="</div>";
					html +="</center>";

					step7.innerHTML += html;

					document.getElementById("container").appendChild(step7);
				}else{
					alert("Qualcuno dei valori inseriti non è un numero!");
				}
			}

			function create_payback(){
				var pdf_as_url;
				var doc = new jsPDF();
				var totalPagesExp = "{total_pages_count_string}";
				var columns = ["Anno", "Risparmio", "Risparmio \nmanutenzione","Quota \nammortizzata","Quota \nresidua","Risparmio \ntot annuo","Investimento"];
				var rows = new Array();


				//valori totali
				var risparmio_totale_vita = 0;
				var ammoratamento_cespite = acquisto_totale * 140 / 100;
				var payback = acquisto_totale / risparmio_annuo_con_led_totale;


				//colonne sempre uguali
				var risparmio_colonna = "€ "+Number((risparmio_annuo_con_led_totale-risparmio_manutenzione).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				var risparmio_manutenzione_colonna = "€ "+Number((risparmio_manutenzione).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				var precedente_colonna = 0;

				for (var i = 0; i < 20 ; i++){
					var quota_ammortizzata_colonna;
					var colonna_temp;
					var quota_residua_colonna;
					var risparmio_tot_annuo_colonna;
					var investimento_colonna;

					//numeri
					quota_ammortizzata_colonna = ((i == 0) ? acquisto_totale : precedente_colonna);
					colonna_temp = quota_ammortizzata_colonna-risparmio_annuo_con_led_totale;
					precedente = colonna_temp;
					quota_residua_colonna = ((colonna_temp > 0) ? colonna_temp : 0);
					risparmio_tot_annuo_colonna = ((quota_residua_colonna > 0) ? 0 : (risparmio_annuo_con_led_totale-quota_ammortizzata_colonna));

					risparmio_totale_vita += risparmio_tot_annuo_colonna;

					if(i == 0) investimento_colonna = "€ "+Number((acquisto_totale).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					else investimento_colonna = "€ "+Number((0).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});

					//stringhe formattate per stampa
					quota_ammortizzata_colonna = "€ "+Number((quota_ammortizzata_colonna).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					quota_residua_colonna = "€ "+Number((quota_residua_colonna).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					risparmio_tot_annuo_colonna = "€ "+Number((risparmio_tot_annuo_colonna).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});


					rows[i] = [i+1,risparmio_colonna,risparmio_manutenzione_colonna,quota_ammortizzata_colonna,quota_residua_colonna,risparmio_tot_annuo_colonna,investimento_colonna];
				}

				//totali formattati in require_once
				payback = ""+Number((payback).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				risparmio_totale_vita = "€ "+Number((risparmio_totale_vita).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				ammoratamento_cespite = "€ "+Number((ammoratamento_cespite).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});



				var pageContent = function (data) {
					// HEADER
					doc.setFontSize(9);
					doc.setTextColor(40);
					doc.setFontStyle('normal');
			 // Purple

					if (imgLogo) {
							doc.addImage(imgLogo, 'JPEG', doc.internal.pageSize.width/2-50, 5, 100, 15);
					}
					doc.setFontType('bold');
					doc.text("PROFESSIONAL LED SRL\n", data.settings.margin.left, 30);
					doc.setFontType('normal');
					doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", data.settings.margin.left, 34);
					doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);
					// FOOTER
					var str = "Page " + data.pageCount;
					// Total page number plugin only available in jspdf v1.0+
					doc.setTextColor(201,201,201);
					if (typeof doc.putTotalPages === 'function') {
							str = str + " of " + totalPagesExp;
					}
					doc.setFontSize(10);
					doc.text(str, data.settings.margin.left, doc.internal.pageSize.height - 10);
				};

				doc.setDrawColor(0);
				doc.setFillColor(0, 77, 126);
				doc.rect(10, 55, doc.internal.pageSize.width-20, 10, 'FD');

				doc.setFontType('bold');
				doc.setTextColor(160, 197, 25);
				doc.setFontSize(16);
				doc.text(70, 62, "PAYBACK IN "+payback+" ANNI");

				doc.autoTable(columns, rows, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, right: 15},
					headerStyles: {fillColor: [0, 77, 126]},
					addPageContent: pageContent
				});

				var finalY = doc.autoTable.previous.finalY;
				var finalX = doc.autoTable.previous.finalX;
				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(54, finalY+3, 113, 11, 'FD');
				doc.rect(139.2, finalY+3, 27.8, 11, 'FD');

				doc.setFontType('bold');
				doc.setTextColor(160, 197, 25);
				doc.setFontSize(9);
				doc.text(59, finalY+8, "RISPARMIO TOTALE PER VITA UTILE \nCORPI ILLUMINANTI A LED INSTALLATI");
				doc.setTextColor(0, 77, 126);
				doc.setFontSize(12);
				doc.text(141, finalY+10, risparmio_totale_vita);

				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(10, finalY+20, doc.internal.pageSize.width-20, 11, 'FD');
				doc.rect(11, finalY+21, doc.internal.pageSize.width-22, 9, 'FD');

				doc.setTextColor(0);
				doc.setFontSize(12);
				doc.text(20,finalY+27,"Legge finanziaria 2018: ammortamento cespite 130% annuo                         "+ammoratamento_cespite);

				doc.setTextColor(0);
				doc.setFontSize(9);
				doc.text(14,finalY+40,"N.B. IL CONSUMO DI CORRENTE NON CONSIDERA EVENTUALI VARIAZIONI DI TARIFFA");

				if (typeof doc.putTotalPages === 'function') {
        	doc.putTotalPages(totalPagesExp);
    		}
				pdf_as_string = doc.output('datauristring');

				if (typeof(Storage) !== "undefined") {
					localStorage.setItem('pdf', JSON.stringify(pdf_as_string));
					window.open("./toPrint.html");
				} else {
					alert("Impossile stampare, prego scaricare ultima versione di Chrome");
				}

			}

			</script>

		</header>

		<body background="https://static.webshopapp.com/shops/001680/files/145451846/striscia-led-rigida-impermeabile-blanco-5050-smd-7.jpg" style="background-size:cover">

			<div class="loading_screen" id="loading_screen">
				<div class="sk-rotating-plane"></div>
			</div>

			<center>
				<div class="container" id="container">
					<h2><big><strong>Preventivatore online</strong></big></h2>
					<hr>
					<div id="step1" >
						<p>Inserisci i dati per iniziare</p>
						<p>Tutti i valori inseriti andranno in stampa così come sono scritti. Fai attenzione!</p>

						<div class="flex-container">
							<div><span>Inserisci il nome dell'azienda</span></div>
							<div><input placeholder="Lampade tristi SRL" id="nomeAzienda"> </input></div>
							<div><span>Inserire N. telefonico dell'azienda</span></div>
							<div><input placeholder="051/123456" id="telAzienda"> </input></div>
						</div>

						<div class="flex-container">
							<div><span>Inserire indirizzo dell'azienda</span></div>
							<div><input placeholder="Via dei matti 0" id="addrAzienda"> </input></div>
							<div><span>Inserire CAP e citta'</span></div>
							<div><input placeholder="40129 Bologna" id="CAPAzienda"> </input></div>
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

			<?php
				echo "<div align='right' style='margin:1rem'>";
				echo "<p>Web app realizzata da Matteo Mendula © Tutti i diritti riservati.</p>";
				echo "<a href='../logout.php'>LOGOUT</a>";
				echo "</div>"
			?>
		</body>
	</html>
