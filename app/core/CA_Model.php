<?php
class CA_Model extends CI_Model {

    private $escapeString = TRUE;

	public function __construct()
	{
		$this->load->database();
      //  $this->db->query("SET time_zone='ASIA/KARACHI'");
	}
	
	public function getData($tbl = false,$fields = "*",$where = false,$group_by = false,$order_by = false,$limit = array(),$return_single = false,$return_str = false){
		$error = false;
		if($tbl !== false){
			$this->db->select($fields,false)->from($tbl);
			if($where !== false){
                if(is_array($where) and count($where) > 0){
                    $where_in = false;
                    $in_str = "IN()";
                    if(isset($where[$in_str])){
                        $where_in = $where[$in_str];
                    }
                    unset($where[$in_str]);

                    $like = false;
                    $like_str = "LIKE()";
                    if(isset($where[$like_str])){
                        $like = $where[$like_str];
                    }
                    unset($where[$like_str]);

                    $join = false;
                    $join_str = "JOIN()";
                    if(isset($where[$join_str])){
                        $join = $where[$join_str];
                    }
                    unset($where[$join_str]);

                    $gjoin = false;
                    $gjoin_str = "G_JOIN()";
                    if(isset($where[$gjoin_str])){
                        $gjoin = $where[$gjoin_str];
                    }
                    unset($where[$gjoin_str]);


                    if(count($where) > 0){
                        $this->db->where($where);
                    }


                    if($where_in !== false){
                        if(!isset($where_in['OR()'])){
                            $this->db->where_in($where_in['field'],$where_in['data']);
                        }else{
                            $this->db->or_where_in($where_in['field'],$where_in['data']);
                        }
                    }

                    if($like !== false){
                        $this->db->like($like[0], $like[1], isset($like[2]) ? $like[2] : 'both');
                    }

                    if($join !== false){
                        foreach($join as $table => $on){
                            if(!is_array($on)){
                                $this->db->join($table, $on);
                            }else{
                                $this->db->join($table, $on[0], $on[1], $on[2]);
                            }
                        }
                    }

                    if($gjoin !== false){
                        foreach($gjoin as $table => $on){
                            $this->db->join($table, $on['ON'],$on['TYPE']);
                        }
                    }
                }else{
                    if(check_not_empty($where)){
                        $this->db->where($where);
                    }
                }
			}

            if($group_by !== false){
                $this->db->group_by($group_by);
            }

			if($order_by !== false){
                if(is_array($order_by) and isset($order_by[0]) and isset($order_by[1])){
                    $this->db->order_by($order_by[0],$order_by[1]);
                }else{
                    $this->db->order_by($order_by);
                }

			}
			if(is_array($limit) and $limit !== false and isset($limit[0],$limit[1])){
				$this->db->limit($limit[0],$limit[1]);	
			}elseif(!is_array($limit) and $limit !== false){
				$this->db->limit($limit);		
			}
			
			$query = $this->db->get();

            if($return_str == false){
                if(!$error and $query->num_rows() > 1){
                    return $query->result_array();
                }else{
                    if(!$return_single){
                        if($query->num_rows() > 0){
                            return array(0 => $query->row_array());
                        }else{
                            return array();
                        }
                    }else{
                        return $query->row_array();
                    }
                }
            }else{
                return $this->db->last_query();
            }
		}else{
			return false;	
		}
	}
	
	public function saveData($tbl,$data,$update = false,$previewStr = false){

        $set_str = "NO_QUOTES()";

        if(isset($data[$set_str])){
            foreach($data[$set_str] as $set_key => $set_value){
                $this->db->set($set_key, $set_value, FALSE);
            }
            unset($data[$set_str]);
        }


        if(isset($update[$set_str])){
            foreach($update[$set_str] as $whr_key => $whr_value){
                $this->db->where($whr_key." ".$whr_value,NULL,false);
            }
            unset($update[$set_str]);
            if(is_array($update) and count($update) <= 0){
                $update = true;
            }
        }

		if($update == false){
			$this->db->insert($tbl, $data);

            if($previewStr){
                return $this->db->last_query();
            }else{
                return $this->db->insert_id();
            }
		}else{
            $result = NULL;
            if(!is_array($update)){
                if(is_array($data) and count($data) > 0){
                    foreach($data as $field => $value){
                        $this->db->set($field, $value);
                    }
                }
                $result = $this->db->update($tbl);
            }else{
                $result = $this->db->update($tbl, $data,$update);
            }

            if($previewStr){
                return $this->db->last_query();

            }else{
                return $result;
            }
		}
	}
	
	public function delData($tbl = false,$where = array()){
		if($tbl !== false){
			return $this->db->delete($tbl, $where);
		}else{
			return false;
		}
	}

    public function simpleQuery($query,$return_array = false,$return_single = false){
        $ac = $this->db->query($query);
        if($return_array === false){
            return $ac;
        }else{
            if($return_single === false){
                return $ac->result_array();
            }else{
                return $ac->row_array();
            }
        }
    }

}