<?php

class OAuthUtil {
  public static function urlencodeRFC3986($input)
  {
    return str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($input)));
  }

  public static function generateNonce()
  {
    $mt = microtime();
    $rand = mt_rand();
    return md5($mt . $rand);
  }
}
