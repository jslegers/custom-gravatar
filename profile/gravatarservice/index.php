<?php

require('gravatar.php');

class gravatarService extends gravatar {

    public static function process() {
        if (isset($_SERVER['ORIG_PATH_INFO'])) {
            $pathinfo = $_SERVER['ORIG_PATH_INFO'];
        } elseif (isset($_SERVER['PATH_INFO'])) {
            $pathinfo = $_SERVER['PATH_INFO'];
        } else {
            $pathinfo = array();
        }

        if ($pathinfo != '') {
            $pathinfo = explode('/', urldecode($pathinfo));
            array_shift($pathinfo);
        }

        if ($pathinfo[count($pathinfo) - 1] == '') {
            $droplast = array_pop($pathinfo);
        }
        
        return parent::process($pathinfo);
    }
    
    public static function run(){
        static::process()->render();
    }

}

gravatarService::run();
?>