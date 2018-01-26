<?php
require_once('blast_sqlin.php');
$conf['debug']['level']=5;

/*		数据库配置		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=caisb';
$conf['db']['user']='root';
$conf['db']['password']='root';
$conf['db']['charset']='utf8';
$conf['db']['prename']='blast_';

$conf['safepass']='123456';     //后台登陆安全码

$conf['cache']['expire']=0;
$conf['cache']['dir']='_blast_buffer/';     //前台缓存目录
$conf['url_modal']=2;
$conf['action']['template']='blast_Front/admin/';
$conf['action']['modals']='blast_back/admin/';
$conf['member']['sessionTime']=15*60;	// 用户有效时长
$conf['node']['access']='http://localhost:65531';	// node访问基本路径

error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');
ini_set('display_errors', 'Off');