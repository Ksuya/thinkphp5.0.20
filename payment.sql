/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-22 20:16:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for merchat
-- ----------------------------
DROP TABLE IF EXISTS `merchat`;
CREATE TABLE `merchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '商户名称',
  `sign_number` int(11) NOT NULL COMMENT '商户编号',
  `balance` decimal(10,2) DEFAULT NULL COMMENT '商户余额',
  `bond` decimal(10,2) DEFAULT NULL COMMENT '保证金',
  `status` tinyint(4) DEFAULT '1' COMMENT '商户状态 1-有效  2-冻结',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '登陆邮箱',
  `phone` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '登陆手机号',
  `created_time` datetime DEFAULT NULL COMMENT '创建时间',
  `created_user` int(11) DEFAULT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat
-- ----------------------------
INSERT INTO `merchat` VALUES ('1', '测试商户名称', '902152144', '1000000.00', '100.00', '1', '761243073@qq.com', '15369197307', '2018-08-19 19:07:50', null);

-- ----------------------------
-- Table structure for merchat_bank
-- ----------------------------
DROP TABLE IF EXISTS `merchat_bank`;
CREATE TABLE `merchat_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchat_id` int(11) DEFAULT '-1' COMMENT '所属商户',
  `cardByName` varchar(255) NOT NULL COMMENT '持卡人姓名',
  `cardByNo` varchar(50) NOT NULL COMMENT '持卡人卡号',
  `tradeTime` datetime NOT NULL COMMENT '交易时间',
  `openBank` varchar(50) NOT NULL COMMENT '开户行',
  `openProvinve` varchar(20) DEFAULT NULL COMMENT '开户行-省',
  `openCity` varchar(20) DEFAULT NULL COMMENT '开户行-市',
  `created_time` datetime DEFAULT NULL COMMENT '创建时间',
  `created_user` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of merchat_bank
-- ----------------------------
INSERT INTO `merchat_bank` VALUES ('1', '1', '测试持卡人', '621226854521', '2018-08-22 20:11:51', '建设银行', '山东', '青岛', '2018-08-22 20:05:52', null);

-- ----------------------------
-- Table structure for merchat_detail
-- ----------------------------
DROP TABLE IF EXISTS `merchat_detail`;
CREATE TABLE `merchat_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchat_id` int(11) NOT NULL COMMENT '对应 商户表ID merchat',
  `real_name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '真实姓名',
  `id_number` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '身份证号码',
  `region` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '公司地区',
  `address` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '地址',
  `business` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '营业执照号',
  `legal_name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '法人名称',
  `legal_card_a` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '法人身份证A',
  `legal_card_b` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '法人身份证B',
  `business_card` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '营业执照副本',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_detail
-- ----------------------------
INSERT INTO `merchat_detail` VALUES ('1', '1', '王红亮', '130121199406181014', '北京市,西城区', '香港中路', '的撒', '的撒', '/resource/uploads/default/20180821/b03dc7f8cc3aeaea55aee73764151adb.png', '/resource/uploads/default/20180821/bb5fdca8e3553e8542eaf771410d6adf.jpg', '/resource/uploads/default/20180821/29556c98a6335307e544e0602f61ac00.jpg');

-- ----------------------------
-- Table structure for merchat_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `merchat_withdraw`;
CREATE TABLE `merchat_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchat_id` int(11) NOT NULL COMMENT '提现商户',
  `transaction` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '体现流水号',
  `order_amount` decimal(10,2) NOT NULL COMMENT '提现金额',
  `service_charge` decimal(10,2) NOT NULL COMMENT '提现手续费',
  `status` tinyint(4) DEFAULT '0' COMMENT '0-处理中 1-处理成功 2-处理失败 ',
  `created_time` datetime DEFAULT NULL COMMENT '创建时间',
  `deal_user` int(11) DEFAULT NULL COMMENT '处理人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_withdraw
-- ----------------------------
INSERT INTO `merchat_withdraw` VALUES ('1', '1', '2018082212212222', '100.00', '1.00', '0', '2018-08-22 12:21:18', null);
INSERT INTO `merchat_withdraw` VALUES ('2', '1', '2018022112215412', '1020.00', '10.00', '0', '2018-08-22 12:21:37', null);
INSERT INTO `merchat_withdraw` VALUES ('3', '-1', '11111', '111.00', '11.00', '0', '2018-08-22 12:23:36', null);

-- ----------------------------
-- Table structure for system_file
-- ----------------------------
DROP TABLE IF EXISTS `system_file`;
CREATE TABLE `system_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `size` double DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_file
-- ----------------------------
INSERT INTO `system_file` VALUES ('1', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821\\7260fc5cbde66a687208f55e7a433e93.png', '2018-08-21 19:02:21', null);
INSERT INTO `system_file` VALUES ('2', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/fafaf0206b77fc6df8ca6fa4a0e8dc23.png', '2018-08-21 19:03:17', null);
INSERT INTO `system_file` VALUES ('3', '201806151011288599548.jpg', '18665', 'jpg', '/resource/uploads/default/20180821/d899fe4bcfd7dd203f48921e31aca2d3.jpg', '2018-08-21 19:03:22', null);
INSERT INTO `system_file` VALUES ('4', '201806151415585979614.jpg', '5383', 'jpg', '/resource/uploads/default/20180821/20d4b3474d4fa5f746cc205f35fd7e5a.jpg', '2018-08-21 19:03:25', null);
INSERT INTO `system_file` VALUES ('5', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/ee8d63b3f46093345928061046e51794.png', '2018-08-21 19:06:35', null);
INSERT INTO `system_file` VALUES ('6', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/8fe0f250b6c9e47d30b3af6f802a447b.png', '2018-08-21 19:06:53', null);
INSERT INTO `system_file` VALUES ('7', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/b9af54c5634aafeba4d50f2347b346d1.png', '2018-08-21 19:07:01', null);
INSERT INTO `system_file` VALUES ('8', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/71d3478e0ef622a8ae0492970cebfcc9.png', '2018-08-21 19:07:21', null);
INSERT INTO `system_file` VALUES ('9', '201806151011288599548.jpg', '18665', 'jpg', '/resource/uploads/default/20180821/a475910797af4bb8ab8df7f0639832dc.jpg', '2018-08-21 19:07:30', null);
INSERT INTO `system_file` VALUES ('10', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/26be5c9719f31dfbf2270dff4b0a1e68.png', '2018-08-21 19:09:14', null);
INSERT INTO `system_file` VALUES ('11', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/02f7c4373277b8d84b45fd129872d336.png', '2018-08-21 19:10:01', null);
INSERT INTO `system_file` VALUES ('12', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/cb5433642dc0bcea5a5f222015477cde.png', '2018-08-21 19:11:57', null);
INSERT INTO `system_file` VALUES ('13', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/1465581ee3c67e0da050c7db95dc350d.png', '2018-08-21 19:13:18', null);
INSERT INTO `system_file` VALUES ('14', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180821/b03dc7f8cc3aeaea55aee73764151adb.png', '2018-08-21 19:13:47', null);
INSERT INTO `system_file` VALUES ('15', '201806151011288599548.jpg', '18665', 'jpg', '/resource/uploads/default/20180821/bb5fdca8e3553e8542eaf771410d6adf.jpg', '2018-08-21 19:13:51', null);
INSERT INTO `system_file` VALUES ('16', '201806151415585979614.jpg', '5383', 'jpg', '/resource/uploads/default/20180821/29556c98a6335307e544e0602f61ac00.jpg', '2018-08-21 19:13:55', null);
INSERT INTO `system_file` VALUES ('17', '201806151010304788818.png', '5862', 'png', '/resource/uploads/default/20180822/54f13b624cc0b2049b2b0327f33dda56.png', '2018-08-22 12:26:55', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchat_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '登陆账号',
  `password` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '登陆密码',
  `create_time` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL COMMENT '上次登陆时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'test01', '0e698a8ffc1a0af622c7b4db3cb750cc', '2018-08-19 16:56:03', '2018-08-19 16:56:06');
