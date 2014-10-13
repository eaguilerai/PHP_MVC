<?php
namespace php_mvc\views;

require_once HOME_DIR . '/common/web/mvc/view.php';
require_once HOME_DIR . '/common/util/util.php';

abstract class Layout extends \common\web\mvc\View
{
    abstract public function head_section();
    abstract public function body_section();
    public function __construct($model, $title)
    {
        parent::__construct($model);
        $this->set_title($title);
    }

    public function content()
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>
                    <?php echo $this->title() ?>
                </title>
                <?php echo $this->head_section() ?>
            </head>
            <body>
                <?php echo $this->body_section() ?>
            </body>
        </html>
        <?php
    }

    public function title()
    {
        return $this->m_title;
    }

    public function set_title($new_title)
    {
        $this->m_title = $new_title;
    }

    private $m_title;
}
