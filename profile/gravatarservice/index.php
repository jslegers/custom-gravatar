<?php

require('gravatar.php');

class gravatarService extends gravatar {

    public static function process() {
        if (isset($_SERVER['ORIG_PATH_INFO'])) {
            $pathinfo = $_SERVER['ORIG_PATH_INFO'];
        } elseif (isset($_SERVER['PATH_INFO'])) {
            $pathinfo = $_SERVER['PATH_INFO'];
        } else {
            $pathinfo = '';
        }

        if ($pathinfo != '') {
            $pathinfo = explode('/', urldecode($_SERVER['PATH_INFO']));
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