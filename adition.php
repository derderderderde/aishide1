<?php
// 获取访问者的IP地址
$ip = $_SERVER['REMOTE_ADDR'];

// 使用IP定位API获取地理位置信息
$location = file_get_contents("http://ip-api.com/json/{$ip}?lang=zh-CN");
$locationData = json_decode($location, true);

// 获取省、市、区信息
$region = $locationData['regionName'] ?? '未知省份';
$city = $locationData['city'] ?? '未知城市';
$district = $locationData['district'] ?? '未知区';

// 拼接地址
$address = "{$region} {$city} {$district}";

// 获取当前时间
$visitTime = date('Y-m-d H:i:s');

// 将记录保存到文件
$log = "{$address} - {$visitTime}\n";
file_put_contents('access_log.txt', $log, FILE_APPEND);

// 读取所有访问记录
$records = file_get_contents('access_log.txt');
$recordsArray = explode("\n", trim($records));
?>