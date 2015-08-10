-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 12 Juin 2013 à 11:40
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `worldplay`
--

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `password`, `isprof`, `blob_styles`, `blob_products`, `create_at`, `update_at`, `token`, `etat`, `avatar`, `domaine`, `admin`) VALUES
(183, 'C1AA4A26-FD19-4198-808D-0DE8A65B1202', 'dorian', 'dorian@yahoo.fr', '6474c6ade84b7bd4c56d9eeef5680287', 'true', NULL, NULL, '2013-03-05 17:44:49', '2013-06-12 08:09:17', '', 1, '', '', 0),
(231, 'E6873EF5-7D30-4270-AE23-9EAD2036183D', 'jrk', 'francis@gmai.com', '47d9dbdeb4730f067d629b26f7780f39', 'false', NULL, NULL, '2013-03-13 11:03:10', '2013-06-12 10:39:21', '', 1, NULL, '', 1),
(232, 'A62B8EF8-B3CA-43AC-C0ED-1FC584DD790A', 'jrk Software', 'jrwSoftware@gmail.com', '721c6ff80a6d3e4ad4ffa52a04c60085', 'true', NULL, NULL, '2013-03-13 11:03:48', '2013-06-11 19:17:34', '', 1, '', '', 0),
(233, '575E904B-E7CA-43E4-8024-AEFE2641CEAC', 'leger foposse', 'leger@yahoo.fr', '721c6ff80a6d3e4ad4ffa52a04c60085', 'true', NULL, NULL, '2013-03-13 11:04:08', '2013-06-11 19:17:34', '', 1, '', '', 0),
(234, 'F6905CEC-9655-4BF3-C4AA-CBFFF318C401', 'anthony Bauer n', 'antony@hotmail.com', '721c6ff80a6d3e4ad4ffa52a04c60085', 'true', NULL, NULL, '2013-03-13 11:07:23', '2013-06-11 19:17:34', '', 1, '', 'Prof de francais', 0),
(238, '139D6FCC-D73D-4D30-AC9D-670C58DD9F49', 'user', 'user@yahoo.fr', '721c6ff80a6d3e4ad4ffa52a04c60085', 'true', NULL, NULL, '2013-03-22 15:23:25', '2013-06-11 19:17:34', '', 1, '', '', 0),
(262, 'EB7748CC-5CC6-48B9-E833-BDDF12FBE629', 'moi', 'moi@gmail.com', '721c6ff80a6d3e4ad4ffa52a04c60085', 'true', NULL, NULL, '2013-03-26 18:36:16', '2013-06-11 19:17:34', '', 1, '', '', 0),
(293, '1B456B72-30DF-400D-FDE6-18C81247663A', 'Moi Francis', 'mouafodor2000@yahoo.fr', '8f8ad28dd6debff410e630ae13436709', 'true', NULL, NULL, '2013-03-27 15:41:56', '0000-00-00 00:00:00', 'bc407bf4a91d61360d035150c4f633ae', 0, '', '', 0),
(294, 'F27E37B9-02CC-4466-A893-2FC81E3322AF', ' magloire', 'magloire@yahoo.fr', '4e7d5f9b14e6b081faea60bb6a2d8ff0', 'false', NULL, NULL, '2013-04-02 12:59:36', '0000-00-00 00:00:00', '14714e7a460299cb459ee64f05f73c13', 0, '', '', 0),
(296, '2D730122-7BC8-481B-B5BD-863450B6B5F9', 'toi', 'toi@yahoo.fr', '501446ac98afd1e291c2498bb817bbd8', 'false', NULL, NULL, '2013-04-02 13:30:24', '0000-00-00 00:00:00', '902bef2a98613fe0b68f22e2d3ce12b3', 0, '', '', 0),
(297, '2ECBF69B-1A04-4813-D8DB-AD1A060CE719', 'pp', 'pp@yhoo.fr', 'c483f6ce851c9ecd9fb835ff7551737c', 'false', NULL, NULL, '2013-04-04 19:04:08', '0000-00-00 00:00:00', 'b62b1f602c753dde88750410de46aa0c', 0, '', '', 0),
(298, 'C846115E-86A7-4281-BF2F-A29F450D952C', 'xxx', 'xxx@yahoo.fr', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'false', NULL, NULL, '2013-04-04 19:58:25', '0000-00-00 00:00:00', 'f819cbd25894c54c397154f5a44e917d', 0, '', '', 0),
(301, 'A1919955-7579-4422-A515-E6B1288E7C1F', 'ccc', 'ccc@yahoo.com', '9df62e693988eb4e1e1444ece0578579', 'false', NULL, NULL, '2013-04-12 19:00:21', '0000-00-00 00:00:00', '6cc8cdc50ff4b9a4b44c46121b269512', 0, '', '', 0),
(304, 'B4A7F3E9-17F9-4537-CC70-B1A44D8D9888', 'mane', 'mane@yahoo.com', 'd41d8cd98f00b204e9800998ecf8427e', 'false', NULL, NULL, '2013-04-12 19:10:48', '0000-00-00 00:00:00', '9d782b8f76f23889d9e1fe7fb926dbd2', 0, '', '', 0),
(307, '63D26B12-88E6-478F-C786-2C2AAF2E28BF', 'magson', 'pppmagloire@yahoo.com', '340330411ff0a53399d4128362dd7dd4', 'false', NULL, NULL, '2013-04-12 19:29:59', '2013-04-30 12:03:51', 'cb72a90e2abbb3f162348b4e3c78d48f', 1, '', '', 0),
(308, 'F5A93564-1643-4050-C39C-0F2CE6F8DCA3', 'lll', 'lll@yahoo.com', 'd41d8cd98f00b204e9800998ecf8427e', 'false', NULL, NULL, '2013-04-12 20:39:22', '2013-04-25 16:01:00', 'cee05af8c99016f123e751057517da2f', 1, '', '', 0),
(310, 'A181E8A1-9075-4038-9700-2BCC151B9299', 'kkk', 'kkk@yahoo.com', 'd41d8cd98f00b204e9800998ecf8427e', 'false', NULL, NULL, '2013-04-15 11:56:05', '0000-00-00 00:00:00', 'a282caa989b88dd2becbb4aa20ffa1c2', 0, '', '', 0),
(311, 'BC0A1615-7398-427A-D21F-BBCDF013AC80', 'kaka', 'kaka@yahoo.com', 'd41d8cd98f00b204e9800998ecf8427e', 'false', NULL, NULL, '2013-04-15 11:57:15', '2013-05-30 13:16:33', 'dfcff05d3661d870d3aba432d10bf288', 0, '', '', 0),
(312, 'D6F6D184-E7DF-4664-F1F8-537AEB667782', 'magloire', 'magloire@yahho.com', 'd41d8cd98f00b204e9800998ecf8427e', 'false', NULL, NULL, '2013-04-15 11:59:19', '0000-00-00 00:00:00', '92c104c3abf4349b947f8fc151e44fc8', 0, '', '', 0),
(313, 'B0AC0CC2-FEA5-4DDD-C780-2E32BD0A4DD8', 'lolo', 'pppmagloire@yahoo.fr', 'd6581d542c7eaf801284f084478b5fcc', 'true', NULL, NULL, '2013-04-15 16:16:24', '2013-04-25 16:00:34', '8c3346a1e9d01f18e101fa88fb12b26d', 1, '', '', 0),
(315, '9FF054D9-821E-44C1-ED10-8BC5594C5555', 'tonti', 'dada@yahoo.com', '9da42e7e4868640c89f6ce4beb30ac18', 'false', NULL, NULL, '2013-04-17 16:16:04', '2013-04-25 17:03:35', '70a0fa81574ad5f4efd596cb0a56e7a3', 1, '', '', 0),
(319, '10C0F3DB-6D9E-4D20-AC45-8573C61AE8D6', 'tonmagloire', 'magloire.magson@facebook.com', 'df8691af9b7247cf8c963b174ddfcb25', 'true', NULL, NULL, '2013-04-29 12:27:47', '0000-00-00 00:00:00', '045642e01ccafe35af489cce7e7a125f', 0, '', '', 0),
(320, 'B075A65D-5175-4AF7-BD14-EA639058D89F', 'laplace', 'mpetnji@software-phone.com', 'c9089f3c9adaf0186f6ffb1ee8d6501c', 'true', NULL, NULL, '2013-04-29 15:52:55', '0000-00-00 00:00:00', '20d9edab568bb3f7fda5ca4a537518a8', 0, '', '', 0),
(321, 'B9AAA342-7FC0-4EEF-B452-30B77A2FE4C7', 'petnji', 'petnji@mag.com', 'e10adc3949ba59abbe56e057f20f883e', 'true', NULL, NULL, '2013-04-29 16:36:50', '0000-00-00 00:00:00', 'bab5d6aded6348b5afac40e50a0e24e1', 0, '', '', 0),
(322, '78F64688-176C-4CC4-8861-590D4B1414A8', 'pascalo', 'pascalo@yahoo.fr', 'f6122c971aeb03476bf01623b09ddfd4', 'false', NULL, NULL, '2013-05-03 16:47:39', '2013-05-28 10:49:18', 'a94bd9dca53bb0aa38663c3375f1bd27', 0, '', '', 0),
(324, 'F17805BB-7911-4760-9370-2C7C6A10A38C', 'Ma', 'dorianmouafo@gmail.com', 'b74df323e3939b563635a2cba7a7afba', 'true', NULL, NULL, '2013-05-08 18:30:54', '0000-00-00 00:00:00', 'c73a303a6f8f5a2f3700e48ca92c1aff', 0, '', '', 0),
(325, '5FA30ADB-C044-45C3-8A70-12F8D0E93718', 'bbgat', 'aas@yahoo.fr', '522748524ad010358705b6852b81be4c', 'true', NULL, NULL, '2013-05-14 12:44:15', '0000-00-00 00:00:00', '57d3aa7b9116678217d28f3cb763ee6d', 0, '', '', 0),
(326, '2948C37E-BFB3-4265-EE86-83D5DBBE5DD6', 'mop', 'mop@yahoo.fr', 'b7208774faea1d155062bdb773b5f221', 'false', NULL, NULL, '2013-05-14 12:47:12', '0000-00-00 00:00:00', 'fe04e7ec0e6ba9e5ded73bce6408a87f', 0, '', '', 0),
(327, '9CC46E1E-A851-41D5-D15D-8DEC81622273', 'xs', 'zz@gmail.com', '03c7c0ace395d80182db07ae2c30f034', 'true', NULL, NULL, '2013-05-15 16:08:42', '0000-00-00 00:00:00', '68c353c462e8c28a47075ba5db446171', 0, '', '', 0),
(329, 'CE1D0918-48D5-4C41-D952-550285D47A7B', 'papoul', 'papoul@gmail.com', '5109d85d95fece7816d9704e6e5b1279', 'true', NULL, NULL, '2013-05-15 16:27:57', '0000-00-00 00:00:00', 'fcf030c548c173cb43e1b9ce855f3ecc', 0, '', '', 0),
(330, '399BF07D-B48E-4BC3-E030-BC72119EAB66', 'dd', 'dde@yahoo.fr', '1aabac6d068eef6a7bad3fdf50a05cc8', 'true', NULL, NULL, '2013-05-16 11:54:08', '0000-00-00 00:00:00', '0a9b729f2f36e37ee6a29718f4b7731f', 0, '', '', 0),
(331, 'BE0911A3-68E7-43D1-E4F3-94BF335A4BF2', 'paul', 'paul@gmail.com', '6c63212ab48e8401eaf6b59b95d816a9', 'true', NULL, NULL, '2013-05-16 13:23:09', '2013-05-16 11:25:36', 'edb69b67c7f2df8ce34333b1a085603c', 1, '', '', 0),
(332, '8E6B5830-3F2D-47DC-C689-196E819606BB', 'ssSS', 'xxsss@yahoo.fr', '3691308f2a4c2f6983f2880d32e29c84', 'true', NULL, NULL, '2013-06-05 16:49:08', '0000-00-00 00:00:00', '57aa92e5139de566d6ca691c874d425d', 0, 0x64617461312e646f6378, 'ss', 0),
(333, 'B9A28001-870A-48AD-A068-187BEC82272D', 'gtrs', 'xxxxxxxx@yahoo.fr', '03806f268e34cf63ef9440ae24cf4580', 'true', NULL, NULL, '2013-06-05 17:50:17', '0000-00-00 00:00:00', '48949f8bc92ac601e9ddd677bef3fd7b', 0, 0x446f63756d656e7420706f7572206c652070726f6a657420576f726c6420706c617920706172746965207365727665722e646f6378, 'testtt', 0),
(334, '63B55FC4-A200-4378-85A2-D983E4174DE1', 'aaa', 'oooo@yahoo.fr', '44d610b3325b4aa08f32d925bc693149', 'true', NULL, NULL, '2013-06-05 18:21:50', '0000-00-00 00:00:00', '6d3052c0f6aaf34c3c2c37e59e9b0e27', 0, 0x646f63756d656e74206176616e63656d656e742070726f6a65742e646f6378, 'xs', 0),
(335, 'F2E79556-71B2-41EE-DF70-70AE7B41BF18', 'xc', 'ddu@yahoo.fr', '831c4baa8a44083a6434b892d573846b', 'true', NULL, NULL, '2013-06-12 11:33:59', '0000-00-00 00:00:00', '09cb12409aab8f2258bf5174c5d45ab8', 0, NULL, 'xc', 0);
