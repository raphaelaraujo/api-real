<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model  extends CI_Model {

    public function index() {
       // $this->load->view('welcome_message');
    }

    public function executa_api($operacao = null, $parametro = null) {

        $appKey = "ps7eHG6ouYq6Nc7l";
        $sessionToken = "ED1bc3lEDroNkJ3BJYgoCbCD7WmlWlD4ttgOQdoQhko=";
        $url = "https://api.betfair.com/exchange/betting/json-rpc/v1";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:',
            'X-Application: ' . $appKey,
            'X-Authentication: ' . $sessionToken,
            'Accept: application/json',
            'Content-Type: application/json'
        ));

        $postData = '[{ "jsonrpc": "2.0", "method": "SportsAPING/v1.0/' . $operacao . '", "params" :' . $parametro . ', "id": 1}]';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = json_decode(curl_exec($ch));
        
        curl_close($ch);

        if (isset($response[1]->error)) {
            echo 'Call to api-ng failed: ' . "\n";
            echo 'Response: ' . json_encode($response);
            exit(-1);
        } else {
            return $response;
        }
    }

}
