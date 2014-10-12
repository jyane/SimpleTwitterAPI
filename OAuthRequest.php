<?php

require_once('config.php');
require_once('OAuthUtil.php');


class OAuthRequest {
  private $parameter;
  private $method;
  private $url;
  private $setting;

  function __construct($method, $url, $setting)
  {
    $this->method = $method;
    $this->url = $url;
    $this->setting = $setting;
    $this->parameter = $this->setting;
  }

  private function buildOAuthSetting()
  {
    return array(
      'oauth_consumer_key' => CONSUMER_KEY,
      'oauth_token' => ACCESS_TOKEN,
      'oauth_nonce' => OAuthUtil::generateNonce(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0'
    );
  }

  public function buildSignature()
  {
    $this->parameter = array_merge($this->parameter, $this->buildOAuthSetting());
    ksort($this->parameter);
    $data = implode('&', array(
      OAuthUtil::urlencodeRFC3986($this->method),
      OAuthUtil::urlencodeRFC3986($this->url),
      OAuthUtil::urlencodeRFC3986(http_build_query($this->parameter, '', '&'))
    ));
    $key = implode('&', array(CONSUMER_SECRET, ACCESS_TOKEN_SECRET));
    $hash = hash_hmac('sha1', $data, $key, true);
    return base64_encode($hash);
  }

  public function buildRequestHeader()
  {
    $signature = $this->buildSignature();
    $this->parameter['oauth_signature'] = $signature;
    return http_build_query($this->parameter, '', ',');
  }

  public function buildRequestURL()
  {
    return $this->url . '?' . http_build_query($this->setting, '', '&');
  }
}

