<?php

require_once('OAuthRequest.php');

class TwitterAPI {
  // Some rental servers do not allow "allow_url_fopen".
  // Use curl_exec() instead of file_get_contents().
  private function curl($method, $request_url, $header)
  {
    $curl = curl_init($request_url);
    $options = array(
      CURLOPT_HTTPHEADER => array('Authorization: OAuth ' . $header),
      CURLOPT_RETURNTRANSFER => true
    );
    if ($method === 'POST') {
      curl_setopt($curl, CURLOPT_POST, true);
    }
    curl_setopt_array($curl, $options);
    return curl_exec($curl);
  }

  private function connect($method, $url, $setting)
  {
    $oAuthRequest = new OAuthRequest($method, $url, $setting);
    $header = $oAuthRequest->buildRequestHeader();
    $request_url = $oAuthRequest->buildRequestURL();
    return $this->curl($method, $request_url, $header);
  }

  public function getUserTweets($setting)
  {
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    return $this->connect('GET', $url, $setting);
  }
}

