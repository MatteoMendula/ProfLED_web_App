<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if($_SESSION['username'] != "manrico"){
  header("location: login.php");
  exit;
}else{
  $utente = $_SESSION['username'];
  if ($utente == "dwalin"){
    echo "<h2>Benvenuto Manrico </h2>";
    echo "<p>Solo tu hai accesso a questa area</p>";
  }
}
?>

<html>
<header>
	  <meta charset="UTF-8">
    <title>IES app</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 2rem;margin-left:1rem; }
    </style>
</header>

<body>
		<div class="wrapper">
			<h1> Programma di supporto per la gestione dei file IES </h2>
			<p>Questo programma elimina il produttore del prodotto e sostituisce il nuovo nome prodotto inserito dall'utente</p>
			<hr>
			<p id="text1">Select a IES file to Load:</p>
			<input id="inputFileToLoad" type="file" onchange="loadImageFileAsText();" />
			<p id="text2">File Contents as Text:</p>
			<textarea id="textAreaFileContents" style="width:640;height:240" >Qui compare il contenuto del file scelto</textarea>
			<hr>
			<p>Nome del prodotto PLED (sarà anche il nome del file IES)</p>
			<textarea id="nameProduct" style="width:250;height:30" >Inserire nome prodotto</textarea>
			<br><br><br>
			<button id="create">Crea nuovo file con sostituzioni</button>
			<br><br><br>
			<a id="downloadlink" style="display: none">Scarica il file IES con le sostituzioni</a>
		</div>

<script>
var fileUploaded;
function loadImageFileAsText()
{
    var filesSelected = document.getElementById("inputFileToLoad").files;
    if (filesSelected.length > 0)
    {
        var fileToLoad = filesSelected[0];

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent)
        {
            var textAreaFileContents = document.getElementById("textAreaFileContents");
			textAreaFileContents.innerHTML = fileLoadedEvent.target.result;
            fileUploaded = fileLoadedEvent.target.result;
        };

        fileReader.readAsText(fileToLoad);
    }
}

function deleteManufacture(){
	var result = "";
	if (!fileUploaded){
		alert("Errore nel caricamento del file");
	}
	else{
		var rows = fileUploaded.split("\n");
		var i ;
		for (i = 0 ; i < rows.length; i++)
			if (rows[i].startsWith("[MANUFAC]")){
				result = result + "[MANUFAC]" +"\r";
			}else if (rows[i].startsWith("[TESTLAB]")){
				result = result + "[TESTLAB]" +"\r";
			}else if (rows[i].startsWith("[OTHER]")){
				result = result + "[OTHER]" +"\r";
			}else{
				result = result + rows[i] + "\n";
			}
		}
	return result;
}


(function () {
	var textFile = null,
	makeTextFile = function (text) {

		text = deleteManufacture();

		var data = new Blob([text], {type: 'text/plain'});

		// If we are replacing a previously generated file we need to
		// manually revoke the object URL to avoid memory leaks.
		if (textFile !== null) {
		  window.URL.revokeObjectURL(textFile);
		}

		textFile = window.URL.createObjectURL(data);

		return textFile;
	};


  var create = document.getElementById('create');

  create.addEventListener('click', function () {
    var link = document.getElementById('downloadlink');
	var nameProduct = document.getElementById("nameProduct").value;
	link.setAttribute("download", nameProduct+".ies");
    link.href = makeTextFile(fileUploaded);
    link.style.display = 'block';
  }, false);
})();

</script>


</body>
</html>
