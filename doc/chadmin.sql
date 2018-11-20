/*
Navicat MySQL Data Transfer

Source Server         : local.Mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : chadmin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-19 04:15:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `controller_id` varchar(20) DEFAULT NULL COMMENT '控制器ID',
  `action_id` varchar(20) DEFAULT NULL COMMENT '方法ID',
  `url` varchar(200) DEFAULT NULL COMMENT '访问地址',
  `module_name` varchar(50) DEFAULT NULL COMMENT '模块',
  `func_name` varchar(50) DEFAULT NULL COMMENT '功能',
  `right_name` varchar(50) DEFAULT NULL COMMENT '方法',
  `client_ip` varchar(15) DEFAULT NULL COMMENT '客户端IP',
  `create_user` varchar(50) DEFAULT NULL COMMENT '用户',
  `create_date` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `index_create_date` (`create_date`),
  KEY `index_create_index` (`create_user`),
  KEY `index_url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_log
-- ----------------------------
INSERT INTO `admin_log` VALUES ('1', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 15:23:47');
INSERT INTO `admin_log` VALUES ('2', 'admin-user', 'index', 'admin-user/index', '菜单用户权限', '用户管理', '用户操作', '127.0.0.1', 'admin', '2018-06-18 15:23:50');
INSERT INTO `admin_log` VALUES ('3', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 15:23:54');
INSERT INTO `admin_log` VALUES ('4', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 15:23:59');
INSERT INTO `admin_log` VALUES ('5', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 15:24:03');
INSERT INTO `admin_log` VALUES ('6', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 15:24:07');
INSERT INTO `admin_log` VALUES ('7', 'admin-user', 'index', 'admin-user/index', '菜单用户权限', '用户管理', '用户操作', '127.0.0.1', 'admin', '2018-06-18 15:24:10');
INSERT INTO `admin_log` VALUES ('8', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 15:24:31');
INSERT INTO `admin_log` VALUES ('9', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 15:24:42');
INSERT INTO `admin_log` VALUES ('10', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 15:24:51');
INSERT INTO `admin_log` VALUES ('11', 'admin-role', 'view', 'admin-role/view', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 15:24:56');
INSERT INTO `admin_log` VALUES ('12', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 15:25:01');
INSERT INTO `admin_log` VALUES ('13', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:08:12');
INSERT INTO `admin_log` VALUES ('14', 'admin-module', 'create', 'admin-module/create', '菜单用户权限', '菜单管理', '一级菜单添加', '127.0.0.1', 'admin', '2018-06-18 16:10:23');
INSERT INTO `admin_log` VALUES ('15', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:10:24');
INSERT INTO `admin_log` VALUES ('16', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:12:33');
INSERT INTO `admin_log` VALUES ('17', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:12:37');
INSERT INTO `admin_log` VALUES ('18', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:13:38');
INSERT INTO `admin_log` VALUES ('19', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:13:51');
INSERT INTO `admin_log` VALUES ('20', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:13:54');
INSERT INTO `admin_log` VALUES ('21', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:14:40');
INSERT INTO `admin_log` VALUES ('22', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:14:47');
INSERT INTO `admin_log` VALUES ('23', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:15:58');
INSERT INTO `admin_log` VALUES ('24', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:16:10');
INSERT INTO `admin_log` VALUES ('25', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:16:49');
INSERT INTO `admin_log` VALUES ('26', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:16:52');
INSERT INTO `admin_log` VALUES ('27', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:17:26');
INSERT INTO `admin_log` VALUES ('28', 'admin-menu', 'create', 'admin-menu/create', '菜单用户权限', '菜单管理', '二级菜单添加', '127.0.0.1', 'admin', '2018-06-18 16:18:45');
INSERT INTO `admin_log` VALUES ('29', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:18:46');
INSERT INTO `admin_log` VALUES ('30', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:18:52');
INSERT INTO `admin_log` VALUES ('31', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:19:03');
INSERT INTO `admin_log` VALUES ('32', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:19:08');
INSERT INTO `admin_log` VALUES ('33', 'admin-role', 'view', 'admin-role/view', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:19:13');
INSERT INTO `admin_log` VALUES ('34', 'admin-role', 'view', 'admin-role/view', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:19:17');
INSERT INTO `admin_log` VALUES ('35', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:19:21');
INSERT INTO `admin_log` VALUES ('36', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:19:25');
INSERT INTO `admin_log` VALUES ('37', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:19:45');
INSERT INTO `admin_log` VALUES ('38', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:19:48');
INSERT INTO `admin_log` VALUES ('39', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:20:06');
INSERT INTO `admin_log` VALUES ('40', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:20:21');
INSERT INTO `admin_log` VALUES ('41', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:20:35');
INSERT INTO `admin_log` VALUES ('42', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:20:45');
INSERT INTO `admin_log` VALUES ('43', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:20:53');
INSERT INTO `admin_log` VALUES ('44', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:21:07');
INSERT INTO `admin_log` VALUES ('45', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:21:19');
INSERT INTO `admin_log` VALUES ('46', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:21:22');
INSERT INTO `admin_log` VALUES ('47', 'admin-role', 'save-rights', 'admin-role/save-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:21:28');
INSERT INTO `admin_log` VALUES ('48', 'admin-role', 'view', 'admin-role/view', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:21:39');
INSERT INTO `admin_log` VALUES ('49', 'admin-user-role', 'index', 'admin-user-role/index', '菜单用户权限', '角色管理', '分配用户', '127.0.0.1', 'admin', '2018-06-18 16:21:45');
INSERT INTO `admin_log` VALUES ('50', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:21:50');
INSERT INTO `admin_log` VALUES ('51', 'admin-user', 'index', 'admin-user/index', '菜单用户权限', '用户管理', '用户操作', '127.0.0.1', 'admin', '2018-06-18 16:21:56');
INSERT INTO `admin_log` VALUES ('52', 'admin-user', 'view', 'admin-user/view', '菜单用户权限', '用户管理', '用户操作', '127.0.0.1', 'admin', '2018-06-18 16:22:00');
INSERT INTO `admin_log` VALUES ('53', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:04');
INSERT INTO `admin_log` VALUES ('54', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:09');
INSERT INTO `admin_log` VALUES ('55', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:15');
INSERT INTO `admin_log` VALUES ('56', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:18');
INSERT INTO `admin_log` VALUES ('57', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:22:20');
INSERT INTO `admin_log` VALUES ('58', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:22:26');
INSERT INTO `admin_log` VALUES ('59', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:39');
INSERT INTO `admin_log` VALUES ('60', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:42');
INSERT INTO `admin_log` VALUES ('61', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:22:46');
INSERT INTO `admin_log` VALUES ('62', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:22:48');
INSERT INTO `admin_log` VALUES ('63', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:22:51');
INSERT INTO `admin_log` VALUES ('64', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:23:03');
INSERT INTO `admin_log` VALUES ('65', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:23:06');
INSERT INTO `admin_log` VALUES ('66', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:23:20');
INSERT INTO `admin_log` VALUES ('67', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:23:22');
INSERT INTO `admin_log` VALUES ('68', 'admin-right', 'create', 'admin-right/create', '菜单用户权限', '菜单管理', '路由添加', '127.0.0.1', 'admin', '2018-06-18 16:24:10');
INSERT INTO `admin_log` VALUES ('69', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:24:11');
INSERT INTO `admin_log` VALUES ('70', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:24:18');
INSERT INTO `admin_log` VALUES ('71', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:24:22');
INSERT INTO `admin_log` VALUES ('72', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:24:33');
INSERT INTO `admin_log` VALUES ('73', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:24:48');
INSERT INTO `admin_log` VALUES ('74', 'admin-role', 'save-rights', 'admin-role/save-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:24:53');
INSERT INTO `admin_log` VALUES ('75', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:24:59');
INSERT INTO `admin_log` VALUES ('76', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '查看', '127.0.0.1', 'admin', '2018-06-18 16:25:17');
INSERT INTO `admin_log` VALUES ('77', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:27:39');
INSERT INTO `admin_log` VALUES ('78', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:27:43');
INSERT INTO `admin_log` VALUES ('79', 'admin-module', 'update', 'admin-module/update', '菜单用户权限', '菜单管理', '一级菜单添加', '127.0.0.1', 'admin', '2018-06-18 16:27:52');
INSERT INTO `admin_log` VALUES ('80', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:27:53');
INSERT INTO `admin_log` VALUES ('81', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:27:57');
INSERT INTO `admin_log` VALUES ('82', 'admin-module', 'update', 'admin-module/update', '菜单用户权限', '菜单管理', '一级菜单添加', '127.0.0.1', 'admin', '2018-06-18 16:28:02');
INSERT INTO `admin_log` VALUES ('83', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:28:04');
INSERT INTO `admin_log` VALUES ('84', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:28:12');
INSERT INTO `admin_log` VALUES ('85', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:28:14');
INSERT INTO `admin_log` VALUES ('86', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:28:17');
INSERT INTO `admin_log` VALUES ('87', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:28:23');
INSERT INTO `admin_log` VALUES ('88', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:28:28');
INSERT INTO `admin_log` VALUES ('89', 'admin-right', 'view', 'admin-right/view', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:28:32');
INSERT INTO `admin_log` VALUES ('90', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:28:37');
INSERT INTO `admin_log` VALUES ('91', 'admin-right', 'create', 'admin-right/create', '菜单用户权限', '菜单管理', '路由添加', '127.0.0.1', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_log` VALUES ('92', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 16:29:13');
INSERT INTO `admin_log` VALUES ('93', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:29:15');
INSERT INTO `admin_log` VALUES ('94', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:29:19');
INSERT INTO `admin_log` VALUES ('95', 'admin-role', 'save-rights', 'admin-role/save-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 16:29:25');
INSERT INTO `admin_log` VALUES ('96', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:30:13');
INSERT INTO `admin_log` VALUES ('97', 'soldier-record', 'create', 'soldier-record/create', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:30:41');
INSERT INTO `admin_log` VALUES ('98', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:30:42');
INSERT INTO `admin_log` VALUES ('99', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:30:50');
INSERT INTO `admin_log` VALUES ('100', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:30:56');
INSERT INTO `admin_log` VALUES ('101', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 16:31:13');
INSERT INTO `admin_log` VALUES ('102', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:31:48');
INSERT INTO `admin_log` VALUES ('103', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:17');
INSERT INTO `admin_log` VALUES ('104', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:19');
INSERT INTO `admin_log` VALUES ('105', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:21');
INSERT INTO `admin_log` VALUES ('106', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:27');
INSERT INTO `admin_log` VALUES ('107', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:30');
INSERT INTO `admin_log` VALUES ('108', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:38:33');
INSERT INTO `admin_log` VALUES ('109', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:41:10');
INSERT INTO `admin_log` VALUES ('110', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 16:59:44');
INSERT INTO `admin_log` VALUES ('111', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:00:23');
INSERT INTO `admin_log` VALUES ('112', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:21:56');
INSERT INTO `admin_log` VALUES ('113', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:22:16');
INSERT INTO `admin_log` VALUES ('114', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:22:17');
INSERT INTO `admin_log` VALUES ('115', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:22:51');
INSERT INTO `admin_log` VALUES ('116', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:23:00');
INSERT INTO `admin_log` VALUES ('117', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:23:03');
INSERT INTO `admin_log` VALUES ('118', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:25:48');
INSERT INTO `admin_log` VALUES ('119', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:25:52');
INSERT INTO `admin_log` VALUES ('120', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:26:16');
INSERT INTO `admin_log` VALUES ('121', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:26:19');
INSERT INTO `admin_log` VALUES ('122', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:27:31');
INSERT INTO `admin_log` VALUES ('123', 'soldier-record', 'create', 'soldier-record/create', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:30:23');
INSERT INTO `admin_log` VALUES ('124', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:30:25');
INSERT INTO `admin_log` VALUES ('125', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:34:39');
INSERT INTO `admin_log` VALUES ('126', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:34:56');
INSERT INTO `admin_log` VALUES ('127', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:35:13');
INSERT INTO `admin_log` VALUES ('128', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:35:57');
INSERT INTO `admin_log` VALUES ('129', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:37:52');
INSERT INTO `admin_log` VALUES ('130', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:38:25');
INSERT INTO `admin_log` VALUES ('131', 'admin-module', 'view', 'admin-module/view', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:38:28');
INSERT INTO `admin_log` VALUES ('132', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:38:33');
INSERT INTO `admin_log` VALUES ('133', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:38:36');
INSERT INTO `admin_log` VALUES ('134', 'admin-menu', 'view', 'admin-menu/view', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 17:41:13');
INSERT INTO `admin_log` VALUES ('135', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:44:02');
INSERT INTO `admin_log` VALUES ('136', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:44:23');
INSERT INTO `admin_log` VALUES ('137', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:45:03');
INSERT INTO `admin_log` VALUES ('138', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:45:27');
INSERT INTO `admin_log` VALUES ('139', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:50:08');
INSERT INTO `admin_log` VALUES ('140', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:50:21');
INSERT INTO `admin_log` VALUES ('141', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:50:24');
INSERT INTO `admin_log` VALUES ('142', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:51:19');
INSERT INTO `admin_log` VALUES ('143', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 17:55:55');
INSERT INTO `admin_log` VALUES ('144', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:39:58');
INSERT INTO `admin_log` VALUES ('145', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:42:53');
INSERT INTO `admin_log` VALUES ('146', 'admin-module', 'create', 'admin-module/create', '菜单用户权限', '菜单管理', '一级菜单添加', '127.0.0.1', 'admin', '2018-06-18 18:44:41');
INSERT INTO `admin_log` VALUES ('147', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:44:42');
INSERT INTO `admin_log` VALUES ('148', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:44:51');
INSERT INTO `admin_log` VALUES ('149', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:45:36');
INSERT INTO `admin_log` VALUES ('150', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:52:56');
INSERT INTO `admin_log` VALUES ('151', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:53:05');
INSERT INTO `admin_log` VALUES ('152', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:53:13');
INSERT INTO `admin_log` VALUES ('153', 'admin-menu', 'create', 'admin-menu/create', '菜单用户权限', '菜单管理', '二级菜单添加', '127.0.0.1', 'admin', '2018-06-18 18:53:59');
INSERT INTO `admin_log` VALUES ('154', 'admin-menu', 'index', 'admin-menu/index', '菜单用户权限', '菜单管理', '二级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:54:00');
INSERT INTO `admin_log` VALUES ('155', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 18:54:03');
INSERT INTO `admin_log` VALUES ('156', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 18:54:08');
INSERT INTO `admin_log` VALUES ('157', 'admin-right', 'create', 'admin-right/create', '菜单用户权限', '菜单管理', '路由添加', '127.0.0.1', 'admin', '2018-06-18 18:55:05');
INSERT INTO `admin_log` VALUES ('158', 'admin-right', 'create', 'admin-right/create', '菜单用户权限', '菜单管理', '路由添加', '127.0.0.1', 'admin', '2018-06-18 18:55:13');
INSERT INTO `admin_log` VALUES ('159', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 18:55:14');
INSERT INTO `admin_log` VALUES ('160', 'admin-right', 'right-action', 'admin-right/right-action', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 18:55:17');
INSERT INTO `admin_log` VALUES ('161', 'admin-right', 'create', 'admin-right/create', '菜单用户权限', '菜单管理', '路由添加', '127.0.0.1', 'admin', '2018-06-18 18:55:39');
INSERT INTO `admin_log` VALUES ('162', 'admin-right', 'index', 'admin-right/index', '菜单用户权限', '菜单管理', '路由查看', '127.0.0.1', 'admin', '2018-06-18 18:55:40');
INSERT INTO `admin_log` VALUES ('163', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 18:55:46');
INSERT INTO `admin_log` VALUES ('164', 'admin-module', 'index', 'admin-module/index', '菜单用户权限', '菜单管理', '一级菜单查看', '127.0.0.1', 'admin', '2018-06-18 18:56:22');
INSERT INTO `admin_log` VALUES ('165', 'admin-role', 'index', 'admin-role/index', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 18:56:26');
INSERT INTO `admin_log` VALUES ('166', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 18:56:31');
INSERT INTO `admin_log` VALUES ('167', 'admin-role', 'save-rights', 'admin-role/save-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_log` VALUES ('168', 'admin-role', 'get-all-rights', 'admin-role/get-all-rights', '菜单用户权限', '角色管理', '分配权限', '127.0.0.1', 'admin', '2018-06-18 18:56:44');
INSERT INTO `admin_log` VALUES ('169', 'admin-user-role', 'index', 'admin-user-role/index', '菜单用户权限', '角色管理', '分配用户', '127.0.0.1', 'admin', '2018-06-18 18:56:49');
INSERT INTO `admin_log` VALUES ('170', 'admin-user-role', 'view', 'admin-user-role/view', '菜单用户权限', '角色管理', '分配用户', '127.0.0.1', 'admin', '2018-06-18 18:56:55');
INSERT INTO `admin_log` VALUES ('171', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:57:19');
INSERT INTO `admin_log` VALUES ('172', 'company-news', 'create', 'company-news/create', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:57:47');
INSERT INTO `admin_log` VALUES ('173', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:57:48');
INSERT INTO `admin_log` VALUES ('174', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:59:00');
INSERT INTO `admin_log` VALUES ('175', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 18:59:52');
INSERT INTO `admin_log` VALUES ('176', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:00:00');
INSERT INTO `admin_log` VALUES ('177', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:00:01');
INSERT INTO `admin_log` VALUES ('178', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:02:50');
INSERT INTO `admin_log` VALUES ('179', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:02:58');
INSERT INTO `admin_log` VALUES ('180', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:03:05');
INSERT INTO `admin_log` VALUES ('181', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:04:30');
INSERT INTO `admin_log` VALUES ('182', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:04:43');
INSERT INTO `admin_log` VALUES ('183', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:12');
INSERT INTO `admin_log` VALUES ('184', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:18');
INSERT INTO `admin_log` VALUES ('185', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:21');
INSERT INTO `admin_log` VALUES ('186', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:22');
INSERT INTO `admin_log` VALUES ('187', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:33');
INSERT INTO `admin_log` VALUES ('188', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:35');
INSERT INTO `admin_log` VALUES ('189', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 19:05:36');
INSERT INTO `admin_log` VALUES ('190', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:05:39');
INSERT INTO `admin_log` VALUES ('191', 'company-news', 'create', 'company-news/create', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:06:06');
INSERT INTO `admin_log` VALUES ('192', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:06:07');
INSERT INTO `admin_log` VALUES ('193', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:06:10');
INSERT INTO `admin_log` VALUES ('194', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:06:16');
INSERT INTO `admin_log` VALUES ('195', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:06:18');
INSERT INTO `admin_log` VALUES ('196', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:06');
INSERT INTO `admin_log` VALUES ('197', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:12');
INSERT INTO `admin_log` VALUES ('198', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:13');
INSERT INTO `admin_log` VALUES ('199', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:18');
INSERT INTO `admin_log` VALUES ('200', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:21');
INSERT INTO `admin_log` VALUES ('201', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:27');
INSERT INTO `admin_log` VALUES ('202', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:28');
INSERT INTO `admin_log` VALUES ('203', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:07:32');
INSERT INTO `admin_log` VALUES ('204', 'company-news', 'create', 'company-news/create', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:08:16');
INSERT INTO `admin_log` VALUES ('205', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:08:17');
INSERT INTO `admin_log` VALUES ('206', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:08:20');
INSERT INTO `admin_log` VALUES ('207', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:08:24');
INSERT INTO `admin_log` VALUES ('208', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:08:25');
INSERT INTO `admin_log` VALUES ('209', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:09:42');
INSERT INTO `admin_log` VALUES ('210', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:09:48');
INSERT INTO `admin_log` VALUES ('211', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:09:51');
INSERT INTO `admin_log` VALUES ('212', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:09:52');
INSERT INTO `admin_log` VALUES ('213', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:09:55');
INSERT INTO `admin_log` VALUES ('214', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:01');
INSERT INTO `admin_log` VALUES ('215', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:06');
INSERT INTO `admin_log` VALUES ('216', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:07');
INSERT INTO `admin_log` VALUES ('217', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:51');
INSERT INTO `admin_log` VALUES ('218', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:56');
INSERT INTO `admin_log` VALUES ('219', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:10:59');
INSERT INTO `admin_log` VALUES ('220', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:01');
INSERT INTO `admin_log` VALUES ('221', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:19');
INSERT INTO `admin_log` VALUES ('222', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:24');
INSERT INTO `admin_log` VALUES ('223', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:25');
INSERT INTO `admin_log` VALUES ('224', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:40');
INSERT INTO `admin_log` VALUES ('225', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:45');
INSERT INTO `admin_log` VALUES ('226', 'soldier-record', 'update', 'soldier-record/update', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:54');
INSERT INTO `admin_log` VALUES ('227', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:11:55');
INSERT INTO `admin_log` VALUES ('228', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:03');
INSERT INTO `admin_log` VALUES ('229', 'soldier-record', 'view', 'soldier-record/view', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:08');
INSERT INTO `admin_log` VALUES ('230', 'soldier-record', 'update', 'soldier-record/update', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:30');
INSERT INTO `admin_log` VALUES ('231', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:32');
INSERT INTO `admin_log` VALUES ('232', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:40');
INSERT INTO `admin_log` VALUES ('233', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:43');
INSERT INTO `admin_log` VALUES ('234', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:48');
INSERT INTO `admin_log` VALUES ('235', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:49');
INSERT INTO `admin_log` VALUES ('236', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:13:57');
INSERT INTO `admin_log` VALUES ('237', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:01');
INSERT INTO `admin_log` VALUES ('238', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:02');
INSERT INTO `admin_log` VALUES ('239', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:31');
INSERT INTO `admin_log` VALUES ('240', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:33');
INSERT INTO `admin_log` VALUES ('241', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:37');
INSERT INTO `admin_log` VALUES ('242', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:38');
INSERT INTO `admin_log` VALUES ('243', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:41');
INSERT INTO `admin_log` VALUES ('244', 'company-news', 'view', 'company-news/view', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:47');
INSERT INTO `admin_log` VALUES ('245', 'company-news', 'update', 'company-news/update', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:51');
INSERT INTO `admin_log` VALUES ('246', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:53');
INSERT INTO `admin_log` VALUES ('247', 'company-news', 'delete', 'company-news/delete', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:14:58');
INSERT INTO `admin_log` VALUES ('248', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:00');
INSERT INTO `admin_log` VALUES ('249', 'company-news', 'create', 'company-news/create', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:08');
INSERT INTO `admin_log` VALUES ('250', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:09');
INSERT INTO `admin_log` VALUES ('251', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:13');
INSERT INTO `admin_log` VALUES ('252', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:15');
INSERT INTO `admin_log` VALUES ('253', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:16');
INSERT INTO `admin_log` VALUES ('254', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:17');
INSERT INTO `admin_log` VALUES ('255', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:18');
INSERT INTO `admin_log` VALUES ('256', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:19');
INSERT INTO `admin_log` VALUES ('257', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:20');
INSERT INTO `admin_log` VALUES ('258', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:22');
INSERT INTO `admin_log` VALUES ('259', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:23');
INSERT INTO `admin_log` VALUES ('260', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:24');
INSERT INTO `admin_log` VALUES ('261', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:25');
INSERT INTO `admin_log` VALUES ('262', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:26');
INSERT INTO `admin_log` VALUES ('263', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:28');
INSERT INTO `admin_log` VALUES ('264', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:29');
INSERT INTO `admin_log` VALUES ('265', 'company-news', 'index', 'company-news/index', '新闻发布', '新闻列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:15:30');
INSERT INTO `admin_log` VALUES ('266', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 19:18:06');
INSERT INTO `admin_log` VALUES ('267', 'site', 'error', 'site/error', null, null, null, '127.0.0.1', 'admin', '2018-06-18 19:49:10');
INSERT INTO `admin_log` VALUES ('268', 'admin-log', 'index', 'admin-log/index', '日志管理', '操作日志', '操作', '127.0.0.1', 'admin', '2018-06-18 20:07:32');
INSERT INTO `admin_log` VALUES ('269', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 20:07:38');
INSERT INTO `admin_log` VALUES ('270', 'soldier-record', 'index', 'soldier-record/index', '军人档案', '档案列表', '编辑', '127.0.0.1', 'admin', '2018-06-18 20:07:41');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT 'code',
  `menu_name` varchar(200) NOT NULL COMMENT '名称',
  `module_id` int(11) NOT NULL COMMENT '模块id',
  `display_label` varchar(200) DEFAULT NULL COMMENT '显示名',
  `des` varchar(400) DEFAULT NULL COMMENT '描述',
  `display_order` int(5) DEFAULT NULL COMMENT '显示顺序',
  `entry_right_name` varchar(50) DEFAULT NULL COMMENT '入口地址名称',
  `entry_url` varchar(200) NOT NULL COMMENT '入口地址',
  `action` varchar(50) NOT NULL COMMENT '操作ID',
  `controller` varchar(100) NOT NULL COMMENT '控制器ID',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_code` (`code`),
  KEY `fk_module_id` (`module_id`),
  CONSTRAINT `fk_module_id` FOREIGN KEY (`module_id`) REFERENCES `admin_module` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', 'menu_manger', '菜单管理', '1', '菜单管理', '菜单管理', '1', '菜单管理', 'admin-module/index', 'index', 'backend\\controllers\\AdminMenuController', 'n', 'admin', '2016-08-11 16:44:11', 'admin', '2016-08-11 16:44:11');
INSERT INTO `admin_menu` VALUES ('2', 'menu_role', '角色管理', '1', '角色管理', '角色管理', '2', '角色管理', 'admin-role/index', 'index', 'backend\\controllers\\AdminRoleController', 'n', 'admin', '2016-08-11 16:51:56', 'admin', '2016-08-11 16:51:56');
INSERT INTO `admin_menu` VALUES ('3', 'menu_user', '用户管理', '1', '用户管理', '用户管理', '3', '用户管理', 'admin-user/index', 'index', 'backend\\controllers\\AdminUserController', 'n', 'admin', '2016-08-11 16:58:43', 'admin', '2016-08-11 16:58:43');
INSERT INTO `admin_menu` VALUES ('4', 'coazaorizhi', '操作日志', '2', '操作日志', '操作日志', '1', '', 'admin-log/index', 'index', 'backend\\controllers\\AdminLogController', 'n', 'test', '2016-08-14 06:54:17', 'test', '2016-08-14 06:54:17');
INSERT INTO `admin_menu` VALUES ('5', 'menu-soldier-record', '档案列表', '3', '档案列表', '档案列表', '1', '档案列表', 'soldier-record/index', 'index', 'backend\\controllers\\SoldierRecordController', 'n', 'admin', '2018-06-18 16:18:45', 'admin', '2018-06-18 16:18:45');
INSERT INTO `admin_menu` VALUES ('6', 'menu_new_list', '新闻列表', '4', '新闻列表', '新闻列表', '1', '新闻列表', 'company-news/index', 'index', 'backend\\controllers\\CompanyNewsController', 'n', 'admin', '2018-06-18 18:53:59', 'admin', '2018-06-18 18:53:59');

-- ----------------------------
-- Table structure for admin_message
-- ----------------------------
DROP TABLE IF EXISTS `admin_message`;
CREATE TABLE `admin_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg` varchar(1000) DEFAULT NULL COMMENT '留言内容',
  `expiry_days` int(5) unsigned DEFAULT NULL COMMENT '有效天数',
  `create_user` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_user` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_message
-- ----------------------------
INSERT INTO `admin_message` VALUES ('1', '测试文本', '1', 'admin', '2014-11-21 18:47:20', 'admin', '2014-11-21 18:47:27');

-- ----------------------------
-- Table structure for admin_module
-- ----------------------------
DROP TABLE IF EXISTS `admin_module`;
CREATE TABLE `admin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT 'code',
  `display_label` varchar(200) NOT NULL COMMENT '显示名称',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `des` varchar(400) DEFAULT NULL COMMENT '描述',
  `entry_url` varchar(100) DEFAULT NULL COMMENT '入口地址',
  `display_order` int(5) DEFAULT NULL COMMENT '顺序',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_module
-- ----------------------------
INSERT INTO `admin_module` VALUES ('1', 'menu_manage', '菜单用户权限', 'n', '菜单管理', '', '10', 'admin', '2016-08-11 15:26:21', 'admin', '2018-06-18 16:27:52');
INSERT INTO `admin_module` VALUES ('2', 'rizhimaanage', '日志管理', 'n', '日志管理', '', '11', 'test', '2016-08-14 06:53:13', 'admin', '2018-06-18 16:28:02');
INSERT INTO `admin_module` VALUES ('3', 'menurecord', '军人档案', 'n', '军人档案', null, '1', 'admin', '2018-06-18 16:10:23', 'admin', '2018-06-18 16:10:23');
INSERT INTO `admin_module` VALUES ('4', 'menu_new', '新闻发布', 'n', '新闻发布', null, '4', 'admin', '2018-06-18 18:44:41', 'admin', '2018-06-18 18:44:41');

-- ----------------------------
-- Table structure for admin_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_right`;
CREATE TABLE `admin_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int(11) NOT NULL COMMENT '功能主键',
  `right_name` varchar(200) NOT NULL COMMENT '名称',
  `display_label` varchar(200) DEFAULT NULL COMMENT '显示名',
  `des` varchar(200) DEFAULT NULL COMMENT '描述',
  `display_order` int(5) DEFAULT NULL COMMENT '显示顺序',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `FK_admin_right` (`menu_id`),
  KEY `index_menu_id` (`menu_id`),
  CONSTRAINT `FK_admin_right` FOREIGN KEY (`menu_id`) REFERENCES `admin_menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_right
-- ----------------------------
INSERT INTO `admin_right` VALUES ('4', '2', '角色操作', '角色操作', '角色操作', '1', 'n', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right` VALUES ('5', '2', '分配用户', '分配用户', '分配用户', '2', 'n', 'admin', '2016-08-13 17:05:04', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right` VALUES ('6', '2', '分配权限', '分配权限', '分配权限', '3', 'n', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right` VALUES ('7', '3', '用户操作', '用户操作', '用户操作', '1', 'n', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right` VALUES ('8', '4', '操作', '操作', '操作', '1', 'n', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right` VALUES ('13', '1', '一级菜单查看', '一级菜单查看', '一级菜单查看', '1', 'n', 'test', '2016-08-16 15:52:45', 'test', '2016-08-16 15:52:45');
INSERT INTO `admin_right` VALUES ('14', '1', '一级菜单添加', '一级菜单添加', '一级菜单添加', '2', 'n', 'test', '2016-08-16 15:53:10', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right` VALUES ('15', '1', '一级菜单删除', '一级菜单删除', '一级菜单删除', '3', 'n', 'test', '2016-08-16 15:53:44', 'test', '2016-08-16 15:53:44');
INSERT INTO `admin_right` VALUES ('16', '1', '二级菜单查看', '二级菜单查看', '二级菜单查看', '4', 'n', 'test', '2016-08-16 15:55:02', 'test', '2016-08-16 15:55:02');
INSERT INTO `admin_right` VALUES ('17', '1', '二级菜单添加', '二级菜单修改', '二级菜单添加', '5', 'n', 'test', '2016-08-16 15:55:21', 'test', '2016-08-16 15:58:50');
INSERT INTO `admin_right` VALUES ('18', '1', '二级菜单删除', '二级菜单删除', '二级菜单删除', '6', 'n', 'test', '2016-08-16 15:55:58', 'test', '2016-08-16 15:55:58');
INSERT INTO `admin_right` VALUES ('19', '1', '路由查看', '路由查看', '路由查看', '7', 'n', 'test', '2016-08-16 15:56:32', 'test', '2016-08-16 15:57:14');
INSERT INTO `admin_right` VALUES ('20', '1', '路由添加', '路由添加', '路由添加', '8', 'n', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right` VALUES ('21', '1', '路由删除', '路由删除', '路由删除', '9', 'n', 'test', '2016-08-16 15:58:05', 'test', '2016-08-16 15:58:05');
INSERT INTO `admin_right` VALUES ('22', '5', '查看', '查看', '查看', '1', 'n', 'admin', '2018-06-18 16:24:10', 'admin', '2018-06-18 16:24:10');
INSERT INTO `admin_right` VALUES ('23', '5', '编辑', '编辑', '编辑', '2', 'n', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right` VALUES ('24', '6', '查看', '查看', '查看', '1', 'n', 'admin', '2018-06-18 18:55:13', 'admin', '2018-06-18 18:55:13');
INSERT INTO `admin_right` VALUES ('25', '6', '编辑', '编辑', '编辑', '2', 'n', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');

-- ----------------------------
-- Table structure for admin_right_url
-- ----------------------------
DROP TABLE IF EXISTS `admin_right_url`;
CREATE TABLE `admin_right_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `right_id` int(11) NOT NULL COMMENT 'right主键',
  `url` varchar(200) DEFAULT NULL COMMENT 'url',
  `para_name` varchar(40) DEFAULT NULL COMMENT '参数名',
  `para_value` varchar(40) DEFAULT NULL COMMENT '参数值',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `FK_admin_right_url` (`right_id`),
  KEY `index_right_id` (`right_id`),
  CONSTRAINT `FK_admin_right_url` FOREIGN KEY (`right_id`) REFERENCES `admin_right` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_right_url
-- ----------------------------
INSERT INTO `admin_right_url` VALUES ('16', '4', 'admin-role/index', 'admin-role', 'index', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('17', '4', 'admin-role/view', 'admin-role', 'view', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('18', '4', 'admin-role/create', 'admin-role', 'create', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('19', '4', 'admin-role/update', 'admin-role', 'update', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('20', '4', 'admin-role/delete', 'admin-role', 'delete', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('21', '4', 'admin-role/get-all-rights', 'admin-role', 'get-all-rights', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('22', '4', 'admin-role/save-rights', 'admin-role', 'save-rights', 'admin', '2016-08-13 17:04:40', 'admin', '2016-08-13 17:04:40');
INSERT INTO `admin_right_url` VALUES ('30', '6', 'admin-role/index', 'admin-role', 'index', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('31', '6', 'admin-role/view', 'admin-role', 'view', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('32', '6', 'admin-role/create', 'admin-role', 'create', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('33', '6', 'admin-role/update', 'admin-role', 'update', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('34', '6', 'admin-role/delete', 'admin-role', 'delete', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('35', '6', 'admin-role/get-all-rights', 'admin-role', 'get-all-rights', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('36', '6', 'admin-role/save-rights', 'admin-role', 'save-rights', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('37', '7', 'admin-user/index', 'admin-user', 'index', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right_url` VALUES ('38', '7', 'admin-user/view', 'admin-user', 'view', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right_url` VALUES ('39', '7', 'admin-user/create', 'admin-user', 'create', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right_url` VALUES ('40', '7', 'admin-user/update', 'admin-user', 'update', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right_url` VALUES ('41', '7', 'admin-user/delete', 'admin-user', 'delete', 'admin', '2016-08-13 17:05:57', 'admin', '2016-08-13 17:05:57');
INSERT INTO `admin_right_url` VALUES ('42', '8', 'admin-log/index', 'admin-log', 'index', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right_url` VALUES ('43', '8', 'admin-log/view', 'admin-log', 'view', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right_url` VALUES ('44', '8', 'admin-log/create', 'admin-log', 'create', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right_url` VALUES ('45', '8', 'admin-log/update', 'admin-log', 'update', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right_url` VALUES ('46', '8', 'admin-log/delete', 'admin-log', 'delete', 'test', '2016-08-14 06:54:38', 'test', '2016-08-14 06:54:38');
INSERT INTO `admin_right_url` VALUES ('81', '5', 'admin-user-role/index', 'admin-user-role', 'index', 'test', '2016-08-14 08:22:13', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right_url` VALUES ('82', '5', 'admin-user-role/view', 'admin-user-role', 'view', 'test', '2016-08-14 08:22:13', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right_url` VALUES ('83', '5', 'admin-user-role/create', 'admin-user-role', 'create', 'test', '2016-08-14 08:22:13', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right_url` VALUES ('84', '5', 'admin-user-role/update', 'admin-user-role', 'update', 'test', '2016-08-14 08:22:13', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right_url` VALUES ('85', '5', 'admin-user-role/delete', 'admin-user-role', 'delete', 'test', '2016-08-14 08:22:13', 'test', '2016-08-14 08:22:13');
INSERT INTO `admin_right_url` VALUES ('112', '13', 'admin-module/index', 'admin-module', 'index', 'test', '2016-08-16 15:52:45', 'test', '2016-08-16 15:52:45');
INSERT INTO `admin_right_url` VALUES ('113', '13', 'admin-module/view', 'admin-module', 'view', 'test', '2016-08-16 15:52:45', 'test', '2016-08-16 15:52:45');
INSERT INTO `admin_right_url` VALUES ('115', '15', 'admin-module/delete', 'admin-module', 'delete', 'test', '2016-08-16 15:53:44', 'test', '2016-08-16 15:53:44');
INSERT INTO `admin_right_url` VALUES ('118', '16', 'admin-menu/index', 'admin-menu', 'index', 'test', '2016-08-16 15:55:02', 'test', '2016-08-16 15:55:02');
INSERT INTO `admin_right_url` VALUES ('119', '16', 'admin-menu/view', 'admin-menu', 'view', 'test', '2016-08-16 15:55:02', 'test', '2016-08-16 15:55:02');
INSERT INTO `admin_right_url` VALUES ('122', '18', 'admin-menu/delete', 'admin-menu', 'delete', 'test', '2016-08-16 15:55:58', 'test', '2016-08-16 15:55:58');
INSERT INTO `admin_right_url` VALUES ('125', '19', 'admin-right/index', 'admin-right', 'index', 'test', '2016-08-16 15:57:14', 'test', '2016-08-16 15:57:14');
INSERT INTO `admin_right_url` VALUES ('126', '19', 'admin-right/view', 'admin-right', 'view', 'test', '2016-08-16 15:57:14', 'test', '2016-08-16 15:57:14');
INSERT INTO `admin_right_url` VALUES ('127', '19', 'admin-right/right-action', 'admin-right', 'right-action', 'test', '2016-08-16 15:57:14', 'test', '2016-08-16 15:57:14');
INSERT INTO `admin_right_url` VALUES ('128', '20', 'admin-right/create', 'admin-right', 'create', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right_url` VALUES ('129', '20', 'admin-right/update', 'admin-right', 'update', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right_url` VALUES ('130', '21', 'admin-right/delete', 'admin-right', 'delete', 'test', '2016-08-16 15:58:05', 'test', '2016-08-16 15:58:05');
INSERT INTO `admin_right_url` VALUES ('131', '14', 'admin-module/create', 'admin-module', 'create', 'test', '2016-08-16 15:58:30', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right_url` VALUES ('132', '14', 'admin-module/update', 'admin-module', 'update', 'test', '2016-08-16 15:58:30', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right_url` VALUES ('133', '17', 'admin-menu/create', 'admin-menu', 'create', 'test', '2016-08-16 15:58:51', 'test', '2016-08-16 15:58:51');
INSERT INTO `admin_right_url` VALUES ('134', '17', 'admin-menu/update', 'admin-menu', 'update', 'test', '2016-08-16 15:58:51', 'test', '2016-08-16 15:58:51');
INSERT INTO `admin_right_url` VALUES ('135', '22', 'soldier-record/index', 'soldier-record', 'index', 'admin', '2018-06-18 16:24:10', 'admin', '2018-06-18 16:24:10');
INSERT INTO `admin_right_url` VALUES ('136', '22', 'soldier-record/view', 'soldier-record', 'view', 'admin', '2018-06-18 16:24:10', 'admin', '2018-06-18 16:24:10');
INSERT INTO `admin_right_url` VALUES ('137', '23', 'soldier-record/index', 'soldier-record', 'index', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right_url` VALUES ('138', '23', 'soldier-record/view', 'soldier-record', 'view', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right_url` VALUES ('139', '23', 'soldier-record/create', 'soldier-record', 'create', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right_url` VALUES ('140', '23', 'soldier-record/update', 'soldier-record', 'update', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right_url` VALUES ('141', '23', 'soldier-record/delete', 'soldier-record', 'delete', 'admin', '2018-06-18 16:29:12', 'admin', '2018-06-18 16:29:12');
INSERT INTO `admin_right_url` VALUES ('142', '24', 'company-news/index', 'company-news', 'index', 'admin', '2018-06-18 18:55:13', 'admin', '2018-06-18 18:55:13');
INSERT INTO `admin_right_url` VALUES ('143', '24', 'company-news/view', 'company-news', 'view', 'admin', '2018-06-18 18:55:13', 'admin', '2018-06-18 18:55:13');
INSERT INTO `admin_right_url` VALUES ('144', '25', 'company-news/index', 'company-news', 'index', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');
INSERT INTO `admin_right_url` VALUES ('145', '25', 'company-news/view', 'company-news', 'view', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');
INSERT INTO `admin_right_url` VALUES ('146', '25', 'company-news/create', 'company-news', 'create', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');
INSERT INTO `admin_right_url` VALUES ('147', '25', 'company-news/update', 'company-news', 'update', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');
INSERT INTO `admin_right_url` VALUES ('148', '25', 'company-news/delete', 'company-news', 'delete', 'admin', '2018-06-18 18:55:39', 'admin', '2018-06-18 18:55:39');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT '角色编号',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `des` varchar(400) DEFAULT NULL COMMENT '角色描述',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '更新人',
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', 'superadmin', '超级管理员', '拥有所有权限', 'test', '2016-08-12 15:33:01', 'test', '2016-08-12 15:33:01');
INSERT INTO `admin_role` VALUES ('2', 'testuser', '测试人员', '测试人员', 'test', '2016-08-12 15:33:45', 'test', '2016-08-12 15:33:45');

-- ----------------------------
-- Table structure for admin_role_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_right`;
CREATE TABLE `admin_role_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `role_id` int(11) NOT NULL COMMENT '角色主键',
  `right_id` int(11) NOT NULL COMMENT '权限主键',
  `full_path` varchar(250) DEFAULT NULL COMMENT '全路径',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `index_role_id` (`role_id`),
  KEY `index_right_id` (`right_id`),
  CONSTRAINT `admin_role_right_ibfk_1` FOREIGN KEY (`right_id`) REFERENCES `admin_right` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role_right
-- ----------------------------
INSERT INTO `admin_role_right` VALUES ('112', '2', '13', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('113', '2', '14', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('114', '2', '15', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('115', '2', '16', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('116', '2', '17', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('117', '2', '18', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('118', '2', '19', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('119', '2', '20', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('120', '2', '21', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('121', '2', '4', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('122', '2', '5', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('123', '2', '6', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('124', '2', '7', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('125', '2', '8', null, 'test', '2016-08-16 16:02:57', 'test', '2016-08-16 16:02:57');
INSERT INTO `admin_role_right` VALUES ('172', '1', '13', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('173', '1', '14', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('174', '1', '15', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('175', '1', '16', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('176', '1', '17', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('177', '1', '18', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('178', '1', '19', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('179', '1', '20', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('180', '1', '21', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('181', '1', '4', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('182', '1', '5', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('183', '1', '6', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('184', '1', '7', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('185', '1', '8', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('186', '1', '22', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('187', '1', '23', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('188', '1', '24', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');
INSERT INTO `admin_role_right` VALUES ('189', '1', '25', null, 'admin', '2018-06-18 18:56:40', 'admin', '2018-06-18 18:56:40');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `auth_key` varchar(50) DEFAULT NULL COMMENT '自动登录key',
  `last_ip` varchar(50) DEFAULT NULL COMMENT '最近一次登录ip',
  `is_online` char(1) DEFAULT 'n' COMMENT '是否在线',
  `domain_account` varchar(100) DEFAULT NULL COMMENT '域账号',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `create_user` varchar(100) NOT NULL COMMENT '创建人',
  `create_date` datetime NOT NULL COMMENT '创建时间',
  `update_user` varchar(101) NOT NULL COMMENT '更新人',
  `update_date` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('156', 'admin', '$2y$13$QMnfWjLciroaaCi6duvkC.HuPcU4vuP8mp.7VnvAA2zzFrBCso3.q', null, '127.0.0.1', 'n', null, '10', 'admin', '2014-07-07 00:05:47', 'admin', '2014-09-03 12:19:12');
INSERT INTO `admin_user` VALUES ('158', 'test', '$2y$13$9O6bKJieocg//oSax9fZOOuljAKarBXknqD8.RyYg60FfNjS7SoqK', null, '', 'n', null, '10', 'admin', '2014-09-03 12:19:52', 'admin', '2014-11-21 19:19:22');

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `role_id` int(11) NOT NULL COMMENT '角色',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_role_id` (`role_id`),
  CONSTRAINT `admin_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES ('1', '156', '1', 'admin', '2016-08-12 17:03:13', 'admin', '2016-08-12 17:03:13');
INSERT INTO `admin_user_role` VALUES ('2', '158', '2', 'test', '2016-08-13 16:34:20', 'test', '2016-08-13 16:34:20');

-- ----------------------------
-- Table structure for company_news
-- ----------------------------
DROP TABLE IF EXISTS `company_news`;
CREATE TABLE `company_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(200) DEFAULT '' COMMENT '标题',
  `body` text COMMENT '内容',
  `post_status` int(1) DEFAULT '0' COMMENT '发布状态',
  `create_time` date DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of company_news
-- ----------------------------
INSERT INTO `company_news` VALUES ('4', '1', '1', '0', null, '0000-00-00 00:00:00');
INSERT INTO `company_news` VALUES ('2', '标题2', '新闻内容', '1', null, '2018-06-19 03:14:37');
INSERT INTO `company_news` VALUES ('3', '新闻3', '新闻3', '1', null, '2018-06-19 03:10:46');

-- ----------------------------
-- Table structure for soldier_record
-- ----------------------------
DROP TABLE IF EXISTS `soldier_record`;
CREATE TABLE `soldier_record` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(25) DEFAULT NULL COMMENT '姓名',
  `sex` int(2) DEFAULT NULL COMMENT '性别',
  `moblie` varchar(20) DEFAULT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `birthday` varchar(10) DEFAULT NULL COMMENT '出生日期',
  `height` varchar(4) DEFAULT NULL COMMENT '身高',
  `weight` varchar(4) DEFAULT NULL COMMENT '体重',
  `idcard` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `address` varchar(80) DEFAULT NULL COMMENT '住址',
  `leave_time` timestamp NULL DEFAULT NULL COMMENT '退伍时间',
  `report_time` timestamp NULL DEFAULT NULL COMMENT '报道时间',
  `train_status` int(1) DEFAULT '0' COMMENT '培训状态',
  `job_status` int(1) DEFAULT '0' COMMENT '就业状态',
  `check_status` int(1) DEFAULT '0' COMMENT '审核状态',
  `del_status` int(1) DEFAULT '0' COMMENT '删除状态',
  `create_date` date DEFAULT NULL COMMENT '创建时间',
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='军人档案表';

-- ----------------------------
-- Records of soldier_record
-- ----------------------------
INSERT INTO `soldier_record` VALUES ('1', '5', '1', '13112345657', '7', '', '2', '3', '4', '8', null, null, '1', '0', '0', null, '2018-06-18', '2018-06-19 03:13:31');
INSERT INTO `soldier_record` VALUES ('2', '姓名', '2', '1361111111', 'i@test.io', '1989-09-09', '175', '65', '52020304198909094312', '贵阳市观山湖区美的会展中心', '2018-05-05 00:00:00', '2018-05-06 00:00:00', '2', '1', '1', null, '2018-06-18', '2018-06-19 03:11:54');
