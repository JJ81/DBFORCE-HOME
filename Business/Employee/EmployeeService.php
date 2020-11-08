<?php
namespace JCORP\Business\Employee;

use JCORP\Database\DBConnection;

class EmployeeService extends DBConnection
{

    private $db=null; // 디비 객체 임시 저장

    public function __construct(){
        $this->db=new DBConnection();
    }

    public function getEmployee(){
        $employee_query=
            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
            "from `crm_employee` as `ce` " .
            "left join `crm_role` as `cr` " .
            "on `ce`.`crm_role`= `cr`.`id` " .
            "left join `crm_team` as `ct` " .
            "on `ce`.`crm_team`=`ct`.`id` " .
            "where `ce`.`crm_role`=4 and `ce`.`is_available`=true;";
//            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
//            "from `crm_employee` as `ce` " .
//            "left join `crm_role` as `cr` " .
//            "on `ce`.`crm_role`= `cr`.`id` " .
//            "left join `crm_team` as `ct` " .
//            "on `ce`.`crm_team`=`ct`.`id` " .
//            "where `ce`.`crm_role`!=5 and `ce`.`crm_role`!=1 and `ce`.`is_available`=true;";
        error_log($employee_query);
        return $this->db->query($employee_query);
    }

    public function getAnalyst(){
        $analyst_query="select `ce`.`id`, `ce`.`name`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
            "from `crm_employee` as `ce` " .
            "left join `crm_role` as `cr` " .
            "on `ce`.`crm_role`= `cr`.`id` " .
            "left join `crm_team` as `ct` " .
            "on `ce`.`crm_team`=`ct`.`id` " .
            "where `ce`.`crm_role`=5;";
        return $this->db->query($analyst_query);
    }

    public function getAllEmployee(){
        $employee_query=
            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
            "from `crm_employee` as `ce` " .
            "left join `crm_role` as `cr` " .
            "on `ce`.`crm_role`= `cr`.`id` " .
            "left join `crm_team` as `ct` " .
            "on `ce`.`crm_team`=`ct`.`id` " .
            "where `ce`.`crm_role`!=1 and `ce`.`is_available`=true;";
        return $this->db->query($employee_query);
    }

    public function getTotalEmployee(int $role_id=null){
        $employee_query=
            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
            "from `crm_employee` as `ce` " .
            "left join `crm_role` as `cr` " .
            "on `ce`.`crm_role`= `cr`.`id` " .
            "left join `crm_team` as `ct` " .
            "on `ce`.`crm_team`=`ct`.`id` " .
            "where `ce`.`is_available`=true ";

        if(!empty($role_id)){
            $employee_query .= "and `ce`.`crm_role`=$role_id ";
        }

        $employee_query .= ";";
        return $this->db->query($employee_query);
    }

    public function getAllEmployeeWithSuperAdmin(int $company_id){
        $employee_query=
            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`role_id`, `cr`.`role_name`, `ce`.`registered_dt` " .
            "from `platform_employee` as `ce` " .
            "left join `platform_role` as `cr` " .
            "on `ce`.`role_id`= `cr`.`id` " .
            "where `ce`.`is_available`=true and `ce`.`company_id`=$company_id;";
        return $this->db->query($employee_query);
    }



    /**
     * 파라미터값을 제외한 직원 리스트 출력
     * @param $employee_id
     * @return array
     */
    public function getEmployeeIdWithoutID($employee_id){
        $employee_query=
            "select `ce`.`id`, `ce`.`name`, `ce`.`phone`, `ce`.`login_id`, `ce`.`crm_role` as `role_id`, `cr`.`role_name`, `ct`.`id` as `team_id`, `ct`.`team_name`, `ce`.`registered_dt` " .
            "from `crm_employee` as `ce` " .
            "left join `crm_role` as `cr` " .
            "on `ce`.`crm_role`= `cr`.`id` " .
            "left join `crm_team` as `ct` " .
            "on `ce`.`crm_team`=`ct`.`id` " .
            "where `ce`.`crm_role`!=1 and `ce`.`crm_role`!=$employee_id and `ce`.`is_available`=true;";
        return $this->db->query($employee_query);
    }

    /**
     * @param $username
     * @param $accountId
     * @param $roleId
     * @param $teamId
     * @param $phone
     * @param $employee_id
     * @return string
     */
    public function updateEmployeeInfo($username, $accountId, $roleId, $teamId, $phone, $employee_id){
        $update_query=
            "update `platform_employee` set `name`=:username, `login_id`=:account_id, ".
            "`role_id`=:role_id, `team_id`=:team_id, `phone`=:phone where `id`=:employee_id;";
        $value=array(
            ":username" => $username,
            ":account_id" => $accountId,
            ":role_id" => $roleId,
            ":team_id" => $teamId,
            ":phone" => $phone,
            ":employee_id" => $employee_id
        );

        return $this->db->update($update_query, $value);
    }

    /**
     * crm_team에 is_available이라는 칼럼을 언제 넣은 적이 있는지 모르겠음. 20190221 쿼리문에서 삭제조치함.
     * @return array
     */
    public function getTeamList(){
        $query="select * from `crm_team` order by `id` asc;";
        return $this->db->query($query);
    }

    /**
     * 직원계정 생성
     * @param $name
     * @param $login_id
     * @param $password
     * @param $crm_role
     * @param null $crm_team
     * @param $phone
     * @param $company_id
     * @return string
     */
    public function makeNewEmployee($name, $login_id, $password, $crm_role, $crm_team=null, $phone, $company_id){
        $query=
            "insert into `platform_employee` (`name`, `login_id`, `password`, `role_id`, `team_id`, `phone`, `company_id`) ".
            " values (:name, :login_id, :password, :crm_role, :crm_team, :phone, :company_id)";
        $value=array(
            ":name" => $name,
            ":login_id" => $login_id,
            ":password" => $password,
            ":crm_role" => $crm_role,
            ":crm_team" => $crm_team,
            ":phone" => $phone,
            ':company_id' => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $login_id
     * @param $company_id
     * @return array
     */
    public function checkDuplicated($login_id, $company_id){
        $query="select * from `platform_employee` where `login_id`='$login_id' and `company_id`=$company_id";
        error_log($query);
        return $this->db->query($query);
    }



}