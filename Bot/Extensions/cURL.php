<?php


/**
 * A standalone Curl class to get the html file
 */
class Curl {

    public $ch;

    public function __construct($domain = ''){
        if (strlen($domain) < 1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domain);

        $this->ch = $ch;
        
    }

    public function setUserAgent($user_agent){
        if (is_null($user_agent)) throw new Exception('The passed argument http header must not null.');

        curl_setopt($this->ch, CURLOPT_USERAGENT, $user_agent);
    }

    public function seHttpHeader($httpheader){
        /* the example
        "Upgrade-Insecure-Requests: 1",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,
        */
        if (!is_array($httpheader)) throw new Exception('The passed argument http header must an array.');
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $httpheader);
    }


    public function curlExec(){
        // return the transfer as a string 
        //curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch,CURLOPT_VERBOSE,1);
        curl_setopt($this->ch, CURLOPT_REFERER,'http://www.google.com');  //just a fake referer
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch,CURLOPT_POST,0);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 20);


        $output = curl_exec($this->ch); 


        return $output;
    }
}
