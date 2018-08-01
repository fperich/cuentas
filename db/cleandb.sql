/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.35 : Database - cuentas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `conceptos_gastos` */

CREATE TABLE `conceptos_gastos` (
  `cod_concepto_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `concepto_gasto` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_concepto_gasto`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Table structure for table `gastos` */

CREATE TABLE `gastos` (
  `cod_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `cod_concepto_gasto` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `pagado` int(11) NOT NULL,
  `valor_minimo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_gasto`),
  KEY `congas` (`cod_concepto_gasto`),
  KEY `ano` (`ano`),
  KEY `mes` (`mes`),
  KEY `cod_gasto` (`cod_gasto`,`ano`,`mes`)
) ENGINE=MyISAM AUTO_INCREMENT=894 DEFAULT CHARSET=utf8;

/*Table structure for table `gastos_detalle` */

CREATE TABLE `gastos_detalle` (
  `cod_gasto` int(11) NOT NULL,
  `cod_detalle` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` bigint(20) NOT NULL,
  `cantidad_cuotas` int(11) NOT NULL,
  `primera_cuota` int(11) NOT NULL,
  `fecha_primera_cuota` date NOT NULL,
  PRIMARY KEY (`cod_gasto`,`cod_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `pagos` */

CREATE TABLE `pagos` (
  `cod_gasto` int(11) NOT NULL,
  `cod_pago` int(11) NOT NULL,
  `valor_pago` bigint(20) NOT NULL,
  PRIMARY KEY (`cod_gasto`,`cod_pago`),
  KEY `cod_gasto` (`cod_gasto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
