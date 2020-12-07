<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model  extends CI_Model {

    public function index() {
       // $this->load->view('welcome_message');
    }

    public function executa_api($operacao = null, $parametro = null) {

        $appKey = "ps7eHG6ouYq6Nc7l";
        $sessionToken = "+xEyBPh8tAzGX1PjoE3sP7nHdHdmvzwpvYB9YR3Z7rI=";
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
        //var_dump($response);
//        foreach ($response[0]->result as $evento) {
//            var_dump($evento);
////            echo "<b>Preço(vitória mandante):</b> " . $evento->runners[0]->lastPriceTraded . "<br/>" . " | ";
////            echo "<b>Preço(vitória visitante):</b> " . $evento->runners[1]->lastPriceTraded . "<br/>" . " | ";
////            echo "<b>Preço(empate):</b> " . $evento->runners[2]->lastPriceTraded . "<br/>" . " | ";
////            echo "<b>Nome Mercado:</b> " . $evento->marketName . "<br/>" . " | ";
////            echo "<b>Qtd de mercados estão na comp: </b>" . $evento->marketCount ."<br/>". " | ";
////            echo "<b>Região: </b>" . $evento->competitionRegion ."<br/>". " | ";
//            //echo "<hr>";
//        }

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
