<?php

require('smarty/Smarty.class.php');

date_default_timezone_set('Asia/Tokyo');

$smarty = new Smarty();

$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';

// $smarty->assign('title', 'ページタイトル');
$smarty->display('index.tpl');

?>