-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 21 Mars 2016 à 00:07
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mikoz`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_article`
--

CREATE TABLE IF NOT EXISTS `t_article` (
`id_article` int(11) NOT NULL,
  `titre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `date_article` date NOT NULL,
  `contenu` text CHARACTER SET latin1 NOT NULL,
  `fk_login` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `t_article`
--

INSERT INTO `t_article` (`id_article`, `titre`, `date_article`, `contenu`, `fk_login`) VALUES
(1, 'Titre', '2016-01-23', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.\r\nNunc viverra imperdiet enim. Fusce est. Vivamus a tellus.\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.\r\n\r\n', 'test'),
(4, 'Test img', '2016-02-10', '<img src="../Albums/Graffiti/MaSignature.jpg">', 'Guilhem'),
(5, 'aaaaa', '2016-03-20', 'aaa', 'Guilhem'),
(9, 'gras', '2016-03-20', '<b>JE suis en gras grace Ã  la balise </b>', 'Guilhem'),
(10, 'Le groupe du coin', '2016-03-21', 'Si un jour, vous voyez une affiche annonÃ§ant un concert par\r\n\r\nÂ« le groupe du coin Â»,\r\n\r\nnâ€™hÃ©sitez, prenez le temps de les Ã©couter ils valent vraiment le dÃ©placement.\r\n\r\n3 jeunes chanteurs aveyronnais vous feront dÃ©couvrir le monde Ã  travers leurs chansons:\r\n\r\n<a href="http://bebeduperou.org/?p=81">Video du groupe en action</a>', 'Guilhem'),
(11, 'Encodage', '2016-03-19', '<img src="../Albums/BlaguesDev/martine_utf8.jpg">\r\n\r\nàh môî @ûssi j''écris èn UTF8', 'Guilhem');

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE IF NOT EXISTS `t_users` (
  `login` varchar(25) CHARACTER SET latin1 NOT NULL,
  `password` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_users`
--

INSERT INTO `t_users` (`login`, `password`) VALUES
('admin', 'admin'),
('Guilhem', 'Serene'),
('Soufiane', 'Jaouad'),
('test', 'test'),
('Xavier', 'Mouly');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_article`
--
ALTER TABLE `t_article`
 ADD PRIMARY KEY (`id_article`), ADD KEY `fk_article_users` (`fk_login`);

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
 ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_article`
--
ALTER TABLE `t_article`
MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_article`
--
ALTER TABLE `t_article`
ADD CONSTRAINT `fk_article_users` FOREIGN KEY (`fk_login`) REFERENCES `t_users` (`login`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
