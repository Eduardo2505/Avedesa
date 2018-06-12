<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salir extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function close() {
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    
}
