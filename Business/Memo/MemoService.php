<?php

namespace JCORP\Business\Memo;

use JCORP\Database\DBConnection;

class MemoService extends DBConnection
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }

    /**
     * @param int $customer_id
     * @return array
     */
    public function getMemoByCustomerId(int $customer_id, int $company_id){
        $query=
            "select `jlc`.*, `jlm`.`id` as `memo_id`, `jlm`.`memo`, `jlm`.`created_dt`, `jlm`.`customer_id`, `jlm`.`admin_id` as `admin_id` " .
            "from `platform_memo` as `jlm` " .
            "left join `platform_customer` as `jlc` " .
            "on `jlc`.`id`=`jlm`.`customer_id` " .
            "where `jlm`.`customer_id`=$customer_id and `jlm`.`company_id`=$company_id " .
            "order by `jlm`.`created_dt` desc, `jlc`.`id` desc;";
        error_log($query);
        return $this->db->query($query);
    }


    /**
     * @param string $memo
     * @param int $customer_id
     * @param int $admin_id
     * @param int $company_id
     * @return string
     */
    public function setMemo(string $memo, int $customer_id, int $admin_id, int $company_id){
        $query=
            "insert into `platform_memo` (`memo`, `customer_id`, `admin_id`, `company_id`) values (:memo, :customer_id, :admin_id, :company_id);";
        $value=array(
            ":memo" => $memo,
            ":customer_id" => $customer_id,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $memo_id
     * @param $customer_id
     * @param $company_id
     * @return bool|null
     */
    public function deleteMemo($memo_id, $customer_id, $company_id){
        $query="delete from `platform_memo` where `id`=$memo_id and `customer_id`=$customer_id and `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    public function deleteMemoWithCustomerId($db, int $customer, int $company_id){
        $query="delete from `platform_memo` where `customer_id`=$customer and `company_id`=$company_id;";
        return $db->delete($query);
    }

    /**
     * @param string $memo
     * @param int $company_id
     * @param int $memo_id
     * @return string
     */
    public function modifyMemo(string $memo, int $company_id, int $memo_id){
        $query=
            "update `platform_memo` set `memo`=:memo, `company_id`=:company_id where `id`=:memo_id;";
        $value=array(
            ":memo" => $memo,
            ":company_id" => $company_id,
            ":memo_id" => $memo_id
        );
        return $this->db->update($query, $value);
    }

}