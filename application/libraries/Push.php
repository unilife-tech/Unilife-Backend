<?php

/**
 * Push notification file 
 */
class Push {
    private $title;
    private $message;
    private $od_id;
    private $to_id;
    private $fname;
    private $uid;
    private $data;

    function __construct() {
        
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setoid($to_id) {
        $this->to_id = $to_id;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function setfname($fname) {
        $this->fname = $fname;
    }


    public function setProfile($od_id) {
        $this->od_id = $od_id;
    }

    public function setUser($uid) {
        $this->uid = $uid;
    }

    public function setPayload($data) {
        $this->data = $data;
    }

    public function getPush() {
        $res = array();
        $res['title'] = $this->title;
        $res['body'] = $this->message;
        $res['fname'] = $this->fname;
        $res['to_id'] = $this->to_id;
        $res['uid'] = $this->uid;
        return $res;
    }

}