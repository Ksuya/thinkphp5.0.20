/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-23 20:16:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for merchat
-- ----------------------------
DROP TABLE IF EXISTS `merchat`;
CREATE TABLE `merchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '商户名称',
  `signNumber` int(11) NOT NULL COMMENT '商户编号',
  `signKey` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '商户支付密钥',
  `withdrawKey` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `balance` decimal(10,2) DEFAULT NULL COMMENT '商户余额',
  `bond` decimal(10,2) DEFAULT NULL COMMENT '保证金',
  `gateway` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '使用通道',
  `status` tinyint(4) DEFAULT '1' COMMENT '商户状态 1-有效  2-冻结',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '登陆邮箱',
  `phone` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '登陆手机号',
  `createdTime` datetime DEFAULT NULL COMMENT '创建时间',
  `createdUser` int(11) DEFAULT NULL COMMENT '创建人',
  PRIMARY KEY (`id`),
  KEY `signNumber` (`signNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商户表';

-- ----------------------------
-- Records of merchat
-- ----------------------------
INSERT INTO `merchat` VALUES ('1', '测试商户名称', '902152144', '2e5d85f8fs8f5f8g', '19940618', '849.10', '100.00', '1,2,3', '1', '761243073@qq.com', '15369197307', '2018-08-19 19:07:50', null);

-- ----------------------------
-- Table structure for merchat_bank
-- ----------------------------
DROP TABLE IF EXISTS `merchat_bank`;
CREATE TABLE `merchat_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchatId` int(11) DEFAULT '-1' COMMENT '所属商户',
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
INSERT INTO `merchat_bank` VALUES ('1', '1', '测试持卡人', '621226854521', '2018-08-22 20:11:51', '建设银行', '山东省', '青岛市', '2018-08-22 20:05:52', null);

-- ----------------------------
-- Table structure for merchat_detail
-- ----------------------------
DROP TABLE IF EXISTS `merchat_detail`;
CREATE TABLE `merchat_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchatId` int(11) NOT NULL COMMENT '对应 商户表ID merchat',
  `realName` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '真实姓名',
  `idNumber` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '身份证号码',
  `region` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '公司地区',
  `address` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '地址',
  `business` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '营业执照号',
  `legalName` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '法人名称',
  `legalCarda` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '法人身份证A',
  `legalCardb` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '法人身份证B',
  `businessCard` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '营业执照副本',
  PRIMARY KEY (`id`),
  KEY `merchatId` (`merchatId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_detail
-- ----------------------------
INSERT INTO `merchat_detail` VALUES ('1', '1', '王红亮', '130121199406181014', '山西省,阳泉市,郊区', '香港中路', '251522148GH541', '测试', '/resource/uploads/default/20180821/b03dc7f8cc3aeaea55aee73764151adb.png', '/resource/uploads/default/20180821/bb5fdca8e3553e8542eaf771410d6adf.jpg', '/resource/uploads/default/20180821/29556c98a6335307e544e0602f61ac00.jpg');

-- ----------------------------
-- Table structure for merchat_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `merchat_withdraw`;
CREATE TABLE `merchat_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchatId` int(11) NOT NULL COMMENT '提现商户',
  `bankId` int(11) NOT NULL COMMENT '对应商户银行表ID，这个字段暂时不用',
  `transaction` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '体现流水号',
  `orderAmount` decimal(10,2) NOT NULL COMMENT '提现金额',
  `cardByName` varchar(20) COLLATE utf8_bin NOT NULL,
  `cardByNo` varchar(50) COLLATE utf8_bin NOT NULL,
  `openBank` varchar(20) COLLATE utf8_bin NOT NULL,
  `openProvinve` varchar(20) COLLATE utf8_bin NOT NULL,
  `openCity` varchar(20) COLLATE utf8_bin NOT NULL,
  `serviceCharge` decimal(10,2) NOT NULL COMMENT '提现手续费',
  `accType` tinyint(4) DEFAULT '0' COMMENT '0-对私 1-对公',
  `status` tinyint(4) DEFAULT '0' COMMENT '0-处理中 1-处理成功 2-处理失败 ',
  `createdTime` datetime DEFAULT NULL COMMENT '创建时间',
  `createdUser` int(255) NOT NULL,
  `dealUser` int(11) DEFAULT NULL COMMENT '处理人',
  PRIMARY KEY (`id`),
  KEY `merchatId` (`merchatId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of merchat_withdraw
-- ----------------------------
INSERT INTO `merchat_withdraw` VALUES ('12', '1', '1', '201808222302477918076355', '100.00', '测试持卡人', '621226854521', '建设银行', '河北省', '邯郸市', '0.60', '0', '0', '2018-08-22 13:35:00', '2', null);
INSERT INTO `merchat_withdraw` VALUES ('13', '1', '1', '201808231332328739650216', '50.00', '测试持卡人', '621226854521', '建设银行', '河北省', '秦皇岛市', '0.30', '0', '0', '2018-08-23 13:35:05', '2', null);

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
-- Table structure for system_gateway
-- ----------------------------
DROP TABLE IF EXISTS `system_gateway`;
CREATE TABLE `system_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '通道名称',
  `code` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '通道标识',
  `serviceId` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '服务商-也就是上游',
  `depositeRate` double NOT NULL DEFAULT '0.006' COMMENT '入金- 通道费率 默认千6',
  `withdrawRate` double DEFAULT '0.006' COMMENT '出金- 通道费率 默认千6',
  `minAmount` decimal(10,2) DEFAULT '10.00' COMMENT '最低限额',
  `maxAmount` decimal(10,2) DEFAULT '100000.00' COMMENT '最高限额',
  `statementsRate` varchar(20) COLLATE utf8_bin DEFAULT 'T0' COMMENT '结算方式',
  `comment` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of system_gateway
-- ----------------------------
INSERT INTO `system_gateway` VALUES ('1', 'h5快捷&支付宝h5&微信h5', 'MINGFU561', '1', '0.006', '0.006', '10.00', '100000.00', 'T0', null);
INSERT INTO `system_gateway` VALUES ('2', '银联扫码&QQ扫码&微信&支付宝', 'MINGFU591', '1', '0.006', '0.006', '10.00', '100000.00', 'T0', null);
INSERT INTO `system_gateway` VALUES ('3', '手动提现', 'PLATFORM999', '-1', '0.006', '0.006', '10.00', '100000.00', 'T0', '此通道请勿删除,否则无法手动提现');

-- ----------------------------
-- Table structure for system_order
-- ----------------------------
DROP TABLE IF EXISTS `system_order`;
CREATE TABLE `system_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchatId` int(11) NOT NULL,
  `gatewayId` int(11) NOT NULL COMMENT '交易通道ID',
  `merCode` varchar(50) NOT NULL COMMENT '商户号',
  `orderNo` varchar(50) NOT NULL COMMENT '商户订单号',
  `transaction` varchar(50) NOT NULL COMMENT '平台流水号',
  `orderAmount` double NOT NULL COMMENT '订单金额 单位元',
  `serviceCharge` double NOT NULL COMMENT '手续费',
  `status` varchar(20) DEFAULT '0001' COMMENT '0000-支付成功  0001-提交，尚未支付  0002-支付失败   0003-通知失败  0004-已退款  0005-订单关闭',
  `notifyNumber` int(11) DEFAULT '0' COMMENT '通知次数 指导通知完毕  要求商户返回 success 不区别大小写',
  `returnAddress` varchar(255) DEFAULT NULL COMMENT '同步回调地址',
  `backAddress` varchar(255) DEFAULT NULL COMMENT '后台通知地址,通知5次，通知后关闭订单',
  `dateTime` varchar(20) DEFAULT NULL COMMENT '发起时间（YYYYmmddHHiiss）',
  `payType` varchar(50) DEFAULT NULL COMMENT '支付方式 这个暂时留着,要用的,',
  `bankCardType` tinyint(4) DEFAULT '1' COMMENT '1-借记卡 2-信用卡',
  `bankCode` varchar(50) DEFAULT NULL COMMENT '银行编码，具体支付具体编码',
  `sign` varchar(255) NOT NULL COMMENT '签名',
  `createdTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `merCode` (`merCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_order
-- ----------------------------
INSERT INTO `system_order` VALUES ('1', '1', '1', '', '20180823170765451', '201808231708541285542214', '159.99', '0', '0001', '0', 'http://www.baidu.com', 'http://www.baidu.com', '20180823170752', null, '1', 'CCB', 'd45s4d5s4d545', '2018-08-23 17:19:02');

-- ----------------------------
-- Table structure for system_supplire
-- ----------------------------
DROP TABLE IF EXISTS `system_supplire`;
CREATE TABLE `system_supplire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '服务商名称',
  `merchatId` varchar(128) COLLATE utf8_bin NOT NULL COMMENT '上游-提供的商户号',
  `key` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '交易密钥',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of system_supplire
-- ----------------------------
INSERT INTO `system_supplire` VALUES ('1', '深圳明付科技支付公司', '19921252142', '2dsc78sd45sdw7845sd45fdsew');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', '1', 'test01', 'f46ef81f2464441ba58aeecbf654ee41', '2018-08-19 16:56:03', '2018-08-19 16:56:06');
INSERT INTO `users` VALUES ('1', '-1', 'whlphper', '9b0dae2d1d76cc9afb3f339e69506f68', '2018-08-01 13:35:36', '2018-08-06 13:35:41');
