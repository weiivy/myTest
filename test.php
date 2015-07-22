<?php
/**
 * Created by PhpStorm.
 * User: zhangweiwei
 * Date: 15/7/22
 * Time: 下午10:48
 */

require_once 'preg.php';
$regex = new regexTool();
$regex->setFixMode('U');



/**
 * 打印结果
 * @param null $var
 * @param bool $isdump
 */
function show($var = null, $isdump = false)
{
    $func = $isdump ? 'var_dump' : 'print_r';
    if(empty($var)) {
        echo 'null';
    } elseif(is_array($var) || is_object($var)) {
        echo '<pre>';
        $func($var);
        echo '</pre>';
    } else {
        echo $var;
    }
}