<?php

namespace JCORP\Business\Free;

use JCORP\Database\DBConnection;

class FreeExpService extends DBConnection
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }


    /**
     * @param int $size
     * @return array
     */
    public function getListBySize(int $size){
        $query="select `fid`, `user_name`, `tel_end` from `platform_free_list` order by `fid` desc limit $size;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $name
     * @param string $tel_end
     * @param int $id
     * @return int
     */
    public function modVipList(string $name, string $tel_end, int $id){
        $query="update `platform_free_list` set `user_name`=:user_name, `tel_end`=:tel_end where `fid`=:fid;";
        $value=array(
            ':user_name' => $name,
            ':tel_end' => $tel_end,
            ':fid' => $id
        );

        return $this->db->update($query, $value);
    }


}