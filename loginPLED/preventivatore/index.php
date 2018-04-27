
	<?php

		session_start();

		// If session variable is not set it will redirect to login page
		if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		  header("location: ../login.php");
		  exit;
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
			var dimmerabilita = "Tutti i prodotti sono stati richiesti non dimmerabili";

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

			var indici_foto_filtrati = new Array();


			var acquisto_totale;
			var spesa_annua_led_totale;
			var risparmio_annuo_con_led_totale;
			var risparmio_percentuale_totale;

			var noleggio1;
			var noleggio2;
			var noleggio3;
			var noleggio4;
			var noleggio5;

			var local_db_stato_attuale = [
				["Seleziona un modello","",""],
				["modelloA",1,"durataA"],
				["modelloB",2,"durataB"],
				["modelloC",3,"durataC"],
				["Inserimento_manuale","",""],
			];

			var imgLogo = "data:image/png;base64,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";
			var simboli="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4RDoRXhpZgAATU0AKgAAAAgABQESAAMAAAABAAEAAAE7AAIAAAAGAAAIVodpAAQAAAABAAAIXJydAAEAAAAMAAAQ1OocAAcAAAgMAAAASgAAAAAc6gAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAE1BVFRFAAAFkAMAAgAAABQAABCqkAQAAgAAABQAABC+kpEAAgAAAAM4MgAAkpIAAgAAAAM4MgAA6hwABwAACAwAAAieAAAAABzqAAAACAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAxODowNDoyNCAxNjo1OTo1NAAyMDE4OjA0OjI0IDE2OjU5OjU0AAAATQBBAFQAVABFAAAA/+ELGGh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8APD94cGFja2V0IGJlZ2luPSfvu78nIGlkPSdXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQnPz4NCjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iPjxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+PHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9InV1aWQ6ZmFmNWJkZDUtYmEzZC0xMWRhLWFkMzEtZDMzZDc1MTgyZjFiIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iLz48cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0idXVpZDpmYWY1YmRkNS1iYTNkLTExZGEtYWQzMS1kMzNkNzUxODJmMWIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyI+PHhtcDpDcmVhdGVEYXRlPjIwMTgtMDQtMjRUMTY6NTk6NTQuODIxPC94bXA6Q3JlYXRlRGF0ZT48L3JkZjpEZXNjcmlwdGlvbj48cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0idXVpZDpmYWY1YmRkNS1iYTNkLTExZGEtYWQzMS1kMzNkNzUxODJmMWIiIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyI+PGRjOmNyZWF0b3I+PHJkZjpTZXEgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj48cmRmOmxpPk1BVFRFPC9yZGY6bGk+PC9yZGY6U2VxPg0KCQkJPC9kYzpjcmVhdG9yPjwvcmRmOkRlc2NyaXB0aW9uPjwvcmRmOlJERj48L3g6eG1wbWV0YT4NCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgPD94cGFja2V0IGVuZD0ndyc/Pv/bAEMAAgEB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";

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
					var id = id;
					if (isNaN(id)) id = id.replace( /^\D+/g, '');
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
						durata_span.innerHTML = "Durata in ore [" + modello_input+ "] ";
						PL_span.innerHTML = "Numero di punti luce del modello [" + modello_input + "]";
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

					var control = 0;

					for (var i = 0 ; i < N_analogic_bulb ; i++){
						var modello = document.getElementById("modelloStandard"+i).value;
						var consumo = document.getElementById("consumoStandard"+i).value;
						var durata = document.getElementById("durataStandard"+i).value;
						var PL = document.getElementById("puntiluceStandard"+i).value;
						var GG = document.getElementById("GGStandard"+i).value;
						var HH = document.getElementById("HHStandard"+i).value;



						if(modello != "" && consumo != "" && !isNaN(consumo) && durata != "" && PL != "" && !isNaN(PL) && GG != "" && !isNaN(GG) && HH != "" && !isNaN(HH)){
							//StatoAttualeArray[i] = new Array(modello,consumo,durata,PL,GG,HH);
							control ++;
						}else {
							if (modello == ""){
								alert("Nome Modello "+(i+1)+" mancante!");
							}
							if (consumo == "" || isNaN(consumo)){
								alert("Consumo del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
							}
							if (durata == ""){
								alert("Durata del modello "+(i+1)+ " mancante !")
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
						html += "<div><span id='standardSpanConsumo"+indice_id+"'>"+consumo_span+ "</span></div>";
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
						//html += "<div><input id='modelloStandard"+N_analogic_bulb+ "' onkeyup='updateNameStandard(this.id)'> </input></div>";
						html += "<div id='divManuale"+N_analogic_bulb+"'><select id='modelloStandard"+N_analogic_bulb+"' onChange='changeModelliStatoAttuale(this.id)'>";
						for (var i = 0; i < local_db_stato_attuale.length; i ++){
							html += "<option value="+local_db_stato_attuale[i][0]+">"+local_db_stato_attuale[i][0]+"</option>";
						}
						html += "</select></div>";
						html += "<div><span id='standardSpanConsumo"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'>Consumo reale del modello "+(N_analogic_bulb+1)+ " (in Watt)</span></div>";
						html += "<div><input id='consumoStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'></input></div>";
						html += "<div><span id='standardSpanDurata"+N_analogic_bulb+"'>Durata in ore del modello "+(N_analogic_bulb+1)+ "</span></div>";
						html += "<div><input id='durataStandard"+N_analogic_bulb+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
						html += "<div><span id='standardSpanPL"+N_analogic_bulb+"'>Numero di punti luce del modello "+(N_analogic_bulb+1)+ "</span></div>";
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
					}else{
						alert("Errore: non sono stati inseriti tutti i valori nell'ultimo modello");
					}
				}

				function changeModelliStatoAttuale(id){
					var indice = id.replace( /^\D+/g, '');
					var x = document.getElementById("modelloStandard"+indice);
					updateNameStandard(indice);
					for (var i = 0; i < local_db_stato_attuale.length; i ++){
						var consumo = document.getElementById("consumoStandard"+indice);
						var durata = document.getElementById("durataStandard"+indice);
						if (x.value == local_db_stato_attuale[i][0]){
							consumo.value = local_db_stato_attuale[i][1];
							durata.value = local_db_stato_attuale[i][2];
						}else if (x.value == "Inserimento_manuale"){
							consumo.value = "";
							durata.value = "";
							var div = document.getElementById("divManuale"+indice);
							var manuale = "";
							manuale += "<input id='modelloStandard"+(N_analogic_bulb-1)+ "' onkeyup='updateNameStandard(this.id)'> </input></div>";
							div.innerHTML = manuale;

						}
					}
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
								if (array_gruppo_modello[i] == "Plafo 4k" && selezionato == "3"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Plafo 5k" && selezionato == "4"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Plafo 6k" && selezionato == "5"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Proiettore" && selezionato == "6"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Fari SPORT" && selezionato == "7"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Campana" && selezionato == "8"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "alimentatori" && selezionato == "9"){
									modelliLed.options[modelliLed.options.length] = new Option(array_modello[i]);
								}
								if (array_gruppo_modello[i] == "Varie" && selezionato == "10"){
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
								alert("Devi inserire il nome del referente dell'azienda!");
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
							//html += "<div><input id='modelloStandard"+indice_id+ "' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div id='divManuale"+indice_id+"'><select id='modelloStandard"+indice_id+"' onChange='changeModelliStatoAttuale(this.id)'>";
							for (var i = 0; i < local_db_stato_attuale.length; i ++){
								html += "<option value="+local_db_stato_attuale[i][0]+">"+local_db_stato_attuale[i][0]+"</option>";
							}
							html += "</select></div>";
							html += "<div><span id='standardSpanConsumo"+indice_id+"'>Consumo reale del modello "+(indice_id+1)+ " (in Watt)</span></div>";
							html += "<div><input id='consumoStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'></input></div>";
							html += "<div><span id='standardSpanDurata"+indice_id+"'>Durata in ore "+(indice_id+1)+ "</span></div>";
							html += "<div><input id='durataStandard"+indice_id+"' onkeyup='updateNameStandard(this.id)'> </input></div>";
							html += "<div><span id='standardSpanPL"+indice_id+"'>Numero di punti luce del modello "+(indice_id+1)+ "</span></div>";
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



							if(modello != "" && consumo != "" && !isNaN(consumo) && durata != ""  && PL != "" && !isNaN(PL) && GG != "" && !isNaN(GG) && HH != "" && !isNaN(HH)){
								StatoAttualeArray[i] = new Array(modello,consumo,durata,PL,GG,HH);
								control ++;
							}else {
								if (modello == ""){
									alert("Nome Modello "+(i+1)+" mancante!");
								}
								if (consumo == "" || isNaN(consumo)){
									alert("Consumo del modello "+(i+1)+ " mancante oppure in formato non valido (deve essere un numero)!")
								}
								if (durata == "" ){
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
							html += "<option value='Plafo 4k'>Plafo 4k</option>";
							html += "<option value='Plafo 5k'>Plafo 5k</option>";
							html += "<option value='Plafo 6k'>Plafo 6k</option>";
							html += "<option value='Proiettore'>Proiettore</option>";
							html += "<option value='Fari SPORT'>Fari SPORT</option>";
							html += "<option value='Camapana'>Campana</option>";
							html += "<option value='alimentatori'>alimentatori</option>";
							html += "<option value='Varie'>Varie</option>";
							html += "</select><select id='modelliLED"+i+"' size='1'></select></div>";
							html += "<div><label>Dimmerabile </label><input id='dimmerabile"+i+"' type='checkbox' value='0'></div>";
							html += "<div class='flex-containerPLED'>";
								html += "<div><span>Inserire punti luce: </span></div>";
								html += "<div><button id='dec_button"+i+"' onclick='dec_PuntiLuce_SOL_PLED(this.id)' class='buttonLess'> - </button></div>";
								html += "<div><input type='number' min='0' value='0' id='PuntiLuceLED"+i+"' style='text-align:center'></div>";
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
					var count_dimmerabili = 0;
					for (var i = 0 ; i < N_analogic_bulb ; i++){
						var modello = document.getElementById("modelliLED"+i).value;
						var PL = document.getElementById("PuntiLuceLED"+i).value;
						var dimmer = document.getElementById("dimmerabile"+i);
						var control_dimmerabile = 0;

						if (dimmer.checked){
							control_dimmerabile = 1;
							count_dimmerabili++;
							modello += "_DIM";
						}

						if(count_dimmerabili > 0){
							dimmerabilita = ""+count_dimmerabili+" prodotti sono stati richiesti dimmerabili";
						}

						if(modello != "" && PL != "0" ){
							control++;
							SolPLEDArray[i] = new Array(modello,PL,control_dimmerabile);
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
						html += "<div><input type='number' min='0' value='0' id='risparmioManutenzione' style='text-align:center'></div>";
					html += "</div>";
					html += "<div class='flex-containerPLED'>";
						html += "<p>Smaltimento vecchi apparecchi illuminotecnici in Isola Ecologica (in euro)</p>";
						html += "<div><input type='number' min='0' value='0' id='costoSmaltimento' style='text-align:center'></div>";
					html += "</div>";
					html += "<div class='flex-containerPLED'>";
						html += "<p>Inserire il numero del preventivo</p>";
						html += "<div><input type='number' min='0' value='0' id='NPreventivo' style='text-align:center'></div>";
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
					alert("Non hai inserito il numero di preventivo!");
				}

			if (control == 4){

				var step4 = document.getElementById("step4");
				step4.parentNode.removeChild(step4);

				var step5 = document.createElement("div");
				step5.id="step5";

				var html = "";

				html += "<h2>Controlla i valori inseriti per il preventivo nr."+numero_preventivo+"</h2>";
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
					html += " - punti luce: "+SolPLEDArray[i][1];

					if (SolPLEDArray[i][2] == 1) html += " - richiesto dimmerabile (+30euro)]";
					else html += "]";

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
				html += "<p>Hai inserito "+costo_smaltimento+" euro come costo di smaltimento</p>";
				html += "<hr>";

				html += "<h3>Se i dati inseriti risultano corretti clicca su Calcola per calcolare il preventivo</h3>";
				html += "<p>altrimenti clicca su Nuovo Preventivo per reinserire i dati</p>";



				html += "<div class='flex-containerPLED'>";
				html += "<hr>";
				html += "<div id='bottoni_stato_attuale_inc_dec' class='flex-containerPLED'>";
				html += "<div><button class='buttonAddItem' onclick='toCheckCalcolo()'>Calcola</button></div>";
				html += "<div><button class='buttonRemoveItem' onclick='window.location.reload()'>Nuovo Preventivo</button></div>";
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
						html += "<div><span>Prezzo unitario del modello "+SolPLEDArray[i][0];
						if (SolPLEDArray[i][2] == 1) html += " (richiesto DIMMERABILE):</span></div>"
						else html += ":</span></div>";
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

				html += "<hr>";

				html += "<p>Valori calcoli per noleggio (Tabella GRENKE)</p>";
				html += "<div><p>24 mesi: </p><input value='"+noleggio1+"' id='nol1'></div>";
				html += "<div><p>30 mesi: </p><input value='"+noleggio2+"' id='nol2'></div>";
				html += "<div><p>36 mesi: </p><input value='"+noleggio3+"' id='nol3'></div>";
				html += "<div><p>48 mesi: </p><input value='"+noleggio4+"' id='nol4'></div>";
				html += "<div><p>60 mesi: </p><input value='"+noleggio5+"' id='nol5'></div>";
				html += "<hr>";


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

					//valori GRENKE
					var nol1 = document.getElementById("nol1");
					var nol2 = document.getElementById("nol2");
					var nol3 = document.getElementById("nol3");
					var nol4 = document.getElementById("nol4");
					var nol5 = document.getElementById("nol5");

					Grenke();

					nol1.value = noleggio1;
					nol2.value = noleggio2;
					nol3.value = noleggio3;
					nol4.value = noleggio4;
					nol5.value = noleggio5;
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
					var modelloLED_dim = "";
					if (modelloLED.includes("_DIM")) modelloLED_dim = modelloLED.substring(0,modelloLED.length-4);
					for (var j = 0; j < array_modello.length; j++){
						if (modelloLED == array_modello[j] || modelloLED_dim == array_modello[j]){
							selezionati_consumo[i] = parseFloat(array_consumo[j]);
							selezionati_prezzo[i] = parseFloat(array_prezzo[j]);
							selezionati_foto[i] = array_id_foto_modello[j];
							selezionati_note[i] = array_note[j];
							selezionati_durata[i] = array_durata[j];
							selezionati_kelvin[i] = array_kelvin[j];
							selezionati_garanzia[i] = array_garanzia[j];
							selezionati_nome_lungo[i] = array_nome_lungo[j];
							selezionati_lumen[i] = array_lumen[j];
							selezionati_marca[i] = array_marca[j];
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
				//CALCOLI PER GRENKE
				//----------------------------------------------------------------------
				noleggio1 = -1000;
				noleggio2 = -1001;
				noleggio3 = -1002;
				noleggio4 = -1003;
				noleggio5 = -1004;

				Grenke();
			}

			function Grenke(){
				var coeff_attrezzature = attrezzature ? 1.15 : 1.1 ;
				var acquisto_totale_maggiorato = acquisto_totale * coeff_attrezzature;

				var array_coeff_grenke = [-1,-2,-3,-4,-5];

				if(acquisto_totale_maggiorato > 500 && acquisto_totale_maggiorato < 2500) array_coeff_grenke = [4.740,3.829,3.415,2.850,2.323];
				else if(acquisto_totale_maggiorato > 2501 && acquisto_totale_maggiorato < 5000) array_coeff_grenke = [4.639,3.7,3.228,2.461,1.915];
				else if(acquisto_totale_maggiorato > 5001 && acquisto_totale_maggiorato < 12000) array_coeff_grenke = [4.597,3.609,3.175,2.419,1.909];
				else if(acquisto_totale_maggiorato > 12001 && acquisto_totale_maggiorato < 25000) array_coeff_grenke = [4.501,3.576,3.08,2.398,1.899];
				else if(acquisto_totale_maggiorato > 25001 && acquisto_totale_maggiorato < 50000) array_coeff_grenke = [4.467,3.554,3.041,2.325,1.894];
				else if(acquisto_totale_maggiorato > 50001 && acquisto_totale_maggiorato < 100000) array_coeff_grenke = [4.415,3.383,3.031,2.291,1.792];

				noleggio1 = Math.floor((array_coeff_grenke[0] * acquisto_totale_maggiorato)/100) + 5;
				noleggio2 = Math.floor((array_coeff_grenke[1] * acquisto_totale_maggiorato)/100) + 5;
				noleggio3 = Math.floor((array_coeff_grenke[2] * acquisto_totale_maggiorato)/100) + 5;
				noleggio4 = Math.floor((array_coeff_grenke[3] * acquisto_totale_maggiorato)/100) + 5;
				noleggio5 = Math.floor((array_coeff_grenke[4] * acquisto_totale_maggiorato)/100) + 5;
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

				//valori GRENKE
				var nol1 = document.getElementById("nol1").value;
				var nol2 = document.getElementById("nol2").value;
				var nol3 = document.getElementById("nol3").value;
				var nol4 = document.getElementById("nol4").value;
				var nol5 = document.getElementById("nol5").value;


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

				if (!isNaN(nol1)){
					control++;
					noleggio1 = nol1;
				}else{
					alert("Il valore inserito nel campo noleggio 24 mesi GRENKE non è un numero!")
				}

				if (!isNaN(nol2)){
					control++;
					noleggio2 = nol2;
				}else{
					alert("Il valore inserito nel campo noleggio 30 mesi GRENKE non è un numero!")
				}

				if (!isNaN(nol3)){
					control++;
					noleggio3 = nol3;
				}else{
					alert("Il valore inserito nel campo noleggio 36 mesi GRENKE non è un numero!")
				}

				if (!isNaN(nol4)){
					control++;
					noleggio4 = nol4;
				}else{
					alert("Il valore inserito nel campo noleggio 48 mesi GRENKE non è un numero!")
				}

				if (!isNaN(nol5)){
					control++;
					noleggio5 = nol5;
				}else{
					alert("Il valore inserito nel campo noleggio 60 mesi GRENKE non è un numero!")
				}

				if (control == (N_analogic_bulb+9)){


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
							html +="<div><button class='buttonRemoveItem' onclick='window.location.reload()'>Nuovo Preventivo</button></div>";
						html +="</div>";
					html +="</center>";

					step7.innerHTML += html;

					document.getElementById("container").appendChild(step7);
				}else{
					alert("Qualcuno dei valori inseriti non è un numero!");
				}
			}


			function  create_noleggio_listino(){
				var pdf_as_url;
				var doc = new jsPDF();
				doc.page = 1;
				var totalPagesExp = "{total_pages_count_string}";

				var data = getDataAcquisto();
				//elimino ultime due stringhe
				data.pop();
				data.pop();
				var colonne = getColumns();
				//elimino ultime due colonne
				colonne.pop();
				colonne.pop();

				var pageContent = function (data) {
					// HEADER
					doc.setFontSize(9);
					doc.setTextColor(40);
					doc.setFontStyle('normal');
			 // Purple

					if (imgLogo) {
							doc.addImage(imgLogo, 'JPEG', doc.internal.pageSize.width/2-50, 5, 100, 15);
					}
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

				var today  = new Date();
				var images = [];


				doc.setFontType('bold');
				doc.setFontSize(9);
				doc.text("PROFESSIONAL LED SRL\n", 10, 30);
				doc.setFontType('normal');
				doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", 10, 34);
				doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);


				doc.setFontSize(10);
				doc.setFontType('bold');
				doc.text(14,60,"Soluzione NOLEGGIO");

				doc.setFontType('normal');
				doc.text(85,60,"Data: "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());

				//doc.setFillColor(160, 197, 25);
				//doc.setDrawColor(0);
				//doc.rect(174,55,28,8,'F');
				doc.text(175,60,""+Math.floor(numero_preventivo)+"-"+today.getFullYear()+"/"+utente);

				doc.autoTable(colonne, data, {
					theme: 'grid',
					columnStyles: {	cod:{columnWidth: 30},
													descrizione:{columnWidth: 90},
													foto:{columnWidth: 50},
													quantity:{columnWidth: 20},},

					drawCell: function (cell, data) {
						if (data.column.dataKey === "foto") {
							var indice_foto = indici_foto_filtrati[data.row.index];
							var img = array_foto[indice_foto];
							images.push({
								indice: indice_foto,
								elem: img,
								w: cell.width,
								h: cell.height,
								x: cell.textPos.x,
								y: cell.textPos.y
							});
						}
					},

					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 7},
					headerStyles: {fillColor: [0, 77, 126]},
					addPageContent: pageContent
				});


				//adding photos
				for (var i = 0; i < images.length; i++) {
					if (images[i].elem != "no foto"){
						doc.addImage(images[i].elem, 'jpg', images[i].x, images[i].y,images[i].w-5,images[i].h-5);
					}
				}
				//contenuti dopo la tabella
				var finalY = doc.autoTable.previous.finalY;

				doc.setFontSize(9);
				doc.setTextColor(0, 77, 126);
				doc.text(14,finalY+17,"Tutti i prodotti sono conformi alla Normativa Europea\nEN 6241:2008 contro il Rischio Fotobiologico da illuminazione LED.");
				doc.addImage(simboli,14,finalY+23,80,20);

				noleggio1 = parseFloat(noleggio1);
				noleggio2 = parseFloat(noleggio2);
				noleggio3 = parseFloat(noleggio3);
				noleggio4 = parseFloat(noleggio4);
				noleggio5 = parseFloat(noleggio5);

				//alert("debug: "+noleggio1+" "+noleggio2+" "+noleggio3+" "+noleggio4+" "+noleggio5);

				noleggio1 = "€ "+Number((noleggio1).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				noleggio2 = "€ "+Number((noleggio2).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				noleggio3 = "€ "+Number((noleggio3).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				noleggio4 = "€ "+Number((noleggio4).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				noleggio5 = "€ "+Number((noleggio5).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});

				//parte statica dopo tabella
				doc.addPage();

				doc.setFillColor(0, 77, 126);
				doc.rect(10,37,doc.internal.pageSize.width-20,200,'F');
				doc.setFillColor(160, 197, 25);
				doc.rect(12,39,doc.internal.pageSize.width-24,196,'FD');
				doc.setFillColor(255);
				doc.rect(14,41,doc.internal.pageSize.width-28,192,'FD');

				doc.setFontSize(14);
				doc.setTextColor(0, 77, 126);
				doc.text("NOLEGGIO OPERATIVO LED",65,50);

				doc.setDrawColor(201,201,201);
				doc.rect(20,57,doc.internal.pageSize.width-40,50);

				doc.setFontStyle("bold");
				doc.setTextColor(0);

				doc.text("Durata noleggio mesi 24",24,64);
				doc.text("Durata noleggio mesi 30",24,74);
				doc.text("Durata noleggio mesi 36",24,84);
				doc.text("Durata noleggio mesi 48",24,94);
				doc.text("Durata noleggio mesi 60",24,104);

				doc.line(108,57,108,107);
				doc.setFontStyle("normal");
				doc.text(""+noleggio1+"  + iva",120,64);
				doc.text(""+noleggio2+"  + iva",120,74);
				doc.text(""+noleggio3+"  + iva",120,84);
				doc.text(""+noleggio4+"  + iva",120,94);
				doc.text(""+noleggio5+"  + iva",120,104);
				doc.line(20,67,190,67);
				doc.line(20,77,190,77);
				doc.line(20,87,190,87);
				doc.line(20,97,190,97);

				doc.setFontStyle("bold");
				doc.text("Il canone di noleggio comprende",24,120);
				doc.setFontStyle("normal");
				doc.text(" - Anticipo zero\n - Installazione corpi illuminanti LED\n - Garanzia per l'intero periodo del noleggio\n - Manutenzione straordinaria per il periodo del noleggio\n - Manutenzione ordinaria per il periodo del noleggio.\n - Assicurazione All-Risk sul materiale installato \n     (furto, incendio, atti vandalici, fenomeno elettrico)\n     con manleva su vs polizza. \n     In alternativa assicurazione Grenke a carico cliente.\n - Riscatto finale 3%",24,130);
				doc.text(""+dimmerabilita,24,200);

				doc.setFontStyle("bold");
				doc.setFontSize(14);
				doc.text("CANONE MENSILE DI NOLEGGIO OPERATIVO LED. DURATA MESI",24,220);
				doc.setFontStyle("normal");
				doc.text("IVA 22%",24,227);
				doc.text("Rate e condizioni indicative, soggette ad approvazione dell'Istituto di Credito.\nIl presente prospetto, come da normativa vigente a tutela del Consumatore e \nTesto Unico Bancario, non rappresenta alcun tipo di sollecitazione al finanziamento.",15,245);

				var pagina = data.pageCount;

				//doc.text("Page "+pagina+ " of " +totalPagesExp,10, doc.internal.pageSize.height - 10);

				doc.addPage();

				doc.setFillColor(0, 77, 126);
				doc.rect(10,37,doc.internal.pageSize.width-20,100,'F');
				doc.setFillColor(160, 197, 25);
				doc.rect(12,39,doc.internal.pageSize.width-24,96,'FD');
				doc.setFillColor(255);
				doc.rect(14,41,doc.internal.pageSize.width-28,92,'FD');

				doc.setFontStyle("bold");
				doc.text("CONDIZIONI DI GARANZIA E CERTIFICAZIONI:",17,50);
				doc.text("             su tutti i prodotti (vedi singole voci del preventivo)",17,62)
				doc.setTextColor(0, 77, 126);
				doc.text("5 ANNI ",17,62);
				doc.setTextColor(0);
				doc.setFontStyle("normal");
				doc.text("La garanzia prevede la sostituzione dell'eventuale componente led difettoso \ncon uno equivalente.",17,70)
				doc.text("Tutti i nostri prodotti si avvalgono delle certificazioni di legge:\n - Certificazione EN 6241:2008 Rischio Fotobiologico\n - Certificazione Rohs\n - Certicazione CE ",17,90);

				doc.setFontStyle("bold");
				doc.text("Consegna:",17,120);
				doc.setFontStyle("normal");
				doc.text("da concordare",45,120);
				doc.text("Validità offerta 15 gg.",17,130);
				doc.text("Salvo errori e/o commissioni",17,143);

				doc.setFontStyle("bold");
				doc.text("Elenco documentazione da inviare unitamente \nall'accettazione del preventivo per istruire la pratica di noleggio:",17,155)
				doc.setFontStyle("normal");
				doc.text("- Ragione Sociale\n- Partita Iva\n- Telefono fisso\n- Fax\n- Data di costituzione dell’azienda\n- IBAN aziendale ed intestazione conto corrente\n- Fronte/Retro Carta d’identità del legale rappresentante\n- Fronte/Retro Tessera sanitaria o Tessera codice fiscale del legale rappresentante\n- Bilancio provvisorio.\n- Dichiarazione dei redditi anno precedente.",17,170);


				//doc.text("Page "+pagina+ " of " +totalPagesExp,10, doc.internal.pageSize.height - 10);

				doc.addPage();

				doc.setFontStyle("bold");
				doc.text("SCHEDA ANAGRAFICA NUOVO CLIENTE: ",12,50)
				doc.line(20, 65, doc.internal.pageSize.width-20, 65);
				doc.text("Ragione sociale",25,64);
				doc.line(20, 80, doc.internal.pageSize.width-20, 80);
				doc.text("Indirizzo Sede Legale",25,79);

				doc.line(20, 90, doc.internal.pageSize.width-20, 90);
				doc.line(20, 110, doc.internal.pageSize.width-20, 110);
				doc.text("Indirizzo di consegna (se diverso dalla Sede Legale)",25,109);
				doc.line(20, 120, doc.internal.pageSize.width-20, 120);
				doc.line(20, 135, doc.internal.pageSize.width-20, 135);
				doc.text("P.Iva",25,134);
				doc.line(20, 150, doc.internal.pageSize.width-20, 150);
				doc.text("Cod. Fisc.",25,149);
				doc.line(20, 165, doc.internal.pageSize.width-20, 165);
				doc.text("Tel.                                                              mail",25,164);
				doc.line(20, 180, doc.internal.pageSize.width-20, 180);
				doc.text("mail Ufficio Amministrativo",25,179);
				doc.line(20, 195, doc.internal.pageSize.width-20, 195);
				doc.text("mail PEC",25,194);

				doc.setFontStyle("normal");
				doc.text("Data",25,255);
				doc.line(20,260,80,260);
				doc.text("Timbro e firma",100,255);
				doc.line(200,260,80,260);


				//doc.text("Page "+(totalPagesExp)+ " of " +totalPagesExp,10, doc.internal.pageSize.height - 10);

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

			function create_acquisto_listino(){
				var pdf_as_url;
				var doc = new jsPDF();
				var totalPagesExp = "{total_pages_count_string}";
				var data = getDataAcquisto();

				var pageContent = function (data) {
					// HEADER
					doc.setFontSize(9);
					doc.setTextColor(40);
					doc.setFontStyle('normal');

					if (imgLogo) {
							doc.addImage(imgLogo, 'JPEG', doc.internal.pageSize.width/2-50, 5, 100, 15);
					}
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

				var today  = new Date();
				var images = [];


				doc.setFontType('bold');
				doc.setFontSize(9);
				doc.text("PROFESSIONAL LED SRL\n", 10, 30);
				doc.setFontType('normal');
				doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", 10, 34);
				doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);


				doc.setFontSize(10);
				doc.setFontType('bold');
				doc.text(14,60,"Soluzione ACQUISTO");

				doc.setFontType('normal');
				doc.text(85,60,"Data: "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());

				//doc.setFillColor(160, 197, 25);
				//doc.setDrawColor(0);
				//doc.rect(174,55,28,8,'F');
				doc.text(175,60,""+Math.floor(numero_preventivo)+"-"+today.getFullYear()+"/"+utente);

				doc.autoTable(getColumns(), data, {
					theme: 'grid',
					columnStyles: {	cod:{columnWidth: 20},
													descrizione:{columnWidth: 70},
													foto:{columnWidth: 50},
													quantity:{columnWidth: 10},
													price:{columnWidth: 20},
													total:{columnWidth: 25}},

					drawCell: function (cell, data) {
						if (data.column.dataKey === "foto") {
							var indice_foto = indici_foto_filtrati[data.row.index];
							var img = array_foto[indice_foto];
							images.push({
								indice: indice_foto,
								elem: img,
								w: cell.width,
								h: cell.height,
								x: cell.textPos.x,
								y: cell.textPos.y
							});
						}
					},

					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 7},
					headerStyles: {fillColor: [0, 77, 126]},
					addPageContent: pageContent
				});

				//sincronizzazione array
				images.pop();
				images.pop();

				//adding photos
				for (var i = 0; i < images.length; i++) {
					if (images[i].elem != "no foto"){
						doc.addImage(images[i].elem, 'jpg', images[i].x, images[i].y,images[i].w-5,images[i].h-5);
					}
				}
				//contenuti dopo la tabella
				var finalY = doc.autoTable.previous.finalY;
				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(7, finalY, 195, 10, 'FD');
				doc.rect(177, finalY, 25, 10, 'FD');
				doc.setTextColor(0, 77, 126);
				doc.text(179, finalY+6, "€ "+Number((acquisto_totale).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2}));
				doc.setFontType('bold');
				doc.setTextColor(160, 197, 25);
				doc.setFontSize(12);
				doc.text(77, finalY+7, "IMPORTO TOTALE");
				doc.setTextColor(201,201,201);
				doc.setFontSize(9);
				doc.text(170,finalY+15,"(esclusa I.V.A. di legge)");
				doc.setFontSize(9);
				doc.setTextColor(0, 77, 126);
				doc.text(14,finalY+17,"Tutti i prodotti sono conformi alla Normativa Europea\nEN 6241:2008 contro il Rischio Fotobiologico da illuminazione LED.");
				doc.addImage(simboli,14,finalY+23,80,20);

				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(10, finalY+43, doc.internal.pageSize.width-20, 11, 'FD');
				doc.rect(11, finalY+44, doc.internal.pageSize.width-22, 9, 'FD');

				doc.setTextColor(0);
				doc.setFontSize(12);
				doc.text(20,finalY+50,"Legge finanziaria 2018: ammortamento cespite 130% annuo");

				var anticipo = acquisto_totale*35/100;
				var posticipo = acquisto_totale*65/100;
				anticipo = "€ "+Number((anticipo).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				posticipo = "€ "+Number((posticipo).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});

				//parte statica dopo tabella
				doc.addPage();

				doc.setFillColor(0, 77, 126);
				doc.rect(8,53,doc.internal.pageSize.width-16,54,'FD');
				doc.setFillColor(160, 197, 25);
				doc.rect(10,55,doc.internal.pageSize.width-20,50,'FD');
				doc.setFillColor(255);
				doc.rect(12,57,doc.internal.pageSize.width-24,46,'FD');

				doc.setFontStyle("bold");
				doc.setFontSize(12);
				doc.text("CONDIZIONI DI PAGAMENTO: bonifico bancario a ricevimento fattura",17,65);
				doc.text("Banca d'appoggio: BCC Felsinea                           IBAN: IT34U0847237072040000040906",17,73);
				doc.setFontStyle("normal");
				doc.text(anticipo+" (+ I.V.A. di legge) quale acconto all'ordine  35%",52,88);
				doc.text(posticipo+" (+ I.V.A. di legge) a Consegna/Installazione  65%",52,95);
				doc.rect(45,83,125,15);

				doc.setFillColor(0, 77, 126);
				doc.rect(8,120,doc.internal.pageSize.width-16,70,'FD');
				doc.setFillColor(160, 197, 25);
				doc.rect(10,122,doc.internal.pageSize.width-20,66,'FD');
				doc.setFillColor(255);
				doc.rect(12,124,doc.internal.pageSize.width-24,62,'FD');

				doc.setFontStyle("bold");
				doc.text("CONDIZIONI DI GARANZIA E CERTIFICAZIONI:",17,132);
				doc.text("             su tutti i prodotti (vedi singole voci del preventivo)",17,137)
				doc.setTextColor(0, 77, 126);
				doc.text("5 ANNI ",17,137);
				doc.setTextColor(0);
				doc.setFontStyle("normal");
				doc.text("La garanzia prevede la sostituzione dell'eventuale componente led difettoso \ncon uno equivalente.",17,145)
				doc.text("Sono esclusi lo smontaggio ed il rimontaggio dello stesso.",17,155);
				doc.text("Tutti i nostri prodotti si avvalgono delle certificazioni di legge:\n - Certificazione EN 6241:2008 Rischio Fotobiologico\n - Certificazione Rohs\n - Certificazione CE ",17,165);



				doc.setFontStyle("bold");
				doc.text("Consegna:",17,207);
				doc.setFontStyle("normal");
				doc.text("da concordare",45,207);
				doc.text("Validità offerta 15 gg.",17,215);

				doc.setFontSize(12);
				doc.text("cell. 334/99.14.178\nmail: direzione@professional-led.it",10,37);

				//accettazione page
				doc.addPage();

				doc.setLineWidth(0.5)
				doc.line(20, 25, doc.internal.pageSize.width-50, 25);
				doc.setFontStyle("bold");
				doc.text("Il Cliente DATA E TIMBRO PER ACCETTAZIONE",25,30)
				doc.text("SCHEDA ANAGRAFICA ",12,50)
				doc.line(20, 65, doc.internal.pageSize.width-20, 65);
				doc.text("Ragione sociale",25,64);
				doc.line(20, 80, doc.internal.pageSize.width-20, 80);
				doc.text("Indirizzo Sede Legale",25,79);

				doc.line(20, 90, doc.internal.pageSize.width-20, 90);
				doc.line(20, 110, doc.internal.pageSize.width-20, 110);
				doc.text("Indirizzo di consegna (se diverso dalla Sede Legale)",25,109);
				doc.line(20, 120, doc.internal.pageSize.width-20, 120);
				doc.line(20, 135, doc.internal.pageSize.width-20, 135);
				doc.text("P.Iva",25,134);
				doc.line(20, 150, doc.internal.pageSize.width-20, 150);
				doc.text("Cod. Fisc.",25,149);
				doc.line(20, 165, doc.internal.pageSize.width-20, 165);
				doc.text("Tel.                                                              mail",25,164);
				doc.line(20, 180, doc.internal.pageSize.width-20, 180);
				doc.text("mail Ufficio Amministrativo",25,179);
				doc.line(20, 195, doc.internal.pageSize.width-20, 195);
				doc.text("mail PEC",25,194);

				doc.setFontStyle("normal");
				doc.text("Data",25,255);
				doc.line(20,260,80,260);
				doc.text("Timbro e firma",100,255);
				doc.line(200,260,80,260);



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

			var getColumns = function () {
					return [
							{title: "Codice", dataKey: "cod"},
							{title: "Descrizione", dataKey: "descrizione"},
							{title: "",dataKey: "foto"},
							{title: "Q.tà", dataKey: "quantity"},
							{title: "Prezzo unit.", dataKey: "price"},
							{title: "Importo totale", dataKey: "total"}
					];
			};

			function getDataNoleggio(){
				var data = [];

				var filtrato = new Array();
				var modelli = new Array();


				for (var i = 0; i < N_analogic_bulb; i++) {
						var modello = SolPLEDArray[i][0];
						var descrizione = ""+selezionati_nome_lungo[i]+"\n";
								descrizione += selezionati_marca[i]+"\n";
								descrizione += selezionati_lumen[i]+"\n";
								descrizione += "Durata "+ selezionati_durata[i]+"ore\n";
								descrizione += selezionati_kelvin[i]+"\n";
								if (selezionati_note[i] != null) {
									descrizione += selezionati_note[i]+"\n";
									descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI";
								}else{
									descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI\n";
								}
						var quantita = parseFloat(SolPLEDArray[i][1]);


						data.push({
								cod: modello,
								descrizione: descrizione,
								foto: "",
								quantity: quantita
						});
				}

				filtrato[0] = data[0];
				modelli.push(data[0].cod);
				indici_foto_filtrati[0] = selezionati_foto[0];


				for (var i = 1; i < data.length; i++){
					if (modelli.includes(data[i].cod)){
						var indice = modelli.indexOf(data[i].cod);
						filtrato[indice].quantity += data[i].quantity;
						filtrato[indice].total += data[i].quantity * filtrato[indice].price;
					}else{
						modelli.push(data[i].cod);
						indici_foto_filtrati.push(selezionati_foto[i]);
						filtrato.push({
							cod: data[i].cod,
							descrizione: data[i].descrizione,
							foto: "",
							quantity: data[i].quantity
						});
					}
				}

				//formattazione in require_once
				//prezzo_unitario = "€ "+Number((prezzo_unitario).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				//importo = "€ "+Number((importo).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
				for (var j = 0; j < filtrato.length; j++){
					filtrato[j].quantity = ""+filtrato[j].quantity;
				}

				//aggiungo smaltimento
				costo_smaltimento = parseFloat(costo_smaltimento);
				filtrato.push({
						cod: "",
						descrizione: "Smaltimento vecchi apparecchi illuminotecnici in Isola Ecologica",
						foto: "",
						quantity: ""
				});

				//aggiungo dimmerabilità
				dimmerabilita += "\nContributi RAEE compresi."

				//aggiungo info installazione
				filtrato.push({
						cod: "",
						descrizione: "Installazione a forfait su impianto elettrico esistente.\nImporto da confermare dopo sopralluogo da parte dei nostri tecnici.\nSono escluse eventuali difformità o difetti rilevati nell'impianto.\nNoleggio di piattaforma mobile (se necessaria) da quotare a parte.\n\n"+dimmerabilita,
						foto: "",
						quantity: ""
				});



				return filtrato;

			}


			function getDatiRisparmio(){
				var data = [];
				var spesa_annua_attuale;
				var spesa_annua_led;
				var totale_attuale = 0;
				var totale_led = 0;
				var risparmio = 0;
				for (var i = 0; i < N_analogic_bulb; i++){
					spesa_annua_attuale = StatoAttualeArray[i][1] * StatoAttualeArray[i][3] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					spesa_annua_led = selezionati_consumo[i] * SolPLEDArray[i][1] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					totale_attuale += spesa_annua_attuale;
					totale_led += spesa_annua_led;
					risparmio += spesa_annua_attuale - spesa_annua_led;
					data.push({
						sostLED: SolPLEDArray[i][0],
						consumo: selezionati_consumo[i],
						ore: selezionati_durata[i] + " h",
						PL: SolPLEDArray[i][1],
						spesa_att: "€ " + Number(spesa_annua_attuale.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
						spesa_led: "€ " + Number(spesa_annua_led.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
						risparmio: "-€ " + Number((spesa_annua_attuale - spesa_annua_led).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
						perc: Math.round(spesa_annua_led / spesa_annua_attuale * 100 - 100) + " %"
					});
				}

				risparmio += risparmio_manutenzione;

				data.push({
					sostLED: "Risparmio \nmanutenzione \nannua",
					risparmio: "-€ " + Number((risparmio_manutenzione).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2})
				});

				data.push({
					sostLED: "TOTALI",
					spesa_att: "€ " + Number(totale_attuale.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
					spesa_led: "€ " + Number(totale_led.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
					risparmio: "€ " + Number((risparmio).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2})
				})

				return data;
			}

			function create_acquisto_conti() {
				var doc = new jsPDF("l");
				var totalPagesExp = "{total_pages_count_string}";
				var columns1 = [
					"Illuminazione attuale",
					"Consumo reale in Watt",
					"Ore \ndurata media",
					"Punti luce",
					"Giorni di funz.",
					"Ore di funz."
				];
				/*var columns2 = [
					"Sostituzione LED",
					"Consumo in Watt",
					"Ore durata \nmedia",
					"Punti luce",
					"Spesa annua \nattuale",
					"Spesa annua \ncon LED",
					"Risparmio annuo \ncon LED",
					"%"
				];*/

				var getColumns = function () {
					return [
							{title: "Sostituzione \nLED", dataKey: "sostLED"},
							{title: "Consumo \nin Watt", dataKey: "consumo"},
							{title: "Ore durata \nmedia", dataKey: "ore"},
							{title: "Punti luce", dataKey: "PL"},
							{title: "Spesa \nannua \nattuale", dataKey: "spesa_att"},
							{title: "Spesa \nannua \ncon LED", dataKey: "spesa_led"},
							{title: "Risparmio \nannuo \ncon LED", dataKey: "risparmio"},
							{title: "%", dataKey: "perc"}
					];
				};
				var rows1 = new Array();
				//var rows2 = new Array();
				var data = getDatiRisparmio();
				var finalY;
				var finalX;
				var risparmio = 0;

				for (var i = 0; i < N_analogic_bulb; i++){
					var spesa_annua_attuale = StatoAttualeArray[i][1] * StatoAttualeArray[i][3] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					var spesa_annua_led = selezionati_consumo[i] * SolPLEDArray[i][1] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					risparmio += spesa_annua_attuale - spesa_annua_led;
					rows1[i] = [
								StatoAttualeArray[i][0],
								StatoAttualeArray[i][1],
								StatoAttualeArray[i][2],
								StatoAttualeArray[i][3],
								StatoAttualeArray[i][4],
								StatoAttualeArray[i][5]
								];
					/*rows2[i] = [
								SolPLEDArray[i][0],
								selezionati_consumo[i],
								selezionati_durata[i] + " h",
								SolPLEDArray[i][1],
								"€ " + Number(spesa_annua_attuale.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								"€ " + Number(spesa_annua_led.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								"€ " + Number((spesa_annua_attuale - spesa_annua_led).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								Math.round(spesa_annua_led / spesa_annua_attuale * 100 - 100) + " %"
								];*/
				}


				/*rows2[i] = [
								"",
								"",
								"",
								"",
								"",
								"",
								"€ " + Number((risparmio_manutenzione).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								""
								];*/

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
					doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede Operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", data.settings.margin.left, 34);
					doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);
					// FOOTER
					var str = "Page " + data.pageCount;
					// Total page number plugin only available in jspdf v1.0+
					doc.setTextColor(201,201,201);
					if (typeof doc.putTotalPages === 'function') {
						str = str + " of " + totalPagesExp;
					}
					doc.setFontSize(10);
					doc.text(str, data.settings.margin.left, doc.internal.pageSize.height - 5);
				};

				var today  = new Date();

				doc.setFontSize(10);
				doc.setFontType('bold');
				doc.text(14,60,"Soluzione ACQUISTO");

				doc.setFontType('normal');
				doc.text(85,60,"Data: "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());

				doc.text(175,60,""+Math.floor(numero_preventivo)+"-"+today.getFullYear()+"/"+utente);


				var leftPos = 4;
				doc.autoTable(columns1, rows1, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, right: 190, left: leftPos},
					headerStyles: {fillColor: [0, 77, 126], fontSize: 8},
					addPageContent: pageContent
				});

				/*doc.autoTable(columns2, rows2, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 139, right: 4},
					headerStyles: {fillColor: [0, 77, 126]},
				});*/

				finalY = doc.autoTable.previous.finalY;
				finalX = doc.autoTable.previous.finalX;

				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(leftPos, finalY+5, 60, 10, 'FD');
				doc.rect(leftPos + 60, finalY+5, 10 + (costoKWH + "").length * 1.5, 10, 'FD');

				doc.setFontType('normal');
				doc.setTextColor(0, 0, 0);
				doc.setFontSize(10);
				doc.text(leftPos + 3, finalY+12, "Costo energia elettrica in Kw/h.");
				doc.setTextColor(0, 0, 0);
				doc.setFontSize(10);
				doc.text(leftPos + 63, finalY+12, costoKWH + "");
				doc.setFontSize(12);



				doc.autoTable(getColumns(), data, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//}
					drawRow: function(row, data){
						if (data.row.index === N_analogic_bulb) {
							doc.setFontStyle('bold');
							doc.setTextColor(200, 0, 0);
							doc.rect(data.settings.margin.left, row.y, data.table.width, 10, 'S');
							data.cursor.y += 10;
						}
					},
					createdCell: function (cell, data) {
						if (data.row.index >= N_analogic_bulb) {
							cell.styles.fontStyle = 'bold';

						}
					},
					drawCell: function (cell, data) {
            // Rowspan
            if (data.column.dataKey === 'risparmio') {
                if (data.row.index == N_analogic_bulb +1) {
									doc.setFontSize(12);
									doc.setTextColor(160, 197, 25);
									doc.setFontStyle("bold");
                }
            }
        },
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 109, right: 4},
					headerStyles: {fillColor: [0, 77, 126], fontSize: 8},
				});

				finalY = doc.autoTable.previous.finalY;
				finalX = doc.autoTable.previous.finalX;

				doc.setFontType('bold');
				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(10, doc.internal.pageSize.height - 22, doc.internal.pageSize.width-20, 11, 'FD');
				doc.rect(11, doc.internal.pageSize.height - 21, doc.internal.pageSize.width-22, 9, 'FD');

				doc.setTextColor(0);
				doc.setFontSize(12);
				doc.text(doc.internal.pageSize.width / 2 - 50,doc.internal.pageSize.height - 15,"Legge finanziaria 2018: ammortamento cespite 130% annuo")

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

			function getDataAcquisto() {
   				var data = [];

					var filtrato = new Array();
					var modelli = new Array();


			    for (var i = 0; i < N_analogic_bulb; i++) {
							var modello = SolPLEDArray[i][0];
							var descrizione = ""+selezionati_nome_lungo[i]+"\n";
									descrizione += selezionati_marca[i]+"\n";
									descrizione += selezionati_lumen[i]+"\n";
									descrizione += "Durata "+ selezionati_durata[i]+"ore\n";
									descrizione += selezionati_kelvin[i]+"\n";
									if (selezionati_note[i] != null) {
										descrizione += selezionati_note[i]+"\n";
										descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI";
									}else{
										descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI\n";
									}
							var quantita = parseFloat(SolPLEDArray[i][1]);
							var prezzo_unitario = parseFloat(selezionati_prezzo[i]);
							var importo = prezzo_unitario * quantita;


			        data.push({
			            cod: modello,
			            descrizione: descrizione,
									foto: "",
			            quantity: quantita,
			            price: prezzo_unitario,
			            total: importo
			        });
			    }

					filtrato[0] = data[0];
					modelli.push(data[0].cod);
					indici_foto_filtrati[0] = selezionati_foto[0];


					for (var i = 1; i < data.length; i++){
						if (modelli.includes(data[i].cod)){
							var indice = modelli.indexOf(data[i].cod);
							filtrato[indice].quantity += data[i].quantity;
							filtrato[indice].total += data[i].quantity * filtrato[indice].price;
						}else{
							modelli.push(data[i].cod);
							indici_foto_filtrati.push(selezionati_foto[i]);
							filtrato.push({
								cod: data[i].cod,
								descrizione: data[i].descrizione,
								foto: "",
								quantity: data[i].quantity,
								price: data[i].price,
								total: data[i].total
							});
						}
					}

					//formattazione in require_once
					//prezzo_unitario = "€ "+Number((prezzo_unitario).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					//importo = "€ "+Number((importo).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					for (var j = 0; j < filtrato.length; j++){
						filtrato[j].quantity = ""+filtrato[j].quantity;
						filtrato[j].price = "€ "+Number((filtrato[j].price).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
						filtrato[j].total = "€ "+Number((filtrato[j].total).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					}

					//aggiungo smaltimento
					costo_smaltimento = parseFloat(costo_smaltimento);
					filtrato.push({
							cod: "",
							descrizione: "Smaltimento vecchi apparecchi illuminotecnici in Isola Ecologica",
							foto: "",
							quantity: "",
							price: "",
							total: "€ "+Number(costo_smaltimento.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})
					});

					//aggiungo dimmerabilità
					dimmerabilita += "\nContributi RAEE compresi."

					//aggiungo info installazione
					filtrato.push({
							cod: "",
							descrizione: "Installazione a forfait su impianto elettrico esistente.\nImporto da confermare dopo sopralluogo da parte dei nostri tecnici.\nSono escluse eventuali difformità o difetti rilevati nell'impianto.\nNoleggio di piattaforma mobile (se necessaria) da quotare a parte.\n\n"+dimmerabilita,
							foto: "",
							quantity: "",
							price: "",
							total: "€ "+Number((0).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})
					});



			    return filtrato;
			}

			function create_noleggio_conti() {
				var doc = new jsPDF("l");
				var totalPagesExp = "{total_pages_count_string}";
				var columns1 = [
					"Illuminazione attuale",
					"Consumo reale in Watt",
					"Ore \ndurata media",
					"Punti luce",
					"Giorni di funz.",
					"Ore di funz."
				];
				/*var columns2 = [
					"Sostituzione LED",
					"Consumo in Watt",
					"Ore durata \nmedia",
					"Punti luce",
					"Spesa annua \nattuale",
					"Spesa annua \ncon LED",
					"Risparmio annuo \ncon LED",
					"%"
				];*/

				var getColumns = function () {
					return [
							{title: "Sostituzione \nLED", dataKey: "sostLED"},
							{title: "Consumo \nin Watt", dataKey: "consumo"},
							{title: "Ore durata \nmedia", dataKey: "ore"},
							{title: "Punti luce", dataKey: "PL"},
							{title: "Spesa \nannua \nattuale", dataKey: "spesa_att"},
							{title: "Spesa \nannua \ncon LED", dataKey: "spesa_led"},
							{title: "Risparmio \nannuo \ncon LED", dataKey: "risparmio"},
							{title: "%", dataKey: "perc"}
					];
				};
				var rows1 = new Array();
				//var rows2 = new Array();
				var data = getDatiRisparmio();
				var finalY;
				var finalX;
				var risparmio = 0;

				for (var i = 0; i < N_analogic_bulb; i++){
					var spesa_annua_attuale = StatoAttualeArray[i][1] * StatoAttualeArray[i][3] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					var spesa_annua_led = selezionati_consumo[i] * SolPLEDArray[i][1] * StatoAttualeArray[i][4] * StatoAttualeArray[i][5] * costoKWH / 1000;
					risparmio += spesa_annua_attuale - spesa_annua_led;
					rows1[i] = [
								StatoAttualeArray[i][0],
								StatoAttualeArray[i][1],
								StatoAttualeArray[i][2],
								StatoAttualeArray[i][3],
								StatoAttualeArray[i][4],
								StatoAttualeArray[i][5]
								];
					/*rows2[i] = [
								SolPLEDArray[i][0],
								selezionati_consumo[i],
								selezionati_durata[i] + " h",
								SolPLEDArray[i][1],
								"€ " + Number(spesa_annua_attuale.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								"€ " + Number(spesa_annua_led.toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								"€ " + Number((spesa_annua_attuale - spesa_annua_led).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								Math.round(spesa_annua_led / spesa_annua_attuale * 100 - 100) + " %"
								];*/
				}


				/*rows2[i] = [
								"",
								"",
								"",
								"",
								"",
								"",
								"€ " + Number((risparmio_manutenzione).toFixed(2)).toLocaleString("it-IT", {minimumFractionDigits: 2}),
								""
								];*/

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
					doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede Operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", data.settings.margin.left, 34);
					doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);
					// FOOTER
					var str = "Page " + data.pageCount;
					// Total page number plugin only available in jspdf v1.0+
					doc.setTextColor(201,201,201);
					if (typeof doc.putTotalPages === 'function') {
						str = str + " of " + totalPagesExp;
					}
					doc.setFontSize(10);
					doc.text(str, data.settings.margin.left, doc.internal.pageSize.height - 5);
				};

				var today  = new Date();

				doc.setFontSize(10);
				doc.setFontType('bold');
				doc.text(14,60,"Soluzione ACQUISTO");

				doc.setFontType('normal');
				doc.text(85,60,"Data: "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());

				doc.text(175,60,""+Math.floor(numero_preventivo)+"-"+today.getFullYear()+"/"+utente);


				var leftPos = 4;
				doc.autoTable(columns1, rows1, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, right: 190, left: leftPos},
					headerStyles: {fillColor: [0, 77, 126], fontSize: 8},
					addPageContent: pageContent
				});

				/*doc.autoTable(columns2, rows2, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 139, right: 4},
					headerStyles: {fillColor: [0, 77, 126]},
				});*/

				finalY = doc.autoTable.previous.finalY;
				finalX = doc.autoTable.previous.finalX;

				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(leftPos, finalY+5, 60, 10, 'FD');
				doc.rect(leftPos + 60, finalY+5, 10 + (costoKWH + "").length * 1.5, 10, 'FD');

				doc.setFontType('normal');
				doc.setTextColor(0, 0, 0);
				doc.setFontSize(10);
				doc.text(leftPos + 3, finalY+12, "Costo energia elettrica in Kw/h.");
				doc.setTextColor(0, 0, 0);
				doc.setFontSize(10);
				doc.text(leftPos + 63, finalY+12, costoKWH + "");
				doc.setFontSize(12);

				doc.setTextColor(0, 77, 126);
				doc.text(leftPos + 3, finalY+27, "RISPARMIO ANNUO");
				doc.text(leftPos + 3, finalY+32, "RISPARMIO MENSILE");

				doc.setTextColor(0, 0, 0);
				doc.text(leftPos + 3, finalY+37, "DEDUCIBILITA' CANONI:  100%	");


				doc.setTextColor(160, 197, 25);
				doc.text(leftPos + 80, finalY+27, "-€ "+Number((risparmio+risparmio_manutenzione).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2}));
				doc.text(leftPos + 80, finalY+32, "-€ "+Number(((risparmio+risparmio_manutenzione)/12).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2}));


				doc.autoTable(getColumns(), data, {
					//styles: {fillColor: [154, 216, 25]},
					//columnStyles: {
					//	id: {fillColor: [0, 0, 0]}
					//}
					drawRow: function(row, data){
						if (data.row.index === N_analogic_bulb) {
							doc.setFontStyle('bold');
							doc.setTextColor(200, 0, 0);
							doc.rect(data.settings.margin.left, row.y, data.table.width, 10, 'S');
							data.cursor.y += 10;
						}
					},
					createdCell: function (cell, data) {
						if (data.row.index >= N_analogic_bulb) {
							cell.styles.fontStyle = 'bold';

						}
					},
					drawCell: function (cell, data) {
						// Rowspan
						if (data.column.dataKey === 'risparmio') {
								if (data.row.index == N_analogic_bulb +1) {
									doc.setFontSize(12);
									doc.setTextColor(160, 197, 25);
									doc.setFontStyle("bold");
								}
						}
				},
					theme: 'grid',
					styles: {overflow: 'linebreak'},
					margin: {top: 70,bottom: 20, left: 109, right: 4},
					headerStyles: {fillColor: [0, 77, 126], fontSize: 8},
				});

				finalY = doc.autoTable.previous.finalY;
				finalX = doc.autoTable.previous.finalX;

				doc.setFontType('bold');
				doc.setDrawColor(201,201,201);
				doc.setFillColor(255, 255, 255);
				doc.rect(10, doc.internal.pageSize.height - 22, doc.internal.pageSize.width-20, 11, 'FD');
				doc.rect(11, doc.internal.pageSize.height - 21, doc.internal.pageSize.width-22, 9, 'FD');

				doc.setTextColor(0);
				doc.setFontSize(12);
				doc.text(doc.internal.pageSize.width / 2 - 50,doc.internal.pageSize.height - 15,"Legge finanziaria 2018: ammortamento cespite 130% annuo")

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

			function getDataAcquisto() {
					var data = [];

					var filtrato = new Array();
					var modelli = new Array();


					for (var i = 0; i < N_analogic_bulb; i++) {
							var modello = SolPLEDArray[i][0];
							var descrizione = ""+selezionati_nome_lungo[i]+"\n";
									descrizione += selezionati_marca[i]+"\n";
									descrizione += selezionati_lumen[i]+"\n";
									descrizione += "Durata "+ selezionati_durata[i]+"ore\n";
									descrizione += selezionati_kelvin[i]+"\n";
									if (selezionati_note[i] != null) {
										descrizione += selezionati_note[i]+"\n";
										descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI";
									}else{
										descrizione += "GARANZIA "+selezionati_garanzia[i]+" ANNI\n";
									}
							var quantita = parseFloat(SolPLEDArray[i][1]);
							var prezzo_unitario = parseFloat(selezionati_prezzo[i]);
							var importo = prezzo_unitario * quantita;


							data.push({
									cod: modello,
									descrizione: descrizione,
									foto: "",
									quantity: quantita,
									price: prezzo_unitario,
									total: importo
							});
					}

					filtrato[0] = data[0];
					modelli.push(data[0].cod);
					indici_foto_filtrati[0] = selezionati_foto[0];


					for (var i = 1; i < data.length; i++){
						if (modelli.includes(data[i].cod)){
							var indice = modelli.indexOf(data[i].cod);
							filtrato[indice].quantity += data[i].quantity;
							filtrato[indice].total += data[i].quantity * filtrato[indice].price;
						}else{
							modelli.push(data[i].cod);
							indici_foto_filtrati.push(selezionati_foto[i]);
							filtrato.push({
								cod: data[i].cod,
								descrizione: data[i].descrizione,
								foto: "",
								quantity: data[i].quantity,
								price: data[i].price,
								total: data[i].total
							});
						}
					}

					//formattazione in require_once
					//prezzo_unitario = "€ "+Number((prezzo_unitario).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					//importo = "€ "+Number((importo).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					for (var j = 0; j < filtrato.length; j++){
						filtrato[j].quantity = ""+filtrato[j].quantity;
						filtrato[j].price = "€ "+Number((filtrato[j].price).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
						filtrato[j].total = "€ "+Number((filtrato[j].total).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2});
					}

					//aggiungo smaltimento
					costo_smaltimento = parseFloat(costo_smaltimento);
					filtrato.push({
							cod: "",
							descrizione: "Smaltimento vecchi apparecchi illuminotecnici in Isola Ecologica",
							foto: "",
							quantity: "",
							price: "",
							total: "€ "+Number(costo_smaltimento.toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})
					});

					//aggiungo dimmerabilità
					dimmerabilita += "\nContributi RAEE compresi."

					//aggiungo info installazione
					filtrato.push({
							cod: "",
							descrizione: "Installazione a forfait su impianto elettrico esistente.\nImporto da confermare dopo sopralluogo da parte dei nostri tecnici.\nSono escluse eventuali difformità o difetti rilevati nell'impianto.\nNoleggio di piattaforma mobile (se necessaria) da quotare a parte.\n\n"+dimmerabilita,
							foto: "",
							quantity: "",
							price: "",
							total: "€ "+Number((0).toFixed(2)).toLocaleString("es-ES", {minimumFractionDigits: 2})
					});



					return filtrato;
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

				doc.setFontType('bold');
				doc.setFontSize(9);
				doc.text("PROFESSIONAL LED SRL\n", 10, 30);
				doc.setFontType('normal');
				doc.text("Sede Legale: Via Filippo Beroaldo, 38 - 40127 Bologna (BO)\nSede operativa: Via Palazzetti, 5/F - 40068 San Lazzaro di Savena (BO)\nReg. Impr. BO P.I. e C.F.  03666271204 – REA 537385 – C.S. € 10.000,00 (i.v.)\nTel +39 051-625.55.83\nmail: info@professional-led.it", 10, 34);
				doc.text("Spett.le\n"+nome_azienda+"\n"+indirizzo_azienda+"\n"+cap_azienda+"\n\n"+nome_referente+"\n"+mail_referente,doc.internal.pageSize.width/2+40, 30);

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

			<?php
				$utente = $_SESSION['username'];
				echo "<h2 style='color:green'>Benvenuto ".$utente."!</h1>";

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
					echo "var utente = '" . $_SESSION['username'] . "';";
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
							//echo "id: " . $row["id"]. " - idfoto: " . $row["id_foto"]. "<br>";
							$id[] = $row['id'];
							$modello[] = $row["modello"];
							$id_foto[] = $row["id_foto"];
							$prezzo[] = $row["prezzo"];
							$gruppo_modello[] = $row["group_modello"];
							$consumo[] = $row["consumo"];
							$durata[] = $row["durata"];
							$nome_lungo[] = $row["nome_lungo"];
							$marca[] = $row["marca"];
							$lumen[] = $row["lumen"];
							$note[] = $row["note"];
							$kelvin[] = $row["kelvin"];
							$garanzia[] = $row["garanzia"];
					}
					echo "<script>";
					echo "var array_id_leds = " . json_encode($id) . ";";
					echo "var array_modello = " . json_encode($modello) . ";";
					echo "var array_id_foto_modello = " . json_encode($id_foto) . ";";
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
