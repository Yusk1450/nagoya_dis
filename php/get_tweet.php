<?php

// TODO: データベースからツイートを取得する

/* -------------------------------------------------------------------------------------
 * 指定した文字列の感情を分析する
------------------------------------------------------------------------------------- */
// function analyzeSentiment($text)
// {
// 	$url = 'http://mueki.net/twana/api.php';
// 	$data = array(
// 	    'q' => $text,
// 	);
// 	$data = http_build_query($data);

// 	$header = array(
//         "Content-Type: application/x-www-form-urlencoded",
//         "Content-Length: ".strlen($data)
//     );
// 	$options = array('http' => array(
// 	    'method' => 'POST',
// 	    'header' => implode("\r\n", $header),
// 	    'content' => $data
// 	));
// 	$pn = file_get_contents($url, false, stream_context_create($options));

// 	$data = array();
// 	$data['pn'] = $pn;
// 	$data['text'] = $text;

// 	return $data;
// }