<?php
//test.php
//
// Usage on command-line: php test.php <file|textstring>
// Usage on web: 
header('content-type:text/html;charset=utf-8');

//声明字符串
$text = <<<EOF
美军5架全球鹰无人侦察机将暂时部署日本
EOF;

// 引入类文件
require 'pscws4.class.php';
// 实例化
@$cws = new PSCWS4;
//设置字符集
$cws->set_charset('utf8');
//设置词典
$cws->set_dict('etc/dict.utf8.xdb');
//设置utf8规则
$cws->set_rule('etc/rules.utf8.ini');
//忽略标点符号
$cws->set_ignore(true);
//传递字符串
$cws->send_text($text);
//获取权重最高的前十个词
// $res = $cws->get_tops(10);// top 顶部

//获取所有的结果
$res = $cws->get_result();

//打印
var_dump($res);
//关闭
$cws->close();


?>