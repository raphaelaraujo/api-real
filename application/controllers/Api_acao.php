<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_acao extends CI_Controller {

    public function index() {
        $this->load->view('welcome_message');
    }

    public function core_competicao() {

        $operacao = "listCompetitions";
        $parametro = '{"filter" : {
                                   "eventTypeIds" : ["1"],
                                   "marketCountries": ["BR"]                                          
                                  },
                       "locale" : "pt"          
                      }';

        $resposta = $this->api_model->executa_api($operacao, $parametro);

        foreach ($resposta[0]->result as $competicao) {

            if ($this->core_model->delete('competicoes')) {
                //if (!$this->core_model->get_by_id('competicoes', array('id' => $competicao->competition->id))) {    
                $data['id'] = $competicao->competition->id;
                $data['nome'] = $competicao->competition->name;
                $data['regiao'] = $competicao->competitionRegion;
                $data['market_count'] = $competicao->marketCount;
                $data['data_cadastro'] = date('Y-m-d H:i:s');

                $this->core_model->insert('competicoes', $data);
            }//fim do if
        }
    }

    public function core_evento() {

        $lista_competicao = $this->core_model->get_all('competicoes');

        foreach ($lista_competicao as $competicao) {
            $operacao = "listEvents";
            $parametro = '{"filter" : {
                                       "eventTypeIds" : ["1"],
                                       "marketCountries": ["BR"],
                                       "marketBettingTypes": ["ASIAN_HANDICAP_DOUBLE_LINE"],
                                       "competitionIds":["' . $competicao->id . '"]
                                      },
                           "locale" : "pt"      
                          }';

            $resposta = $this->api_model->executa_api($operacao, $parametro);


            foreach ($resposta[0]->result as $evento) {

                if ($this->core_model->delete('eventos')) {
                    //if (!$this->core_model->get_by_id('eventos', array('id' => $evento->event->id))) {
                    $data['id'] = $evento->event->id;
                    $data['id_competicao'] = $competicao->id;
                    $data['nome_evento'] = $evento->event->name;
                    $data['pais_evento'] = $evento->event->countryCode;
                    $data['timezone_evento'] = $evento->event->timezone;
                    $data['data_evento'] = $evento->event->openDate;
                    $data['market_count_evento'] = $evento->marketCount;
                    $data['data_cadastro_evento'] = date('Y-m-d H:i:s');

                    $this->core_model->insert('eventos', $data);
                }
            }
        }
    }

    public function core_mercado() {

        $lista_evento = $this->core_model->get_all('eventos');

        foreach ($lista_evento as $evento) {

            $competicao_obj = $this->core_model->get_by_id('competicoes', array('id' => $evento->id_competicao));
            $evento_obj = $this->core_model->get_by_id('eventos', array('id' => $evento->id));


            $operacao = "listMarketCatalogue";
            $parametro = '{"filter" : {
                                       "eventIds" : ["' . $evento->id . '"],
                                       "marketCountries": ["BR"],
                                       "marketTypeCodes": ["MATCH_ODDS"]
                                       },
                          "maxResults" : 1,
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

                var_dump($respostaBook);

//                foreach ($respostaBook[0]->result as $mercadoBook) {
//                    $data['id'] = $mercado->marketId;
//                    $data['id_competicao_mercado'] = $evento->id_competicao;
//                    $data['id_evento_mercado'] = $evento->id;
//                    $data['mandante_mercado'] = $mercadoBook->runners[0]->lastPriceTraded;
//                    $data['visitante_mercado'] = $mercadoBook->runners[1]->lastPriceTraded;
//                    $data['empate_mercado'] = $mercadoBook->runners[2]->lastPriceTraded;
//                    $data['data_cadastro_mercado'] = date('Y-m-d H:i:s');
//
//                    $this->core_model->insert('mercado', $data);
//                }
            }
        }
    }

}
