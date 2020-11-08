<?php

namespace JCORP\Business\VIP;

use JCORP\Database\DBConnection;

class VIPService extends DBConnection
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
        $query="select `vid`, `user_name`, `tel_end`, `registered_dt` from `platform_vip_list` order by `vid` asc limit $size;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function totalVIPAmount(){
        $query="select `count` from `platform_vip` order by `vid` desc limit 0, 1;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $amount
     * @return int
     */
    public function setTotalVIPAmount(int $amount){
        $query="insert into `platform_vip` (`count`) values ($amount);";
        error_log('setTotalVIPAmount method');
        error_log($query);
        return $this->db->update($query);
    }

    /**
     * @param string $name
     * @param string $tel_end
     * @param int $id
     * @return int
     */
    public function modVipList(string $name, string $tel_end, int $id){
        $query="update `platform_vip_list` set `user_name`=:user_name, `tel_end`=:tel_end where `vid`=:vid;";
        $value=array(
            ':user_name' => $name,
            ':tel_end' => $tel_end,
            ':vid' => $id
        );

        return $this->db->update($query, $value);
    }



}