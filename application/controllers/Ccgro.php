<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ccgro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("registrobi");
        $this->bi = $this->registrobi;
    }

    public function index()
    {
        $this->load->view('ccgro');
    }

    public function agregarRegistro()
    {
        $registro = array(
            "fullname" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "telefono" => $this->input->post('telefono'),
            "mensaje" => $this->input->post('mensaje'),
        );

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => "smtp.gmail.com",//'mail.ccgro.com.mx',
            'smtp_port' => 465,//26,//465
            'smtp_user' => 'sacorus@gmail.com',//'admin@@ccgro.com.mx',
            'smtp_pass' => 'Et3lb3rt0',//'V1ct0rfu3nt3s@', // change it to yours
            //'mailtype' => 'html',
            //'charset' => 'iso-8859-1',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->sendMail();
        echo $this->bi->agregarRegistro($registro, $this->email);
	}
	
	function sendMail()
    {
        $this->email->from('admin@@ccgro.com.mx', 'Portal Web Información');
        $this->email->to('sacorus@gmail.com');        
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        if($this->email->send())
            return true;
        echo $this->email->print_debugger();
    }

}
