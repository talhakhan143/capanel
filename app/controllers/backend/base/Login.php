<?php

/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 5/31/2016
 * Time: 11:42 AM
 */
class Login extends CA_Capanel
{

    private $tblName = "tbl_admin_users";

    public function __construct()
    {
        parent::__construct();
        if (($this->session->has_userdata("back_login") or $this->session->userdata("back_login") != NULL) and $this->uri->segment(3) != "logout") {
            $this->isLoggedIn = true;
            redirect($this->getDefaultModuleUrl());
        }
    }

    public function index()
    {
        $this->setPageTitle("Login");
        $this->loadView("login");
    }

    public function verifyUser()
    {
        $postData = $this->input->post();
        if (count($postData) > 0) {
            $uname = $postData['uname'];
            $pass = $postData['pass'];
            if (isset($uname) and check_not_empty($uname) and isset($pass) and check_not_empty($pass)) {
                $loginData = $this->Dbo->getData($this->tblName, "*", array(
                    "ausr_uname" => $uname
                ), false, false, false, true);
                if (count($loginData) > 0) {
                    if ($pass == $this->encryption->decrypt($loginData['ausr_pass'])) {
                        $this->session->set_userdata("back_login", $loginData);
                        $this->setJsonResponse("message", "Logged In... Please wait while we take you in");
                        $this->setJsonResponse("goto", $this->getDefaultModuleUrl());
                        $this->setJsonResponse("error", false);
                    } else {
                        $this->setJsonResponse("message", "Invalid Username / Password");
                    }
                } else {
                    $this->setJsonResponse("message", "Please enter valid Username");
                }
            } else {
                $this->setJsonResponse("message", "Please enter Username / Password");
            }
        } else {
            $this->setJsonResponse("message", "Invalid data sent");
        }
        $this->printJsonResponse();
    }

    public function logout()
    {
        $this->session->unset_userdata("back_login");
        $this->ca_redirect("login");
    }
}