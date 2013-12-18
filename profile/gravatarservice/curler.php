<?php
// http://www.jonasjohn.de/snippets/php/curl-example.htm

define('GRAVATAR_REFERER', "http://www.example.org/yay.htm");
define('GRAVATAR_USERAGENT', "MozillaXYZ/1.0");
define('GRAVATAR_HEADER', 0);
define('GRAVATAR_RETURNTRANSFER', true);
define('GRAVATAR_TIMEOUT', 10);
define('PRODUCTION', false);
if (!PRODUCTION) {
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('error_reporting', E_ALL);
} else {
    error_reporting(0);
}

class curler {
    public static function getPathInfo() {
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

        if ($pathinfo[0] == '') {
            $pathinfo[0] = 'beau';
        }

        return $pathinfo;
    }
    
    public static function load($url) {

        // is cURL installed yet?
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }

        if (filter_var($requestHash, FILTER_VALIDATE_EMAIL)) {
            // valid address
            $requestHash = md5($requestHash);
        }

        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();

        // Now set some options (most are optional)
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, GRAVATAR_REFERER);

        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, GRAVATAR_USERAGENT);

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, GRAVATAR_HEADER);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, GRAVATAR_RETURNTRANSFER);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, GRAVATAR_TIMEOUT);

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);

        return unserialize($output);
    }
    
    public static function getFiletype($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $filetype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);
        return $filetype;
    }
}