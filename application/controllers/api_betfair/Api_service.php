<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_service extends CI_Controller {

    public function index() {
        
    }

    public function service_odds($lista_mercado = null) {
        
        var_dump($lista_mercado);
        exit();

        $id_mercado_tratado = "";

        foreach ($lista_mercado as $mercado) {

            $id_mercado_tratado .= '"' . $mercado . '"' . ",";
        }

        echo $id_mercado_tratado = substr($id_mercado_tratado, 0, -2);


        $operacaoBook = "listMarketBook";
        $parametroBook = '{
                           "marketIds" : [' . $id_mercado_tratado . '"],
                           "priceProjection": {
                                                     "priceData": ["EX_ALL_OFFERS"],
                                                     "virtualise": "true"
                                                   },
    
                           "locale" : "pt"
                          }';

        $respostaBook = $this->api_model->executa_api_betfair($operacaoBook, $parametroBook);

        foreach ($respostaBook[0]->result as $mercadoBook) {
            $data_market[] = array(
                'mercado' => $this->core_model->get_by_id('mercado', array('mercado_id' => $mercadoBook->marketId)),
                'mandante_afavor' => isset($mercadoBook->runners[0]->ex->availableToBack[0]->price) ? $mercadoBook->runners[0]->ex->availableToBack[0]->price : '0.0',
                'visitante_afavor' => isset($mercadoBook->runners[1]->ex->availableToBack[0]->price) ? $mercadoBook->runners[1]->ex->availableToBack[0]->price : '0.0',
                'empate_afavor' => isset($mercadoBook->runners[2]->ex->availableToBack[0]->price) ? $mercadoBook->runners[2]->ex->availableToBack[0]->price : '0.0',
                'mandante_contra' => isset($mercadoBook->runners[0]->ex->availableToLay[0]->price) ? $mercadoBook->runners[0]->ex->availableToLay[0]->price : '0.0',
                'visitante_contra' => isset($mercadoBook->runners[1]->ex->availableToLay[0]->price) ? $mercadoBook->runners[1]->ex->availableToLay[0]->price : '0.0',
                'empate_contra' => isset($mercadoBook->runners[2]->ex->availableToLay[0]->price) ? $mercadoBook->runners[2]->ex->availableToLay[0]->price : '0.0',
            );
        }

        echo json_encode($data_market);
    }

    public function teste() {

        $id = array("1.176833737", "1.176848721", "1.176848406", "1.176848511");

        echo http_build_query($id);
        exit();
        //echo http_build_query($data, 'myvar_');
    }

}
