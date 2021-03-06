<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_acao_1 extends CI_Controller {

    public function index() {
        
    }

    public function core_competicao() {

        $this->core_football_model->delete_registros('competicoes');

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

            $this->core_football_model->insert('competicoes', $data);
//} //fim do if
        }
    }

    public function core_evento() {
        $this->core_football_model->delete_registros('eventos');

        if ($this->core_football_model->get_all('competicoes')) {
            $lista_competicao = $this->core_football_model->get_all('competicoes');
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

                $this->core_football_model->insert('eventos', $data);
            }
        } else {
            echo "Erro ->evento";
        }
    }

    public function core_mercado() {
        if ($this->core_football_model->get_all('eventos') && $this->core_football_model->get_all('competicoes')) {
            $lista_evento = $this->core_football_model->get_all('eventos');
            $lista_competicao = $this->core_football_model->get_all('competicoes');
//$this->core_football_model->delete_registros('mercado');

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


            foreach ($resposta[0]->result as $mercado) {

                if (!$this->core_football_model->get_by_id('mercado', array('mercado_id' => $mercado->marketId))) {

                    $data['mercado_id'] = $mercado->marketId;
                    $data['competicao_id'] = $mercado->competition->id;
                    $data['evento_id'] = $mercado->event->id;
                    $data['evento_nome'] = $mercado->event->name;
                    $data['codigo_pais'] = $mercado->event->countryCode;
                    $data['timezone'] = $mercado->event->timezone;
                    $data['evento_data'] = date("d/m/Y H:i:s", strtotime($mercado->event->openDate));

                    $this->core_football_model->insert('mercado', $data);
                }
            }
        } else {
            echo "Erro ->evento";
        }
    }

    public function core_odds() {

//$lista_competicao = $this->core_football_model->get_all('competicoes');
//$lista_mercado = $this->core_football_model->get_all('mercado');
        if (
                $this->core_football_model->get_all_in('competicoes', 'id', array('13', '321319', '3172302'), 'nome') &&
                $this->core_football_model->get_all_in('mercado', 'competicao_id', array('13', '321319', '3172302'))
        ) {

            $lista_competicao = $this->core_football_model->get_all_in('competicoes', 'id', array('13', '321319', '3172302'), 'nome');
            $lista_mercado = $this->core_football_model->get_all_in('mercado', 'competicao_id', array('13', '321319', '3172302'));


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


            $respostaBook = $this->api_model->executa_api($operacaoBook, $parametroBook);

            foreach ($respostaBook[0]->result as $mercadoBook) {
                $data_market[] = array(
                    'book_id' => $mercadoBook->marketId,
                    'mandante_afavor' => isset($mercadoBook->runners[0]->ex->availableToBack[0]->price) ? $mercadoBook->runners[0]->ex->availableToBack[0]->price : '0.0',
                    'visitante_afavor' => isset($mercadoBook->runners[1]->ex->availableToBack[0]->price) ? $mercadoBook->runners[1]->ex->availableToBack[0]->price : '0.0',
                    'empate_afavor' => isset($mercadoBook->runners[2]->ex->availableToBack[0]->price) ? $mercadoBook->runners[2]->ex->availableToBack[0]->price : '0.0',
                    'mandante_contra' => isset($mercadoBook->runners[0]->ex->availableToLay[0]->price) ? $mercadoBook->runners[0]->ex->availableToLay[0]->price : '0.0',
                    'visitante_contra' => isset($mercadoBook->runners[1]->ex->availableToLay[0]->price) ? $mercadoBook->runners[1]->ex->availableToLay[0]->price : '0.0',
                    'empate_contra' => isset($mercadoBook->runners[2]->ex->availableToLay[0]->price) ? $mercadoBook->runners[2]->ex->availableToLay[0]->price : '0.0',
                );
            }


            $data = array(
                'book' => $data_market,
                'competicao' => $lista_competicao,
                'mercado' => $lista_mercado
            );

            $this->load->view('bet/index_layout', $data);
        } else {
            echo "Erro ->odds";
        }
    }

    public function core_geral() {

        $this->core_competicao();
        $this->core_evento();
        $this->core_mercado();
        $this->core_odds();
    }

}
