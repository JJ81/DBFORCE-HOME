<?php

namespace JCORP\Business\Customer;
use \JCORP\Database\DBConnection as DBConn;

class CustomerService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param int $offset
     * @param int $size
     * @param string|null $name
     * @param string|null $phone
     * @param int|null $status
     * @param string|null $memo
     * @param string|null $reg_start_dt
     * @param string|null $reg_end_dt
     * @param string|null $mod_start_dt
     * @param string|null $mod_end_dt
     * @param int $company_id
     * @return array
     */
    public function getCustomerList(int $offset, int $size, string $name=null, string $phone=null, int $status=null, string $memo=null, string $reg_start_dt=null, string $reg_end_dt=null, string $mod_start_dt=null, string $mod_end_dt=null, int $company_id){
//        $query=
//            "select `jlc`.*, group_concat(`jlm`.`memo` order by `jlm`.`created_dt` desc separator '{}') as `memo`, " .
//            "group_concat(`jlm`.`created_dt` order by `jlm`.`created_dt` desc separator '{}') as `memo_dt`, " .
//            "group_concat(`jlm`.`admin_id` order by `jlm`.`created_dt` desc separator '{}') as `memo_employee_id`, " .
//            "`jls`.`id` as `status_id`, `jls`.`name` as `status_name` ".
//            "from `jp_ld_customer` as `jlc` " .
//            "left join `jp_ld_memo` as `jlm` " .
//            "on `jlm`.`customer_id`=`jlc`.`id` " .
//            "left join `jp_ld_status` as `jls` ".
//            "on `jls`.`id`=`jlc`.`status_id`".
//            "where `jlc`.`company_id`=$company_id ";
//
//        if(!empty($name)){
//            $query .= "and `jlc`.`name` like \"%$name%\" ";
//        }
//
//        if(!empty($phone)){
//            $query .= "and `jlc`.`phone` like \"%$phone%\" ";
//        }
//
//        if(!empty($status)){
//            $query .= "and `jlc`.`status_id`=$status ";
//        }
//
//        if(!empty($memo)){
//            $query .= "and `jlm`.`memo` like \"%$memo%\" ";
//        }
//
//        if(!empty($reg_start_dt) and !empty($reg_end_dt)){
//            $query .= "and `jlc`.`created_dt` between '$reg_start_dt' and '$reg_end_dt' ";
//        }
//
//        if(!empty($mod_start_dt) and !empty($mod_end_dt)){
//            $query .= "and `jlc`.`modified_dt` between '$mod_start_dt' and '$mod_end_dt' ";
//        }
//
//        $query .= "group by `jlc`.`id` ";
//        //$query .= "order by `jlc`.`modified_dt` desc, `jlc`.`created_dt` desc, `jlc`.`id` desc ";
//        // TODO 정렬기준을 설정할 수 있도록 쿼리를 변경할 것.
//        $query .= "order by `jlc`.`id` desc, `jlc`.`created_dt` desc, `jlc`.`modified_dt` desc ";
//        $query .= "limit $offset, $size;";
        $query=
            "select `pc`. *, `jls`.`name` as `status_name` from `platform_customer` as `pc` ".
            "left join `platform_customer_status` as `jls` " .
            "on `jls`.`id`=`pc`.`status_id` " .
            " where `pc`.`company_id`=$company_id order by `id` desc".
            " limit $offset, $size;";

        error_log('Customer List');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string|null $name
     * @param string|null $phone
     * @param int|null $status
     * @param string|null $memo
     * @param string|null $reg_start_dt
     * @param string|null $reg_end_dt
     * @param string|null $mod_start_dt
     * @param string|null $mod_end_dt
     * @param int $company_id
     * @return array
     */
    public function getCustomerListCount(string $name=null, string $phone=null, int $status=null, string $memo=null, string $reg_start_dt=null, string $reg_end_dt=null, string $mod_start_dt=null, string $mod_end_dt=null, int $company_id){

//        $query=
//            "select count(*) as `total` from (" .
//            "select `jlc`.*, group_concat(`jlm`.`memo` order by `jlm`.`created_dt` desc separator '{}') as `memo` " .
//            "from `jp_ld_customer` as `jlc` " .
//            "left join `jp_ld_memo` as `jlm` " .
//            "on `jlm`.`customer_id`=`jlc`.`id` " .
//            "left join `jp_ld_status` as `jls` ".
//            "on `jls`.`id`=`jlc`.`status_id`".
//            "where `jlc`.`company_id`=$company_id ";
//
//        if(!empty($name)){
//            $query .= "and `jlc`.`name` like \"%$name%\" ";
//        }
//
//        if(!empty($phone)){
//            $query .= "and `jlc`.`phone` like \"%$phone%\" ";
//        }
//
//        if(!empty($status)){
//            $query .= "and `jlc`.`status_id`=$status ";
//        }
//
//        if(!empty($memo)){
//            $query .= "and `jlm`.`memo` like \"%$memo%\" ";
//        }
//
//        if(!empty($reg_start_dt) and !empty($reg_end_dt)){
//            $query .= "and `jlc`.`created_dt` between '$reg_start_dt' and '$reg_end_dt' ";
//        }
//
//        if(!empty($mod_start_dt) and !empty($mod_end_dt)){
//            $query .= "and `jlc`.`modified_dt` between '$mod_start_dt' and '$mod_end_dt' ";
//        }
//
//        $query .= "group by `jlc`.`id`";
//        $query .= ") as `tmp_table`";
        $query="select count(*) as `total` from `platform_customer` where `company_id`=$company_id;";

        error_log($query);
        return $this->db->query($query);
    }


    /**
     * @param int $id
     * @param string $name
     * @param int|null $status
     * @param string|null $created_dt
     * @param string $modified_dt
     * @param string $phone
     * @param int $admin_id
     * @param int $company_id
     * @return int
     */
    public function modifyCustomerInfo(int $id, string $name, int $status=null, string $modified_dt, string $phone, int $admin_id, int $company_id, string $created_dt){
        $update_query="update `platform_customer` set `name`=:name, `phone`=:phone, `status_id`=:status, `modified_dt`=:modified_dt, `admin_id`=:admin_id, `created_dt`=:created_dt where `id`=:id and `company_id`=:company_id;";
        $value=array(
            ":name" => $name,
            ":phone" => $phone,
            ":status" => $status,
            ":modified_dt" => $modified_dt,
            ":admin_id" => $admin_id,
            ":id" => $id,
            ":company_id"=>$company_id,
            ":created_dt" => $created_dt
        );
        return $this->db->update($update_query, $value);
    }

    /**
     * @param $db
     * @param int $customer_id
     * @param int $company_id
     * @return mixed
     */
    public function deleteCustomerInfo($db, int $customer_id, int $company_id){
        $delete_query_customer="delete from `platform_customer` where `id`=$customer_id and `company_id`=$company_id;";
        return $db->delete($delete_query_customer);
    }


    /**
     * @param int $id
     * @return array
     */
    public function getDeviceInfo(int $id){
        $query="select `device_info` from `platform_customer` where `id`=$id;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $name
     * @param string $phone
     * @param int $company_id
     * @param int|null $admin_id
     * @param string|null $ip_addr
     * @param string|null $referrer
     * @param string $device_info
     * @param string $req_item_type
     * @param string|null $path
     * @return string
     */
    public function setCustomerInfo(string $name, string $phone, int $company_id, int $admin_id=null, string $ip_addr=null, string $referrer=null, string $device_info, string $req_item_type, string $path=null){
        $query="insert into `platform_customer` (`name`, `phone`, `company_id`, `admin_id`, `ip_addr`, `referrer`, `device_info`, `req_item_type`, `url`) ".
            "values (:name, :phone, :company_id, :admin_id, :ip_addr, :referrer, :device_info, :req_item_type, :url);";
        $value=array(
            ':name' => $name,
            ':phone' => $phone,
            ':company_id' => $company_id,
            ':admin_id' => $admin_id,
            ':ip_addr' => $ip_addr,
            ':referrer' => $referrer,
            ':device_info' => $device_info,
            ':req_item_type' => $req_item_type,
            ':url' => $path
        );
        return $this->db->insert($query, $value);
    }

}