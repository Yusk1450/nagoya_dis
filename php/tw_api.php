<?php

require_once 'tw_oauth/twitteroauth.php';

$consumer_key = "AVNEG0HX3Vhpw7NawYj7ellwK";
$consumer_secret = "XVQUYJzdXqiqeXAziRZiZzmgNmvkqKLDwDchPDtkB3EEdcNueB";
$access_token = "19062623-ojOdNvBOPQMH4xgZweDX2Q5UGBkdJUiCFR0QCWeKk";
$access_token_secret = "beZ44DCeRbSrd5ePjULnSEpUfuoZ9CAoUJbf7SU0H0aBq";

function isReplyTweet($tweet_data)
{
    if (count($tweet_data->entities->user_mentions) <= 0)
    {
        return false;
    }
    return true;
}

/* -------------------------------------------------------------------------------------
 * 指定した文字列を含むツイートを返す
------------------------------------------------------------------------------------- */
function getTweets($word, $count = 100)
{
    global $consumer_key;
    global $consumer_secret;
    global $access_token;
    global $access_token_secret;

    $tw_obj = new TwitterOAuth(
        $consumer_key,
        $consumer_secret,
        $access_token,
        $access_token_secret);

    return $tw_obj->get('search/tweets', array('q' => $word, 'count' => $count, 'result_type' => 'recent'));
}

/* -------------------------------------------------------------------------------------
 * ユーザタイムラインを返す
------------------------------------------------------------------------------------- */
function getUserTimeline($screen_name, $count = 15)
{
	global $consumer_key;
	global $consumer_secret;
	global $access_token;
	global $access_token_secret;

	$tw_obj = new TwitterOAuth(
		$consumer_key,
		$consumer_secret,
		$access_token,
		$access_token_secret);

	return $tw_obj->get('statuses/user_timeline', array('screen_name' => $screen_name, 'count' => $count));
}

/* -------------------------------------------------------------------------------------
 * 指定ユーザのフォローリストを返す
------------------------------------------------------------------------------------- */
function getFollowUser($screen_name, $count = 20)
{
    global $consumer_key;
    global $consumer_secret;
    global $access_token;
    global $access_token_secret;

    $tw_obj = new TwitterOAuth(
        $consumer_key,
        $consumer_secret,
        $access_token,
        $access_token_secret);

    return $tw_obj->get('friends/list', array('screen_name' => $screen_name, 'count' => $count));
}

/* -------------------------------------------------------------------------------------
 * 形態素解析に不要な文字列を除去して返す	
------------------------------------------------------------------------------------- */
function removeNeedlessText($tweet_text, $tweet_data)
{
	//リプライネームの削除
    if(!is_null($tweet_data->entities->user_mentions))
    {
        foreach ($tweet_data->entities->user_mentions as $user)
        {
        	// echo "user: ".$user->screen_name."<br>";
            $tweet_text = str_replace("@".$user->screen_name, "", $tweet_text);
        }
    }
    // URL除去
    if (!empty($tweet_data->entities->urls))
    {
        foreach ($tweet_data->entities->urls as $url)
        {
        	// echo "url: ".$url."<br>";
            $tweet_text = str_replace($url->url, "", $tweet_text);
        }
    }
    // メディア除去
    if (!empty($tweet_data->entities->media))
    {
        foreach ($tweet_data->entities->media as $media)
        {
            $media_url = $media->url;
            // echo "media_url: ".$media_url."<br>";
            $tweet_text = str_replace($media_url, "", $tweet_text); 
        }
    }
    // ハッシュタグ除去
    if (!empty($tweet_data->entities->hashtags))
    {
        foreach ($tweet_data->entities->hashtags as $hash)
        {
            $hashtag = "#".$hash->text;
            // echo "hashtag: ".$hashtag."<br>";
            $tweet_text = str_replace($hashtag, "", $tweet_text); 
        }
    }
    // RTを削除する
    $tweet_text = str_replace("RT : ", "", $tweet_text);

    return $tweet_text;
}

?>