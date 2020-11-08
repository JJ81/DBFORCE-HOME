<?php

namespace JCORP\Business\Customer;
use \JCORP\Database\DBConnection as DBConn;

class HashService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    public function genHashCode($customer_id){
        $today=getToday('ymdhsi');
        return md5($today.$customer_id);
    }

    /**
     * @param $hash
     * @return array
     */
    public function getInfoByHash(string $hash){
        $query="select `customer_id`, `is_used`, `created_dt` from `platform_pub_hash` where `hash`='$hash' order by `id` limit 0,1;";
        error_log('getInfoByHash method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param $customer_id
     * @param $hash
     * @return string
     */
    public function setHash($customer_id, $hash){
        $query="insert into `platform_pub_hash` (`customer_id`, `hash`) values (:customer_id, :hash)";
        $value=array(
            ':customer_id' => $customer_id,
            ':hash' => $hash
        );

        return $this->db->insert($query, $value);
    }

    /**
     * @param $customer_id
     * @param $hash
     * @return int
     */
    public function expiredHash($customer_id, $hash){
        $query="update `platform_pub_hash` set `is_used`=1 where `customer_id`=:customer_id and `hash`=:hash;";
        $value=array(
            ':customer_id' => $customer_id,
            ':hash' => $hash
        );
        return $this->db->update($query, $value);
    }

}