<html>
	<head>
		<title>
			Hero Kids PHP Edition
		</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	</head>
	<style>
body {
		background-image: url("assets/fondo1.jpg");
		 background-repeat: no-repeat;
		 background-size: cover;
	}
</style>
	<body>
	<div id="menubar">
		<div id="menubar-title"><img src="./resources/logo.png"></img></div>
		<div id="menubar-menu">
			<ul>
				<li><a href="./index.php">Aventuras</a></li>
				<li><a href="./characters.php">Mis Personajes</a></li>
				<li><a href="./profile.php">Mi Perfil</a></li>
				<li><a href="#" id='myBtn2'>Reglas</a></li>
				<li><a href="#" id="myBtn">Pantalla DM</a></li>
			</ul>
		</div>
		<div id="menubar-logout"><a href="./login.php"><img src="resources/logout.png"></img></a></div>
	</div>
	<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close">&times;</span>
		<p><img src="resources/pantalladm.jpg" id="img_dm" class="img_logout"></img></p>
	  </div>

	</div>
	<div id="myModal2" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close">&times;</span>
		<embed src="test.pdf" type="application/pdf"   height="700px" width="500">
	  </div>

	</div>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(function () {
        var fileName = "test.pdf";
        $("#btnShow").click(function () {
            $("#dialog").dialog({
                modal: true,
                title: fileName,
                width: 540,
                height: 450,
                buttons: {
                    Close: function () {
                        $(this).dialog('close');
                    }
                },
                open: function () {
                    var object = "<object data=\"test.pdf\" type=\"application/pdf\" width=\"500px\" height=\"300px\">";
                    object += "If you are unable to view file, you can download from <a href = \"test.pdf\">here</a>";
                    object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                    object += "</object>";
                    //object = object.replace(/{FileName}/g, "Files/" + fileName);
                    $("#dialog").html(object);
                }
            });
        });
    });
</script>
<input id="btnShow" type="button" value="Show PDF" />
<div id="dialog" style="display: none">
</div>
