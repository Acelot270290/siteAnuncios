-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 27-Set-2021 às 18:06
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `anuncios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `anuncio_id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_user_id` int(11) UNSIGNED NOT NULL,
  `anuncio_codigo` longtext NOT NULL,
  `anuncio_titulo` varchar(255) NOT NULL,
  `anuncio_descricao` longtext NOT NULL,
  `anuncio_categoria_pai_id` int(11) NOT NULL,
  `anuncio_categoria_id` int(11) NOT NULL,
  `anuncio_preco` decimal(15,2) NOT NULL,
  `anuncio_localizacao_cep` varchar(15) NOT NULL,
  `anuncio_logradouro` varchar(255) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_cidade` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_estado` varchar(2) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro_metalink` varchar(50) DEFAULT NULL,
  `anuncio_cidade_metalink` varchar(50) DEFAULT NULL,
  `anuncio_data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `anuncio_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `anuncio_publicado` tinyint(1) DEFAULT '0' COMMENT 'Publicado ou não',
  `anuncio_situacao` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Novo ou usado',
  PRIMARY KEY (`anuncio_id`),
  KEY `fk_anuncio_user_id` (`anuncio_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`anuncio_id`, `anuncio_user_id`, `anuncio_codigo`, `anuncio_titulo`, `anuncio_descricao`, `anuncio_categoria_pai_id`, `anuncio_categoria_id`, `anuncio_preco`, `anuncio_localizacao_cep`, `anuncio_logradouro`, `anuncio_bairro`, `anuncio_cidade`, `anuncio_estado`, `anuncio_bairro_metalink`, `anuncio_cidade_metalink`, `anuncio_data_criacao`, `anuncio_data_alteracao`, `anuncio_publicado`, `anuncio_situacao`) VALUES
(3, 5, '91524637', 'Gol G7', 'Completo, IPVA pago e vistoriado', 2, 6, '25000.00', '25615-142', 'Rua Brigadeiro Castrioto', 'Provisória', 'Petrópolis', 'RJ', 'provisoria', 'petropolis', '2021-09-24 16:08:09', '2021-09-24 16:08:35', 1, 1),
(4, 11, '63859012', 'Câmera Nikon d3100', 'Câmera nova e pronto para usar', 11, 28, '1200.00', '25780-000', '', '', 'São José do Vale do Rio Preto', 'RJ', '', 'sao-jose-do-vale-do-rio-preto', '2021-09-24 16:32:30', '2021-09-24 16:52:44', 1, 0),
(5, 12, '57031698', 'IBANEZ GIO GRX70', 'Pronta Entrega, pouco tempo de uso', 13, 29, '1780.00', '25615-131', 'Rua Doutor Bonjean', 'Provisória', 'Petrópolis', 'RJ', 'provisoria', 'petropolis', '2021-09-24 16:36:54', '2021-09-24 16:52:54', 1, 1),
(6, 13, '82435107', 'Iphone 11', 'Iphones novos com nota fiscal', 16, 27, '4500.00', '25615-142', 'Rua Brigadeiro Castrioto', 'Provisória', 'Petrópolis', 'RJ', 'provisoria', 'petropolis', '2021-09-24 16:40:34', '2021-09-24 16:53:06', 1, 0),
(7, 14, '53896247', 'Jeep Compass 2021', 'Carro com IPVA pago e vistoriado', 2, 6, '108000.00', '22060-001', 'Avenida Nossa Senhora de Copacabana', 'Copacabana', 'Rio de Janeiro', 'RJ', 'copacabana', 'rio-de-janeiro', '2021-09-24 16:44:55', '2021-09-24 16:53:17', 1, 1),
(8, 15, '83791024', 'Criação de sites', 'Crio o seu site completo', 17, 7, '1500.00', '25615-131', 'Rua Doutor Bonjean', 'Provisória', 'Petrópolis', 'RJ', 'provisoria', 'petropolis', '2021-09-24 16:48:32', '2021-09-24 16:53:27', 1, 0),
(9, 16, '36421978', 'Red Dead Redemption 2', 'Jogo novo e lacrado', 5, 25, '75.00', '22710-325', 'Rua Frei Luiz Alevato', 'Taquara', 'Rio de Janeiro', 'RJ', 'taquara', 'rio-de-janeiro', '2021-09-24 16:52:13', '2021-09-24 16:53:36', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_fotos`
--

DROP TABLE IF EXISTS `anuncios_fotos`;
CREATE TABLE IF NOT EXISTS `anuncios_fotos` (
  `foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `foto_anuncio_id` int(11) DEFAULT NULL,
  `foto_nome` varchar(255) NOT NULL,
  PRIMARY KEY (`foto_id`),
  KEY `fk_foto_anuncio_id` (`foto_anuncio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios_fotos`
--

INSERT INTO `anuncios_fotos` (`foto_id`, `foto_anuncio_id`, `foto_nome`) VALUES
(130, 3, '55d7327d0ebdc73ee7f4423841f745dd.jpg'),
(131, 3, '4e6489ae3fd5629e3ec880128c2d9e6d.jpg'),
(132, 3, 'a9a792d6dfe6b0b63a3a35d2de4dcaba.jpg'),
(153, 4, 'c43252530bcd70f22febed15b78387d8.jpg'),
(154, 4, 'd656d2ffddf2baddf38e8880c9ae0712.jpg'),
(155, 4, '5a0b8ccfadb7e771984af255a1d9e01f.jpg'),
(156, 5, '8edaaf42b622a57b780685c1aa631c34.jpg'),
(157, 5, 'b7405cf8c3a92894a7b0fcb429582563.jpg'),
(158, 5, '60a37fe42d1b8a268fbe15fe279162a4.jpg'),
(159, 6, '020f5cef7ea391409f3935cf068519c6.jpg'),
(160, 6, '2b2d28e91b344d654ed0bbcca6ae6dba.jpg'),
(161, 6, '61ceafc63ba0b754e316ef340d1db8a8.png'),
(162, 7, 'b36d3dcc305510c4cb0baa2ab6fb954a.jpg'),
(163, 7, 'd01a152cd6d2764dc0587f751ae05707.jpg'),
(164, 7, '93c6cce942f857b1f6dee32646fc5625.jpeg'),
(165, 8, 'ae44ff453d33819c45f49cd3c44515e5.jpg'),
(166, 8, '9ef9ca46f14d64eb7b29e4423c502b7e.jpg'),
(167, 9, 'ee4c5675ccd5ae4351a647020f3f7504.jpg'),
(168, 9, '9aaa8dc1aa57b265af60171c03199d6e.jpg'),
(169, 9, '98c3d45bf1e6c6f4c7a4202fafaf9ced.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_pai_id` int(11) DEFAULT NULL,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_meta_link` varchar(100) DEFAULT NULL,
  `categoria_data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoria_id`),
  KEY `categoria_pai_id` (`categoria_pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_pai_id`, `categoria_nome`, `categoria_ativa`, `categoria_meta_link`, `categoria_data_criacao`, `categoria_data_alteracao`) VALUES
(1, 5, 'Teclado Simples', 0, 'teclado-simples', '2021-09-10 13:57:22', '2021-09-10 16:41:34'),
(3, 2, 'teste', 1, 'teste', '2021-09-10 16:42:00', '2021-09-10 16:55:13'),
(4, 5, 'Memória Ram', 1, 'memoria-ram', '2021-09-10 16:54:24', '2021-09-10 16:54:57'),
(5, 5, 'Controles', 1, 'controles', '2021-09-13 16:34:38', NULL),
(6, 2, 'Carros', 1, 'carros', '2021-09-23 16:47:25', NULL),
(7, 17, 'Desenvolvimento Web e Mobile', 1, 'desenvolvimento-web-e-mobile', '2021-09-24 14:16:50', NULL),
(8, 5, 'Acessórios gamer', 1, 'acessorios-gamer', '2021-09-24 14:17:17', NULL),
(9, 10, 'Moda Masculina', 1, 'moda-masculina', '2021-09-24 14:17:39', NULL),
(10, 10, 'Moda Feminina', 1, 'moda-feminina', '2021-09-24 14:17:53', NULL),
(11, 6, 'Correntes e Colares', 1, 'correntes-e-colares', '2021-09-24 14:18:16', NULL),
(12, 6, 'Pulseiras', 1, 'pulseiras', '2021-09-24 14:18:32', NULL),
(13, 6, 'Anéis', 1, 'aneis', '2021-09-24 14:18:43', NULL),
(14, 6, 'Relógio Masculino', 1, 'relogio-masculino', '2021-09-24 14:18:58', NULL),
(15, 6, 'Relógio Fermino', 1, 'relogio-fermino', '2021-09-24 14:19:13', NULL),
(16, 8, 'Cursos', 1, 'cursos', '2021-09-24 14:19:41', NULL),
(17, 17, 'Reparos de Computadores', 1, 'reparos-de-computadores', '2021-09-24 14:20:09', NULL),
(18, 17, 'Eventos e Festas', 1, 'eventos-e-festas', '2021-09-24 14:20:29', NULL),
(19, 17, 'Serviços Domésticos', 1, 'servicos-domesticos', '2021-09-24 14:20:50', NULL),
(20, 17, 'Cuidador e babá', 1, 'cuidador-e-baba', '2021-09-24 14:21:05', NULL),
(21, 14, 'Moveis para sua casa', 1, 'moveis-para-sua-casa', '2021-09-24 14:21:34', NULL),
(22, 11, 'Televisores', 1, 'televisores', '2021-09-24 14:21:49', NULL),
(23, 5, 'Xbox 360', 1, 'xbox-360', '2021-09-24 14:22:14', NULL),
(24, 5, 'Xbox One', 1, 'xbox-one', '2021-09-24 14:22:28', NULL),
(25, 5, 'Jogos', 1, 'jogos', '2021-09-24 14:23:04', NULL),
(26, 16, 'Telefones', 1, 'telefones', '2021-09-24 14:23:21', NULL),
(27, 16, 'Celulares', 1, 'celulares', '2021-09-24 14:23:33', NULL),
(28, 11, 'Cameras', 1, 'cameras', '2021-09-24 16:30:52', NULL),
(29, 13, 'Guitarra', 1, 'guitarra', '2021-09-24 16:34:17', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_pai`
--

DROP TABLE IF EXISTS `categorias_pai`;
CREATE TABLE IF NOT EXISTS `categorias_pai` (
  `categoria_pai_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_pai_nome` varchar(45) NOT NULL,
  `categoria_pai_ativa` tinyint(1) DEFAULT NULL,
  `categoria_pai_meta_link` varchar(100) DEFAULT NULL,
  `categoria_pai_classe_icone` varchar(50) NOT NULL,
  `categoria_pai_data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_pai_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoria_pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias_pai`
--

INSERT INTO `categorias_pai` (`categoria_pai_id`, `categoria_pai_nome`, `categoria_pai_ativa`, `categoria_pai_meta_link`, `categoria_pai_classe_icone`, `categoria_pai_data_criacao`, `categoria_pai_data_alteracao`) VALUES
(2, 'Veículos', 1, 'veiculos', 'lni-car', '2021-09-09 17:21:46', '2021-09-25 13:15:25'),
(5, 'Games', 1, 'games', 'lni-game', '2021-09-10 13:51:38', '2021-09-25 13:16:02'),
(6, 'Jóias e relógios', 1, 'joias-e-relogios', 'lni-alarm-clock', '2021-09-24 14:09:28', NULL),
(7, 'Imóveis', 1, 'imoveis', 'lni-apartment', '2021-09-24 14:10:04', NULL),
(8, 'Cursos e Treinamentos', 1, 'cursos-e-treinamentos', 'lni-graduation', '2021-09-24 14:10:41', NULL),
(9, 'Eletrodomésticos', 1, 'eletrodomesticos', 'lni-agenda', '2021-09-24 14:11:15', NULL),
(10, 'Moda', 1, 'moda', 'lni-tshirt', '2021-09-24 14:11:41', NULL),
(11, 'Áudio, TV, vídeo e fotografia', 1, 'audio-tv-video-e-fotografia', 'lni-video', '2021-09-24 14:12:20', NULL),
(12, 'Acessórios para Celulares', 1, 'acessorios-para-celulares', 'lni-control-panel', '2021-09-24 14:13:03', '2021-09-24 14:13:14'),
(13, 'Instrumentos Musicais', 1, 'instrumentos-musicais', 'lni-music', '2021-09-24 14:14:02', NULL),
(14, 'Para sua Casa', 1, 'para-sua-casa', 'lni-home', '2021-09-24 14:14:40', NULL),
(15, 'Cameras e Acessórios', 1, 'cameras-e-acessorios', 'lni-camera', '2021-09-24 14:15:02', NULL),
(16, 'Celulares e Telefones', 1, 'celulares-e-telefones', 'lni-mobile', '2021-09-24 14:15:35', NULL),
(17, 'Serviços', 1, 'servicos', 'lni-hammer', '2021-09-24 14:15:54', '2021-09-25 13:16:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador'),
(2, 'Anunciantes', 'Anunciantes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(13, '::1', 'Manuella Marques', 1632501672),
(14, '::1', 'Manuella Marques', 1632501681),
(15, '::1', 'Manuella Marques', 1632501708);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

DROP TABLE IF EXISTS `sistema`;
CREATE TABLE IF NOT EXISTS `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_titulo` varchar(255) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_bairro` varchar(100) NOT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_titulo`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_bairro`, `sistema_cidade`, `sistema_estado`, `sistema_data_alteracao`) VALUES
(1, 'Anuncios Inc', 'Anúncios legais', '80.838.809/0001-26', '683.90228-49', '(24) 2231-8039', '(24) 99232-3522', 'contato@infoanuncios.com.br', 'Anuncie aqui', '25615-131', 'Dr.Bojean', '1042', 'Provisória', 'Petrópolis', 'RJ', '2021-09-22 13:58:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_foto` varchar(250) DEFAULT NULL,
  `user_cpf` varchar(15) DEFAULT NULL,
  `user_cep` varchar(9) NOT NULL,
  `user_endereco` varchar(250) NOT NULL,
  `user_numero_endereco` varchar(50) NOT NULL,
  `user_bairro` varchar(50) NOT NULL,
  `user_cidade` varchar(50) NOT NULL,
  `user_estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `user_foto`, `user_cpf`, `user_cep`, `user_endereco`, `user_numero_endereco`, `user_bairro`, `user_cidade`, `user_estado`) VALUES
(3, '::1', NULL, '$2y$12$EGgL9HsVay3YpBD7N.gN1uLZdUhGQYOb9P7g/qqk2j21KXRu1Z6GS', 'teste@adsites.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1630953486, 1632575707, 1, 'Acelot', 'Diniz', NULL, '(24) 2224-6223', '8db47dc2764e22fae2e36627d4f3abdd.jpg', '074.325.660-38', '25780-000', 'Camboatá', '288', 'Camboatá', 'São José do Vale do Rio Preto', 'RJ'),
(5, '::1', NULL, '$2y$10$wAYI3v9sPsTta.UONbFz1.F/wwINNWg2Dc7O2fVFWIZH9iNTV8uhm', 'alan.diniz@ucp.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1631297464, 1632499459, 1, 'Alan', 'Diniz', NULL, '(24) 2231-8039', 'ac3342502971620d252a816fd8981402.jpg', '302.235.490-88', '25615-142', 'Rua Brigadeiro Castrioto', '1042', 'Provisória', 'Petrópolis', 'RJ'),
(10, '::1', NULL, '$2y$10$hrsfYBsPSzTJMXthF5E8XutDMF4fyWg4gJA0RDba7yyGfnnkgTsUK', 'teste5414@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632492253, NULL, 1, 'michel', 'DIniz', NULL, '(24) 6223-8031', 'd1b2efeeb808a1abaa8150820e27715d.jpg', '822.864.630-50', '25615-142', 'Rua Brigadeiro Castrioto', '1048', 'Provisória', 'Petrópolis', 'RJ'),
(11, '::1', NULL, '$2y$10$antE5Lvxn64yG5HOL3kar.11RINIqj24TIFFDs1XGpktK6mbiq3ye', 'isabela2815@tinilalo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500357, 1632500863, 1, 'Isabela', 'Joana', NULL, '(21) 2246-0570', '2c298a9970e6c4315683a1f29dd29a30.jpg', '468.262.820-89', '25780-000', 'Camboatá', '100', 'Camboatá', 'São José do Vale do Rio Preto', 'RJ'),
(12, '::1', NULL, '$2y$10$QKi.zZV1aUiJmQbRAL4VketsxcV40E8Y2kULw8cBfBU23ePn8jLYq', 'j1705@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500446, 1632501197, 1, 'Jonatham', 'Ferreira', NULL, '(24) 2235-0678', '08e5dd4ec54bf22f6f381e86a14f3fe0.jpg', '473.788.460-07', '25680-276', 'Avenida Barão do Rio Branco', '105', 'Centro', 'Petrópolis', 'RJ'),
(13, '::1', NULL, '$2y$10$ow7DEEiXZwGZu2lDmjr4TeBqultdOYiZQwchWmyb9mXovR2PTq.g.', 'maicon.vares27@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500576, 1632501462, 1, 'Maicon', 'varez', NULL, '(24) 2231-8702', '5ea096d243b8dfab38b09aafb51c0dac.jpg', '901.747.200-68', '23548-013', 'Travessa 1', '1780', 'Sepetiba', 'Rio de Janeiro', 'RJ'),
(14, '::1', NULL, '$2y$10$xTrXeo3dQyuIHlgVMnKyY.iSLQHQ28/asxj8x5DivrSE.qrVrIFgi', 'manu.marques@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500671, 1632501723, 1, 'Manuella', 'Marques', NULL, '(24) 99232-5502', '7af00544268869bc6ed8d1dc929b659d.jpg', '092.548.460-15', '22020-020', 'Rua Duvivier', '173', 'Copacabana', 'Rio de Janeiro', 'RJ'),
(15, '::1', NULL, '$2y$10$LRgRAC8MD5tQR.cEwLckvegi/q.NR/aX0o3m8Bx8D63mPRnPONZRe', 'marcelodiniz324@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500762, 1632502006, 1, 'Marcelo', 'Diniz', NULL, '(24) 2224-7854', 'b1c9666e4f4f436735b597ab7fcb4e14.jpg', '925.286.270-68', '21910-030', 'Rua Chapot Prevost', '254', 'Freguesia (Ilha do Governador)', 'Rio de Janeiro', 'RJ'),
(16, '::1', NULL, '$2y$10$mGHxbUr9GOeFooVVV5a5y.nOEGkxFJ./CLbjoBE3.96QtxeGk7xmi', 'Pedro.doido@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1632500832, 1632502239, 1, 'Pedro', 'Cabral', NULL, '(21) 5545-6535', '6834a16768cd2d46a9fa8e0f997d435e.jpg', '240.989.920-00', '21820-020', 'Rua Bangu', '254', 'Bangu', 'Rio de Janeiro', 'RJ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(18, 3, 1),
(28, 5, 2),
(33, 10, 2),
(34, 11, 2),
(35, 12, 2),
(36, 13, 2),
(40, 14, 2),
(38, 15, 2),
(39, 16, 2);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anuncio_user_id` FOREIGN KEY (`anuncio_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD CONSTRAINT `fk_foto_anuncio_id` FOREIGN KEY (`foto_anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_pai_id` FOREIGN KEY (`categoria_pai_id`) REFERENCES `categorias_pai` (`categoria_pai_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
