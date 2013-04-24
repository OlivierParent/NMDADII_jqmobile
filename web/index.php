<?php
/**
 * Constanten definiëren
 */
define('PATH_VENDOR' , realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor') . DIRECTORY_SEPARATOR);
define('PATH_SOURCE' , realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src'   ) . DIRECTORY_SEPARATOR);
define('PATH_CONFIG' , PATH_SOURCE . 'config' . DIRECTORY_SEPARATOR);
define('PATH_WEBROOT', dirname($_SERVER['SCRIPT_NAME']) );   // Pad vanaf de map waarin het project staat.

/**
 * Eenvoudige Autoloader om klassen automatisch in te laden.
 *
 * @todo PSR-0 implementeren https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 *
 * @param string $class
 * @throws \ErrorException
 */
spl_autoload_register(function ($class)
{
    $class_path = explode('\\', $class);

    $path = ($class_path[0] === 'App') ? PATH_SOURCE : PATH_VENDOR;

    $filename = $path . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new \ErrorException("Class <strong>{$class}</strong> does not exist.");
    }
});

new \App\Application();
