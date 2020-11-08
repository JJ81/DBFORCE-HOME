<?php

namespace JCORP\Business\Admin;
use \JCORP\Database\DBConnection as DBconn;

class AdminService extends DBconn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBconn();
    }




}