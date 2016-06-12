<?php
/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 6/1/2016
 * Time: 11:04 AM
 */

class ModuleDefault extends CA_Mhandler{

    public function __construct()
    {
        parent::__construct();
       
    }
    public function index(){
        $this->loadCurrentView();
    }

    public function manage(){
        $this->loadCurrentView();
    }

    public function form(){
        $this->loadCurrentView();
    }

    public function add(){
        $this->loadCurrentView();
    }
}