
<?php
/* --------------------------------------------------------------------------------------
                                      GOTHIC MMO
-------------------------------------------------------------------------------------- */

session_start();
	
if (!isset($_SESSION['zalogowany']))
{
	header('Location: ../index.php');
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
        <script src="../items.js"></script>		
    </head>
<body>

	<div id="header">
	</div>
	<div id="panel">
        <div class="menu">
			<a href="<?php echo FORUM_ADRESS?>">Forum</a>
			<a href="strona.php">Przegląd</a>
			<a href="ekwipunek.php">Ekwipunek</a>
			<a href="serwer.php">Serwer</a>
			<?php
			    if($_SESSION['admin'] == true)
				{
					echo "<a href='admin.php'>Admin</a>";
				}
			?>
			<a href="logout.php">Wyloguj</a>
        </div>		
	</div>
	<div id="middle">
        <div class="ourtext">
		<div style="background:url(/Strona/images/ramka.png);background-size:100% 100%;background-repeat:none; height:100%; overflow:auto;">
		</br>
        <?php
	    $conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$id_gracza = $_SESSION['id_gracza'];
		$nick = $_SESSION['nickname'];
		
        $sql = "SELECT * FROM player_statistics WHERE id_gracza=$id_gracza";
        $result = mysqli_query($conn, $sql);	
		
		/////////////////////////////////////////////////////////
        if (mysqli_num_rows($result) > 0) 
		{
            while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<div><img src='/Strona/images/twarz.jpg' style='float:right;border:3px solid black;margin-left:100px;margin-right:30px;'/><center><h2 style='font-family:Impact;color: rgba(255,255,255,0.7); font-weight:normal'>$nick</h2></center>";
				echo "<ul style='float:left;margin-left:20px;font-family:Arial;color: rgba(255,255,255,0.7);font-weight:normal'>";
				echo "<h4>Statystyki</h4>";
				echo "<li>Siła : ".$row['str']."</li>";
				echo "<li>Zręczność : ".$row['dex']."</li>";
				echo "<li>Życie : ".$row['hp']."/".$row['maxhp']."</li>";
				echo "<li>Poziom : ".$row['lvl']."</li>";
				echo "<li>Doświadczenie : ".$row['exp']."</li>";
				echo "<li>Punkty Nauki : ".$row['lp']."</li>";
				echo "</ul>";
				echo "<ul style='float:right;font-family:Arial;color: rgba(255,255,255,0.7); font-weight:normal'>";
				echo "<h4>Umiejętności Walki</h4>";
				echo "<li>Broń Jednoręczna : ".$row['oneh']."</li>";
				echo "<li>Broń Dwuręczna : ".$row['twoh']."</li>";
				echo "<li>Łuki : ".$row['bow']."</li>";
				echo "<li>Kusze : ".$row['cbow']."</li>";
				echo "</ul>";
				echo "</div>";
			}
        }else{
			echo "<h3 style='font-size:40;color:rgb(200,0,0)'> Nie można znaleźć konta. Skontaktuj się z administracją!</h3>";
		}
		mysqli_close($conn);
		//////////////////////////////////////////////////////// 		
        ?>	
        </div>		
		</br>
		</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
