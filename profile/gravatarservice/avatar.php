<?php

require('curler.php');

class avatar extends curler {

    public static function load($requestHash) {
        return parent::load('http://en.gravatar.com/' . $requestHash . '.php');
    }

    public static function getParameter($parameter, $default = '') {
        if (isset($_GET[$parameter])) {
            return $_GET[$parameter];
        } else {
            return $default;
        }
    }

    public static function createFromURL($filename) {
        $filetype = static::getFiletype($filename);
        switch ($filetype) {
            case 'image/jpeg':
                return imagecreatefromjpeg($filename);
                break;

            case 'image/png':
                $image = imagecreatefrompng($filename);
                imagealphablending($image, true);
                imagesavealpha($image, true);
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

    public static function getURL() {
        $gravatarData = avatar::load(array_shift(static::getPathInfo()));
        return 'http://0.gravatar.com/avatar/' . $gravatarData['entry'][0]['hash'] . '?size=' . static::getParameter('size', 80) . '&r=' . static::getParameter('r', 'G');
    }

    public static function process($array = array()) {
        // Load the gd2 image
        $im = avatar::createFromURL(static::getURL());
        // Set the content type header - in this case image/png
        header('Content-Type: image/png');
        // Output the image
        imagepng($im);
        // Free up memory
        imagedestroy($im);
    }

}

?>