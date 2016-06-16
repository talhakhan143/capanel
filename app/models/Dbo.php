<?php

class Dbo extends CA_Model
{

    private $escapeString = TRUE;
    private $tableName = false;

    public function __construct()
    {
        $this->load->database();
        //  $this->db->query("SET time_zone='ASIA/KARACHI'");
    }

    public function setTableName($tableName = false)
    {
        $this->tableName = $tableName;
    }

    public function getData($tbl = false, $fields = "*", $where = false, $group_by = false, $order_by = false, $limit = array(), $return_single = false, $return_str = false)
    {
        if (!$tbl) {
            $tbl = $this->tableName;
        }
        return parent::getData($tbl, $fields, $where, $group_by, $order_by, $limit, $return_single, $return_str);
    }

    public function saveData($tbl, $data, $update = false, $previewStr = false)
    {
        if (!$tbl) {
            $tbl = $this->tableName;
        }
        return parent::saveData($tbl, $data, $update, $previewStr);
    }

    public function delData($tbl = false, $where = array())
    {
        if (!$tbl) {
            $tbl = $this->tableName;
        }
        return parent::delData($tbl, $where);
    }
}