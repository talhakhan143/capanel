<?php
/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 5/31/2016
 * Time: 11:53 AM
 */

class CA_Capanel extends CA_Base{

    private $defaultModule = null;
    public $isLoggedIn = false;

    public function __construct()
    {
        $this->viewType = 'backend';
        parent::__construct();
        if(!$this->session->has_userdata("back_login") or $this->session->userdata("back_login") == NULL ){
            if(check_not_empty($this->uri->segment(2)) and $this->uri->segment(2) != "login"){
                $this->isLoggedIn = false;
                $this->ca_redirect("login");
            }
        }
    }

    public function getDefaultModule(){
        foreach ($this->modules_config as $name => $module){
            if(isset($module->isDefault) and $module->isDefault){
                $this->defaultModule = $module;
                break;
            }
        }

        return $this->defaultModule;
    }

    public function getDefaultModuleUrl(){
        return $this->base_url("module/".$this->getDefaultModule()->package);
    }

    public function ca_redirect($url = ""){
        redirect(base_url("capanel/".$url));
    }

    public function setPageTitle($pageName = ""){
        $this->setViewParam("pageTitle",(check_not_empty($pageName) ? $pageName." - " : "")."CaPanel");
    }

    public function base_url($url = false){
        return base_url(($url ? "capanel/".$url : ""));
    }
}