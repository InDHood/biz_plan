<?php  

// Auth..
error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ini_set("memory_limit","64M");

$RooT 	= ( $_SERVER['HTTP_HOST']=='workspace' || $_SERVER['HTTP_HOST']=='localhost' ) ? ( '/' . ex( $_SERVER['PHP_SELF'], 1, '/' ) ) : '';
$UrL 	= $_SERVER['HTTP_HOST'] . $RooT;

define( 'ROOT', realpath( $_SERVER["DOCUMENT_ROOT"] ) . $RooT . '/');
define( 'URL', 'http://' . $UrL . '/');
define( 'UI', URL . 'ui/' );
( !empty( $_GET['url'] ) ) ? define( '_URL', $_GET['url'] ) : define( '_URL', '' );

define('API_KEY', '6gdzV8tT2YFXJFt2vN6Kjopx824p61on');

require_once ROOT . 'control/index.php';

if ( !empty($_GET['url']) ) {
    $url = explode( '/', filter_var( rtrim( $_GET['url'], '/' ), FILTER_SANITIZE_URL ) );
} else {
    $url = '';
}


if ( isset( $url[0] ) && $url[0] == 'admin' ) {
    require_once ROOT . 'ui/admin.php';
} else {
    require_once ROOT . 'ui/index.php';
}

$control = new Control( $url );

// Functions
function URL($a = '') {
    echo URL . $a;
}

function URLa($a = '') {
    echo URL . 'admin/' . $a;
}

function LOGO() {
    echo LOGO;
}

function img($a = '', $styl = '', $z = true) {
    $style = '';
    if (trim($styl) != '') {
        $style = ' style="' . $styl . '"';
    } if ($z === true) {
        echo '<img src="/ui/img/' . $a . '" ' . $style . '>';
        // echo '<img src="' . UI . 'img/' . $a . '" ' . $style . '>';
    } else {
        return '<img src="/img/' . $a . '" ' . $style . '>';
    }
}

function upld_($a = '', $styl = '', $z = true) {
    list($width, $height, $type, $attr) = getimagesize(UI . 'uploads/' . $a);
    if ($width > $height) {
        $hh = 'class="hh" ';
    } else {
        $hh = '';
    } //if(($height*1.65)>$width){ $h = 'class="ww" '; }
    $style = '';
    if (trim($styl) != '') {
        $style = ' style="' . $styl . '"';
    } if ($z === true) {
        echo '<img src="' . UI . 'uploads/' . $a . '" ' . $hh . ' ' . $style . '>';
    } else {
        return '<img src="/uploads/' . $a . '" ' . $style . '>';
    }
}

function im($a = '', $cls = '') {
    $img_ext = ex('jpg|png|gif|bmp', '-1');
    if (!in_array(ex($a, 'last', '.'), $img_ext)) {
        $a = $a . '.png';
    }
    if($cls==''){ $attr = ''; } elseif(isJson($cls)){ $attr = tagAttr($cls); } else { $attr = ' class="'.$cls.'" '; }
    echo '<img src="/ui/img/' . $a . '" '.$attr.'>';
}

function upld($a = 'no.jpg', $cls = '') {
    $img_ext = ex('jpg|png|gif|bmp', '-1');
    if ($cls == '') {
        $attr = '';
    } elseif (isJson($cls)) {
        $attr = tagAttr($cls);
    } else {
        $attr = ' class="' . $cls . '" ';
    }
    if (!in_array(ex($a, 'last', '.'), $img_ext)) {
        $a = $a . '.png';
    }
    echo '<img src="/ui/uploads/' . $a . '" ' . $attr . ' >';
}

function js($a = '') {
    $a_ = explode('|', $a);
    foreach ($a_ as $aa) {
        if(ex($a, 'last','.')=='js') $ext = ''; else $ext = '.js';
        echo '<script type="text/javascript" src="/ui/js/' . trim($aa) . $ext .'"></script>';
        // echo '<script type="text/javascript" src="' . UI . 'js/' . trim($aa) . $ext .'"></script>';
    }
}

function css($a = '') {
    $a_ = explode('|', $a);
    foreach ($a_ as $aa) {
        if(ex($a, 'last','.')=='css') $ext = ''; else $ext = '.css';
        echo '<link href="/ui/css/' . trim($aa) . $ext . '" type="text/css" rel="stylesheet" />';
        // echo '<link href="' . UI . 'css/' . trim($aa) . $ext . '" type="text/css" rel="stylesheet" />';
    }
}

function e($val = '') {
    if (is_array($val) || is_object($val))
        p($val);
    else
        echo sr_($val);
}

function r($val = '') {
    return $val;
}

function p_($val = '') { print_r($val); }

function p($val = '') { echo '<pre>'; print_r($val); echo '</pre>'; }

function ex($val = '', $n = 0, $sp = '|') {
    if (empty($val)) {
        return $val;
    } elseif ($n === 'last') {
        $v_ = explode($sp, $val);
        return end($v_);
    } else {
        $v_ = explode($sp, $val);
        if ($n == '-1') {
            return $v_;
        } return !isset($v_[$n]) ? '' : $v_[$n];
    }
}


function arrToObj($dataArray) {
    if (!is_array($dataArray)) {
        return $dataArray;
    } $dataObject = new stdClass;
    foreach ($dataArray as $key => $value) {
        $dataObject->$key = (is_array($value)) ? arrToObj($value) : $value;
    } return $dataObject;
}

function objToArr($objArray) {
    $dataArray = array();
    foreach ($objArray as $key => $value) {
        $dataArray[$key] = (is_object($value)) ? (array) $value : $value;
    } return $dataArray;
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}


function sr($a) {
    return str_replace("'", "|+", $a);
}

function sr_($a) {
    return str_replace("|+", "'", $a);
}




?>