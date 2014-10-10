<?php

require_once('TwitterAPI.php');

$twitterAPI = new TwitterAPI();
print_r(json_decode($twitterAPI->getUserTweets(
  array(
    'screen_name' => '@_jyane',
    'count' => 10
  )
)));
