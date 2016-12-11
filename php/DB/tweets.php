<?php

require_once "dao_base.php";


class Tweets extends DAOBase
{
	public $index = null;
	public $str_id = '';		// TweetID
	public $username = '';		// ユーザ名
	public $screenname = '';	// スクリーン名
	public $img = '';			// アイコンURL
	public $date = '';			// 投稿日時
	public $text = '';			// ツイート本文
	public $pn = '';			// ネガティブ or ポジティブ
	public $count = 0;			// 共感カウント

	public function __construct()
	{
		$this->_table_name = Tweets::TableName();
	}

	public static function TableName()
	{
		return "Tweets";
	}

	public function insert()
	{
		return $this->insertRecord("tweets_id,
									tweets_str_id,
									tweets_username,
									tweets_screenname,
									tweets_img,
									tweets_date,
									tweets_text,
									tweets_pn,
									tweets_count",
									"'',
									'$this->str_id',
									'$this->username',
									'$this->screenname',
									'$this->img',
									'$this->date',
									'$this->text',
									'$this->pn',
									'$this->count'");
	}

	public static function FindAll()
	{
		$res = DAOBase::executeQuery(Tweets::TableName(), "*", false);
		return Tweets::TweetsFromResource($res);
	}

	public static function FindByTweetIndex($tweet_id)
	{
		$res = DAOBase::executeQuery(Tweets::TableName(), "*", false, "tweets_str_id = '${tweet_id}'");
		return Tweets::TweetsFromResource($res);
	}

	public static function TweetsFromResource($res)
	{
		$results = array();
		while ($row = mysql_fetch_object($res))
		{
			$tweets = new Tweets();
			$tweets->index = $row->tweets_id;				// インデックス
			$tweets->str_id = $row->tweets_str_id;			// TweetID
			$tweets->username = $row->tweets_username;		// ユーザ名
			$tweets->screenname = $row->tweets_screenname;	// スクリーン名
			$tweets->img = $row->tweets_img;				// アイコンURL
			$tweets->date = $row->tweets_date;				// 投稿日時
			$tweets->text = $row->tweets_text;				// ツイート本文
			$tweets->pn = $row->tweets_pn;					// ネガティブ or ポジティブ
			$tweets->count = $row->tweets_count;			// 共感カウント
			$results[] = $tweets;
		}
		return $results;
	}
}

?>