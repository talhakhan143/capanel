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
            redirect($this->getUiUrls($this->viewName,true));
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

    public function getUploadDir($view = false){
        if(!$view){
            return "assets/uploads/".$this->getModule()->upload_dir;
        }else{
            return "../uploads/".$this->getModule()->upload_dir;
        }

    }

    public function getDbPrefix($fieldName = false){
        if(!$fieldName){
            return $this->getDbConfig()->prefix;
        }else{
            return $this->getDbConfig()->prefix.$fieldName;
        }
    }

    public function getDbTable(){
        return $this->getDbConfig()->table;
    }

    public function getUiUrls($uiName = false, $buildLink = false){
        $uis = $this->getModule()->urls->ui;
        if(!$uiName){
            return $uis;
        }else{
            $uis = (Array) $uis;
            return ($buildLink ? $this->module_base_url($uis[$uiName]) : $uis[$uiName]);
        }
    }

    public function getCtrlUrls($ctrlName = false, $buildLink = false){
        $ctrls = $this->getModule()->urls->ctrls;
        if(!$ctrlName){
            return $ctrls;
        }else{
            $ctrls = (Array) $ctrls;
            return ($buildLink ? $this->module_base_url($ctrls[$ctrlName]) : $ctrls[$ctrlName]);
        }
    }

    public function module_base_url($url = false){
        return $this->base_url(($url ? "module/".$this->moduleName."/".$url : "module/".$this->moduleName));
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

    public function processPostPrefix(){
        foreach($this->getPostData() as $k => $v){
            $_POST[$this->getDbConfig()->prefix.$k] = $v;
            unset($_POST[$k]);
        }

        foreach($this->getPostFilesData() as $k => $v){
            $_FILES[$this->getDbConfig()->prefix.$k] = $v;
            unset($_FILES[$k]);
        }
    }

    public function redirectToDefault(){
        $uiArray = (Array) $this->getUiUrls();
        $this->viewName = current(array_keys($uiArray));
        redirect($this->getUiUrls($this->viewName,true));
    }
}