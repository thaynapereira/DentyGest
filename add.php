<?php
	require_once 'user.php';
	$u = new user;
	$nomepE = "";
	$tipoE = "";
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
		<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
		<title>DentyGest - Novo Pedido</title>
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

		.loginbox{
			width: 800px;
			background: #e0e0e0;
			color: #000;
			left: 50%;
			margin-top: 550px;
			margin-bottom:50px;
			position: absolute;
			transform: translate(-50%,-50%);
			box-sizing: border-box;
			padding: 30px 30px;
			border-radius: 20px;
		}

		.Forms input{
			width: 100%;
			margin-bottom: 30px;
		}

		.loginbox input[type="text"]{
			border:none;
			border-bottom: 1px solid #fff;
			background: transparent;
			outline: none;
			height: 25px;
			color: #fff
			font-size: 12px;
		}

		.image{text-align: center;}

		.dentes{
			width:65%;
			margin-top: 50px;
			margin-bottom: 50px;
			border: 3px solid;
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
			margin: 35px;
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
		
		#numero{
			margin-bottom: 30px;
			display: inline-block;
			border: double;
			text-align: right;
			padding: 10px;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		#datascript{
			margin-bottom: 30px;
			display: inline-block;
			border: double;
			text-align: left;
			padding: 10px;
			padding-top: 10px;
			padding-bottom: 10px;
			float: right;
		}

		#tipotrabalho{font-size: 13px;}

		.container {
			display: inline-block;
			position: relative;
			padding-left: 35px;
			margin-bottom: 12px;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		.container input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
		}

		.checkmark {
			position: absolute;
			top: 0;
			left: 0;
			height: 15px;
			width: 15px;
			background-color: #eee;
			border-radius: 50%;
		}

		.container:hover input ~ .checkmark {background-color: #ccc;}

		.container input:checked ~ .checkmark {background-color: #2196F3;}

		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}

		.container input:checked ~ .checkmark:after {display: block;}

		.container .checkmark:after {
		 	top: 5px;
			left:5px;
			width: 4px;
			height:4px;
			border-radius: 50%;
			background: white;
		}

		.sexo{
			font-size: 12px;
			display: inline-block;
			position: relative;
			margin-left: 0;
			color: gray

		}

		.sexo input{
			width: 30px;
			padding: 10px 10px;
			color:#fff;
		}

		.input-container {
			display: flex;
			width: 100%;
			outline: none;
		}
		.error{
			color: #FF0000;
			font-size: 11px;
		}
		.errorwarning{
			color: #FF0000;
			font-size: 13px;
		}

		i{
			padding-top: 5px;
			padding-bottom: 5px;
  			min-width: 30px;
		}


	</style>

	<body>
		<?php
	    if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if(empty($_POST["nome_paciente"])){
					$nomepE = "Nome Obrigatório";
				}else{
					$nome_paciente = addslashes($_POST['nome_paciente']);
				}
				if(empty($_POST["tipotrabalho"])){
					$tipoE = "Tipo trabalho Obrigatório";
				}else{
					$tipotrabalho = addslashes($_POST['tipotrabalho']);
				}
			}
	    ?>
			<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'menu.php';">

			<div class="logout">
				<?php
					if($_SESSION["User"]) {
				?>
				Olá, <?php echo $_SESSION["User"]; }?><br> <a href="logout.php" title="Logout" style="color:#00008B; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout </a>
			</div>

    		<nav id="nav-menu" class="container-fluid">
    		 	<a href="add.php" class="link active">Adicionar</a>
    		 	<a href="verinfo.php" class="link">Ver Informações</a>
    		</nav>

		    <div class="loginbox">
		    <h1>Adicionar Pedido</h1>

		    <div id="datascript" class="datacss"></div>
			
		    <script>document.getElementById("demo").innerHTML = Date();</script> 

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="Forms">
<!--------------------------------------------APARECER CASO USER ESTEJA REGISTADO COMO MÉDICO---------------------------------------------->
					<?php
					$pdo = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
					$user = $_SESSION['User'];
					if($_SESSION['tipo'] == "medico")
					{
						$sql = $pdo->prepare("SELECT Nome, Nome_Clinica, id_Medico FROM medico WHERE User = :u");
						$sql->bindValue(":u",$user);
						$sql->execute();
						$row = $sql->fetch();
						$nome_medico = utf8_encode($row['Nome']);
						$nome_clinica = $row['Nome_Clinica'];
						$id_medico = $row['id_Medico'];
						?>
						
						<div class="input-container">
						    <i class="fas fa-user"></i>
						    <input type="text" name="id_medico" placeholder="id Médico" maxlength="100" id="medico" value= "<?=$id_medico?>" readonly>
						    <input type="text" name="nome_medico" placeholder="Nome Médico" maxlength="100" id="medico" value="<?=$nome_medico?>" readonly>
						
<!----------------------------------------------------------CASO NÃO TENHA CLÍNICA ASSOCIADA------------------------------------------------------------------------------>
						    <?php
						    if($nome_clinica == "")
						    {
    							?>
        							<i class="fas fa-user"></i>
        							<input type="text" name="id_clinica" placeholder="id Clínica" maxlength="30" id="clinica" value="">
        							<input type="text" name="nome_clinica" placeholder="Nome Clínica" maxlength="30" id="clinica" value="" >
    						</div> <!-- Fecha a 1ª div input-container-->
    						
    						    <?php
						    }else
    					        {
    							$sql = $pdo->prepare("SELECT id_Clinica FROM clinica WHERE Nome = :nc");
    							$sql->bindValue(":nc",$nome_clinica);
    							$sql->execute();
    							$row = $sql->fetch();
    							$id_clinica = $row['id_Clinica'];
    							echo "</div>";
    					    ?>
    							
    							<div class="input-container">
        							<i class="fas fa-user"></i>
        							<input type="text" name="id_clinica" placeholder="id Clínica" maxlength="30" id="clinica" value="<?=$id_clinica ?>" readonly>
        							<input type="text" name="nome_clinica" placeholder="Nome Clínica" maxlength="60" id="clinica" value="<?=$nome_clinica ?>" readonly>
    							</div>
    						<?php
						    }
					    }
//-------------------------------------- CASO USER ESTEJA REGISTADO COMO CLINICA ----------------------------------------------------------
					   else{
    						$sql = $pdo->prepare("SELECT id_Clinica, Nome FROM clinica WHERE User = :u");
    						$sql->bindValue(":u",$user);
    						$sql->execute();
    						$row = $sql->fetch();
    						$id_clinica = $row['id_Clinica'];
    						$nome_clinica = $row['Nome'];
					    	?>
					    	
    						<div class="input-container">
    						    <i class="fas fa-user"></i>
    						    <input type="text" name="id_medico" placeholder="id Médico" maxlength="100" id="medico" value="">
    						    <input type="text" name="nome_medico" placeholder="Nome Médico" maxlength="100" id="medico" value=""> 
    						    <i class="fas fa-user"></i>
    						    <input type="text" name="id_clinica" placeholder="id Clínica" maxlength="30" id="clinica" value="<?=$id_clinica ?>" readonly>
    						    <input type="text" name="nome_clinica" placeholder="Nome Clínica" maxlength="30" id="clinica" value="<?=$nome_clinica ?>" readonly>
    					    </div>
    					    <?php
					    }
					        ?>
					       
<!-----------------------------------------------------------------------------------------------------------------------------------------> 
    				
    					<div class="input-container">
    						<i class="far fa-user"></i>
    						<input type="text" name="nome_paciente" placeholder="Nome Paciente" maxlength="100" id="paciente">
    						<span class="error">* <?php echo $nomepE;?></span>
    					</div>

					    <?php
					    	$data = date('Y/m/d', time()); //Variavel com a data
				    	?>
				    	
    					<div class="input-container">
    						<input type="hidden" name="data" placeholder="Data" id="data" value="<?=$data ?>" readonly>
    					</div>
    					
					    <div id="tipotrabalho">
					        <i class="fas fa-tooth"></i>
						    <u>Tipo Trabalho:</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						    Acrílica <label class="container ">
					  		    <input value="1" type="radio" name="tipotrabalho">
					  		    <span class="checkmark"></span>
					    	</label>
					    	
						    Esquelética <label class="container">
							    <input value="2" type="radio" name="tipotrabalho">
						 	    <span class="checkmark"></span>
						    </label>
						    
						    Flexível <label class="container">
						  	    <input value="3" type="radio" name="tipotrabalho">
						  	    <span class="checkmark"></span>
						    </label>
						    
						    Ortodontica <label class="container">
						  	    <input value="4" type="radio" name="tipotrabalho">
						  	    <span class="checkmark"></span>
						    </label>
						    
						    P.Fixa <label class="container">
						  	    <input value="5" type="radio" name="tipotrabalho">
						  	    <span class="checkmark"></span>
						    </label>
						    
						    Implante <label class="container">
				                <input value="6" type="radio" name="tipotrabalho">
							    <span class="checkmark"></span>
						    </label>
						    
						    <span class="error">* <?php echo $tipoE;?></span>
					    </div> <!-- Fecha a div tipotrabalho-->
				
                </div> <!-- Fecha a div Forms-->
				<div class="image"> <img src="Imagens/dentes.jpg" class="dentes" > </div>
				
				<div>
					<label style="font-family: sans-serif;">Descrição:</label><br>
					<textarea type="text" name="descricao" placeholder="Faça uma breve descrição do que é pretendido" rows="5" cols="100" maxlength="5000" style="resize:none; width: 100%;"></textarea>
					<span class="errorwarning"> * Preenchimento Obrigatório</span>
				</div>
				
				<div class="botoesAzuis botoesAzuis-center-align">
					<button onclick="window.location.href = 'menu.php';" class="return"><i class="fas fa-arrow-circle-left"></i>Voltar Atrás</button>
					<button class="Adicionar">Submeter <i class="fas fa-paper-plane"></i></button> 
				</div>
				
			</form>
		</div> <!-- Fecha a div login-->
		
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
</body>
</html>

	<script>
		var mydate=new Date()
		var year=mydate.getYear()
		if (year<2000)
		year += (year < 1900) ? 1900 : 0
		var month=mydate.getMonth()
		var montharray=new Array(" de Janeiro de "," de Fevereiro de "," de Março de ","de Abril de ","de Maio de ","de Junho de","de Julho de ","de Agosto de ","de Setembro de "," de Outubro de "," de Novembro de "," de Dezembro de ")
		var daym=mydate.getDate()
		if (daym<10)
		daym="0"+daym
		document.getElementById("datascript").innerHTML = daym + " " +montharray[month]+ " " + year
	</script>
<?php

if(isset($_POST['tipotrabalho']))
{
	$nome_paciente = addslashes($_POST['nome_paciente']);
	$tipotrabalho = addslashes($_POST['tipotrabalho']);
	if($nome_paciente == "" or $tipotrabalho == "")
	{
	    $message = "Preencha todos os campos obrigatórios!";
			echo "<script type='text/javascript'>alert('$message');</script>";
	}
	else
	{
	    $conn = new PDO('mysql:host=localhost;dbname=dentyges_projeto', 'dentyges_admin', 'dentyGEST2020');
        $stmt = $conn->prepare("INSERT INTO paciente(Nome) VALUES (:np)");
        $stmt->bindParam(':np', $nome_paciente);
        $stmt->execute();
        $last_id = $conn->lastInsertId();
	
	    $id_clinica = addslashes($_POST['id_clinica']);
	    $id_medico = addslashes($_POST['id_medico']);
	    $id_paciente = addslashes($last_id);
	    $data = addslashes($_POST['data']);
	    $tipotrabalho = addslashes($_POST['tipotrabalho']);
	    $descricao = addslashes($_POST['descricao']);

    	if($u->msgErro == "")//Ligação com sucesso
    	{
    		$u->ligar_BD("dentyges_projeto","localhost","dentyges_admin","dentyGEST2020");
    		if($u->add($id_clinica,$id_medico,$id_paciente,$data,$tipotrabalho,$descricao))
    		{
    			$message = "Encomenda Registada com sucesso!";
    			echo "<script type='text/javascript'>alert('$message');</script>";
    		}
    		else
    		{
    			$message = "Impossível registar encomenda!";
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

