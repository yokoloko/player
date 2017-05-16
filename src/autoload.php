<?php
class Autoloader {
    static public function loader($className)
    {
        $split = explode("\\", $className);
        $app = array_shift($split);

        $map = [
            'Framework' => 'lib/',
            'App' => 'src/'
        ];

        $filename =  dirname(__FILE__) . "/../" . $map[$app] . (implode("/", $split)) . ".php";

        if (file_exists($filename)) {
            include $filename;

            if (class_exists($className)) {
                return true;
            }
        }

        return false;
    }
}
spl_autoload_register('Autoloader::loader');