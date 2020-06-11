<?php
	session_start();
	if(!isset($_SESSION['User']))
	{
		unset($_SESSION["User"]);
		header("location: index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.45, shrink-to-fit=no">
		<title>DentyGest - Novos Pedidos</title>
		<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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

	</style>

	<body>
		<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'admin.php';">

		<div class="logout">
			<?php
			if($_SESSION["User"]) {
			?>
			Olá, <?php echo $_SESSION["User"]; }?><br>
			<a href="logout.php" title="Logout" style="color:#00008B; text-decoration: none;">
			<i class="fas fa-sign-out-alt"> </i> Logout </a>
		</div>

		<nav id="nav-menu" class="container-fluid">
			<a href="novospedidos.php" class="link active">Novos Pedidos</a>
			<a href="verinfo_admin.php" class="link">Ver Informações</a>
			<a href="https://dashboard.tawk.to/#/dashboard/5ec3e7de6f7d401ccbb7f52b" target="_blank" class="link">Chat</a>
		</nav>

	</body>
</html>

<?php
	
	$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
	$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome , paciente.Nome as pnome, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.data as Data, encomenda.Descricao as Descricao from encomenda, clinica, medico, paciente, tipo_trabalho WHERE clinica.id_Clinica=encomenda.Clinica_id_Clinica AND encomenda.Medico_id_Medico=medico.id_Medico AND medico.id_Medico=encomenda.Medico_id_Medico AND paciente.id_Paciente=encomenda.Paciente_id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho AND encomenda.Data>CURRENT_DATE - INTERVAL 3 DAY ORDER BY id_Encomenda DESC");


	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth->execute();
	?>
					
	<table style="width: 70%; text-align: center;" align="center">
		<tr>
			<th>id Encomenda</th>
			<th>Nome Clínica</th>
			<th>Nome Médico</th>
			<th>Nome Paciente</th>
			<th>Tipo Trabalho</th>
			<th>Data</th>
			<th>Descrição</th>
		</tr>
				
		<?php
			while($row = $sth->fetch())
			{
				?>
				<tr>
					<td><?php echo $row->id_Encomenda ?></td>
					<td><?php echo $row->cnome ?></td>
					<td><?php echo $row->mnome ?></td>
					<td><?php echo $row->pnome ?></td>
					<td><?php echo $row->tnome ?></td>
					<td><?php echo $row->Data ?></td>
					<td><?php echo $row->Descricao ?></td>
				</tr>
					<?php
				}

				echo "</table>";
				?>