<?php
$this->load->view("templates/header");
switch ($sidebar) {
    case 'normal': $this->load->view("templates/sidebar");
        break;
    case 'admin' : $this->load->view("templates/sidebarAdmin");
        break;
    case 'profil' : $this->load->view("templates/sidebarProfil");
        break;
    default: $this->load->view("templates/sidebar");
        break;
}
$this->load->view($contents);
$this->load->view("templates/footer"); 
?>