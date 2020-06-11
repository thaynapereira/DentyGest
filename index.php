<?php
    if($_SERVER["HTTPS"] != "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
	require_once 'user.php';
	$u = new user;
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=0.8, shrink-to-fit=no">
    	<title>DentyGest</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    
    <style>

    	body{
    		background: url(Imagens/wall.jpg);
    		background-size: cover;
    		background-repeat: no-repeat;
    		font-family: sans-serif;
    		background-attachment: fixed;
    	}
    	
    	html{ height:100%;}
    
    	.logo{text-align: center;}
    
    	.loginbox{
    		width: 450px;
    		height: 475px;
    		background: #e0e0e0;
    		color: #FFF;
    		left: 50%;
    		top: 62%;
    		position: absolute;
    		transform: translate(-50%,-50%);
    		box-sizing: border-box;
    		padding: 70px 30px;
    		border-radius: 20px;
    	}
    
    	.avatar{
    		border-radius: 50%;
    		position: absolute;
    		top: 15px;
    		left: calc(50% - 50px);
    	}
    
    	.loginbox input{
    		width: 100%;
    		margin-bottom: 20px;
    	}
    
    	.loginbox input[type="text"] , input[type="password"]{
    		border:none;
    		border-bottom: 1px solid #fff;
    		background: transparent;
    		outline: none;
    		height: 40px;
    		color: #fff
    		font-size: 12px;
    	}
    
    	.loginbox input[type="submit"]{
    		border:none;
    		outline: none;
    		height: 40px;
    		background: #1e9ee8;
    		color: #fff;
    		font-size: 18px;
    		border-radius: 20px;
    	}
    
    	.loginbox p{
    		margin: 10;
    		padding: 10;
    		font-weight: bold;
    		color: black;
    	}
    
    	.loginbox h1{
    		margin: 10;
    		padding: 0px;
    		font-weight: bold;
    		color: black;
    	}
    
    	.loginbox input[type="submit"]:hover{
    		cursor: pointer;
    		background: #036dab;
    		color: #FFF;
    	}
    
    	.loginbox a{
    		text-decoration:none;
    		font-size: 12px;
    		line-height: 20px;
    		color: black;
    	}
	
</style>

<body>
    
	<div class="logo">
		<img src="Imagens/logo.png" class="Logo" width="350" height="180" alt="logo">
	</div>

	<div class="loginbox">
		<img src="Imagens/ava2.png" width="100" height="100" class="avatar">
		<h1>   </h1>
		<h1>Login</h1>
		<form method="POST">
			<p> Username </p>
			<input type="text" name="username" placeholder="Username">
			<p> Password </p>
			<input type="password" name="password" placeholder="Senha">
			<input onclick="window.location.href = 'menu.php';" type="submit" value="Entrar">
			<a href="registar_medico.php">Ainda não está registado?<strong> Registe-se!</strong></a>
		</form>
	</div>



<?php
if(isset($_POST['username']))
{
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);

    if($username == "admin" && $password == "admin")
	{
	    $u->login_admin($username,$password);
		header("location: admin.php");
	}
	else
	{
	    if(!empty($username) && !empty($password))
		{
			$u->ligar_BD("dentyges_projeto","localhost","dentyges_admin","dentyGEST2020");
			if($u->msgErro == "")
			{
				if($u->login_medico($username,$password))
				{
					header("location: menu.php");
				}
				else
				{
					if($u->login_clinica($username,$password))
					{
						header("location: menu.php");
					}
					else
					{
					    $message = "User e/ou Password Errados!";
		                echo "<script type='text/javascript'>alert('$message');</script>";
					}
					
				}
			}
			else
			{
				echo "Erro: ".$u->msgErro;
			}
		}
		else
		{
			$message2 = "Preencha todos os campos!";
			echo "<script type='text/javascript'>alert('$message2');</script>";
		}
	}
}

?>
</body>
</html>
