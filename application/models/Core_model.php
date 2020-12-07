<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model {

    public function get_all($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table)) {

            if (is_array($condition)) {
                $this->db->where($condition);
            }
            return $this->db->get($table)->result();
        } else {
            return false;
        }
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
                echo 'inserido com sucesso';
                //$this->session->set_flashdata('success', 'Dados salvos com sucesso!');
            } else {
               echo 'erro na inserção'; 
               //$this->session->set_flashdata('error', 'Não foi possivel salvar os dados');
            }
        } else {
            return false;
        }
    }

    public function update($table = null, $data = null, $condition = null) {

        if ($table && $this->db->table_exists($table) && is_array($data) && is_array($condition)) {

            if ($this->db->update($table, $data, $condition)) {
                $this->session->set_flashdata('success', 'Dados atualizados com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Não foi possivel atualizar os dados');
            }
        } else {
            return false;
        }
    }

    public function delete($table = null, $condition = null) {

        if ($table && $this->db->table_exists($table) && is_array($condition)) {

            if ($this->db->delete($table, $condition)) {
                $this->session->set_flashdata('success', 'Registro excluido com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Não foi possivel excluir o registro');
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
