<?php

namespace php_mvc\models;

class Demo
{
    public function __construct($data)
    {
        $this->set_data($data);
    }
    
    public function data()
    {
        return $this->m_data;
    }
    
    public function set_data($new_data)
    {
        $this->m_data = $new_data;
    }
    
    private $m_data;
}
