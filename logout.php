<?php
	session_start();
	session_unset();
	session_destroy();
	    echo "<script type='text/javascript'>
		var message = 'Sessão Terminada com sucesso!';
		if (message)
   		 alert(message);
	</script>";
	header("refresh:0.000001; url=index.php");
?>


