<?php

/**
 * Created by PhpStorm.
 * User: ajit
 * Date: 29/4/16
 * Time: 12:12 AM
 */

require_once "twitteroauth-master/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
class TwitterConnection
{
    private $conn;

    public function __construct()
    {
        $config = require_once 'Config.php';
        $this->conn = new TwitterOAuth($config['CONSUMER_KEY'], $config['CONSUMER_SECRET'],
            $config['ACCESS_TOKEN'], $config['ACCESS_TOKEN_SECRET']);
    }

    public function getConnectionInstance(){
        return $this->conn;
    }

}