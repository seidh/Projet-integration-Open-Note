<?php
class custom404 extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        //$this->data['content'] = 'custom404view';  // View name
        $this->data['ip_addr'] = $this->input->ip_address();
        $this->load->view('custom404view', $this->data);
    }
}
?>