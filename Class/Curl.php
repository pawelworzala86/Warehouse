<?php

namespace App;


class Curl
{
    private $curl;

    public function __construct()
    {
        $this->curl = \curl_init();
    }

    public function close(){
        \curl_close($this->curl);
    }

    public function get(string $url){
        $this->curl = \curl_init();
        \curl_setopt($this->curl,CURLOPT_URL, $url);
        \curl_setopt($this->curl,CURLOPT_CUSTOMREQUEST, 'GET');
        \curl_setopt($this->curl,CURLOPT_POSTFIELDS, null);
        \curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        return \curl_exec($this->curl);
    }

    public function post(string $url, string $data){
        \curl_setopt($this->curl,CURLOPT_URL, $url);
        \curl_setopt($this->curl,CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($this->curl,CURLOPT_POSTFIELDS, $data);
        \curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        return \curl_exec($this->curl);
    }

    public function put(string $url, string $data){
        \curl_setopt($this->curl,CURLOPT_URL, $url);
        \curl_setopt($this->curl,CURLOPT_CUSTOMREQUEST, 'PUT');
        \curl_setopt($this->curl,CURLOPT_POSTFIELDS, $data);
        \curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        return \curl_exec($this->curl);
    }
}