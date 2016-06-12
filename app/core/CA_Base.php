<?php
/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 5/31/2016
 * Time: 11:43 AM
 */

class CA_Base extends CI_Controller{

    private $viewData = array();
    public $viewType = "frontend";
    public $modules_config;
    private $jsonResponse = array(
        "message" => "",
        "error" => true,
    );

    public function __construct()
    {
        parent::__construct();
        $this->modules_config = $this->config->item("modules_config");
        $this->setViewParam("base_class",get_instance());
    }

    //i have one question in load view method regarding path.
    public function loadView($viewName = false,$path = false){
        if($viewName != false){
            $this->load->view((!$path ? $this->viewType : $path)."/".$viewName,$this->viewData);
        }
    }

    public function setViewParam($name = "",$value = ""){
        $this->viewData[$name] = $value;
    }
    
    public function getViewParam($name = false){
        if($name){
            if(isset($this->viewData[$name])){
                return $this->viewData[$name];
            }else{
                return false;
            }
        }else{
            return $this->viewData;
        }
    }

    public function setJsonResponse($name = "",$value = ""){
        if(check_not_empty($name)){
            $this->jsonResponse[$name] = $value;
        }
    }

    public function printJsonResponse(){
        echo json_encode($this->jsonResponse);
    }
}