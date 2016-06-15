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
        $this->setViewParam("gridData",$this->Dbo->getData($this->getDbTable(),"*",false,false,$this->getDbPrefix()."id DESC"));
        $this->loadCurrentView();
    }

    public function add()
    {
        $this->setViewParam("frmAction",$this->getCtrlUrls("add",true));
        $this->loadCurrentView();
    }

    public function edit($id = false)
    {
        if(!$id){
            $this->redirectToDefault();
            die();
        }

        $this->setViewParam("frmAction",$this->getCtrlUrls("edit",true));
        $this->setViewParam("editData",$this->Dbo->getData($this->getDbTable(),"*",array(
            $this->getDbPrefix("id") => $id
        ),false,false,false,true));
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
        $this->redirectToDefault();
    }

    public function update(){
        $this->processPostPrefix();
        $id = $this->getPostData()[$this->getDbPrefix("id")];
        $upload = $this->uploadFile($this->getDbPrefix()."image",$this->getUploadDir());
        $curData = $this->Dbo->getData($this->getDbTable(),"*",array(
            $this->getDbPrefix("id") => $id
        ),false,false,false,true);
        $postData = $this->getPostData();
        if(!$upload["error"]){
            $postData[$this->getDbPrefix()."image"] = $upload['uploadData']["file_name"];
            if(file_exists($this->getUploadDir().$curData[$this->getDbPrefix("image")])){
                unlink($this->getUploadDir().$curData[$this->getDbPrefix("image")]);
            }
        }
        $this->Dbo->saveData($this->getDbTable(),$postData,array(
            $this->getDbPrefix("id") => $id
        ));
        $this->redirectToDefault();
    }
}