<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_acao extends CI_Controller {

    public function index() {
        
    }

    public function core_competicao() {

        $this->core_model->delete_registros('competicoes');

        $operacao = "listCompetitions";
        $parametro = '{"filter" : {
                                   "eventTypeIds" : ["1"],
                                   "marketCountries": ["BR"]                                          
                                  },
                       "locale" : "pt"          
                      }';

        $resposta = $this->api_model->executa_api($operacao, $parametro);

        foreach ($resposta[0]->result as $competicao) {
            //if ($this->core_model->delete('competicoes')) {
            //if (!$this->core_model->get_by_id('competicoes', array('id' => $competicao->competition->id))) {
            $data['id'] = $competicao->competition->id;
            $data['nome'] = $competicao->competition->name;
            $data['regiao'] = $competicao->competitionRegion;
            $data['market_count'] = $competicao->marketCount;
            $data['data_cadastro'] = date('Y-m-d H:i:s');

            $this->core_model->insert('competicoes', $data);
            //} //fim do if
        }
    }

    public function core_evento() {
        $this->core_model->delete_registros('eventos');
        $lista_competicao = $this->core_model->get_all('competicoes');
        $id_tratado = "";

        foreach ($lista_competicao as $competicao) {
            $data_competicao[] = array(
                'id' => $competicao->id
            );
        }
        foreach ($data_competicao as $id) {
            $id_tratado .= '"' . $id['id'] . '"' . ",";
        }

        $id_tratado = substr($id_tratado, 0, -2);

        $operacao = "listEvents";
        $parametro = '{"filter" : {
                                    "eventTypeIds" : ["1"],
                                    "marketCountries": ["BR"],
                                    "marketBettingTypes": ["ASIAN_HANDICAP_DOUBLE_LINE"],
                                    "competitionIds":[' . $id_tratado . '"]
                                   },
                       "locale" : "pt"
                       
                      }';

        $resposta = $this->api_model->executa_api($operacao, $parametro);

        foreach ($resposta[0]->result as $evento) {
            //if ($this->core_model->delete('eventos')) {
            //if (!$this->core_model->get_by_id('eventos', array('id' => $evento->event->id))) {
            $data['id'] = $evento->event->id;
            $data['nome_evento'] = $evento->event->name;
            $data['pais_evento'] = $evento->event->countryCode;
            $data['timezone_evento'] = $evento->event->timezone;
            $data['data_evento'] = $evento->event->openDate;
            $data['market_count_evento'] = $evento->marketCount;
            $data['data_cadastro_evento'] = date('Y-m-d H:i:s');

            $this->core_model->insert('eventos', $data);
        }
    }

    public function core_mercado() {

        $lista_evento = $this->core_model->get_all('eventos');

        $id_evento_tratado = "";

        foreach ($lista_evento as $evento) {
            $data_id_evento[] = array(
                'id' => $evento->id
            );
        }
        foreach ($data_id_evento as $id) {
            $id_evento_tratado .= '"' . $id['id'] . '"' . ",";
        }

        $id_evento_tratado = substr($id_evento_tratado, 0, -2);


        $operacao = "listMarketCatalogue";
        $parametro = '{"filter" : {
                                       "eventIds" : [' . $id_evento_tratado . '"],
                                       "marketCountries": ["BR"],
                                       "marketTypeCodes": ["MATCH_ODDS"]
                                      },
                                "maxResults" : 1000,
                                "marketProjection": [
                                                     "COMPETITION",
                                                     "EVENT"
                                                    ],
                                "locale" : "pt"
          }';

        $resposta = $this->api_model->executa_api($operacao, $parametro);


        var_dump($resposta);

        exit();










        foreach ($lista_evento as $evento) {

            $operacao = "listMarketCatalogue";
            $parametro = '{"filter" : {
                                       "eventIds" : ["' . $evento->id . '"],
                                       "marketCountries": ["BR"],
                                       "marketTypeCodes": ["MATCH_ODDS"]
                                      },
                                "maxResults" : 1,
                                "marketProjection": [
                                                     "COMPETITION",
                                                     "EVENT"]
                                                    ]
                                "locale" : "pt"
          }';

            $resposta = $this->api_model->executa_api($operacao, $parametro);

            foreach ($resposta[0]->result as $mercado) {
                $operacaoBook = "listMarketBook";
                $parametroBook = '{
                                   "marketIds" : ["' . $mercado->marketId . '"],
                                   "locale" : "pt"
                                  }';

                $respostaBook = $this->api_model->executa_api($operacaoBook, $parametroBook);

                foreach ($respostaBook[0]->result as $mercadoBook) {
                    $data_market[] = array(
                        'competicao' => $evento->id_competicao,
                        'evento_id' => $evento->id,
                        'evento_nome' => $evento->nome_evento,
                        'evento_data' => $evento->data_evento,
                        'mandante' => isset($mercadoBook->runners[0]->lastPriceTraded) ? $mercadoBook->runners[0]->lastPriceTraded : '0.0',
                        'visitante' => isset($mercadoBook->runners[1]->lastPriceTraded) ? $mercadoBook->runners[1]->lastPriceTraded : '0.0',
                        'empate' => isset($mercadoBook->runners[2]->lastPriceTraded) ? $mercadoBook->runners[2]->lastPriceTraded : '0.0'
                    );
                }
            }
        }

        $data = array(
            'mercado' => $data_market,
            'competicao' => $lista_competicao,
        );

        $this->load->view('bet/index', $data);
    }

}
