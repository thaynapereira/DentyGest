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
		<title>DentyGest - Ver Informações</title>
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

	</style>

	<body>
	    
	    		<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ec3e7de6f7d401ccbb7f52b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

<!--End of Tawk.to Script-->


		<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'menu.php';">

		<div class="logout">
		    <?php
			if($_SESSION["User"]) {
			?>
			Olá, <?php echo $_SESSION["User"]; }?><br>
			<a href="logout.php" title="Logout" style="color:#00008B; text-decoration: none;">
			<i class="fas fa-sign-out-alt"> </i> Logout </a>
		</div>

		<nav id="nav-menu" class="container-fluid">
			<a href="add.php" class="link">Adicionar</a>
			<a href="verinfo.php" class="link active">Ver Informações</a>
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
</html>

<?php
	$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
	if(isset($_POST['submit']))
	{
		$pesq = $_POST["pesquisar"];
		$esc = $_POST["escolha"];

		$utilizador = $_SESSION['User'];

		if($_SESSION['tipo'] == "clinica")
		{
///////////////////////////////////////////////C-L-I-N-I-C-A/////////////////////////////////////////
// PESQUISAR POR ID ENCOMENDA
			if($esc == "id_Encomenda")
			{
    			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND ".$esc." = ".$pesq." AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");
    
    			$sth->setFetchMode(PDO:: FETCH_OBJ);
    			$sth->execute();
                ?>
                
				<table style="width: 70%; text-align: center;" align="center">
    				<tr>
    					<th>id Encomenda</th>
    					<th>Nome Clínica</th>
    					<th>Nome Médico</th>
    					<th>Nome Paciente</th>
    					<th>Data</th>
    					<th>Tipo Trabalho</th>
    				</tr>
    				<br><br><br>
    				
			<?php
			while($row = $sth->fetch())
			{
				?>
    				<tr>
						<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
						<td><?php echo $row->Data ?></td>
						<td><?php echo utf8_encode($row->tnome); ?></td>
					</tr>
				<?php
			} echo "</table>";
		}

// PESQUISAR POR DATA	
			if($esc == "Data")
			{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND Data LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");


			$sth->setFetchMode(PDO:: FETCH_OBJ);
			$sth->execute();
			?>
				<table style="width: 70%; text-align: center;" align="center">
				<tr>
					<th>id Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
				</tr>
				<br><br><br>
			<?php
			while($row = $sth->fetch())
			{
				?>
				    <tr>
				    	<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
						<td><?php echo $row->Data ?></td>
						<td><?php echo utf8_encode($row->tnome); ?></td>					
					</tr>
				<?php
			} echo "</table>";
		}

// PESQUISAR POR NOME TRABALHO
			if($esc == "Nome_Tipo_trabalho")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND Nome_Tipo_trabalho LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
			    	<tr>
						<th>id Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
					</tr>
					<br><br><br>
					
					<?php
					while($row = $sth->fetch())
					{
					    ?>
						<tr>
							<td><?php echo $row->id_Encomenda ?></td>
							<td><?php echo utf8_encode($row->cnome) ?></td>
							<td><?php echo utf8_encode($row->mnome) ?></td>
							<td><?php echo $row->pnome ?></td>
							<td><?php echo $row->Data ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
						</tr>
					<?php
				} echo "</table>";
			}

// PESQUISAR POR NOME CLÍNICA
			if($esc == "Nome_Clinica")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND clinica.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

		        $sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
					<tr>
						<th>id Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
					</tr>
					<br><br><br>
					
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr>
							<td><?php echo $row->id_Encomenda ?></td>
							<td><?php echo utf8_encode($row->cnome) ?></td>
							<td><?php echo utf8_encode($row->mnome) ?></td>
							<td><?php echo $row->pnome ?></td>
							<td><?php echo $row->Data ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
						</tr>
					<?php
				} echo "</table>";
			}

// PESQUISAR POR NOME MÉDICO
			if($esc == "Nome_Medico")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND medico.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center">
					<tr>
						<th>id Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
					</tr>
					<br><br><br>
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr>
							<td><?php echo $row->id_Encomenda ?></td>
							<td><?php echo utf8_encode($row->cnome) ?></td>
							<td><?php echo utf8_encode($row->mnome) ?></td>
							<td><?php echo $row->pnome ?></td>
							<td><?php echo $row->Data ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
						</tr>
					<?php
				} echo "</table>";
			}

// PESQUISAR POR NOME Paciente
			if($esc == "Nome_Paciente")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND paciente.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center">
					<tr>
						<th>id Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
					</tr>
					<br><br><br>
					
					<?php
					while($row = $sth->fetch())
					{
					?>
						<tr>
						    <td><?php echo $row->id_Encomenda ?></td>
							<td><?php echo utf8_encode($row->cnome) ?></td>
							<td><?php echo utf8_encode($row->mnome) ?></td>
							<td><?php echo $row->pnome ?></td>
							<td><?php echo $row->Data ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
						</tr>
					<?php
				} echo "</table>";
			}

// PESQUISAR TUDO
			if($esc == "Ver_Tudo")
			{
				$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, clinica.User, medico.Nome as mnome, medico.User, medico.Nome, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE clinica.User LIKE '%$utilizador%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

					$sth->setFetchMode(PDO:: FETCH_OBJ);
					$sth->execute();
					?>

					<table style="width: 70%; text-align: center;" align="center">
					<tr>
						<th>id Encomenda</th>
						<th>Nome Clínica</th>
						<th>Nome Médico</th>
						<th>Nome Paciente</th>
						<th>Data</th>
						<th>Tipo Trabalho</th>
					</tr>
					<br><br><br>
					
					<?php
					while($row = $sth->fetch())
					{
					?>
					
						<tr>
							<td><?php echo $row->id_Encomenda ?></td>
							<td><?php echo utf8_encode($row->cnome) ?></td>
							<td><?php echo utf8_encode($row->mnome) ?></td>
							<td><?php echo $row->pnome ?></td>
							<td><?php echo $row->Data ?></td>
							<td><?php echo utf8_encode($row->tnome); ?></td>
						</tr>
					
					<?php
				} echo "</table>";
			}
		}

/////////////////////////////////////////////////////////M-E-D-I-C-O//////////////////////////////////////////////////////////////////
		else
		{

// PESQUISAR POR ID ENCOMENDA
		if($esc == "id_Encomenda")
		{
    		$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND ".$esc." = ".$pesq." AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");
    
    		$sth->setFetchMode(PDO:: FETCH_OBJ);
    		$sth->execute();
	    	?>
	    	
			<table style="width: 70%; text-align: center;" align="center">
    			<tr>
    				<th>id Encomenda</th>
    				<th>Nome Clínica</th>
    				<th>Nome Médico</th>
    				<th>Nome Paciente</th>
    				<th>Data</th>
    				<th>Tipo Trabalho</th>
    			</tr>
    			<br><br><br>
			
		<?php
		
		while($row = $sth->fetch())
		{
			?>
			    <tr>
				    <td><?php echo $row->id_Encomenda ?></td>
					<td><?php echo utf8_encode($row->cnome) ?></td>
					<td><?php echo utf8_encode($row->mnome) ?></td>
					<td><?php echo $row->pnome ?></td>
					<td><?php echo $row->Data ?></td>
					<td><?php echo utf8_encode($row->tnome); ?></td>
				</tr>
			<?php
		}echo "</table>";
	}

// PESQUISAR POR DATA	
		if($esc == "Data")
		{
		$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND Data LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");


		$sth->setFetchMode(PDO:: FETCH_OBJ);
		$sth->execute();
		?>
			<table style="width: 70%; text-align: center;" align="center">
			<tr>
				<th>id Encomenda</th>
				<th>Nome Clínica</th>
				<th>Nome Médico</th>
				<th>Nome Paciente</th>
				<th>Data</th>
				<th>Tipo Trabalho</th>
			</tr>
			<br><br><br>
		<?php
		while($row = $sth->fetch())
		{
			?>
			<tr>
				<td><?php echo $row->id_Encomenda ?></td>
				<td><?php echo utf8_encode($row->cnome) ?></td>
				<td><?php echo utf8_encode($row->mnome) ?></td>
			    <td><?php echo $row->pnome ?></td>
				<td><?php echo $row->Data ?></td>
				<td><?php echo utf8_encode($row->tnome); ?></td>
			</tr>
			<?php
		} echo "</table>";
	}

// PESQUISAR POR NOME TRABALHO
		if($esc == "Nome_Tipo_trabalho")
		{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND Nome_Tipo_trabalho LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
				<tr>
					<th>id Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
				</tr>
				<br><br><br>
				<?php
				while($row = $sth->fetch())
				{
				?>
					<tr>
						<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
						<td><?php echo $row->Data ?></td>
						<td><?php echo utf8_encode($row->tnome); ?></td>
					</tr>
				<?php
			} echo "</table>";
		}

// PESQUISAR POR NOME CLÍNICA
		if($esc == "Nome_Clinica")
		{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND clinica.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
				<tr>
					<th>id Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
				</tr>
				<br><br><br>
				<?php
				while($row = $sth->fetch())
				{
				?>
					<tr>
						<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
						<td><?php echo $row->Data ?></td>
						<td><?php echo utf8_encode($row->tnome); ?></td>
					</tr>
				<?php
			} echo "</table>";
		}

// PESQUISAR POR NOME CLÍNICA
		if($esc == "Nome_Paciente")
		{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND paciente.Nome LIKE '%$pesq%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
				<tr>
					<th>id Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
				</tr>
				<br><br><br>
				<?php
				while($row = $sth->fetch())
				{
				?>
					<tr>
						<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
		    			<td><?php echo $row->Data ?></td>
						<td><?php echo utf8_encode($row->tnome); ?></td>
					</tr>
				<?php
			} echo "</table>";
		}

// PESQUISAR TUDO
		if($esc == "Ver_Tudo")
		{
			$sth = $pdo->prepare("SELECT encomenda.id_Encomenda, clinica.Nome as cnome, medico.Nome as mnome, medico.User, paciente.Nome as pnome, encomenda.Data, tipo_trabalho.Nome_Tipo_trabalho as tnome, encomenda.Descricao FROM encomenda, medico, clinica, paciente, tipo_trabalho WHERE medico.User LIKE '%$utilizador%' AND encomenda.Medico_id_Medico=medico.id_Medico AND encomenda.Clinica_id_Clinica=clinica.id_Clinica AND encomenda.Paciente_id_Paciente=paciente.id_Paciente AND encomenda.Tipo_Trabalho_id_Tipo_Trabalho=tipo_trabalho.id_Tipo_Trabalho");

				$sth->setFetchMode(PDO:: FETCH_OBJ);
				$sth->execute();
				?>

				<table style="width: 70%; text-align: center;" align="center">
				<tr>
					<th>id Encomenda</th>
					<th>Nome Clínica</th>
					<th>Nome Médico</th>
					<th>Nome Paciente</th>
					<th>Data</th>
					<th>Tipo Trabalho</th>
				</tr>
				<br><br><br>
				<?php
				while($row = $sth->fetch())
				{
				?>
					<tr>
						<td><?php echo $row->id_Encomenda ?></td>
						<td><?php echo utf8_encode($row->cnome) ?></td>
						<td><?php echo utf8_encode($row->mnome) ?></td>
						<td><?php echo $row->pnome ?></td>
						<td><?php echo $row->Data ?></td>
				    	<td><?php echo utf8_encode($row->tnome); ?></td>
					</tr>
				<?php
			} echo "</table>";
		}



		}

}
?>