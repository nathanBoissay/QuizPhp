<?php


class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($className)
    {
        $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}

?>