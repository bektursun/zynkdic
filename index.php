<?php
define('ZYNK', true);
define('ZYNK_DIR', dirname(__FILE__));
define('ZYNK_DS', DIRECTORY_SEPARATOR);
define('ZYNK_SETTING', ZYNK_DIR.ZYNK_DS.'Setting'.ZYNK_DS);
define('ZYNK_INCLUDE', ZYNK_DIR.ZYNK_DS.'Include'.ZYNK_DS);
define('ZYNK_LIBRARY', ZYNK_INCLUDE.'Library'.ZYNK_DS);

if (file_exists(ZYNK_SETTING.'Config.php')){
    require_once (ZYNK_SETTING.'Config.php');
}
else
{
    die('Config file not found');
}
require_once (ZYNK_INCLUDE.'Init.php');

if (isset($_REQUEST['query'])) {
    switch ($_REQUEST['lang']) {
        case 'ru':
            $query = "SELECT  word,translate FROM ru_to_kg WHERE word LIKE '{$_REQUEST['query']}'";
            break;
        case 'kg':
            $query = "SELECT  word,translate FROM kg_to_ru WHERE word LIKE '{$_REQUEST['query']}'";
            break;
        default:
            $query = "SELECT  word,translate FROM ru_to_kg WHERE word LIKE '{$_REQUEST['query']}'";
    }


    $words = Database::getInstance()->query($query)->get('rows');
    if (!empty($words)) {
        echo(json_encode($words));
    } else {
        echo(json_encode(['error' => 'Word not found']));
    }
}

