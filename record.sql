/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : secure

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-27 15:03:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '1' COMMENT '操作类型- 2 新增 3主键更新 4条件更新',
  `name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `code` varchar(50) DEFAULT NULL COMMENT '操作代码',
  `ip` varchar(50) DEFAULT NULL COMMENT '操作者IP',
  `condition` varchar(255) DEFAULT NULL COMMENT '如果为条件修改，需要此字段',
  `tableName` varchar(50) NOT NULL COMMENT '操作的数据表',
  `dataId` varchar(128) NOT NULL COMMENT '操作表的数据主键',
  `createTime` datetime DEFAULT NULL COMMENT '操作时间',
  `user` int(11) DEFAULT '0' COMMENT '操作人',
  `extra` varchar(255) DEFAULT NULL COMMENT '额外修改表的字段信息',
  PRIMARY KEY (`id`),
  KEY `tableName` (`tableName`),
  KEY `user` (`user`),
  KEY `dataId` (`dataId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据变更记录表';

-- ----------------------------
-- Records of record
-- ----------------------------

-- ----------------------------
-- Table structure for record_detail
-- ----------------------------
DROP TABLE IF EXISTS `record_detail`;
CREATE TABLE `record_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recordId` int(11) NOT NULL COMMENT '关联record id',
  `dataId` int(11) DEFAULT NULL COMMENT '当时条件更新时会获取所更新条件对应的就数据',
  `fieldName` varchar(50) NOT NULL COMMENT '字段',
  `old` varchar(255) NOT NULL COMMENT '原始值',
  `new` varchar(255) NOT NULL COMMENT '最新值',
  PRIMARY KEY (`id`),
  KEY `recordId` (`recordId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据变更详情表-只有修改的时候会写入详情到此表';

-- ----------------------------
-- Records of record_detail
-- ----------------------------
