<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_football_model extends CI_Model {

    public function get_all_jogo($table = null, $condition = null) {
        $this->db->select('*'
                . ',(select logo_team from time_football WHERE home_team_id = team_id and match_league_id = team_league_id limit 1 ) as logo_home_team'
                . ',(select logo_team from time_football WHERE away_team_id = team_id and match_league_id = team_league_id limit 1 ) as logo_away_team'
                . ',SUBSTRING(ROUND, 18, 2) AS rodada');
        $this->db->where($condition);
        return $this->db->get($table)->result();
    }

    public function get_all($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table)) {

            if (is_array($condition)) {
                $this->db->where($condition);
                $this->db->where('data_cadastro >= CURDATE() ');
            }
            return $this->db->get($table)->result();
        } else {
            return false;
        }
    }

    public function get_all_football($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table)) {

            if (is_array($condition)) {
                $this->db->where($condition);
            }
            return $this->db->get($table)->result();
        } else {
            return false;
        }
    }

    public function get_group_football($table = null, $group_field = null) {

        if ($table && $this->db->table_exists($table)) {
          
            $this->db->group_by($group_field);

            return $this->db->get($table)->result();
        } else {
            return false;
        }
    }

    public function get_all_in($table = null, $campo = null, $value = null, $order_field = null) {

        if ($table && $this->db->table_exists($table)) {

            if (is_array($value)) {
                $this->db->where_in($campo, $value);
                $this->db->where('data_cadastro >= CURDATE() ');
                $this->db->order_by($order_field, 'ASC');
            }
            return $this->db->get($table)->result();
        } else {
            return false;
        }
    }

    public function get_all_join() {
        $this->db->select('*');
        $this->db->from('competicoes');
        $this->db->where('EXISTS (select * from `eventos` WHERE `competicoes`.`id` = `eventos`.`id_competicao` and `eventos`.`data_cadastro_evento` >= CURDATE())');

        return $this->db->get()->result();
    }

    public function delete_registros($table) {
        $this->db->empty_table($table);
    }

    public function get_by_id($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table) && is_array($condition)) {

            $this->db->where($condition);
            $this->db->limit(1);

            return $this->db->get($table)->row();
        } else {
            return false;
        }
    }

    public function insert($table = null, $data = null, $get_last_id = null) {

        if ($table && $this->db->table_exists($table) && is_array($data)) {

            $this->db->insert($table, $data);

            //insere na sessão o ultimo ID inserido na base de dados
            if ($get_last_id) {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if ($this->db->affected_rows() > 0) {
                //echo 'inserido com sucesso';
                //$this->session->set_flashdata('success', 'Dados salvos com sucesso!');
            } else {
                //echo 'erro na inserção';
                //$this->session->set_flashdata('error', 'Não foi possivel salvar os dados');
            }
        } else {
            return false;
        }
    }

    public function update($table = null, $data = null, $condition = null) {

        if ($table && $this->db->table_exists($table) && is_array($data) && is_array($condition)) {

            if ($this->db->update($table, $data, $condition)) {
                // $this->session->set_flashdata('success', 'Dados atualizados com sucesso!');
            } else {
                // $this->session->set_flashdata('error', 'Não foi possivel atualizar os dados');
            }
        } else {
            return false;
        }
    }

    public function delete($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table) && is_array($condition)) {

            if ($this->db->delete($table, $condition)) {
                //echo 'deletado com sucesso';
                //$this->session->set_flashdata('success', 'Registro excluido com sucesso!');
            } else {
                //echo 'erro no delete';
                //$this->session->set_flashdata('error', 'Não foi possivel excluir o registro');
            }
        } else {
            return false;
        }
    }

    public function generate_unique_code($table = null, $type_code = null, $cod_size = null, $search_field = null) {

        do {

            $codigo = random_string($type_code, $cod_size);
            $this->db->where($search_field, $codigo);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $codigo;
    }

}
