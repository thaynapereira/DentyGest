<?php
	
	$db_host="localhost";
	$db_user="dentyges_admin";
	$db_password="dentyGEST2020";
	$db_name="dentyges_projeto";

	$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);

	if(isset($_REQUEST['apagar'])){

		$sql="DELETE FROM encomenda WHERE id_Encomenda={$_REQUEST['id']}";

		if(mysqli_query($conn,$sql)){
			$message="Registo apagado com sucesso!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
			$message="Erro!";
			echo "<script type='text/javascript'>alert('$message');</script>";		}
	}

	if(isset($_REQUEST['editar'])){
		$editar=$_REQUEST['id'];
		header("Location: edit.php?id=$editar");	
    	exit();	
		}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.45, shrink-to-fit=no">
		<title>Ver Informações</title>
		<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

	</head>

	<style>

		body{
			background: url(Imagens/wall.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			font-family: sans-serif;
		}
		
		html{height:100%;}

		.logo{cursor: pointer;}

		.logout{
			background: transparent;
			border: none;
			text-align: right;
			font-size: 20px;
			float: right;
			padding: 30px 30px;
		}

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

		.pesquisar{
			width: 800px;
			background: #e0e0e0;
			color: #000;
			left: 50%;
			margin-top: 75px;
			position: absolute;
			transform: translate(-50%,-50%);
			box-sizing: border-box;
			padding: 30px 30px;
			border-radius: 10px;
			text-align: center;
			font-family: sans-serif;
		}

		select{
			width: 30%;
			background: #D3D3D3;
			border-color: #808080;
			font-family: sans-serif;
			cursor: pointer;>
		}



		.bt{
			border:none;
			height: 20px;
			width: 20%;
			background: #1e9ee8;
			color: #fff;
			font-size: 15px;
			border-radius: 5px;
			font-family: sans-serif;
		}

		.bt:hover{
			background: #036dab;
			cursor: pointer;
		}


		table {
			margin-top: 100px;
 			font-family: arial, sans-serif;
  			border-collapse: collapse;
		}

		td, th {
			border: 1px solid #dddddd;
  			padding: 8px;
  			width: 10%;
		}

		th{background-color: #A9A9A9;}

		tr:nth-child(even) { background-color: #dddddd;}

		td .fas{
			color: #ba0000;
			cursor:pointer;

		}

		td button{
			border: none;
			background: transparent;
		}


	</style>

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
			<a href="https://dashboard.tawk.to/#/dashboard/5ec3e7de6f7d401ccbb7f52b" target="_blank" class="link">Chat</a>
		</nav>

		<form method="post">
			<div class="pesquisar">
				<label>Pesquisar: </label>
				<input type="text" name="pesquisar">
				<select name="escolha">
					<option value="">Selecionar Filtro</option>
					<option value="id_Encomenda">Nº de Encomenda</option>
					<option value="Nome_Clinica">Nome Clinica</option>
					<option value="Nome_Medico">Nome Medico</option>
					<option value="Nome_Paciente">Nome Paciente</option>
					<option value="Data">Data</option>
					<option value="Nome_Tipo_trabalho">Tipo de Trabalho</option>					
					<option value="Ver_Tudo">Ver Tudo</option>
				</select>
				<input class="bt" type="submit" name="submit">
			</div>
		</form>


	</body>

	<script>
	function myFunction() {
	  var r = confirm("Tem a certeza?");
	  if (r == true) {
	    return true;
	  } else {
	    return false;
	  }
	}
	</script>

</html>

<?php
	$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
	if(isset($_POST['submit']))
	{
		$pesq = $_POST["pesquisar"];
		$esc = $_POST["escolha"];

		// PESQUISAR POR ID ENCOMENDA
			if($esc == "id_Encomenda")
			{
				
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE  ".$esc." = ".$pesq." AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");


				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>
					<table style="width: 70%; text-align: center;" align="center"´>
						<tr>
							<th>Nº Encomenda</th>
							<th>Nome Clínica</th>
							<th>Nome Médico</th>
							<th>Nome Paciente</th>
							<th>Data</th>
							<th>Tipo Trabalho</th>
							<th>Opções</th>
						</tr>
						<br><br><br>
					<?php
						while($row = $sth->fetch())
						{
						?>
							<tr> 
								<td><?php echo $row->id_Encomenda; ?></td>
								<td><?php echo utf8_encode($row->cnome); ?></td>
								<td><?php echo utf8_encode($row->mnome); ?></td>
								<td><?php echo $row->pnome; ?></td>
								<td><?php echo $row->Data; ?></td>
								<td><?php echo utf8_encode($row->tnome); ?></td>
								<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
							</tr>
							<?php
						}
						
						echo "</table>";
			}

			// PESQUISAR POR DATA	

			if($esc == "Data")
			{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE Data LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");


			$sth->setFetchMode(PDO:: FETCH_OBJ);
			$sth->execute();
			?>
				<table style="width: 70%; text-align: center;" align="center"´>
				<tr>
					<th>Nº Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
					<th>Opções</th>
				</tr>
				<br><br><br>
			<?php
			while($row = $sth->fetch())
			{
				?>
				<tr> 
					<td><?php echo $row->id_Encomenda; ?></td>
					<td><?php echo utf8_encode($row->cnome); ?></td>
					<td><?php echo utf8_encode($row->mnome); ?></td>
					<td><?php echo $row->pnome; ?></td>
					<td><?php echo $row->Data; ?></td>
					<td><?php echo utf8_encode($row->tnome); ?></td>
					<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
					</tr>
				<?php
			}
			echo "</table>";
			}

			// PESQUISAR POR TIPO DE TRABALHO

			if($esc == "Nome_Tipo_trabalho")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE Nome_Tipo_trabalho LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho ORDER BY encomenda.id_Encomenda");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center"´>
					<tr>
						<th>Nº Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
						<th>Opções</th>
					</tr>
					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr> 
							<td><?php echo $row->id_Encomenda; ?></td>
							<td><?php echo utf8_encode($row->cnome); ?></td>
							<td><?php echo utf8_encode($row->mnome); ?></td>
							<td><?php echo $row->pnome; ?></td>
							<td><?php echo $row->Data; ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
							<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
						</tr>
					<?php
					}
					echo "</table>";
			}

			// PESQUISAR POR NOME CLÍNICA
			if($esc == "Nome_Clinica")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center"´>
					<tr>
						<th>Nº Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
						<th>Opções</th>
					</tr>
					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr> 
							<td><?php echo $row->id_Encomenda; ?></td>
							<td><?php echo utf8_encode($row->cnome); ?></td>
							<td><?php echo utf8_encode($row->mnome); ?></td>
							<td><?php echo $row->pnome; ?></td>
							<td><?php echo $row->Data; ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
							<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
						</tr>
					<?php
					}
					echo "</table>";
			}

			// PESQUISAR POR NOME MÉDICO
			if($esc == "Nome_Medico")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center"´>
					<tr>
						<th>Nº Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
						<th>Opções</th>
					</tr>
					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr> 
							<td><?php echo $row->id_Encomenda; ?></td>
							<td><?php echo utf8_encode($row->cnome); ?></td>
							<td><?php echo utf8_encode($row->mnome); ?></td>
							<td><?php echo $row->pnome; ?></td>
							<td><?php echo $row->Data; ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
							<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
						</tr>
					<?php
					}
					echo "</table>";
			}

// PESQUISAR POR NOME PACIENTE
			if($esc == "Nome_Paciente")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE paciente.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center"´>
					<tr>
						<th>Nº Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
						<th>Opções</th>
					</tr>
					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr> 
							<td><?php echo $row->id_Encomenda; ?></td>
							<td><?php echo utf8_encode($row->cnome); ?></td>
							<td><?php echo utf8_encode($row->mnome); ?></td>
							<td><?php echo $row->pnome; ?></td>
							<td><?php echo $row->Data; ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
							<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>'; ?>
						</tr>
					<?php
					}
					echo "</table>";
			}

			// PESQUISAR TUDO

			if($esc == "Ver_Tudo")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center"´>
					<tr>
						<th>Nº Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
						<th>Opções</th>
					</tr>

					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>

						<tr> 
							<td><?php echo $row->id_Encomenda; ?></td>
							<td><?php echo $row->cnome; ?></td>
							<td><?php echo utf8_encode($row->mnome); ?></td>
							<td><?php echo $row->pnome; ?></td>
							<td><?php echo $row->Data; ?></td>
							<td><?php echo $row->tnome; ?></td>
							<?php
							echo '<td><form action="" method="POST"><input type="hidden" name="id" value='.$row->id_Encomenda.'><button name="apagar"><i class="fas fa-trash-alt"></i></button><button name="editar"><i class="fas fa-pencil-alt"></i></button></form></td>';
							?>
						</tr>
					
					<?php
					}
					echo "</table>";
								}

		}


