<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_aposta extends CI_Controller {

    public function index() {
        
    }

    public function aposta_competicao() {

        $this->core_model->delete_registros('competicoes');

        $operacao = "listCompetitions";
        $parametro = '{"filter" : {
                                   "eventTypeIds" : ["1"],
                                   "marketBettingTypes": ["ASIAN_HANDICAP_DOUBLE_LINE"],
                                   "marketCountries": ["BR"]                                         
                                  },
                       "locale" : "pt"          
                      }';

        $resposta = $this->api_model->executa_api_betfair($operacao, $parametro);

        foreach ($resposta[0]->result as $competicao) {
            $data['id'] = $competicao->competition->id;
            $data['nome'] = $competicao->competition->name;
            $data['regiao'] = $competicao->competitionRegion;
            $data['market_count'] = $competicao->marketCount;
            $data['data_cadastro'] = date('Y-m-d H:i:s');

            $this->core_model->insert('competicoes', $data);
            //} //fim do if
        }
    }

    public function aposta_evento() {
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

        $resposta = $this->api_model->executa_api_betfair($operacao, $parametro);

        foreach ($resposta[0]->result as $evento) {
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

    public function aposta_mercado() {

        $lista_evento = $this->core_model->get_all('eventos');
        $lista_competicao = $this->core_model->get_all('competicoes');
        //$this->core_model->delete_registros('mercado');

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

        $resposta = $this->api_model->executa_api_betfair($operacao, $parametro);

        foreach ($resposta[0]->result as $mercado) {

            if (!$this->core_model->get_by_id('mercado', array('mercado_id' => $mercado->marketId))) {
                $data['mercado_id'] = $mercado->marketId;
                $data['competicao_id'] = $mercado->competition->id;
                $data['evento_id'] = $mercado->event->id;
                $data['evento_nome'] = $mercado->event->name;
                $data['codigo_pais'] = $mercado->event->countryCode;
                $data['timezone'] = $mercado->event->timezone;
                $data['evento_data'] = date("d/m/Y H:i:s", strtotime($mercado->event->openDate));
                $data['data_cadastro'] = date("Y-m-d");

                $this->core_model->insert('mercado', $data);
            }
        }
    }

    public function aposta_odds() {

        $lista_competicao = $this->core_model->get_all_in('competicoes', 'id', array('13', '321319', '3172302'), 'nome');
        $lista_mercado = $this->core_model->get_all_in('mercado', 'competicao_id', array('13', '321319', '3172302'));

        $id_mercado_tratado = "";

        foreach ($lista_mercado as $mercado) {
            $data_id_mercado[] = array(
                'id' => $mercado->mercado_id
            );
        }
        foreach ($data_id_mercado as $id) {
            $id_mercado_tratado .= '"' . $id['id'] . '"' . ",";
        }

        $id_mercado_tratado = substr($id_mercado_tratado, 0, -2);

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

            if (!$this->core_model->get_by_id('aposta', array('aposta_mercado_id' => $mercadoBook->marketId))) {
                $data['aposta_mercado_id'] = $mercadoBook->marketId;
                $data['mandante_afavor'] = isset($mercadoBook->runners[0]->ex->availableToBack[0]->price) ? $mercadoBook->runners[0]->ex->availableToBack[0]->price : '0.0';
                $data['visitante_afavor'] = isset($mercadoBook->runners[1]->ex->availableToBack[0]->price) ? $mercadoBook->runners[1]->ex->availableToBack[0]->price : '0.0';
                $data['empate_afavor'] = isset($mercadoBook->runners[2]->ex->availableToBack[0]->price) ? $mercadoBook->runners[2]->ex->availableToBack[0]->price : '0.0';
                $data['mandante_contra'] = isset($mercadoBook->runners[0]->ex->availableToLay[0]->price) ? $mercadoBook->runners[0]->ex->availableToLay[0]->price : '0.0';
                $data['visitante_contra'] = isset($mercadoBook->runners[1]->ex->availableToLay[0]->price) ? $mercadoBook->runners[1]->ex->availableToLay[0]->price : '0.0';
                $data['empate_contra'] = isset($mercadoBook->runners[2]->ex->availableToLay[0]->price) ? $mercadoBook->runners[2]->ex->availableToLay[0]->price : '0.0';

                $this->core_model->insert('aposta', $data);
                
            } else {

                $data['aposta_mercado_id'] = $mercadoBook->marketId;
                $data['mandante_afavor'] = isset($mercadoBook->runners[0]->ex->availableToBack[0]->price) ? $mercadoBook->runners[0]->ex->availableToBack[0]->price : '0.0';
                $data['visitante_afavor'] = isset($mercadoBook->runners[1]->ex->availableToBack[0]->price) ? $mercadoBook->runners[1]->ex->availableToBack[0]->price : '0.0';
                $data['empate_afavor'] = isset($mercadoBook->runners[2]->ex->availableToBack[0]->price) ? $mercadoBook->runners[2]->ex->availableToBack[0]->price : '0.0';
                $data['mandante_contra'] = isset($mercadoBook->runners[0]->ex->availableToLay[0]->price) ? $mercadoBook->runners[0]->ex->availableToLay[0]->price : '0.0';
                $data['visitante_contra'] = isset($mercadoBook->runners[1]->ex->availableToLay[0]->price) ? $mercadoBook->runners[1]->ex->availableToLay[0]->price : '0.0';
                $data['empate_contra'] = isset($mercadoBook->runners[2]->ex->availableToLay[0]->price) ? $mercadoBook->runners[2]->ex->availableToLay[0]->price : '0.0';

                $this->core_model->update('aposta', $data, array('aposta_mercado_id' => $mercadoBook->marketId));
            }
        }
    }

    public function aposta_geral() {

        $this->aposta_competicao();
        $this->aposta_evento();
        $this->aposta_mercado();
        $this->aposta_odds();
    }

}
