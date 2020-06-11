<?php
	require_once 'user.php';
	$u = new user;
	session_start();
	if(!isset($_SESSION['User']) || !isset($_SESSION['User']))
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
    	<meta name="viewport" content="width=device-width, initial-scale=0.6, shrink-to-fit=no">
    	<title>DentyGest</title>
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
    
    	.logout{
    		background: transparent;
    		border: none;
    		font-size: 20px;
    		float: right;
    		padding: 30px 30px;
    		text-align: right;
    	}
    
    	.botoes{
    		display: flex;
    		justify-content: center;
    		align-items: center;
    		margin-top: 150px;
    	}
    
    	.b1{background: #70db70;}
    
    	.b2{background: #ff8533;}
    
    	.b1:hover{
    		cursor: pointer;
    		background: #00b300;
    		transition: 0.5s;
    	}
    	
    	.b2:hover{
    		cursor: pointer;
    		background: #ff6600;
    		transition: 0.5s;
    	}
    
    	.botoes button{
    	    
    		width: 270px;
    		height: 180px;
    		font-size: 25px;
    		color: #fff;
    		border-radius: 20px;
    		box-sizing: border-box;
    		margin-left:25px;
    	}
    
    	.botoes button:active{
      		box-shadow: 0 5px #666;
      		transform: translateY(4px);
    	}
    
    	.botoes button .fas{font-size: 30px;}
    	
    	.logo{cursor: pointer;}
    
    	header .far{font-size: 30px;}
    	
    	@media(max-width: 768px){
    	    
    	    .botoes{
    	        float:left;
    	        display:block;
    	        margin-top:30px;
    	        
    	    }
    	    
    	    .botoes button{
    	    	width: 70%;
    	    	height: 180px;
    		    font-size: 25px;
    		    color: #fff;
    	    	border-radius: 20px;
    		    box-sizing: border-box;
    		    margin-top:40px;
    		    margin-left:100px;
    		    
    	    }
    	}
    	
  
    </style>

<body>
	<img class="logo" src="Imagens/logo.png" height="130" width="280" onclick= "window.location.href = 'menu.php';">
	
	<div class="logout">
		<?php
			if($_SESSION["User"]) {
		?>
		Olá, <?php echo $_SESSION["User"]; }?><br> <a href="logout.php" title="Logout" style="color:#00008B; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout </a>
	</div>
	

	    <div class=" botoes">
    	        <a href="add.php"><button class="b1">Adicionar<br /><br /><i class="fas fa-plus-circle"></i></button></a>
    	        <a href="verinfo.php"><button class="b2">Ver Informação<br /><br /><i class="fas fa-search"></i></button></a>
	    </div>
	    
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