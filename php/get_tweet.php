<?php

require_once "DB/tweets.php";

$pn = array();

// ポジティブツイート
$pTweets = Tweets::FindByPosiNega('p');
$p = array();
foreach ($pTweets as $tweet)
{
	$data = array();
	$data['username'] = $tweet->username;
	$data['screenname'] = $tweet->screenname;
	$data['img'] = $tweet->img;
	$data['date'] = $tweet->date;
	$data['text'] = $tweet->text;
	$data['count'] = $tweet->count;
	$p []= $data;
}
$pn['p'] = $p;

$nTweets = Tweets::FindByPosiNega('n');
$n = array();
foreach ($nTweets as $tweet)
{
	$data = array();
	$data['username'] = $tweet->username;
	$data['screenname'] = $tweet->screenname;
	$data['img'] = $tweet->img;
	$data['date'] = $tweet->date;
	$data['text'] = $tweet->text;
	$data['count'] = $tweet->count;
	$n []= $data;
}
$pn['n'] = $n;

echo json_encode($pn);