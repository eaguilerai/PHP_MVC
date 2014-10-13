<?php

/* Name: request_handler.php
 * Description: Defines a class that handles HTTP requests.
 * Author: Erasmo Aguilera
 * Creation date: October 12, 2014
 */
namespace common\web\mvc;

require_once 'common/util/query_string.php';

use common\util\arguments;

class Request_handler
{
    public function __construct(
    $controller_directory, $controller_namespace, $repository_directory, $repository_namespace, $use_lowercase_filenames = true, $controller_key = "c", $action_key = "a", $param_key = "p")
    {
        $this->set_controller_directory($controller_directory);
        $this->set_controller_namespace($controller_namespace);
        $this->set_repository_directory($repository_directory);
        $this->set_repository_namespace($repository_namespace);
        $this->use_lowercase_filenames($use_lowercase_filenames);
        $this->set_controller_key($controller_key);
        $this->set_action_key($action_key);
        $this->set_parameter_key($param_key);
    }

    public function controller_directory()
    {
        return $this->m_controller_dir;
    }

    public function controller_namespace()
    {
        return $this->m_controller_ns;
    }

    public function repository_directory()
    {
        return $this->m_repository_dir;
    }

    public function repository_namespace()
    {
        return $this->m_repository_ns;
    }

    // Gets or sets whether the Request_handler instance should treat filenames 
    // as lowercase.
    public function use_lowercase_filenames($answer = NULL)
    {
        if (is_null($answer)) {
            return $this->m_use_lowercase_fnames;
        } else {
            if (is_bool($answer)) {
                $this->m_use_lowercase_fnames = $answer;
            }
        }
    }

    public function controller_key()
    {
        return $this->m_controller_key;
    }

    public function action_key()
    {
        return $this->m_action_key;
    }

    public function parameter_key()
    {
        return $this->m_param_key;
    }

    public function set_controller_directory($new_directory)
    {
        // Check whether the argument is a string.
        assert(is_string($new_directory));
        
        $this->m_controller_dir = $new_directory;
    }

    public function set_controller_namespace($new_namespace)
    {
        // Check whether the argument is a string.
        assert(is_string($new_namespace));
        
        $this->m_controller_ns = $new_namespace;
    }

    public function set_repository_directory($new_directory)
    {
        // Check whether the argument is a string.
        assert(is_string($new_directory));
        
        $this->m_repository_dir = $new_directory;
    }

    public function set_repository_namespace($new_namespace)
    {
        // Check whether the argument is a string.
        assert(is_string($new_namespace));
        
        $this->m_repository_ns = $new_namespace;
    }

    public function set_controller_key($new_key)
    {
        // Check whether the argument is a string.
        assert(is_string($new_key));
        
        $this->m_controller_key = $new_key;
    }

    public function set_action_key($new_key)
    {
        // Check whether the argument is a string.
        assert(is_string($new_key));
        
        $this->m_action_key = $new_key;
    }

    public function set_parameter_key($new_key)
    {
        // Check whether the argument is a string.
        assert(is_string($new_key));
        
        $this->m_param_key = $new_key;
    }

    // Attends an HTTP request using the specified query string of the URL.
    public function attend($query_string)
    {
        // Check whether the argument is a string.
        assert(is_string($query_string));
        
        // Get the controller and action name
        $qs_values = \common\util\query_string\pairs_of($query_string);
        $controller_name = $this->controller_name_from($qs_values);
        $action_name = $this->action_name_from($qs_values);
        // Create the controller's repository.
        $repo = $this->repository_of($controller_name);
        // Create the controller.
        $controller = $this->controller_of($controller_name, $repo);
        // Call the controller's action method.
        $controller->$action_name();
    }

    private function controller_name_from($query_string_values)
    {
        // Check whether the argument is an array.
        assert(is_array($query_string_values));
        
        $key = $this->controller_key();
        return $query_string_values[$key];
    }

    private function action_name_from($query_string_values)
    {
        // Check whether the argument is an array.
        assert(is_array($query_string_values));
        
        $key = $this->action_key();
        return $query_string_values[$key];
    }

    private function repository_of($controller_name)
    {
        // Check arguments.
        assert(is_string($controller_name));
        
        $repo_path = $this->repository_path_of($controller_name);
        $repo = NULL;

        if (file_exists($repo_path)) {
            require_once $repo_path;
            $repo_qname = $this->repository_namespace() . '\\' . $controller_name;
            $repo = new $repo_qname();
        }
        
        return $repo;
    }

    private function repository_path_of($controller_name)
    {
        // Check arguments.
        assert(is_string($controller_name));
        
        $repo_path = $this->repository_directory() . '/';

        if ($this->use_lowercase_filenames()) {
            $repo_path .= strtolower($controller_name);
        } else {
            $repo_path .= $controller_name;
        }

        $repo_path .= '.php';
        return $repo_path;
    }

    private function controller_of($controller_name, $repository)
    {
        // Check arguments.
        assert(is_string($controller_name));
        
        $controller_path = $this->controller_path_of($controller_name);
        require_once $controller_path;
        $controller_qname = $this->controller_namespace() . '\\' . $controller_name;
        $controller = new $controller_qname($repository);

        return $controller;
    }

    private function controller_path_of($controller_name)
    {
        // Check arguments.
        assert(is_string($controller_name));
        
        $controller_path = $this->controller_directory() . '/';

        if ($this->use_lowercase_filenames()) {
            $controller_path .= strtolower($controller_name);
        } else {
            $controller_path .= $controller_name;
        }
        
        $controller_path .= '.php';
        return $controller_path;
    }
    
    private $m_controller_dir;
    private $m_controller_ns;
    private $m_repository_dir;
    private $m_repository_ns;
    private $m_use_lowercase_fnames = false;
    private $m_controller_key;
    private $m_action_key;
    private $m_param_key;
}
