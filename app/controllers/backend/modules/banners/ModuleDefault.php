<?php

/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 6/1/2016
 * Time: 11:04 AM
 */
class ModuleDefault extends CA_Mhandler
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadCurrentView();
    }

    public function manage()
    {
        $this->loadCurrentView();
    }

    public function add()
    {
        $this->setViewParam("frmAction",$this->getCtrlUrls("add",true));
        $this->loadCurrentView();
    }

    public function create(){
        $this->processPostPrefix();
        $upload = $this->uploadFile($this->getDbPrefix()."image",$this->getUploadDir());
        $postData = $this->getPostData();
        if(!$upload["error"]){
            $postData[$this->getDbPrefix()."image"] = $upload['uploadData']["file_name"];
        }
        $this->Dbo->saveData($this->getDbTable(),$postData);
        redirect($this->getUiUrls("manage",true));
    }
}