<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class CreditLoanService extends DBConnection
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }

    /**
     * @param $topFinGrpNo
     * @param $dcls_month
     * @param $fin_co_no
     * @param $kor_co_nm
     * @param $fin_prdt_cd
     * @param $fin_prdt_nm
     * @param $join_way
     * @param $cb_name
     * @param $crdt_prdt_type
     * @param $crdt_prdt_type_nm
     * @param $dcls_strt_day
     * @param $dcls_end_day
     * @param $fin_co_subm_day
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setData($topFinGrpNo, $dcls_month, $fin_co_no, $kor_co_nm, $fin_prdt_cd, $fin_prdt_nm, $join_way, $cb_name, $crdt_prdt_type, $crdt_prdt_type_nm, $dcls_strt_day, $dcls_end_day, $fin_co_subm_day, $admin_id, $company_id){
        $query=
            "insert into `platform_credit_loan` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `kor_co_nm`, `fin_prdt_cd`, `fin_prdt_nm`, `join_way`, `cb_name`, `crdt_prdt_type`, `crdt_prdt_type_nm`, `dcls_strt_day`, `dcls_end_day`, `fin_co_subm_day`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :kor_co_nm, :fin_prdt_cd, :fin_prdt_nm, :join_way, :cb_name, :crdt_prdt_type, :crdt_prdt_type_nm, :dcls_strt_day, :dcls_end_day, :fin_co_subm_day, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":kor_co_nm" => $kor_co_nm,
            ":fin_prdt_cd" => $fin_prdt_cd,
            ":fin_prdt_nm" => $fin_prdt_nm,
            ":join_way" => $join_way,

            ":cb_name" => $cb_name,
            ":crdt_prdt_type" => $crdt_prdt_type,
            ":crdt_prdt_type_nm" => $crdt_prdt_type_nm,

            ":dcls_strt_day" => $dcls_strt_day,
            ":dcls_end_day" => $dcls_end_day,
            ":fin_co_subm_day" => $fin_co_subm_day,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }


    /**
     * @param $topFinGrpNo
     * @param $dcls_month
     * @param $fin_co_no
     * @param $fin_prdt_cd
     * @param $crdt_prdt_type
     * @param $crdt_lend_rate_type
     * @param $crdt_lend_rate_type_nm
     * @param $crdt_grad_1
     * @param $crdt_grad_4
     * @param $crdt_grad_5
     * @param $crdt_grad_6
     * @param $crdt_grad_10
     * @param $crdt_grad_avg
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setOptData($topFinGrpNo, $dcls_month, $fin_co_no, $fin_prdt_cd, $crdt_prdt_type, $crdt_lend_rate_type, $crdt_lend_rate_type_nm, $crdt_grad_1, $crdt_grad_4, $crdt_grad_5, $crdt_grad_6, $crdt_grad_10, $crdt_grad_avg, $admin_id, $company_id){
        $query=
            "insert into `platform_credit_loan_opt` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `fin_prdt_cd`, `crdt_prdt_type`, `crdt_lend_rate_type`, `crdt_lend_rate_type_nm`, `crdt_grad_1`, `crdt_grad_4`, `crdt_grad_5`, `crdt_grad_6`, `crdt_grad_10`, `crdt_grad_avg`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :fin_prdt_cd, :crdt_prdt_type, :crdt_lend_rate_type, :crdt_lend_rate_type_nm, :crdt_grad_1, :crdt_grad_4, :crdt_grad_5, :crdt_grad_6, :crdt_grad_10, :crdt_grad_avg, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":fin_prdt_cd" => $fin_prdt_cd,

            ":crdt_prdt_type" => $crdt_prdt_type,
            ":crdt_lend_rate_type" => $crdt_lend_rate_type,
            ":crdt_lend_rate_type_nm" => $crdt_lend_rate_type_nm,
            ":crdt_grad_1" => $crdt_grad_1,
            ":crdt_grad_4" => $crdt_grad_4,
            ":crdt_grad_5" => $crdt_grad_5,
            ":crdt_grad_6" => $crdt_grad_6,
            ":crdt_grad_10" => $crdt_grad_10,
            ":crdt_grad_avg" => $crdt_grad_avg,

            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getInstallList($company_id){
        $query="select * from `platform_credit_loan` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param string $fin_co_no
     * @param string $fin_prdt_cd
     * @param int $company_id
     * @return array
     */
    public function getDetails(string $fin_co_no, string $fin_prdt_cd, int $company_id){
        $query="select * from `platform_credit_loan_opt` where `fin_prdt_cd`='$fin_prdt_cd' and `fin_co_no`='$fin_co_no' and `company_id`=$company_id";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllCreditLoan($company_id){
        $query="delete from `platform_credit_loan` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllCreditLoanOpt($company_id){
        $query="delete from `platform_credit_loan_opt` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }


}