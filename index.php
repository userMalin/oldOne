
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


require_once("config.php");
?>

<html>
    <head>
        <title><?php echo SERVER_NAME; ?></title>
        <link rel="Shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="main.css" />	
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />		
    </head>
<body>

	<div id="header">

	</div>
	<div id="panel">
        <div class="menu">
            <a href="index.php">Strona</a>
			<a href="Pages/zaloguj.php">Logowanie</a>
			<a href="Pages/rejestracja.php">Rejestracja</a>
			<a href=<?php echo FORUM_ADRESS?>>Forum</a>
			<a href="Pages/tworcy.php">Twórcy</a>
        </div>		
	</div>
	<div id="middle">
        <div class="ourtext">
		<div style="background:url(/Strona/images/ramka.png);background-size:100% 100%;background-repeat:none; height:100%; overflow:auto;">
		</br></br>
		<center>
		<img src="images/gothic2.png"/></br>
		<p style="font-family:Impact;color: rgba(255,255,255,0.7); ">Witaj na stronie serwera Gothic RolePlay. </p>
	    <h5 style="font-family:Arial;color: rgba(255,255,255,0.7);font-weight:normal">Zapraszamy na serwer, który stale się rozwija i pragniemy abyś dołączył do naszej społeczności.</br>
		Gwarantujemy niezapomnianą rozgrywkę, której klimat pragniemy utrzymać na poziomie znanym z gry Gothic 2.</br>
		Aby zagrać na naszym serwer jedyne co musisz zrobić to zarejestrować się na tej samej stronie i wykonać kilka prostych kroków.</br>
		Aby lepiej zrozumieć proces rejestracji i tego co musisz zrobić zapraszamy tutaj > <a href="/forum">Forum</a></h5>
		</br></br></br>

		</div>
	</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
