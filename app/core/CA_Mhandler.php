<?php
/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 6/1/2016
 * Time: 11:00 AM
 */

class CA_Mhandler extends CA_Capanel{
    private $moduleName = "";
    private $module;
    private $viewName;
    public function __construct()
    {
        parent::__construct();
        $this->moduleName = $this->uri->segment(3);
        $this->viewType = $this->viewType.'/modules/'.$this->moduleName;

        $this->initialize();

        if(check_not_empty($this->uri->segment(4))){
            $this->viewName = $this->uri->segment(4);
        }else{
            $uiArray = (Array) $this->getUiUrls();
            $this->viewName = current(array_keys($uiArray));
        }
    }

    public function initialize($module = false){
        if(!$module){
            $moduleName = $this->moduleName;
        }else{
            $moduleName = $module;
        }
        if(isset($this->modules_config->$moduleName)){
            $this->module = $this->modules_config->$moduleName;
            $this->Dbo->setTableName($this->getDbConfig()->table);
            $this->setPageTitle($this->getModule()->title);
        }else{

        }
    }

    public function getModule(){
        return $this->module;
    }

    public function getUiUrls(){
        return $this->getModule()->urls->ui;
    }

    public function getCtrlUrls(){
        return $this->getModule()->urls->ctrls;
    }

    public function getDbConfig(){
        return $this->getModule()->db_config;
    }

    public function getViewName(){
        $name = $this->viewName;
        return $this->getUiUrls()->$name;
    }

    public function loadCurrentView(){
        $this->loadView($this->getViewName());
    }

    public function loadBtmJs($specificPageVendor = "btmJs.php"){
        $this->loadView("btmJs","backend/tpl");
        if($specificPageVendor != false){
            $this->loadView("tpl/".$specificPageVendor);
        }
        $this->loadView("jsInits","backend/tpl");
    }
}