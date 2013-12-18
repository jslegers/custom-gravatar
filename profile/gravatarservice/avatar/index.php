<?php

define('GRAVATAR_REFERER', "http://www.example.org/yay.htm");
define('GRAVATAR_USERAGENT', "MozillaXYZ/1.0");
define('GRAVATAR_HEADER', 0);
define('GRAVATAR_RETURNTRANSFER', true);
define('GRAVATAR_TIMEOUT', 10);

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

class avatar {

    public static function load($requestHash) {

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
        curl_setopt($ch, CURLOPT_URL, 'http://en.gravatar.com/' . $requestHash . '.php');

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

    public static function imagecreatefromfile($filename) {
        $ch = curl_init($filename);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $filetype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        switch ($filetype) {
            case 'image/jpeg':
                return imagecreatefromjpeg($filename);
                break;

            case 'image/png':
                $image = imagecreatefrompng($filename);
                imagealphablending($image,true);
                imagesavealpha($image, true );
                return $image;
                break;

            case 'image/gif':
                return imagecreatefromgif($filename);
                break;

            default:
                throw new InvalidArgumentException('File "' . $filename . '" is not valid jpg, png or gif image.');
                break;
        }
    }
}

$gravatarData = avatar::load($pathinfo[0]);

if (isset($_GET['size'])) {
    $size = $_GET['size'];
} else {
    $size = 80;
}

if (isset($_GET['r'])) {
    $rating = $_GET['r'];
} else {
    $rating = 'G';
}

// Load the gd2 image
$im = avatar::imagecreatefromfile('http://0.gravatar.com/avatar/' . $gravatarData['entry'][0]['hash'] . '?size=' . $size . '&r=' . $rating);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/png');

// Output the image
imagepng($im);

// Free up memory
imagedestroy($im);
?>