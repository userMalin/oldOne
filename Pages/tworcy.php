
<?php
/* --------------------------------------------------------------------------------------
                                      GOTHIC ROLEPLAY
-------------------------------------------------------------------------------------- */

session_start();
	
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: Pages/strona.php');
	exit();
}

require_once("../config.php");
?>

<html>
    <head>
        <title><?php echo SERVER_NAME; ?></title>
        <link rel="Shortcut icon" href="../favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../main.css" />	
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />		
    </head>
<body>

	<div id="header">

	</div>
	<div id="panel">
        <div class="menu">
            <a href="../index.php">Strona</a>
			<a href="zaloguj.php">Logowanie</a>
			<a href="rejestracja.php">Rejestracja</a>
			<a href="<?php echo FORUM_ADRESS?>">Forum</a>
			<a href="tworcy.php">Twórcy</a>
        </div>		
	</div>
	<div id="middle">
        <div class="ourtext">
		<div style="background:url(/Strona/images/ramka.png);background-size:100% 100%;background-repeat:none; height:100%; overflow:auto;">
		</br></br>
		<h4 style="padding:100px;font-family:Arial; font-weight:normal; color:rgb(255,255,255);">
		Serwer jest tworzony przez team <?php echo SERVER_NAME ?> </br>
		Skrypt stworzony przez <a href="http://gothic-online.com.pl/forum/member.php?action=profile&uid=15">@Quarchodron</a></br>
		Podziękowania dla : </br>
		Orku/Arashel</br>
		Tommy</br>
		Patrix</br>
		</h4>
		</div>
	</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
