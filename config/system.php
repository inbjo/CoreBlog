<?php

$config_file = storage_path('app/settings.php');
$exists = file_exists($config_file);
if ($exists) {
    require_once $config_file;
} else {
    return [
        'name' => '裤裆老湿',
        'slogan' => '一个全栈老司机',
        'keyword' => '裤裆老湿,博客,全栈,老司机',
        'description' => '裤裆老湿博客是一个全栈老司机的博客',
    ];
}

