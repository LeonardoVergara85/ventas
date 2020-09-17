<?php

namespace Core;

class Session
{
    private $append;

    function __construct()
	{
        $this->append = '_'.$_ENV['SIS_ID'];
	}

    public function start()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key.$this->append] = $value;
    }

    public function get($key)
    {
        return isset($_SESSION[$key.$this->append]) ? $_SESSION[$key.$this->append] : null;
    }

    public function all()
    {
        return $_SESSION;
    }

    public function remove($key)
    {
        if (isset($_SESSION[$key.$this->append]))
            unset($_SESSION[$key.$this->append]);
    }

    public function flush()
    {
        session_unset();
    }
    
    public function close()
    {
        session_unset();
        session_destroy();
    }

    public function status()
    {
        return session_status();
    }

    public function exists($key)
    {
        return isset($_SESSION[$key.$this->append]);
    }
}
