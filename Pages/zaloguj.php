
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

	if (isset($_POST['nickname']))
	{
		$login = $_POST['nickname'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		// Create connection
		$conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

        $sql = "SELECT * FROM account WHERE nickname='$login'";
        $result = mysqli_query($conn, $sql);		

		if (mysqli_num_rows($result) > 0) 
		{
			
        // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
					if ($haslo==$row['password'])
				    {
  					$_SESSION['zalogowany'] = true;
					$_SESSION['id_gracza'] = $row['id_gracza'];
					$_SESSION['nickname'] = $row['nickname'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['email'] = $row['email'];
					
					$sql2 = "SELECT * FROM admins WHERE name='$login'";
                    $result2 = mysqli_query($conn, $sql2);
		                if (mysqli_num_rows($result2) > 0) 
	                	{			
                            $_SESSION['admin'] = true;
                        }else{
                            $_SESSION['admin'] = false;
                        }						
					
					unset($_SESSION['blad']);
					header('Location: ../Pages/strona.php');                      
					}
					else
					{
						$_SESSION['e_haslo']="Złe hasło do tego konta!".$haslo." ".$row['password'];	
					}
                }
        }
		else 
		{
        $_SESSION['e_login']="Brak tego użytkownika!";	
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
		Login : <input type="text" name="nickname"></br>
		<?php
			if (isset($_SESSION['e_login']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_login'].'</div>';
				unset($_SESSION['e_login']);
			}
		?>
		Hasło : <input type="password" name="haslo"></br>
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div style="color:red;">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>
		<input type="submit" value="Zaloguj"/><input type="Reset" value="Wyczyść"/>
        </form>

		</div>
	</div>
	</div>
	<div id="footer">
    <center>Strona wykonana przez team <?php echo SERVER_NAME ?> @2017</center>
	</div>
</body>
</html>
