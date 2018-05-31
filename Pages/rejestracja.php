
<?php
/* --------------------------------------------------------------------------------------
                                      GOTHIC ROLEPLAY
-------------------------------------------------------------------------------------- */

session_start();
	
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: ../Pages/strona.php');
	exit();
}
require_once("../config.php");


	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo2']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Sprawdź poprawność hasła
		$testowa = $_POST['test1'];
		
		if($testowa != 'Gothic2Online')
		{
			$wszystko_OK=false;
			$_SESSION['e_test']="Źle wpisane hasło!";			
		}
		
		// Create connection
		$conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

        $sql = "SELECT id_gracza FROM player WHERE email='$email'";
        $result = mysqli_query($conn, $sql);		

			if (mysqli_num_rows($result) > 0) {
				$wszystko_OK=false;
				$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
    		}	
        $sql = "SELECT id_gracza from player where nickname='$nick'";
        $result = mysqli_query($conn, $sql);		

			if (mysqli_num_rows($result) > 0) {
				$wszystko_OK=false;
				$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
    		}
						
			if ($wszystko_OK==true)
			{	
                $sql = "INSERT INTO account(name, haslo, email, online, hp, hpmax, mana, manamax, str, dex, magiclvl, lp, lvl, exp, oneh, twoh, bow, cbow, posx, posy, posz, angle, wyglad1, wyglad2, wyglad3, wyglad4, worldid, isblocked) VALUES ('$nick','$haslo1','$email', 0, 50,50,0,0,10,10,0,0,0,0,0,0,0,0,9942,368,-698,160,0,1,1,14,1,0)";
				mysqli_query($conn, $sql);
				
                $sql = "SELECT * from account where name='$nick'";
                $result = mysqli_query($conn, $sql);		
				while($row = mysqli_fetch_assoc($result)) {
					$idgracza = $row['id'];
				}

                $sql = "INSERT INTO equipment(id,instance,amount) VALUES ($idgracza, 'ITMI_GOLD',20),($idgracza, 'ITAR_VLK_L',1),($idgracza, 'ITFO_BREAD',1),($idgracza, 'ITFO_BEAR',1);";
				mysqli_query($conn, $sql);
				header('Location: ../Pages/zaloguj.php');
                  // Naglowki mozna sformatowac tez w ten sposob.
                  $naglowki = "Reply-to: $nick".PHP_EOL;
                  $naglowki .= "From: Quarchodron <gmp512@interia.pl>".PHP_EOL;
                  $naglowki .= "MIME-Version: 1.0".PHP_EOL;
                  $naglowki .= "Content-type: text/html; charset=iso-8859-2".PHP_EOL; 
                  //Wiadomość najczęściej jest generowana przed wywołaniem funkcji
                  $wiadomosc = '<html> 
                  <head> 
                  <title>Gothic 2 Online</title> 
                  </head>
                  <body>
                  <p><b>Witaj na serwerze Gothic 2 Online</b></br>Twoje dane:</br>Nick : $nick</br>Hasło : $haslo1</br> Zapraszamy na serwer!</p>
                  </body>
                  </html>';


                  mail('$email', 'Gothic 2 Online Serwer', $wiadomosc, $naglowki);

            }		
		mysqli_close($conn);
	}
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
		<center>
		<img src="../images/gothic2.png"/></br>
		<form method="post">
	
		Login:<input type="text" value="<?php
			if (isset($_SESSION['fr_nick']))
			{
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
		?>" name="nick" /><br />
		
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>
		
		E-mail: <input type="text" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>" name="email" /><br />
		
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
		
		Twoje hasło: <input type="password"  value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
		?>" name="haslo1" /><br />
		
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>		
		
		Powtórz hasło: <input type="password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
		?>" name="haslo2" /><br />

		<?php
			if (isset($_SESSION['e_haslo2']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_haslo2'].'</div>';
				unset($_SESSION['e_haslo2']);
			}
		?>			

		Wpisz Gothic 2 Online (bez spacji): <input type="text"  value="<?php
			if (isset($_SESSION['fr_test1']))
			{
				echo $_SESSION['fr_test1'];
				unset($_SESSION['fr_test1']);
			}
		?>" name="test1" /><br />
		
		<?php
			if (isset($_SESSION['e_test']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_test'].'</div>';
				unset($_SESSION['e_test']);
			}
		?>		
		</br>
		<input type="submit" value="Zarejestruj"/><input type="Reset" value="Wyczyść"/>
        </form>

		</div>
	</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
