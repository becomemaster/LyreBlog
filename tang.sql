/*
Navicat MySQL Data Transfer

Source Server         : database
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : tang

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2016-05-11 23:20:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Login_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '1a1dc91c907325c69271ddf0c944bc72', '1462876250');
INSERT INTO `admin` VALUES ('5', 'tyq', '7975867fbd4763efe7947e292f6163e0', null);
INSERT INTO `admin` VALUES ('6', 'tyq', 'be1ab1632e4285edc3733b142935c60b', null);

-- ----------------------------
-- Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `Pageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Page_title` varchar(255) DEFAULT NULL,
  `Page_user` varchar(255) DEFAULT NULL,
  `Page_content` text,
  `Page_type` tinyint(3) unsigned DEFAULT NULL,
  `Page_msg_id` int(10) unsigned DEFAULT NULL,
  `Page_read` int(10) unsigned DEFAULT NULL,
  `Page_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`Pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('16', '创建一个文件上传表单', 'admin', '允许用户从表单上传文件是非常有用的。\r\n\r\n请看下面这个供上传文件的 HTML 表单：\r\n\r\n&lt;html&gt;\r\n&lt;body&gt;\r\n\r\n&lt;form action=&quot;upload_file.php&quot; method=&quot;post&quot;\r\nenctype=&quot;multipart/form-data&quot;&gt;\r\n&lt;label for=&quot;file&quot;&gt;Filename:&lt;/label&gt;\r\n&lt;input type=&quot;file&quot; name=&quot;file&quot; id=&quot;file&quot;&gt;&lt;br&gt;\r\n&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Submit&quot;&gt;\r\n&lt;/form&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt; \r\n\r\n有关上面的 HTML 表单的一些注意项列举如下：\r\n\r\n1.&lt;form&gt; 标签的 enctype 属性规定了在提交表单时要使用哪种内容类型。在表单需要二进制数据时，比如文件内容，请使用 &quot;multipart/form-data&quot;。 \r\n2.&lt;input&gt; 标签的 type=&quot;file&quot; 属性规定了应该把输入作为文件来处理。举例来说，当在浏览器中预览时，会看到输入框旁边有一个浏览按钮。 \r\n注释：允许用户上传文件是一个巨大的安全风险。请仅仅允许可信的用户执行文件上传操作。', '11', null, '29', '1462360721');
INSERT INTO `page` VALUES ('19', 'PHP文章', 'admin', '<p style=\"text-align: center;\">我想测试一下。这是不是真的！！</p><p style=\"text-align: center;\"><img src=\"http://api.map.baidu.com/staticimage?center=116.404,39.915&zoom=10&width=530&height=340&markers=116.404,39.915\" height=\"340\" width=\"530\"/><img style=\"width: 1px; height: 1px;\" alt=\"attachment_069 (14).jpg\" src=\"/ueditor/php/upload/image/20160510/1462871779782059.jpg\" title=\"1462871779782059.jpg\" height=\"1\" width=\"1\"/></p>', '11', null, '6', '1462871856');

-- ----------------------------
-- Table structure for `page_msg`
-- ----------------------------
DROP TABLE IF EXISTS `page_msg`;
CREATE TABLE `page_msg` (
  `username` varchar(255) DEFAULT NULL,
  `Page_msg` text,
  `Pageid` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page_msg
-- ----------------------------
INSERT INTO `page_msg` VALUES ('匿名用户', '测试一下吧', '16', '1643216797@qq.com', '16');

-- ----------------------------
-- Table structure for `page_type`
-- ----------------------------
DROP TABLE IF EXISTS `page_type`;
CREATE TABLE `page_type` (
  `Type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Page_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page_type
-- ----------------------------
INSERT INTO `page_type` VALUES ('11', 'PHP文章');
INSERT INTO `page_type` VALUES ('12', 'HTML5');

-- ----------------------------
-- Table structure for `site`
-- ----------------------------
DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `site_name` varchar(255) DEFAULT NULL,
  `site_num` int(11) DEFAULT NULL,
  `site_user` varchar(255) DEFAULT NULL,
  `site_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of site
-- ----------------------------
INSERT INTO `site` VALUES ('倾旋博客V3.0', '1220', '倾旋', '玩安全');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Login_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Uid`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1462928638');
INSERT INTO `user` VALUES ('12', 'username', '5f4dcc3b5aa765d61d8327deb882cf99', '1462754411');

-- ----------------------------
-- Table structure for `user_img`
-- ----------------------------
DROP TABLE IF EXISTS `user_img`;
CREATE TABLE `user_img` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `photo_read` text,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_img
-- ----------------------------
INSERT INTO `user_img` VALUES ('7', 'admin', '我的新相片呦~', '你必须非努力才能看起来毫不费力', 'Public/users/admin/095331c39d044c9a72b9065393a689f5.jpg');
INSERT INTO `user_img` VALUES ('8', 'admin', '我的风景', '记录一下', 'Public/users/admin/10d929c37d850b0576612040c6d7f121.jpg');
