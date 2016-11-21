/*
SQLyog v10.2 
MySQL - 5.5.5-10.1.13-MariaDB : Database - srhui
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`srhui` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `srhui`;

/*Table structure for table `sr_blessing` */

DROP TABLE IF EXISTS `sr_blessing`;

CREATE TABLE `sr_blessing` (
  `blessingid` int(11) NOT NULL AUTO_INCREMENT COMMENT '祝福ID',
  `cateid` int(11) DEFAULT '0' COMMENT '分类ID',
  `content` longtext COMMENT '内容',
  `path` char(32) DEFAULT '' COMMENT '路径',
  `photo` char(32) DEFAULT '' COMMENT '图片路径',
  `isaudit` tinyint(1) DEFAULT '0' COMMENT '是否审核',
  `isrecommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `count_comment` int(11) DEFAULT '0' COMMENT '统计评论数',
  `count_view` int(11) DEFAULT '0' COMMENT '统计查看',
  `addtime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  `count_love` int(11) DEFAULT '0' COMMENT '赞（真实数据）',
  `count_forward_basenum` int(11) DEFAULT '0' COMMENT '扫二维码(随机数)',
  `count_forward` int(11) DEFAULT '0' COMMENT '扫二维码（真实数据）',
  `updtime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `create_userid` int(11) DEFAULT '0' COMMENT '发布者ID',
  `create_user_name` varchar(30) DEFAULT NULL COMMENT '发布者姓名',
  `count_love_basenum` int(11) DEFAULT '0' COMMENT '赞基数（随机生成数字）',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`blessingid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='祝福表';

/*Data for the table `sr_blessing` */

insert  into `sr_blessing`(`blessingid`,`cateid`,`content`,`path`,`photo`,`isaudit`,`isrecommend`,`count_comment`,`count_view`,`addtime`,`count_love`,`count_forward_basenum`,`count_forward`,`updtime`,`create_userid`,`create_user_name`,`count_love_basenum`,`sort`) values (12,0,'第三代','','',0,0,0,0,'2016-11-10 00:00:00',0,10,0,'0000-00-00 00:00:00',3,'ekiny',10,10),(11,0,'第三代','','',0,0,0,0,'2016-11-10 00:00:00',0,10,0,'0000-00-00 00:00:00',3,'ekiny',10,10),(10,0,'312321312312312','','',1,1,0,0,'2016-11-10 00:00:00',0,10,0,'0000-00-00 00:00:00',3,'ekiny',10,10),(13,0,'第三代','','',0,0,0,0,'2016-11-10 00:00:00',0,10,0,'0000-00-00 00:00:00',3,'ekiny',10,10),(14,0,'哈哈','','',0,0,0,0,'2016-11-10 01:57:09',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(15,0,'你好','','',0,0,0,0,'2016-11-10 01:57:09',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(16,4,'UIUI偶偶i。','','',0,1,0,0,'2016-11-10 02:00:59',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(17,0,'','','',0,0,0,0,'2016-11-10 02:03:19',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(18,0,'发大水','','',0,0,0,0,'2016-11-10 02:14:35',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(19,0,'发大水','','',1,0,0,0,'2016-11-10 02:25:11',0,0,0,'0000-00-00 00:00:00',3,'ekiny',0,0),(20,0,'发大水','','',1,0,0,0,'2016-11-10 02:25:18',0,12121,0,'0000-00-00 00:00:00',3,'ekiny',0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
