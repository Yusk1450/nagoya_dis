<?php

require_once 'tw_api.php';
require_once "DB/tweets.php";

$twTLReq = getTweets('#岐阜独立');
foreach ($twTLReq->statuses as $val)
{
	$id_str = $val->id_str;
	$username = $val->user->name;
	$screenname = $val->user->screen_name;
	$img_url = $val->user->profile_image_url;
	$date = $val->created_at;
	$text = $val->text;

	addTweetToDB($id_str, $username, $screenname, $img_url, $date, $text, 'p');
}

$twTLReq = getTweets('#岐阜完全服従');
foreach ($twTLReq->statuses as $val)
{
	$id_str = $val->id_str;
	$username = $val->user->name;
	$screenname = $val->user->screen_name;
	$img_url = $val->user->profile_image_url;
	$date = $val->created_at;
	$text = $val->text;

	addTweetToDB($id_str, $username, $screenname, $img_url, $date, $text, 'n');
}

function addTweetToDB($str_id, $username, $screenname, $img_url, $date, $text, $pn)
{
	if (!is_null($str_id))
	{
		// 注意：mysql_real_escape_stringはmysqlに接続していないと使えない
		$db = DB::GetInstance();

		// トランザクションスタート（注意：トランザクションはInnoDBのみ動作する）
		if (!$db->startTransaction())
		{
			echo "ERROR: Failed to start transaction.\n";
			return;
		}

		$username = mysql_real_escape_string($username);
		$screenname = mysql_real_escape_string($screenname);
		$img_url = mysql_real_escape_string($img_url);
		$date = mysql_real_escape_string($date);
		$text = mysql_real_escape_string($text);

		$tweet = new Tweets();
		$tweet->str_id = $str_id;
		$tweet->username = $username;
		$tweet->screenname = $screenname;
		$tweet->img = $img_url;
		$tweet->date = $date;
		$tweet->text = $text;
		$tweet->pn = $pn;
		if (!$tweet->insert())
		{
			$db->rollback();
			$db->endTransaction();
			return false;
		}

		$db->commit();
		$db->endTransaction();
	}
	else
	{
		echo "ERROR: POST 'str_id' param is null!\n";
		return false;
	}

	return true;
}