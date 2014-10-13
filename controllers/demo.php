<?php

namespace php_mvc\controllers;

require_once HOME_DIR . '/common/web/mvc/controller.php';
require_once MODELS_DIR . '/demo.php';
require_once VIEWS_DIR . '/demo.php';

class Demo extends \common\web\mvc\Controller
{
    public function index()
    {
        // Create model
        $model = new \php_mvc\models\Demo('Hello world!');
        // Work with model.
        // Render model's view.
        $view = new \php_mvc\views\Demo($model);
        echo $view->content();
    }

}
