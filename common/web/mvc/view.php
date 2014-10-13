<?php

namespace common\web\mvc;

abstract class View
{
    abstract public function content();
    public function __construct($model)
    {
        $this->set_model($model);
    }

    public function model()
    {
        return $this->m_model;
    }

    public function set_model($new_model)
    {
        $this->m_model = $new_model;
    }

    private $m_model;
}
