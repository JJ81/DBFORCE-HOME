<?php

namespace JCORP\Business\Customer;
use \JCORP\Database\DBConnection as DBConn;

class CustomerRegService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param string $user_id
     * @return array
     */
    public function checkDuplicateUserId(string $user_id){
        $query="select count(*) as `total` from `platform_reg_customer` where `user_id`='$user_id';";
        error_log($query);

        return $this->db->query($query);
    }

    /**
     * @param string $name
     * @param string $phone
     * @param string $user_id
     * @param string $password
     * @param string|null $email
     * @return string
     */
    public function setNewCustomer(string $name, string $phone, string $user_id, string $password, string $email=null){
        $query="insert into `platform_reg_customer` (`name`, `phone`, `user_id`, `password`, `email`) 
                values (:name, :phone, :user_id, :password, :email);";
        $value=array(
            ':name' => $name,
            ':phone' => $phone,
            ':user_id' => $user_id,
            ':password' => $password,
            ':email' => $email
        );

        return $this->db->insert($query, $value);
    }

    /**
     * @param $user_id
     * @return array
     */
    public function checkListByUserId($user_id){
        $query="select `id`, `user_id`, `name`, `password`, `is_delete` from `platform_reg_customer` where `user_id`='$user_id'; ";
        error_log($query);
        return $this->db->query($query);
    }


    /**
     * @param string $username
     * @param string $email
     * @return array
     */
    public function queryUserIdByEmailAndUserName(string $username, string $email){
        $query="select `user_id` from `platform_reg_customer` where `name`='$username' and `email`='$email';";
        error_log("queryUserIdByEmailAndUserName method");
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $user_id
     * @return array
     */
    public function queryUserIdByEmailAndUserNameAndUserId(string $username, string $email, string $user_id){
        $query="select count(*) as `total`, `id` as `customer_id` from `platform_reg_customer` where `name`='$username' and `email`='$email' and `user_id`='$user_id';";
        error_log("queryUserIdByEmailAndUserNameAndUserId method");
        error_log($query);
        return $this->db->query($query);
    }

    public function setNewPassword(string $new_pw, int $customer_id){
        $query="update `platform_reg_customer` set `password`=:password where `id`=:id;";
        $value=array(
            ':password' => $new_pw,
            ':id' => $customer_id
        );
        return $this->db->update($query, $value);
    }


}