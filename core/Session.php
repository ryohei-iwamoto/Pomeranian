<?php

class Session
{
    protected static $sessionStarted;
    protected static $sessionIdRegenerated;

    public function __construct()
    {
        if (!self::$sessionStarted){
            session_start();
            self::$sessionStarted = true;
        }
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name, $default=null)
    {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : $default;
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function clear()
    {
        $_SESSION = array();
    }

    public function regenerated($destroy=true)
    {
        if (!self::$sessionIdRegenerated) {
            session_regenerate_id($destroy);
            self::$sessionIdRegenerated = true;
        }
    }

    public function setAuthenticated($bool)
    {
        $this->set('_authenticated', (bool)$bool);
        $this->regenerated();
    }

    public function isAuthenticated()
    {
        return $this->get("_authenticated", false);
    }
}