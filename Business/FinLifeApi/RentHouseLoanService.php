<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class RentHouseLoanService extends DBConnection
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
     * @param $loan_inci_expn
     * @param $erly_rpay_fee
     * @param $dly_rate
     * @param $loan_lmt
     * @param $dcls_strt_day
     * @param $dcls_end_day
     * @param $fin_co_subm_day
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setData($topFinGrpNo, $dcls_month, $fin_co_no, $kor_co_nm, $fin_prdt_cd, $fin_prdt_nm, $join_way, $loan_inci_expn, $erly_rpay_fee, $dly_rate, $loan_lmt, $dcls_strt_day, $dcls_end_day, $fin_co_subm_day, $admin_id, $company_id){
        $query=
            "insert into `platform_rent_house_loan` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `kor_co_nm`, `fin_prdt_cd`, `fin_prdt_nm`, `join_way`, `loan_inci_expn`, `erly_rpay_fee`, `dly_rate`, `loan_lmt`, `dcls_strt_day`, `dcls_end_day`, `fin_co_subm_day`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :kor_co_nm, :fin_prdt_cd, :fin_prdt_nm, :join_way, :loan_inci_expn, :erly_rpay_fee, :dly_rate, :loan_lmt, :dcls_strt_day, :dcls_end_day, :fin_co_subm_day, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":kor_co_nm" => $kor_co_nm,
            ":fin_prdt_cd" => $fin_prdt_cd,
            ":fin_prdt_nm" => $fin_prdt_nm,
            ":join_way" => $join_way,

            ":loan_inci_expn" => $loan_inci_expn,
            ":erly_rpay_fee" => $erly_rpay_fee,
            ":dly_rate" => $dly_rate,
            ":loan_lmt" => $loan_lmt,

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
     * @param $mrtg_type
     * @param $mrtg_type_nm
     * @param $rpay_type
     * @param $rpay_type_nm
     * @param $lend_rate_type
     * @param $lend_rate_type_nm
     * @param $lend_rate_min
     * @param $lend_rate_max
     * @param $lend_rate_avg
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setOptData($topFinGrpNo, $dcls_month, $fin_co_no, $fin_prdt_cd, $rpay_type, $rpay_type_nm, $lend_rate_type, $lend_rate_type_nm, $lend_rate_min, $lend_rate_max, $lend_rate_avg, $admin_id, $company_id){
        $query=
            "insert into `platform_rent_house_loan_opt` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `fin_prdt_cd`, `rpay_type`, `rpay_type_nm`, `lend_rate_type`, `lend_rate_type_nm`, `lend_rate_min`, `lend_rate_max`, `lend_rate_avg`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :fin_prdt_cd, :rpay_type, :rpay_type_nm, :lend_rate_type, :lend_rate_type_nm, :lend_rate_min, :lend_rate_max, :lend_rate_avg, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":fin_prdt_cd" => $fin_prdt_cd,

            ":rpay_type" => $rpay_type,
            ":rpay_type_nm" => $rpay_type_nm,
            ":lend_rate_type" => $lend_rate_type,
            ":lend_rate_type_nm" => $lend_rate_type_nm,
            ":lend_rate_min" => $lend_rate_min,
            ":lend_rate_max" => $lend_rate_max,
            ":lend_rate_avg" => $lend_rate_avg,

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
        $query="select * from `platform_rent_house_loan` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllRentHouse($company_id){
        $query="delete from `platform_rent_house_loan` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllRentHouseOpt($company_id){
        $query="delete from `platform_rent_house_loan_opt` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param string $fin_co_no
     * @param string $fin_prdt_cd
     * @param int $company_id
     * @return array
     */
    public function getDetails(string $fin_co_no, string $fin_prdt_cd, int $company_id){
        $query="select * from `platform_rent_house_loan_opt` where `fin_prdt_cd`='$fin_prdt_cd' and `fin_co_no`='$fin_co_no' and `company_id`=$company_id";
        error_log($query);
        return $this->db->query($query);
    }


}