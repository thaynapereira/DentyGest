<?php
	Class user
	{
		private $pdo;
		public $msgErro = "";

		public function ligar_BD($nome, $host, $utilizador, $senha)
		{
			global $pdo;
			global $msgErro;
			try {
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$utilizador,$senha);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $e)
			{
			    echo $msgErro = $e->getMessage();
			}
			
		}
		public function registarmedico($nome, $morada, $email, $contacto, $user, $password, $nclinica)
		{
			global $pdo;
			//verificar se Username já existe
			$sql = $pdo->prepare("SELECT id_Medico FROM medico WHERE User = :user");
			$sql->bindValue(":user", $user);
			$sql->execute();

			$sql1 = $pdo->prepare("SELECT id_Medico FROM medico WHERE Email = :email");
			$sql1->bindValue(":email", $email);
			$sql1->execute();

			if($sql->rowCount() > 0 || $sql1->rowCount() > 0)
			{
				return false;//Username/Email já registado
			}
			else
			{
				//Registar
				$sql = $pdo->prepare("INSERT INTO medico (Nome,Morada,Email,Contacto,User,Password,Nome_Clinica) VALUES (:n, :m, :e, :c, :u, :p, :nc)");
				$sql->bindValue(":n", $nome);
				$sql->bindValue(":m", $morada);
				$sql->bindValue(":e", $email);
				$sql->bindValue(":c", $contacto);
				$sql->bindValue(":u", $user);
				$sql->bindValue(":p", $password);
				$sql->bindValue(":nc", $nclinica);
				$sql->execute();
				return true;
			}

		}
		public function registarclinica($nome, $morada, $email, $contacto, $user, $password)
		{
			global $pdo;
			//verificar se Username já existe
			$sql = $pdo->prepare("SELECT id_Clinica FROM clinica WHERE User = :user");
			$sql->bindValue(":user", $user);
			$sql->execute();

			$sql1 = $pdo->prepare("SELECT id_Clinica FROM clinica WHERE Email = :email");
			$sql1->bindValue(":email", $email);
			$sql1->execute();

			if($sql->rowCount() > 0 || $sql1->rowCount() > 0)
			{
				return false;//Username/Email já registado
			}
			else
			{
				//Registar
				$sql = $pdo->prepare("INSERT INTO clinica (Nome,Morada,Email,Contacto,User,Password) VALUES (:n, :m, :e, :c, :u, :p)");
				$sql->bindValue(":n", utf8_decode($nome));
				$sql->bindValue(":m", utf8_decode($morada));
				$sql->bindValue(":e", utf8_decode($email));
				$sql->bindValue(":c", utf8_decode($contacto));
				$sql->bindValue(":u", utf8_decode($user));
				$sql->bindValue(":p", utf8_decode($password));
				$sql->execute();
				return true;
			}

		}
		public function add($id_clinica,$id_medico,$id_paciente,$data,$tipotrabalho,$descricao)
		{
			global $pdo;
			try{
			$sql = $pdo->prepare("INSERT INTO encomenda (Clinica_id_Clinica,Medico_id_Medico,Paciente_id_Paciente,Data,Tipo_Trabalho_id_Tipo_Trabalho,Descricao) VALUES (:idc, :idm, :idp, :data, :tt, :des)");
			if($id_clinica == "")
			{
				$id_clinica = NULL;
			}
			$sql->bindValue(":idc", $id_clinica);			
			if($id_medico == "")
			{
				$id_medico = NULL;
			}
			$sql->bindValue(":idm", $id_medico);
			$sql->bindValue(":idp", $id_paciente);
			$sql->bindValue(":data", $data);
			$sql->bindValue(":tt", $tipotrabalho);
			$sql->bindValue(":des", $descricao);
			$sql->execute();
			return true;

			}
			catch(PDOException $e)
			{
				echo $msgErro = $e->getMessage();
				return false;
			}


		}

		public function login_medico($user, $password)
		{
			global $pdo;
			//verificar user e pass estão registados
			$sql = $pdo->prepare("SELECT User FROM medico WHERE User = :u AND Password = :p");
			$sql->bindValue(":u",$user);
			$sql->bindValue(":p",$password);
			$sql->execute();
			if($sql->rowCount() > 0)
			{
				//Está registado
				$dado = $sql->fetch();
				session_start();
				$_SESSION['User'] = $dado['User'];
				$_SESSION['tipo'] = "medico";
				return true; //Login com sucesso
			}
			else
			{
				return false;
				//Não está registado

			}
		}

		public function login_clinica($user, $password)
		{
			global $pdo;
			global $userm;
			//verificar user e pass estão registados
			$sql = $pdo->prepare("SELECT User FROM clinica WHERE User = :u AND Password = :p");
			$sql->bindValue(":u",$user);
			$sql->bindValue(":p",$password);
			$sql->execute();
			if($sql->rowCount() > 0)
			{
				//Está registado
				$dado = $sql->fetch();
				session_start();
				$_SESSION['User'] = $dado['User'];
				$_SESSION['tipo'] = "clinica";
				return true; //Login com sucesso
			}
			else
			{
				return false;
				//Não está registado

			}
		}
		
		public function login_admin($user, $password)
		{
			global $pdo;
			global $useradmin;
			if($user == "admin" && $password == "admin")
			{
				session_start();
				$_SESSION['User'] = "Administrador";
				$_SESSION['tipo'] = "Administrador";
				return true; //Login com sucesso
			}
			else
			{
				return false;
				//Não está registado

			}
		}
		
}
?>