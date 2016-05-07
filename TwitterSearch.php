<?php
/**
 * Created by PhpStorm.
 * User: ajit
 * Date: 29/4/16
 * Time: 12:09 AM
 */
require_once 'TwitterConnection.php';
Class TwitterSearch{

    private $search;
    private $account = 'Your Account';
    private $count = 25;
    private $result_type = 'recent';
    private $connection;

    public function __construct(Abraham\TwitterOAuth\TwitterOAuth $connection)
    {
        $this->connection = $connection;
    }

    public function setAccount($account){
        $this->account = $account;
    }
    public function setCount($count){
        $this->count = $count;
    }
    public function setResultType($result_type){
        $this->result_type = $result_type;
    }

    public function setSearchTerm($term){
        $this->search = $term;
    }

    public function getResults(){
        $query = $this->getQuery();
        return $this->connection->get('search/tweets', $query);
    }

    private function getQuery(){
        $search = isset($this->account) ? '@'.$this->account : '';
        $search .= isset($this->search) ? ' '.$this->search : '';

        $query = array(
            "q" => $search,
            "count" => $this->count,
            "result_type" => $this->result_type
        );

        return $query;
    }

}