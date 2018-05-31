
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
		
	<style>
	table
	{
        color:rgb(44,44,44);
    }
	td
	{
		background-color:rgba(220,220,220,0.9);
		font-size:13;
		width:200px;
	    border:2px solid black;	
		text-align:center;
	}
	</style>
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
			    if($_SESSION['admin'])
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
        <?php
	    $conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$id_gracza = $_SESSION['id_gracza'];
		
        $sql = "SELECT * FROM player_eq WHERE id_gracza=$id_gracza and instance='ITMI_GOLD'";
        $result = mysqli_query($conn, $sql);	
		
		/////////////////////////////////////////////////////////
        if (mysqli_num_rows($result) > 0) 
		{
            while($row = mysqli_fetch_assoc($result)) 
			{
            echo "<h4 style='padding-left:50px;font-family:Impact;color: rgba(255,255,255,0.7); font-weight:normal'>Złoto : ".$row['amount']."</h4>";
			}
        }else{
            echo "<h4 style='padding-left:50px;font-family:Impact;color: rgba(255,255,255,0.7); font-weight:normal'>Brak złota</h4>";
		}
		//////////////////////////////////////////////////////// 		
		
        $sql = "SELECT * FROM player_eq WHERE id_gracza=$id_gracza";
        $result = mysqli_query($conn, $sql);	
		
		/////////////////////////////////////////////////////////
        if (mysqli_num_rows($result) > 0) {
	    echo "<center><h2 style='font-family:Impact;color: rgba(255,255,255,0.7); font-weight:normal'> Przedmioty</h2>";
		echo "<table>";
		echo "<tr><td style='font-size:18;color:rgb(200,0,0);font-family:Impact;'>Kod Przedmiotu</td><td style='font-size:18;color:rgb(200,0,0);font-family:Impact;'>Ilość</td><td style='font-size:18;color:rgb(200,0,0);font-family:Impact;'>Operacje</td></tr>";
		
               // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
				if($row['instance'] != "ITMI_GOLD")
				{
                echo "<tr><td>".$row['instance']."</td><td>".$row['amount']."</td><td><a href='aukcja.php'>Aukcja</a>, <a href='http://pl.gothic.wikia.com/wiki/Specjalna:Szukaj?query=".$row['instance']."'>Szczegóły</a></td></tr>";
                }
			}
		echo "</table></center>";
        }else{
			echo "<h2>Brak przedmiotów</h2>";
		}
        mysqli_close($conn);		
        ?>
		</div>
	</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
