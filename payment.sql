/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : payment

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-20 09:36:30
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_detail
-- ----------------------------
INSERT INTO `merchat_detail` VALUES ('1', '1', '王红亮', '130121199406181014', '山东省青岛市', '香港中路', '', '王红亮', null, null, null);

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
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `deal_user` int(11) DEFAULT NULL COMMENT '处理人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_withdraw
-- ----------------------------

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
