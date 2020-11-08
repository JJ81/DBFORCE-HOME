<?php
/**
 * Created by PhpStorm.
 * User: yijaejun
 * Date: 2019/02/05
 * Time: 18:24
 */

namespace JCORP\Business\Customer;

use JCORP\Database\DBConnection;

class CustomerStatusService extends DBConnection
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }

    public function getList(int $company_id){
        return $this->db->query("select * from `platform_customer_status` where `company_id`=$company_id;");
    }

    public function setList(string $name, $desc=null, int $admin_id, int $company_id){
        $query="insert into `platform_customer_status` (`name`, `description`, `admin_id`, `company_id`) values (:name, :description, :admin_id, :company_id);";
        $value=array(
            ":name" => $name,
            ":description" => $desc,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    public function modifyList(string $name, $desc=null, int $company_id, string $modified_dt, int $id){
        $query="update `platform_customer_status` set `name`=:name, `description`=:description, `modified_dt`=:modified_dt where `id`=:id and `company_id`=:company_id;";
        $value=array(
            ":name" => $name,
            ":description" => $desc,
            ":modified_dt" => $modified_dt,
            ":id" => $id,
            ":company_id" => $company_id
        );
        return $this->db->update($query, $value);
    }

    public function deleteList(int $id, int $company_id){
        $query="delete from `platform_customer_status` where `company_id`=:company_id and `id`=:id";
        $value=array(
            ":company_id" => $company_id,
            ":id" => $id
        );
        return $this->db->delete($query, $value);

    }


}