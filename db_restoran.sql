/*
Navicat MySQL Data Transfer

Source Server         : Kashidota
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_restoran

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-01 10:49:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `chef`
-- ----------------------------
DROP TABLE IF EXISTS `chef`;
CREATE TABLE `chef` (
  `id_chef` int(11) NOT NULL AUTO_INCREMENT,
  `nama_chef` varchar(50) NOT NULL,
  `no_telp_chef` varchar(14) NOT NULL,
  `alamat_chef` varchar(50) NOT NULL,
  `jenis_kelamin_chef` varchar(11) NOT NULL,
  `foto_chef` varchar(100) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_chef`),
  KEY `fk_chefjabatan` (`id_jabatan`),
  CONSTRAINT `fk_chefjabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of chef
-- ----------------------------
INSERT INTO `chef` VALUES ('1', 'Renata', '09887706723', 'Bali', 'Perempuan', 'renata.jpg', '1');
INSERT INTO `chef` VALUES ('2', 'Juna', '08234234233', 'Bekasi', 'Laki-laki', 'juna.jpg', '2');
INSERT INTO `chef` VALUES ('3', 'Arnold', '08234234432', 'Bogor', 'Laki-laki', 'arnold.jpg', '3');
INSERT INTO `chef` VALUES ('6', 'Testing', '08234234324', 'Kalimantan', 'Laki-laki', 'Screenshot_17.png', '4');
INSERT INTO `chef` VALUES ('10', 'Sucipto', '08532532533', 'Purwakarta', 'Laki-laki', 'Screenshot_1944.png', '5');
INSERT INTO `chef` VALUES ('12', 'Codeblue', '085861135341', 'Cimahi', 'Laki-laki', 'Codeblue.jpeg', '6');
INSERT INTO `chef` VALUES ('15', 'arul', '085861135341', 'Lembang', 'Laki-laki', 'Screenshot_2.png', '7');
INSERT INTO `chef` VALUES ('16', 'arul', '085861135341', 'Lembang', 'Laki-laki', 'Screenshot_2.png', '8');
INSERT INTO `chef` VALUES ('18', 'arula', '085861135341', 'Lembang', 'Laki-laki', 'Screenshot_5.png', '2');
INSERT INTO `chef` VALUES ('22', 'arul', '085861135341', 'Lembang', 'Laki-laki', 'Screenshot_21.png', '6');

-- ----------------------------
-- Table structure for `jabatan`
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` char(255) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES ('1', 'Chef-Owner');
INSERT INTO `jabatan` VALUES ('2', 'Executive Chef');
INSERT INTO `jabatan` VALUES ('3', 'Sous Chef');
INSERT INTO `jabatan` VALUES ('4', 'Senior Chef');
INSERT INTO `jabatan` VALUES ('5', 'Expediter');
INSERT INTO `jabatan` VALUES ('6', 'Kitchen Manager');
INSERT INTO `jabatan` VALUES ('7', 'Pastry Chef');
INSERT INTO `jabatan` VALUES ('8', 'Saucier');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `foto_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `id_chef` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `id_chef` (`id_chef`),
  CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`id_chef`) REFERENCES `chef` (`id_chef`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Seblak Tulang', 'seblaktulang.jpg', '12000', 'Tulang lunak enak', '1');
INSERT INTO `menu` VALUES ('2', 'Sate Taichan', 'satetaichan.jpg', '20000', 'Sate taichan terenak sebumi raya', '2');
INSERT INTO `menu` VALUES ('3', 'Terang Bulan', 'terangbulan.jpg', '25000', 'Rasa boleh campur aduk', '3');
INSERT INTO `menu` VALUES ('9', 'Soda Bersedih', 'sodagembira.jpg', '19999', 'Soda yang sering dibilang bergembira oleh orang lain apakah dia tak boleh bersedih?', '3');
INSERT INTO `menu` VALUES ('10', 'Caramell Machiato', 'caramelmachiato.jpg', '27000', 'Salah satu menu \'sosialita\' diantara menu yang lainnya', '2');
INSERT INTO `menu` VALUES ('37', 'Ghulam', 'gulam(2).png', '15000', 'Ambis', '2');
INSERT INTO `menu` VALUES ('39', 'Arul', 'WhatsApp Image 2022-11-10 at 11.35.10.jpeg', '10000', 'Mantap', '6');
INSERT INTO `menu` VALUES ('41', 'Blue Ocean Fresh ', 'blue ocean.jpg', '999999', 'Limited Edition', '6');
INSERT INTO `menu` VALUES ('42', 'ef33', 'WhatsApp Image 2022-11-10 at 11.35.10 (1).jpeg', '324', 'fe4', '3');
INSERT INTO `menu` VALUES ('44', 'a', 'Screenshot_1959.png', '2', 'a', '1');
INSERT INTO `menu` VALUES ('45', 'fe', 'Screenshot_1959.png', '22', 'fe', '1');
DELIMITER ;;
CREATE TRIGGER `tr_chef_null` BEFORE INSERT ON `chef` FOR EACH ROW BEGIN
  IF NEW.nama_chef = '' 
  THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Nama chef tidak boleh kosong!';
  END IF;
  IF NEW.no_telp_chef = ''
  THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'No Telp tidak boleh kosong!';
  END IF;
  IF NEW.alamat_chef = ''
  THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Alamat tidak boleh kosong!';
  END IF;
  IF NEW.jenis_kelamin_chef = ''
  THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Jenis Kelamin tidak boleh kosong!';
  END IF;
 END
;;
DELIMITER ;
