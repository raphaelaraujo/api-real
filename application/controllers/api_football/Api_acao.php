<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_acao extends CI_Controller {

    public function index() {

        $lista_competicao = $this->core_model->get_group_football('competicao_football', 'country');

        $data = array(
            'competicao' => $lista_competicao,
        );


        $this->load->view('football/index', $data);
//        $operacao = "fixtures/league/1396";
//        $resposta = $this->api_model->executa_api_football($operacao);
//        var_dump($resposta);
//
//        //327992
//        //1396
    }

    //America/Sao_Paulo        
    public function core_competicao() {

        $operacao = "leagues/current";
        $resposta = $this->api_model->executa_api_football($operacao);

        foreach ($resposta as $value) {

            $qtd = $value->results;

            for ($contador = 0; $contador < $qtd; $contador++) {

                if (!$this->core_model->get_by_id('competicao_football', array('league_id' => $value->leagues[$contador]->league_id))) {

                    $data['league_id'] = $value->leagues[$contador]->league_id;
                    $data['name'] = $value->leagues[$contador]->name;
                    $data['type'] = $value->leagues[$contador]->type;
                    $data['country'] = $value->leagues[$contador]->country;
                    $data['country_code'] = $value->leagues[$contador]->country_code;
                    $data['season'] = $value->leagues[$contador]->season;
                    $data['season_start'] = $value->leagues[$contador]->season_start;
                    $data['season_end'] = $value->leagues[$contador]->season_end;
                    $data['logo'] = $value->leagues[$contador]->logo;
                    $data['flag'] = $value->leagues[$contador]->flag;

                    $this->core_model->insert('competicao_football', $data);
                }
            }
        }
    }

    public function core_time($league_id) {

        $operacao = "teams/league/" . $league_id;
        $resposta = $this->api_model->executa_api_football($operacao);

        foreach ($resposta as $value) {
            $qtd = $value->results;

            for ($contador = 0; $contador < $qtd; $contador++) {

                $data['team_id'] = $value->teams[$contador]->team_id;
                $data['team_league_id'] = $league_id;
                $data['name_team'] = $value->teams[$contador]->name;
                $data['logo_team'] = $value->teams[$contador]->logo;
                $data['country_team'] = $value->teams[$contador]->country;
                $data['venue_name'] = $value->teams[$contador]->venue_name;
                $data['venue_address'] = $value->teams[$contador]->venue_address;
                $data['venue_city'] = $value->teams[$contador]->venue_city;
                $data['venue_capacity'] = $value->teams[$contador]->venue_capacity;

                $this->core_model->insert('time_football', $data);
            }
        }
    }

    public function core_jogos($league_id) {

        $operacao = "fixtures/league/" . $league_id;
        $resposta = $this->api_model->executa_api_football($operacao);

        foreach ($resposta as $value) {
            $qtd = $value->results;

            for ($contador = 0; $contador < $qtd; $contador++) {

                if (!$this->core_model->get_by_id('jogo_football', array('match_id ' => $value->fixtures[$contador]->fixture_id))) {
                    $data['match_id'] = $value->fixtures[$contador]->fixture_id;
                    $data['match_league_id'] = $value->fixtures[$contador]->league_id;
                    $data['round'] = $value->fixtures[$contador]->round;
                    $data['event_date'] = $value->fixtures[$contador]->event_date;
                    $data['status'] = $value->fixtures[$contador]->status;
                    $data['status_code'] = $value->fixtures[$contador]->statusShort;
                    $data['venue'] = $value->fixtures[$contador]->venue;
                    $data['referee'] = $value->fixtures[$contador]->referee;
                    $data['home_team_id'] = $value->fixtures[$contador]->homeTeam->team_id;
                    $data['home_team_name'] = $value->fixtures[$contador]->homeTeam->team_name;
                    $data['away_team_id'] = $value->fixtures[$contador]->awayTeam->team_id;
                    $data['away_team_name'] = $value->fixtures[$contador]->awayTeam->team_name;
                    $data['goals_home_team'] = $value->fixtures[$contador]->goalsHomeTeam;
                    $data['goals_away_team'] = $value->fixtures[$contador]->goalsAwayTeam;
                    $data['half_time'] = $value->fixtures[$contador]->score->halftime;
                    $data['full_time'] = $value->fixtures[$contador]->score->fulltime;
                    $data['extra_time'] = $value->fixtures[$contador]->score->extratime;
                    $data['penalty'] = $value->fixtures[$contador]->score->penalty;

                    $this->core_model->insert('jogo_football', $data);
                }
            }
        }
    }

    public function core_geral($league_id) {

        $this->core_time($league_id);
        $this->core_jogos($league_id);       
    }

    public function tela_competicao($pais) {

        $lista_competicao = $this->core_model->get_all_football('competicao_football', array('country' => $pais));

        $data = array(
            'competicao' => $lista_competicao,
        );

        $this->load->view('football/competicao', $data);
    }

    public function tela_jogo($competicao) {

        $lista_jogo = $this->core_model->get_all_jogo('jogo_football', array('match_league_id ' => $competicao));

        $data = array(
            'jogo' => $lista_jogo,
        );

        $this->load->view('football/jogo', $data);
    }

    public function tela_detalhe($jogo) {

        $lista_detalhe = $this->core_model->get_all_jogo('jogo_football', array('match_id ' => $jogo));

        $data = array(
            'detalhe' => $lista_detalhe,
        );

        $this->load->view('football/detalhe', $data);
    }

}
