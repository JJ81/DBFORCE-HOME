<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class CommonService extends DBConnection
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }

    // 권역 코드를 가져오기
    public function getAreaList(){
        $query="select * from `platform_area`;";
        error_log($query);
        return $this->db->query($query);
    }



}