<?php
	$id = $_GET['id'];

	$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
	$sql = $pdo->prepare("SELECT * FROM encomenda WHERE id_Encomenda=:i");
	$sql->bindParam(':i', $id, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch();
	$id_Encomenda = $row['id_Encomenda'];
	$id_clinica = $row['Clinica_id_Clinica'];
	$id_medico = $row['Medico_id_Medico'];
	$id_paciente = $row['Paciente_id_Paciente'];
	$data=$row['Data'];
	$id_tt = $row['Tipo_Trabalho_id_Tipo_Trabalho'];
	$descricao =$row['Descricao'];

	//------------------------------------- Nome da Clínica --------------------------
	$sql = $pdo->prepare("SELECT * FROM clinica WHERE id_clinica=:nc");
	$sql->bindParam(':nc', $id_clinica, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch();
	$nome_clinica = utf8_encode($row['Nome']);

	//------------------------------------- Nome do Médico ---------------------------
	$sql = $pdo->prepare("SELECT * FROM medico WHERE id_medico=:nm");
	$sql->bindParam(':nm', $id_medico, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch();
	$nome_medico = utf8_encode($row['Nome']);
	//------------------------------------Nome do Paciente-----------------------------
	$sql = $pdo->prepare("SELECT * FROM paciente WHERE id_paciente=:np");
	$sql->bindParam(':np', $id_paciente, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch();
	$nome_paciente = $row['Nome'];
	//----------------------------Nome do Tipo de Trabalho--------------------------
	$sql = $pdo->prepare("SELECT * FROM tipo_trabalho WHERE id_Tipo_Trabalho=:ntt");
	$sql->bindParam(':ntt', $id_tt, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch();
	$nome_tipot = utf8_encode($row['Nome_Tipo_trabalho']);

	// -------------------CARREGAR NO BOTÃO CANCELAR-----------------------------------
	if(isset($_REQUEST['cancelar'])){
		header("Location: verinfo_admin.php");	
    	exit();	
	}

	// -------------------CARREGAR NO BOTÃO EDITAR-----------------------------------
	if(isset($_REQUEST['editar'])){
		$nome_novo = addslashes($_POST['nome_p']);
		$nova_descr= utf8_decode(addslashes($_POST['descricao']));
		$novott= utf8_decode(addslashes($_POST['tipotrabalho']));
		
		

		
		
		if($nome_novo == "")
		{
		    $message = "Nome do Paciente é obrigatório!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{

			if($nome_paciente!=$nome_novo || $nova_descr!=$descricao || $nome_tipot!=$novott){
				if($nome_paciente!=$nome_novo){
					$sql = $pdo->prepare("UPDATE paciente SET Nome=:nn WHERE id_paciente=:ip");
					$sql->bindParam(':ip', $id_paciente, PDO::PARAM_INT);
					$sql->bindParam(':nn', $nome_novo, PDO::PARAM_STR, 12);
					$sql->execute();
				}

				if($nova_descr!=$descricao){
					$sql = $pdo->prepare("UPDATE encomenda SET Descricao=:des WHERE id_Encomenda=:i");
					$sql->bindParam(':i', $id, PDO::PARAM_INT);
					$sql->bindParam(':des', $nova_descr, PDO::PARAM_STR, 40);
					$sql->execute();
				}

				if($nome_tipot!=utf8_encode($novott)){
					//PASSAR O NOVO NOME DO TIPO DE TRABALHO PARA O SEU ID 
					$sql = $pdo->prepare("SELECT * FROM tipo_trabalho WHERE Nome_Tipo_trabalho=:nntt");
					$sql->bindParam(':nntt', $novott, PDO::PARAM_STR, 12);
					$sql->execute();
					$row = $sql->fetch();
					$novoidtt= $row['id_Tipo_Trabalho'];
					//FAZER UPDATE NA ENCOMENDA COM O NOVO ID
					$sql = $pdo->prepare("UPDATE encomenda SET Tipo_Trabalho_id_Tipo_Trabalho=:itt WHERE id_Encomenda=:i");
					$sql->bindParam(':i', $id, PDO::PARAM_INT);
					$sql->bindParam(':itt', $novoidtt, PDO::PARAM_INT);
					$sql->execute();
				}
			

				$message="Encomenda atualizada com sucesso!";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header("refresh:0.5; url=verinfo_admin.php");
				

			}

			else{
				$message="Não existem alterações";
				echo "<script type='text/javascript'>alert('$message');</script>";	
			}

			

		}
		

		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
		<title>DentyGest - Editar Encomenda</title>

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
				background: #e0e0e0;
				color: #000;
				left: 50%;
				margin-top: 450px;
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
			select{
				width: 100%;
				margin-bottom: 30px;
				border: none;
				border-bottom: 1px solid #fff;
				background: transparent;
				outline: none;
				height: 25px;
				color: #fff
				font-size: 12px;
			}


			.loginbox input[type="text"] , input[type="password"], input[type="date"] {
				width: 100%;
				border:none;
				border-bottom: 1px solid #fff;
				background: transparent;
				outline: none;
				height: 25px;
				color: #fff
				font-size: 12px;
			}

			.logout{
			background: transparent;
			border: none;
			text-align: right;
			font-size: 20px;
			float: right;
			padding: 30px 30px;
		}

			.botoesAzuis{text-align: center;}

			.botoesAzuis button{
				border:none;
				outline: none;
				height: 50px;
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

			.Editar{background: #1e9ee8;}

			.Editar:hover{
		  		cursor: pointer;
				background: #036dab;
				color: #FFF;
			}

			.Delete{background: #e60000;}
			.Delete:hover{
				cursor: pointer;
				background: #ba0000;}

			.botoesAzuis .return .fas{
				margin-right: 15px;
			}

			.botoesAzuis .Adicionar .fas{
				margin-left: 15px;
			}

			.loginbox h1{
			margin-bottom: 50px;
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

		.desc p{
			float:right;
		}

		</style>
	</head>

	<body>
		<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'admin.php';">

		<div class="logout">
				Olá Administrador!<br>
				<a href="logout.php" title="Logout" style="color:#00008B; text-decoration: none;">
					<i class="fas fa-sign-out-alt"> </i> Logout </a>
		</div>

		<nav id="nav-menu" class="container-fluid">
			<a href="novospedidos.php" class="link">Novos Pedidos</a>
			<a href="verinfo_admin.php" class="link active">Ver Informações</a>
		</nav>


		<div class="loginbox">
		<h1>Editar Encomenda</h1>

			<form method="POST">

				<div class="Forms">
					<div class="input-container">
						<i class="fas fa-archive"></i>
						<input type="text" name="id" placeholder="Número da Encomenda" maxlength="100" id="clinica" value="<?=$id_Encomenda?>" readonly>
					</div>

					<div class="input-container">
						<i class="fas fa-hospital"></i>
						<input size="50" type="text" name="nome_c" placeholder="Nome da Clínica" maxlength="100" value="<?=$nome_clinica?>" readonly>
					</div>

					<div class="input-container">
						<i class="fas fa-hospital-user"></i>
						<input type="text" name="nome_m" placeholder="Nome do Médico" maxlength="30" id="email" value="<?=$nome_medico?>"  readonly>
					</div>

					<div class="input-container">
						<i class="fas fa-user"></i>
						<input type="text" name="nome_p" placeholder="Nome do Paciente" value="<?=$nome_paciente?>" maxlength="45">*

					</div>

				
    				<div class="input-container">
    					<i class="far fa-calendar-alt"></i>
    					<input type="date" value="<?=$data?>" readonly>
    				</div>


					<!--------------------------------------------------------------------------------------->

					<?php
					$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
					$sql = "SELECT Nome_Tipo_trabalho FROM tipo_trabalho";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					$results = $stmt->fetchAll();
					?>
					<div class="input-container">
						<i class="fas fa-tooth"></i>

							<select class="select" name="tipotrabalho">
								<?php foreach ($results as $TipoTrabalho){
									if($TipoTrabalho["Nome_Tipo_trabalho"]==$nome_tipot){
										?>
										<option selected><?php echo utf8_encode($TipoTrabalho["Nome_Tipo_trabalho"]);?>
									<?php }
									else{
										?>
										<option><?php echo utf8_encode($TipoTrabalho["Nome_Tipo_trabalho"]);?>

									<?php }} ?>
							</select>
						
						*
					</div>

					<div class="desc">
						<label style="font-family: sans-serif;">Descrição:</label>
						<p>*</p><br>
						<textarea type="text" name="descricao" placeholder="Descrição da encomenda" rows="5" cols="100" maxlength="5000" value="<?=$descricao?>" style="resize:none; width: 100%;"><?php echo utf8_encode($descricao); ?></textarea>
					</div>

					<p>* <u>Apenas os campos assinalados podem ser editados</u> </p>


					<div class="botoesAzuis">
						<button name="cancelar" class="Delete"><i class="fas fa-times"></i>Cancelar</button>
						<button name="editar" class="Editar">Editar <i class="fas fa-pencil-alt"></i></button> 	
					</div>
				</div>
			</form>
		</div>
		
</body>
</html>