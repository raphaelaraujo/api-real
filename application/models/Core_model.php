<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Core_model extends CI_Model{

	public function get_all_jogo($table = null, $condition = null) {
        $this->db->select('*'
                . ',(select logo_team from time_football WHERE home_team_id = team_id and match_league_id = team_league_id limit 1 ) as logo_home_team'
                . ',(select logo_team from time_football WHERE away_team_id = team_id and match_league_id = team_league_id limit 1 ) as logo_away_team'
                . ',SUBSTRING(ROUND, 18, 2) AS rodada');
        $this->db->where($condition);
        return $this->db->get($table)->result();
    }
	
	public function get_all($table = NULL, $condition = NULL){
		
		if($table && $this->db->table_exists($table)){
			
			if(is_array($condition)){

				$this->db->where($condition);
				//$this->db->where('data_cadastro >= CURDATE() ');
			}

			return $this->db->get($table)->result();

		} else {
			return FALSE;
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

	public function get_by_id($table = NULL, $condition = NULL){
		if($table && $this->db->table_exists($table) && is_array($condition)){
			
			$this->db->where($condition);
			$this->db->limit(1);

			return $this->db->get($table)->row();
		} else {
			return FALSE;
		}
	}

	public function insert($table = NULL, $data = NULL){
		
		if($table && $this->db->table_exists($table) && is_array($data)){
			
			$this->db->insert($table, $data);

			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
			} else {
				$this->session->set_flashdata('error', 'Não foi possível salvar os dados!');
			}

		} else {
			return FALSE;
		}
	}

	public function update($table = NULL, $data = NULL, $condition = NULL){

		if($table && $this->db->table_exists($table) && is_array($data) && is_array($condition)){

			if($this->db->update($table, $data, $condition)){

				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');

			} else {
				$this->session->set_flashdata('error', 'Não foi possível salvar os dados!');
			}

		} else {
			return FALSE;
		}
	}

	public function delete($table = NULL, $condition = NULL){

		if($table && $this->db->table_exists($table) && is_array($condition)){

			if($this->db->delete($table, $condition)){
				$this->session->set_flashdata('sucesso', 'Registro excluído com sucesso');
			} else {
				$this->session->set_flashdata('error', 'Não foi possível excluir o registro!');
			}
		} else {
			return FALSE;
		}
	}
}