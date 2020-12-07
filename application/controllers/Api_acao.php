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
            var_dump($competicao);

            $data['id'] = $competicao->competition->id;
            $data['nome'] = $competicao->competition->name;
            $data['regiao'] = $competicao->competitionRegion;
            $data['market_count'] = $competicao->marketCount;
            $data['data_cadastro'] = date('Y-m-d H:i:s');

            $this->core_model->insert('competicoes', $data);

//            echo "<b>Preço(vitória mandante):</b> " . $evento->runners[0]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Preço(vitória visitante):</b> " . $evento->runners[1]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Preço(empate):</b> " . $evento->runners[2]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Nome Mercado:</b> " . $evento->marketName . "<br/>" . " | ";
//            echo "<b>Qtd de mercados estão na comp: </b>" . $evento->marketCount ."<br/>". " | ";
//            echo "<b>Região: </b>" . $evento->competitionRegion ."<br/>". " | ";
            //echo "<hr>";
        }
    }

}
