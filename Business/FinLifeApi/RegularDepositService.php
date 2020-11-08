<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class RegularDepositService extends DBConnection
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }

    /**
     * 정기예금 데이터 저장
     * @param $topFinGrpNo
     * @param $dcls_month
     * @param $fin_co_no
     * @param $kor_co_nm
     * @param $fin_prdt_cd
     * @param $fin_prdt_nm
     * @param $join_way
     * @param $mtrt_int
     * @param $spcl_cnd
     * @param $join_deny
     * @param $join_member
     * @param $etc_note
     * @param $max_limit
     * @param $dcls_strt_day
     * @param $dcls_end_day
     * @param $fin_co_subm_day
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setData($topFinGrpNo, $dcls_month, $fin_co_no, $kor_co_nm, $fin_prdt_cd, $fin_prdt_nm, $join_way, $mtrt_int, $spcl_cnd, $join_deny, $join_member, $etc_note, $max_limit, $dcls_strt_day, $dcls_end_day, $fin_co_subm_day, $admin_id, $company_id){
        $query=
            "insert into `platform_rglr_dpst` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `kor_co_nm`, `fin_prdt_cd`, `fin_prdt_nm`, `join_way`, `mtrt_int`, `spcl_cnd`, `join_deny`, `join_member`, `etc_note`, `max_limit`, `dcls_strt_day`, `dcls_end_day`, `fin_co_subm_day`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :kor_co_nm, :fin_prdt_cd, :fin_prdt_nm, :join_way, :mtrt_int, :spcl_cnd, :join_deny, :join_member, :etc_note, :max_limit, :dcls_strt_day, :dcls_end_day, :fin_co_subm_day, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":kor_co_nm" => $kor_co_nm,
            ":fin_prdt_cd" => $fin_prdt_cd,
            ":fin_prdt_nm" => $fin_prdt_nm,
            ":join_way" => $join_way,
            ":mtrt_int" => $mtrt_int,
            ":spcl_cnd" => $spcl_cnd,
            ":join_deny" => $join_deny,
            ":join_member" => $join_member,
            ":etc_note" => $etc_note,
            ":max_limit" => $max_limit,
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
     * @param $intr_rate_type
     * @param $intr_rate_type_nm
     * @param $save_trm
     * @param $intr_rate
     * @param $intr_rate2
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setOptData($topFinGrpNo, $dcls_month, $fin_co_no, $fin_prdt_cd, $intr_rate_type, $intr_rate_type_nm, $save_trm, $intr_rate, $intr_rate2, $admin_id, $company_id){
        $query=
            "insert into `platform_rglr_dpst_opt` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `fin_prdt_cd`, `intr_rate_type`, `intr_rate_type_nm`, `save_trm`, `intr_rate`, `intr_rate2`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :fin_prdt_cd, :intr_rate_type, :intr_rate_type_nm, :save_trm, :intr_rate, :intr_rate2, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":fin_prdt_cd" => $fin_prdt_cd,
            ":intr_rate_type" => $intr_rate_type,
            ":intr_rate_type_nm" => $intr_rate_type_nm,
            ":save_trm" => $save_trm,
            ":intr_rate" => $intr_rate,
            ":intr_rate2" => $intr_rate2,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getDepositList($company_id){
        $query="select * from `platform_rglr_dpst` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param $fin_co_no 금융회사번호
     * @param $fin_prdt_cd 금융상품코드
     * @param $company_id
     * @return array
     */
    public function getDetails(string $fin_co_no, string $fin_prdt_cd, int $company_id){
        $query="select * from `platform_rglr_dpst_opt` where `fin_prdt_cd`='$fin_prdt_cd' and `fin_co_no`='$fin_co_no' and `company_id`=$company_id";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllDeposit($company_id){
        $query="delete from `platform_rglr_dpst` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllDepositOpt($company_id){
        $query="delete from `platform_rglr_dpst_opt` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

}