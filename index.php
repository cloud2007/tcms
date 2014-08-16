<?php

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', false);

//不生成安全文件
define('BUILD_DIR_SECURE', false);

// 定义应用目录
define('APP_PATH', './Application/');

//根路径
define('APP_ROOT', dirname(__FILE__));

// 引入ThinkPHP入口文件
require ("./TcitPHP/TcitPHP.php");