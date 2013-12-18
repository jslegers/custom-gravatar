<?php
require('avatar.php');

class gravatar extends avatar {
    protected $_data;
    protected $_results;

    public static function factory($requestHash = '') {
        return new static($requestHash);
    }

    public function __construct($requestHash = '') {
        return $this->fetch($requestHash);
    }

    public function dump() {
        var_dump($this->_data);
        return $this;
    }

    public function fetch($requestHash = '') {
        if ($requestHash != '') {
            $this->_data = static::load($requestHash);
            $this->_data = $this->_data['entry'][0];
            if (isset($this->_data['profileBackground'])) {
                unset($this->_data['profileBackground']);
            }
            if (isset($this->_data['preferredUsername'])) {
                $this->_data['username'] = $this->_data['preferredUsername'];
                unset($this->_data['preferredUsername']);
            }
            if (isset($this->_data['urls'])) {
                foreach ($this->_data['urls'] as $key => $value) {
                    $this->_data['urls'][$key]['screenshot'] = 'http://s.wordpress.com/mshots/v1/' . $this->_data['urls'][$key]['value'];
                }
            }
            $this->_data['avatars'] = array(
                'G' => 'http://s.gravatar.com/avatar/' . $this->_data['hash'] . '?r=g',
                'PG' => 'http://s.gravatar.com/avatar/' . $this->_data['hash'] . '?r=pg',
                'R' => 'http://s.gravatar.com/avatar/' . $this->_data['hash'] . '?r=r',
                'X' => 'http://s.gravatar.com/avatar/' . $this->_data['hash'] . '?r=x',
            );
            if (isset($this->_data['profileUrl'])) {
                $this->_data['QR'] = $this->_data['profileUrl'] . '.qr';
            }
        }
        return $this;
    }

    public static function process($array = array()) {
        $results = array();
        
        foreach ($array as $key => $arraykey) {
            if ($key == 0) {
                $gravatar = static::factory($arraykey);
                if (count($array) == 1) {
                    $results = $gravatar->get();
                }
            } else {
                $results[$arraykey] = $gravatar->get($arraykey);
            }
        }
    //    var_dump($results);
        return $gravatar->setResults($results);
    }

    protected function setResults($results) {
        $this->_results = $results;
        return $this;
    }

    public function render() {
        echo json_encode($this->_results);
        return $this;
    }

    public function get($path = '') {
        if ($path == '') {
            return $this->_data;
        } else {
            $pieces = explode(".", $path);
            $result = $this->_data;
            foreach ($pieces as $piecekey => $piece) {
                $piece = explode(":", $piece);
                if (count($piece) == 1) {
                    $piece = $piece[0];
                    if (is_numeric($piece)) {
                        $piece = intval($piece);
                    }
                    if (is_array($result) && array_key_exists($piece, $result)) {
                        $result = $result[$piece];
                    } else {
                        return null;
                    }
                } else {
                    if (is_array($result)) {
                        $temp = array();
                        if (count($pieces) > $piecekey + 1) {
                            $piece[1] = $piece[1] . '.' . implode('.', array_slice($pieces, $piecekey + 1));
                        }
                        foreach ($result as $resultval) {
                            if (isset($resultval[$piece[0]]) && $resultval[$piece[0]] == $piece[1]) {
                                array_push($temp, $resultval);
                            }
                        }
                        if (empty($temp)) {
                            return null;
                        } else {
                            return $temp;
                        }
                    } else {
                        return null;
                    }
                }
            }
            return $result;
        }
    }

    public function __get($path) {
        return $this->get($path);
    }
}

?>