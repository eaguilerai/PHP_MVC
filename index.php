<?php
require_once 'config/config.php';
require_once 'common/web/mvc/request_handler.php';
$handler = new \common\web\mvc\Request_handler(
        'controllers',
        '\\php_mvc\\controllers',
        'data/mysql',
        '\\data\\mysql');
$handler->attend($_SERVER['QUERY_STRING']);
/*require_once CONTROLLERS_DIR . '/demo.php';
$controller = new \mvc\controllers\Demo();
$controller->index();*/