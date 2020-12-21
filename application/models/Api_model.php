<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function index() {
// $this->load->view('welcome_message');
    }

    public function executa_api_betfair($operacao = null, $parametro = null) {

        $appKey = "ps7eHG6ouYq6Nc7l";
        $sessionToken = "IMm4hI8MgtFqCV9PFVeU2Y6Y4iZ184GZskT/7eSOTjs=";
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

    public function executa_api_football($operacao = null) {

        $url = "https://api-football-v1.p.rapidapi.com/v2/";
        
        $curl = curl_init($url);
        //America/Sao_Paulo
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . $operacao,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: 6f5393819dmsh1f30076f07e26f9p152f89jsn9883399da3bb"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $obj = json_decode($response);
            
            return $obj;
        }
    }

}
