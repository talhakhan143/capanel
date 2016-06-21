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
        $this->setViewParam("gridData", $this->Dbo->getData($this->getDbTable(), "*", false, false, $this->getDbPrefix() . "id DESC"));
        $this->loadCurrentView();
    }

    public function add()
    {
        $this->setViewParam("frmAction", $this->getCtrlUrls("add", true));
        $this->loadCurrentView();
    }

    public function edit($id = false)
    {
        if (!$id) {
            $this->redirectToDefault();
            die();
        }
        $this->setViewParam("frmAction", $this->getCtrlUrls("edit", true));
        $this->setViewParam("editData", $this->Dbo->getData($this->getDbTable(), "*", array(
            $this->getDbPrefix("id") => $id
        ), false, false, false, true));
        $this->loadCurrentView();
    }

    public function create()
    {
        $this->processPostPrefix();
        $upload = $this->uploadFile($this->getDbPrefix() . "image", $this->getUploadDir());
        $postData = $this->getPostData();
        if (!$upload["error"]) {
            $postData[$this->getDbPrefix() . "image"] = $upload['uploadData']["file_name"];
        }
        $this->Dbo->saveData($this->getDbTable(), $postData);
        $this->redirectToDefault();
    }

    public function update()
    {
        $this->processPostPrefix();
        $id = $this->getPostData()[$this->getDbPrefix("id")];
        $upload = $this->uploadFile($this->getDbPrefix() . "image", $this->getUploadDir());
        $curData = $this->Dbo->getData($this->getDbTable(), "*", array(
            $this->getDbPrefix("id") => $id
        ), false, false, false, true);
        $postData = $this->getPostData();
        if (!$upload["error"]) {
            $postData[$this->getDbPrefix() . "image"] = $upload['uploadData']["file_name"];
            if (file_exists($this->getUploadDir() . $curData[$this->getDbPrefix("image")])) {
                unlink($this->getUploadDir() . $curData[$this->getDbPrefix("image")]);
            }
        }
        $this->Dbo->saveData($this->getDbTable(), $postData, array(
            $this->getDbPrefix("id") => $id
        ));
        $this->redirectToDefault();
    }

    public function delete($id = false)
    {
        if ($id) {
            $curData = $this->Dbo->getData($this->getDbTable(), "*", array(
                $this->getDbPrefix("id") => $id
            ), false, false, false, true);
            if (count($curData) > 0) {
                $del = $this->Dbo->delData($this->getDbTable(), array(
                    $this->getDbPrefix("id") => $id
                ));
                if ($del) {
                    if (file_exists($this->getUploadDir() . $curData[$this->getDbPrefix("image")])) {
                        unlink($this->getUploadDir() . $curData[$this->getDbPrefix("image")]);
                    }
                    $this->setJsonResponse("message", "Deleted Successfully!");
                    $this->setJsonResponse("error", false);
                } else {
                    $this->setJsonResponse("message", "There was an error while deleting your record!");
                }
            } else {
                $this->setJsonResponse("message", "Data not exists!");
            }
        } else {
            $this->setJsonResponse("message", "Invalid Parameters!");
        }
        $this->printJsonResponse();
    }

    public function dataTableSource()
    {
        $cols = array(
            array(
                "dt" => 0,
                "db" => $this->getDbPrefix("id")
            ),
            array(
                "dt" => 1,
                "db" => $this->getDbPrefix("title")
            ),
            array(
                "dt" => 2,
                "db" => $this->getDbPrefix("image"),
                "formatter" =>  function ($data, $row) {
                    $r = ((check_not_empty($data) and file_exists($this->getUploadDir() . $data)) ? '<a href="' . $this->getUploadDir(true) . $data . '" class="light-box"><i class="fa fa-picture-o" aria-hidden="true"></i></a>' : "-");
                    return $r;
                }
            ),array(
                "dt" => 3,
                "db" => $this->getDbPrefix("status"),
                "formatter" =>  function ($data, $row) {
                    $r = '<input type="checkbox" switch-button data-action="' . $this->getCtrlUrls("status", true) . "/" . $row[0] . '" class="status_btn" ' . ($data > 0 ? "checked" : "") . ' />';
                    return $r;
                }
            ),array(
                "dt" => 4,
                "db" => $this->getDbPrefix("id"),
                "formatter" =>  function ($data, $row) {
                    $r = '<a href="' . $this->getUiUrls("edit", true) . "/" . $data . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                    return $r;
                }
            ),array(
                "dt" => 5,
                "db" => $this->getDbPrefix("id"),
                "formatter" =>  function ($data, $row) {
                    $durl = "'" . $this->getCtrlUrls("delete", true) . "/" . $data . "'";
                    $r = '<a href="#" onclick="deleteGrid(' . $durl . ',this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    return $r;
                }
            ),
        );

        $this->initDataTable($cols);
        echo $this->getDataTableResult();
    }
}