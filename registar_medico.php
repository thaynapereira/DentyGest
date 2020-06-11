<?php
	require_once 'user.php';
	$u = new user;
	$nomeE = "";
	$moradaE = "";
	$emailE = "";
	$contactoE = "";
	$userE = "";
	$passE ="";
	$confpassE = "";

?>

<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=0.45, shrink-to-fit=no">
	    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	    <title>DentyGest - Registo</title>
    </head>

	<style>
		body{
			background: url(Imagens/wall.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			font-family: sans-serif;
		}
		
		html{height:100%;}

		.logo{cursor:pointer;}

		#nav-menu{
			display: flex;
			justify-content: center;
			margin: auto;
			float: none;
			position: relative;
		}

		#nav-menu a.link{
			font-size: 1.2rem;
			text-transform: uppercase;
			color: black;
			text-decoration: none;
			display:  block;
			padding: 1.2rem 1.2rem 1rem 1.2rem;
			border-bottom: 3px solid gray;
			text-align: center;
		}

		#nav-menu a.link:hover{
			background-color: #CCC;
			border-bottom: 3px solid #005ce6!important;
		}

		#nav-menu a.link:active, #nav-menu a.link.active{
			background-color: #CCC;
			border-bottom: 3px solid #005ce6;
		}

		.loginbox{
			width: 800px;
			height: 700px;
			background: #e0e0e0;
			color: #000;
			left: 50%;
			margin-top: 375px;
			position: absolute;
			transform: translate(-50%,-50%);
			box-sizing: border-box;
			padding: 30px 30px;
			padding-bottom: 5px;
			border-radius: 20px;
			margin-bottom:50px;
		}

		.Forms input{
			width: 100%;
			margin-bottom: 30px;
		}

		.loginbox input[type="text"], input[type="password"], input[type="email"]{
			border:none;
			border-bottom: 1px solid #fff;
			background: transparent;
			outline: none;
			height: 25px;
			color: #fff
			font-size: 12px;
		}

		.botoesAzuis{text-align: center;}

		.botoesAzuis button{
			border:none;
			height: 50px;
			width: 200px;
			background: #1e9ee8;
			color: #fff;
			font-size: 18px;
			border-radius: 20px;
			margin: 25px;
		}

		.botoesAzuis button:active{
	  		box-shadow: 0 5px #666;
	  		transform: translateY(4px);
		}

		.botoesAzuis button:hover{
	  		cursor: pointer;
			background: #036dab;
			color: #FFF;
		}

		.botoesAzuis .return .fas{margin-right: 15px;}

		.botoesAzuis .Adicionar .fas{margin-left: 15px;}
		
		.input-container {
			display: flex;
			width: 100%;
			outline: none;
		}

		i{
			padding-top: 5px;
			padding-bottom: 5px;
  			min-width: 30px;
		}

		.select{
			margin-bottom: 20px;
			width: 100%;
			background: #D3D3D3;
			border-color: #808080;
		}
		
		.error{
			color: #FF0000;
			font-size: 11px;
		}
		.errorwarning{
			color: #FF0000;
			font-size: 13px;
		}
		
		#pass-status{
	    cursor:pointer;
		}

	</style>

<body>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if(empty($_POST["nome_m"])){
					$nomeE = "Nome Obrigatório";
				}else{
					$nome_m = addslashes($_POST['nome_m']);
				}

				if(empty($_POST["morada_m"])){
					$moradaE = "Morada Obrigatória";
				}else{
					$morada_m = addslashes($_POST['morada_m']);
				}

				if(empty($_POST["email_m"])){
					$emailE = "Email Obrigatório";

				}else{
					$email_m = addslashes($_POST['email_m']);
				}

				if(empty($_POST["contacto_m"])){
					$contactoE = "Contacto Obrigatório";

				}else{
					$contacto_m = addslashes($_POST['contacto_m']);
				}

				if(empty($_POST["username_m"])){
					$userE = "Username Obrigatório";

				}else{
					$username_m = addslashes($_POST['username_m']);
				}

				if(empty($_POST["password_m"])){
					$passE = "Password Obrigatória";

				}else{
					$password_m = addslashes($_POST['password_m']);
				}

				if(empty($_POST["confpw_m"])){
					$confpassE = "Password Obrigatória";

				}else{
					$confpw_m = addslashes($_POST['confpw_m']);
				}
			}
	?>
    	<div>
    		<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'index.php';">
    	</div>

		<nav id="nav-menu" class="container-fluid">
    		 <a href="registar_medico.php" class="link active">Registar Médico</a>
	    	 <a href="registar_clinica.php" class="link">Registar Clínica</a>
		</nav>

		<div class="loginbox">
		<h1>Registar Médico</h1>

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="Forms">
					<div class="input-container">
						<i class="fas fa-user"></i>
						<input size="50" type="text" name="nome_m" placeholder="Nome" maxlength="30">
						<span class="error">* <?php echo $nomeE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-home icon"></i>
						<input size="50" type="text" name="morada_m" placeholder="Morada" maxlength="100">
						<span class="error">* <?php echo $moradaE;?></span>
					</div>
					
					<div class="input-container">
						<i class="far fa-envelope"></i>
						<input size="50" type="email" name="email_m" placeholder="Email" maxlength="30">
						<span class="error">* <?php echo $emailE;?></span>
					</div>
					
					<div class="input-container">
						<i class="fas fa-phone-alt"></i>
						<input size="50" type="text" name="contacto_m" placeholder="Telefone" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						<span class="error">* <?php echo $contactoE;?></span>
					</div>
					

<!------------------------------------------------------------------------------------------------------------------------------------------------------>
					<?php
					$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
					$sql = "SELECT id_Clinica, Nome FROM clinica";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					$nome = $stmt->fetchAll();
					?>
					<div class="input-container">
						<i class="fas fa-angle-double-right"></i>

							<select class="select" name="nclinica" >
								<option value="">Escolha a Clínica Associada</option>
							    <?php foreach($nome as $nome_c): ?>
							        <option value="<?= utf8_encode($nome_c['Nome']); ?>"><?= utf8_encode($nome_c['Nome']); ?></option>
							    <?php endforeach; ?>
							</select>
						
					</div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="input-container">
						<i class="far fa-user-circle"></i>
						<input size="50" type="text" name="username_m" placeholder="Username" maxlength="30">
						<span class="error">* <?php echo $userE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-unlock-alt"></i>
						<input id="password_m" type="password" name="password_m" placeholder="Senha"maxlength="30">
						<i id="pass-status" class="fa fa-eye" aria-hidden="true" onclick="mostrarpw1()"></i>
						<span class="error">* <?php echo $passE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-unlock-alt"></i>
						<input id="confpw_m" type="password" name="confpw_m" placeholder="Confirmar Senha" maxlength="15">
						<i id="pass-status" class="fa fa-eye" aria-hidden="true" onclick="mostrarpw2()"></i>
						<span class="error">* <?php echo $confpassE;?></span>
					</div>
					
					<span class="errorwarning">* Preenchimento Obrigatório</span>
					
					<script>
						function mostrarpw1()
						{
						  var x = document.getElementById("password_m");
						  if (x.type === "password")
						  {
						    x.type = "text";
						  }
						  else
						  {
						    x.type = "password";
						  }
						}
						
						function mostrarpw2()
						{
						  var y = document.getElementById("confpw_m");
						  if (y.type === "password")
						  {
						    y.type = "text";
						  }
						  else
						  {
						    y.type = "password";
						  }
						}
					</script>

					<div class="botoesAzuis botoesAzuis-center-align">
						<button onclick="window.location.href = 'index.php';" class="return"><i class="fas fa-arrow-circle-left"></i>Voltar Atrás</button>
						<button onclick="window.location.href = 'index.php';" class="Adicionar">Submeter <i class="fas fa-paper-plane"></i></button> 
					</div>
				</div>
			</form>
		</div>


<?php
if(isset($_POST['nome_m']))
{
	$nome_m = utf8_decode(addslashes($_POST['nome_m']));
	$morada_m = utf8_decode(addslashes($_POST['morada_m']));
	$email_m = addslashes($_POST['email_m']);
	$contacto_m = addslashes($_POST['contacto_m']);
	$nclinica = addslashes($_POST['nclinica']);
	$username_m = utf8_decode(addslashes($_POST['username_m']));
	$password_m = utf8_decode(addslashes($_POST['password_m']));
	$confpw_m = utf8_decode(addslashes($_POST['confpw_m']));

		if(!empty($nome_m) && !empty($morada_m) && !empty($email_m) && !empty($contacto_m) && !empty($username_m) && !empty($password_m) && !empty($confpw_m))
		{
			$u->ligar_BD("dentyges_projeto","localhost","dentyges_admin","dentyGEST2020");
			if($u->msgErro == "")//Ligação com sucesso
			{
				if($password_m == $confpw_m)
				{
					if($u->registarmedico($nome_m,$morada_m,$email_m,$contacto_m,$username_m,$password_m,$nclinica))
					{
						$message = "Registado com sucesso!";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else
					{
						$message = "Médico já registado!";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				else
				{
					$message = "Password e Confirmar Password não coincidem!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
			else
			{
				$message = $u->msgErro;
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
}
?>
</body>
</html>