<?php
/**
 * Created by PhpStorm.
 * User: Talha Khan
 * Date: 6/1/2016
 * Time: 10:59 AM
 */

class Main extends CA_Capanel{

    public function __construct()
    {
        parent::__construct();
    }

    public function installRefresh(){
        if(file_exists(__DIR__."/../../../config/temp_configs.capanel")){
            unlink(__DIR__."/../../../config/temp_configs.capanel");
            redirect(base_url("capanel"));
        }
    }
}