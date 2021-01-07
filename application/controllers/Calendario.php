<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Calendario extends CI_Controller{

	public function index(){

		$data = array(
			'titulo' => 'Agenda',
			'subtitulo' => 'Gerenciamento de seus compromissos',

			'styles' => array(
				'plugins/fullcalendar/dist/fullcalendar.min.css',
				'plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css',
			),

			'scripts' => array(
				'plugins/moment/moment.js',
				'plugins/fullcalendar/dist/fullcalendar.min.js',
				'plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js',
				'js/calendar.js',
				//'js/pt-br.js',

			)	
			//'usuarios' =>  $this->ion_auth->users()->result(), // get all users
		);

		/*
		echo '<pre>';
		print_r($data['usuarios']);
		exit();
		*/

		$this->load->view('layout/header', $data);
		$this->load->view('calendario/index');
		$this->load->view('layout/footer');
	}
}