-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 05-Jun-2020 às 19:19
-- Versão do servidor: 5.7.30-cll-lve
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dentyges_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinica`
--

CREATE TABLE `clinica` (
  `id_Clinica` int(11) NOT NULL,
  `Nome` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Morada` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `Email` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `Contacto` int(9) NOT NULL,
  `User` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `clinica`
--

INSERT INTO `clinica` (`id_Clinica`, `Nome`, `Morada`, `Email`, `Contacto`, `User`, `Password`) VALUES
(4, 'Sanus15', 'Rua 15 de Agosto n15', 'sanus15@outlook.pt', 912387584, 'sanus15', 'sanus15'),
(5, 'Almedina', 'Rua da Alegria n21', 'almedina@gmail.com', 926340007, 'almedina', 'almedina'),
(7, 'Smileup', 'Fernão Magalhaes', 'smileup@gmail.com', 123456789, 'smileup', '123'),
(8, 'Fernão Magalhães', 'Fernão Magalhães', 'fm@gmail.com', 123123123, 'fm', '123'),
(9, 'Dental House', 'Av. Fernão Magalhães', 'dentalhouse@gmail.com', 123456123, 'dentalhouse', '12345'),
(10, 'Delille', 'Coimbra', 'delille@gmail.com', 123132441, 'delille', 'delille'),
(11, 'GanhaSorriso', 'Condeixa', 'ganhasorriso@gmail.com', 123456123, 'ganhasorriso', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinica_has_medico`
--

CREATE TABLE `clinica_has_medico` (
  `Clinica_id_Clinica` int(11) NOT NULL,
  `Medico_id_Medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE `encomenda` (
  `id_Encomenda` int(11) NOT NULL,
  `Clinica_id_Clinica` int(11) DEFAULT NULL,
  `Medico_id_Medico` int(11) DEFAULT NULL,
  `Paciente_id_Paciente` int(11) DEFAULT NULL,
  `Data` date NOT NULL,
  `Tipo_Trabalho_id_Tipo_Trabalho` int(11) NOT NULL,
  `Descricao` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `encomenda`
--

INSERT INTO `encomenda` (`id_Encomenda`, `Clinica_id_Clinica`, `Medico_id_Medico`, `Paciente_id_Paciente`, `Data`, `Tipo_Trabalho_id_Tipo_Trabalho`, `Descricao`) VALUES
(25, 4, NULL, 7, '2020-05-14', 1, 'TESTE'),
(31, NULL, 4, 14, '2020-05-14', 1, 'Teste1'),
(32, NULL, 4, 15, '2020-05-14', 3, 'Teste2'),
(35, 4, 7, 15, '2020-06-04', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `id_Medico` int(11) NOT NULL,
  `Nome` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Morada` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `Email` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `Contacto` int(9) NOT NULL,
  `User` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Nome_Clinica` varchar(45) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id_Medico`, `Nome`, `Morada`, `Email`, `Contacto`, `User`, `Password`, `Nome_Clinica`) VALUES
(1, 'Tiago Balhau', 'Rua 15 de Agosto, nº15, Ribeira de Frades', 'tiagobalhau@hotmail.com', 123456789, 'tiagobalhau', '12345', NULL),
(2, 'João Canelas', 'Ribeira de Frades', 'jfcanelas@live.com.pt', 987654321, 'joaocanelas', '54321', NULL),
(4, 'Julieta', 'Coimbra', 'julieta@gmail.com', 123456789, 'julieta', '12345', NULL),
(7, 'Ines Marcelino', 'Antuzede', 'ines@gamil.com', 123432123, 'ines', '1234', NULL),
(20, 'Isabel', 'Figueira da Foz', 'isabel@gmail.com', 123456789, 'isabel', '1234', 'Sanus15'),
(23, 'manuel', 'miranda', 'manuel@gmail.com', 123456789, 'manuel', '123', 'Smileup'),
(25, 'teste123', 'Teste', 'a@xyz.pt', 239000000, 'teste123', 'teste123', 'Almedina'),
(26, 'Manuel Rosa', 'Coimbra', 'massnrosa@gmail.com', 121323213, 'massnrosa', 'manel', 'Delille'),
(28, 'João', 'asdad', 'afsafa@gama.ds', 123124142, 'j', 'pass', 'Fernao Magalhaes'),
(29, 'Paula', 'Rua Capitão Salgueiro Maia 89', 'taynabta@hotmail.com', 916758764, 'thay', 'thay', 'Dental House'),
(30, 'we', 'rua ahaha', 'patayna30@gmail.com', 916523786, 'kk', 'kk', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `id_Paciente` int(11) NOT NULL,
  `Nome` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `paciente`
--

INSERT INTO `paciente` (`id_Paciente`, `Nome`) VALUES
(4, 'Clotilde'),
(5, 'Canelas'),
(6, 'luis'),
(7, 'Mario'),
(14, 'MÃ¡rio'),
(15, 'Luis'),
(16, 'AntÃ³nio'),
(17, 'Ãlvaro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_trabalho`
--

CREATE TABLE `tipo_trabalho` (
  `id_Tipo_Trabalho` int(11) NOT NULL,
  `Nome_Tipo_trabalho` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tipo_trabalho`
--

INSERT INTO `tipo_trabalho` (`id_Tipo_Trabalho`, `Nome_Tipo_trabalho`) VALUES
(1, 'Acrilica'),
(2, 'Esquelética'),
(3, 'Flexivel'),
(4, 'Ortodontica'),
(5, 'P.Fixa'),
(6, 'Implante');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`id_Clinica`,`User`,`Nome`) USING BTREE;

--
-- Índices para tabela `clinica_has_medico`
--
ALTER TABLE `clinica_has_medico`
  ADD PRIMARY KEY (`Clinica_id_Clinica`,`Medico_id_Medico`),
  ADD KEY `fk_Clínica_has_Médico_Médico1` (`Medico_id_Medico`);

--
-- Índices para tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD PRIMARY KEY (`id_Encomenda`),
  ADD KEY `fk_Encomenda_Clínica` (`Clinica_id_Clinica`),
  ADD KEY `fk_Encomenda_Médico1` (`Medico_id_Medico`),
  ADD KEY `fk_Encomenda_Tipo_Trabalho1` (`Tipo_Trabalho_id_Tipo_Trabalho`),
  ADD KEY `fk_Encomenda_Paciente1` (`Paciente_id_Paciente`) USING BTREE;

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_Medico`,`User`,`Nome`) USING BTREE;

--
-- Índices para tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_Paciente`) USING BTREE;

--
-- Índices para tabela `tipo_trabalho`
--
ALTER TABLE `tipo_trabalho`
  ADD PRIMARY KEY (`id_Tipo_Trabalho`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clinica`
--
ALTER TABLE `clinica`
  MODIFY `id_Clinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `encomenda`
--
ALTER TABLE `encomenda`
  MODIFY `id_Encomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id_Medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_Paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tipo_trabalho`
--
ALTER TABLE `tipo_trabalho`
  MODIFY `id_Tipo_Trabalho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clinica_has_medico`
--
ALTER TABLE `clinica_has_medico`
  ADD CONSTRAINT `fk_Clínica_has_Médico_Clínica1` FOREIGN KEY (`Clinica_id_Clinica`) REFERENCES `clinica` (`id_Clinica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clínica_has_Médico_Médico1` FOREIGN KEY (`Medico_id_Medico`) REFERENCES `medico` (`id_Medico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD CONSTRAINT `fk_Encomenda_Clínica` FOREIGN KEY (`Clinica_id_Clinica`) REFERENCES `clinica` (`id_Clinica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_Médico1` FOREIGN KEY (`Medico_id_Medico`) REFERENCES `medico` (`id_Medico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_Paciente1` FOREIGN KEY (`Paciente_id_Paciente`) REFERENCES `paciente` (`id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_Tipo_Trabalho1` FOREIGN KEY (`Tipo_Trabalho_id_Tipo_Trabalho`) REFERENCES `tipo_trabalho` (`id_Tipo_Trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
