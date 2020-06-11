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
			
			html{ height:100%;}

			.logo{cursor: pointer;}

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
				height: 660px;
				background: #e0e0e0;
				color: #000;
				left: 50%;
				margin-top: 355px;
				position: absolute;
				transform: translate(-50%,-50%);
				box-sizing: border-box;
				padding: 30px 30px;
				border-radius: 20px;
				margin-bottom:50px;
			}

			.Forms input{
				width: 100%;
				margin-bottom: 30px;
			}

			.loginbox input[type="text"] , input[type="password"], input[type="email"]{
				width: 100%;
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
				outline: none;
				height: 50px;
				background: #1e9ee8;
				color: #fff;
				font-size: 18px;
				border-radius: 20px;
				width: 200px;
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

			.botoesAzuis .return .fas{
				margin-right: 15px;
			}

			.botoesAzuis .Adicionar .fas{
				margin-left: 15px;
			}

			.loginbox h1{
			margin-bottom: 20px;
			margin: 10;
			padding: 0px;
			font-weight: bold;
			color: black;
		    }

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
    		
    		#pass-status{
    	    cursor:pointer;
    		}
    		
    		.error{
    			color: #FF0000;
    			font-size: 11px;
    		}
    		.errorwarning{
    			color: #FF0000;
    			font-size: 13px;
    		}

		</style>

	<body>
	    <?php
	    
        if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if(empty($_POST["nome_c"])){
					$nomeE = "Nome Obrigatório";
				}else{
					$nome_c = addslashes($_POST['nome_c']);
				}

				if(empty($_POST["morada_c"])){
					$moradaE = "Morada Obrigatória";
				}else{
					$morada_c = utf8_decode(addslashes($_POST['morada_c']));
				}

				if(empty($_POST["email_c"])){
					$emailE = "Email Obrigatório";

				}else{
					$email_c = utf8_decode(addslashes($_POST['email_c']));
				}

				if(empty($_POST["contacto_c"])){
					$contactoE = "Contacto Obrigatório";

				}else{
					$contacto_c = addslashes($_POST['contacto_c']);
				}

				if(empty($_POST["username_c"])){
					$userE = "Username Obrigatório";

				}else{
					$username_c = utf8_decode(addslashes($_POST['username_c']));
				}

				if(empty($_POST["password_c"])){
					$passE = "Password Obrigatória";

				}else{
					$password_c = utf8_decode(addslashes($_POST['password_c']));
				}

				if(empty($_POST["confpw_c"])){
					$confpassE = "Password Obrigatória";

				}else{
					$confpw_c = utf8_decode(addslashes($_POST['confpw_c']));
				}
			}
	    ?>
	    
		<div>
			<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'index.php';">
		</div>

		<nav id="nav-menu" class="container-fluid">
		 	<a href="registar_medico.php" class="link">Registar Médico</a>
		 	<a href="registar_clinica.php" class="link active">Registar Clínica</a>
		</nav>


		<div class="loginbox">
		<h1>Registar Clínica</h1>

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="Forms">
					<div class="input-container">
						<i class="fas fa-user"></i>
						<input type="text" name="nome_c" placeholder="Nome" maxlength="100" id="clinica">
						<span class="error">* <?php echo $nomeE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-home icon"></i>
						<input size="50" type="text" name="morada_c" placeholder="Morada" maxlength="100">
						<span class="error">* <?php echo $moradaE;?></span>
					</div>

					<div class="input-container">
						<i class="far fa-envelope"></i>
						<input type="email" name="email_c" placeholder="Email" maxlength="30" id="email">
						<span class="error">* <?php echo $emailE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-phone-alt"></i>
						<input type="text" name="contacto_c" placeholder="Telefone" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						<span class="error">* <?php echo $contactoE;?></span>
					</div>

					<div class="input-container">
						<i class="far fa-user-circle"></i>
						<input type="text" name="username_c" placeholder="Username" maxlength="30">
						<span class="error">* <?php echo $userE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-unlock-alt"></i>
						<input id="password_c" type="password" name="password_c" placeholder="Senha"maxlength="30">           
						<i id="pass-status" class="fa fa-eye" aria-hidden="true" onclick="mostrarpw1()"></i>
						<span class="error">* <?php echo $passE;?></span>
					</div>

					<div class="input-container">
						<i class="fas fa-unlock-alt"></i>
						<input id="confpw_c" type="password" name="confpw_c" placeholder="Confirmar Senha" maxlength="30">
						<i id="pass-status" class="fa fa-eye" aria-hidden="true" onclick="mostrarpw2()"></i>
						<span class="error">* <?php echo $confpassE;?></span>
					</div>
					<span class="errorwarning">* Preenchimento Obrigatório</span>

					<script>
						function mostrarpw1()
						{
						  var x = document.getElementById("password_c");
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
						  var y = document.getElementById("confpw_c");
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


					<div class="botoesAzuis">
						<button name="retroceder" class="return"><i class="fas fa-arrow-circle-left"></i>Voltar Atrás</button>
						<button name="submeter" class="Submeter">Submeter <i class="fas fa-paper-plane"></i></button> 	
					</div>
					
				</div>
			</form>
		</div>
		

	<?php
	//Verificar se clicou no botão
	if(isset($_POST['submeter']))
	{
		$nome_c = addslashes($_POST['nome_c']);
		$morada_c = addslashes($_POST['morada_c']);
		$email_c = addslashes($_POST['email_c']);
		$contacto_c = addslashes($_POST['contacto_c']);
		$username_c = addslashes($_POST['username_c']);
		$password_c = addslashes($_POST['password_c']);
		$confpw_c = addslashes($_POST['confpw_c']);
		//verificar se está tudo preenchido
		if(!empty($nome_c) && !empty($morada_c) && !empty($email_c) && !empty($contacto_c) && !empty($username_c) &&!empty($password_c) && !empty($confpw_c))
		{
			$u->ligar_BD("dentyges_projeto","localhost","dentyges_admin","dentyGEST2020");
			if($u->msgErro == "")
			{
				if($password_c == $confpw_c)
				{
					if($u->registarclinica($nome_c, $morada_c, $email_c, $contacto_c, $username_c, $password_c))
					{
						$message = "Registado com sucesso!";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else
					{
						$message = "Clínica já registada!";
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
	
    if(isset($_POST['retroceder'])){
		header("Location: index.php");	
    	exit();	
	}
?>
</body>
</html>