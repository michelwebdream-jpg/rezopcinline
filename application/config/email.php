<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
$config['protocol']='smtp';
$config['smtp_host']='ssl0.ovh.net';
$config['smtp_ssl']='tls';
$config['smtp_port']=587;
$config['smtp_user']='info@web-dream.fr'; // change it to yours
$config['smtp_pass']='ma050868'; // change it to yours
$config['mailtype']='html';
$config['charset']='utf-8';
$config['wordwrap'] = TRUE;
*/
$config['protocol']='mail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['mailtype']='html';
$config['charset']='utf-8';
$config['wordwrap'] = TRUE;