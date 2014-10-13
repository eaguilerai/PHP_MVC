<?php
namespace php_mvc\views;
require_once 'layout.php';

class Demo extends Layout
{
    public function __construct($model)
    {
        parent::__construct($model, 'PHP MVC Demo');
    }
    public function head_section()
    {
        
    }

    public function body_section()
    {
        ?>
        <div>
            <?php echo $this->model()->data() ?>
        </div>
        <?php
    }

}
