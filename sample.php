<?php

require_once('TwitterAPI.php');

$twitterAPI = new TwitterAPI();
print_r(json_decode($twitterAPI->request(
  'GET',                                                     // method
  'https://api.twitter.com/1.1/statuses/user_timeline.json', // url
  array(                                                     // parameters
    'screen_name' => '@_jyane',
    'count' => 10
  )
)));
