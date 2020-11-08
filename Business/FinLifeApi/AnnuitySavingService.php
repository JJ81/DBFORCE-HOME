<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class AnnuitySavingService extends DBConnection
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
     * @param $pnsn_kind
     * @param $pnsn_kind_nm
     * @param $sale_strt_day
     * @param $mntn_cnt
     * @param $prdt_type
     * @param $prdt_type_nm
     * @param $avg_prft_rate
     * @param $dcls_rate
     * @param $guar_rate
     * @param $btrm_prft_rate_1
     * @param $btrm_prft_rate_2
     * @param $btrm_prft_rate_3
     * @param $etc
     * @param $sale_co
     * @param $dcls_strt_day
     * @param $dcls_end_day
     * @param $fin_co_subm_day
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setData($topFinGrpNo, $dcls_month, $fin_co_no, $kor_co_nm, $fin_prdt_cd, $fin_prdt_nm, $join_way, $pnsn_kind, $pnsn_kind_nm, $sale_strt_day, $mntn_cnt, $prdt_type, $prdt_type_nm, $avg_prft_rate, $dcls_rate, $guar_rate, $btrm_prft_rate_1, $btrm_prft_rate_2, $btrm_prft_rate_3, $etc, $sale_co, $dcls_strt_day, $dcls_end_day, $fin_co_subm_day, $admin_id, $company_id){
        $query=
            "insert into `platform_pnsn_svng` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `kor_co_nm`, `fin_prdt_cd`, `fin_prdt_nm`, `join_way`, `pnsn_kind`, `pnsn_kind_nm`, `sale_strt_day`, `mntn_cnt`, `prdt_type`, `prdt_type_nm`, `avg_prft_rate`, `dcls_rate`, `guar_rate`, `btrm_prft_rate_1`, `btrm_prft_rate_2`, `btrm_prft_rate_3`, `etc`, `sale_co`, `dcls_strt_day`, `dcls_end_day`, `fin_co_subm_day`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :kor_co_nm, :fin_prdt_cd, :fin_prdt_nm, :join_way, :pnsn_kind, :pnsn_kind_nm, :sale_strt_day, :mntn_cnt, :prdt_type, :prdt_type_nm, :avg_prft_rate, :dcls_rate, :guar_rate, :btrm_prft_rate_1, :btrm_prft_rate_2, :btrm_prft_rate_3, :etc, :sale_co, :dcls_strt_day, :dcls_end_day, :fin_co_subm_day, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":kor_co_nm" => $kor_co_nm,
            ":fin_prdt_cd" => $fin_prdt_cd,
            ":fin_prdt_nm" => $fin_prdt_nm,
            ":join_way" => $join_way,

            ":pnsn_kind" => $pnsn_kind,
            ":pnsn_kind_nm" => $pnsn_kind_nm,
            ":sale_strt_day" => $sale_strt_day,
            ":mntn_cnt" => $mntn_cnt,
            ":prdt_type" => $prdt_type,
            ":prdt_type_nm" => $prdt_type_nm,
            ":avg_prft_rate" => $avg_prft_rate,
            ":dcls_rate" => $dcls_rate,
            ":guar_rate" => $guar_rate,
            ":btrm_prft_rate_1" => $btrm_prft_rate_1,
            ":btrm_prft_rate_2" => $btrm_prft_rate_2,
            ":btrm_prft_rate_3" => $btrm_prft_rate_3,
            ":etc" => $etc,
            ":sale_co" => $sale_co,

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
     * @param $pnsn_recp_trm
     * @param $pnsn_recp_trm_nm
     * @param $pnsn_entr_age
     * @param $pnsn_entr_age_nm
     * @param $mon_paym_atm
     * @param $mon_paym_atm_nm
     * @param $paym_prd
     * @param $paym_prd_nm
     * @param $pnsn_strt_age
     * @param $pnsn_strt_age_nm
     * @param $pnsn_recp_amt
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setOptData($topFinGrpNo, $dcls_month, $fin_co_no, $fin_prdt_cd, $pnsn_recp_trm, $pnsn_recp_trm_nm, $pnsn_entr_age, $pnsn_entr_age_nm, $mon_paym_atm, $mon_paym_atm_nm, $paym_prd, $paym_prd_nm, $pnsn_strt_age, $pnsn_strt_age_nm, $pnsn_recp_amt, $admin_id, $company_id){
        $query=
            "insert into `platform_pnsn_svng_opt` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `fin_prdt_cd`, `pnsn_recp_trm`, `pnsn_recp_trm_nm`, `pnsn_entr_age`, `pnsn_entr_age_nm`, `mon_paym_atm`, `mon_paym_atm_nm`, `paym_prd`, `paym_prd_nm`, `pnsn_strt_age`, `pnsn_strt_age_nm`, `pnsn_recp_amt`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :fin_prdt_cd, :pnsn_recp_trm, :pnsn_recp_trm_nm, :pnsn_entr_age, :pnsn_entr_age_nm, :mon_paym_atm, :mon_paym_atm_nm, :paym_prd, :paym_prd_nm, :pnsn_strt_age, :pnsn_strt_age_nm, :pnsn_recp_amt, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":fin_prdt_cd" => $fin_prdt_cd,

            ":pnsn_recp_trm" => $pnsn_recp_trm,
            ":pnsn_recp_trm_nm" => $pnsn_recp_trm_nm,
            ":pnsn_entr_age" => $pnsn_entr_age,
            ":pnsn_entr_age_nm" => $pnsn_entr_age_nm,
            ":mon_paym_atm" => $mon_paym_atm,
            ":mon_paym_atm_nm" => $mon_paym_atm_nm,
            ":paym_prd" => $paym_prd,
            ":paym_prd_nm" => $paym_prd_nm,
            ":pnsn_strt_age" => $pnsn_strt_age,
            ":pnsn_strt_age_nm" => $pnsn_strt_age_nm,
            ":pnsn_recp_amt" => $pnsn_recp_amt,

            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getAnnuityList($company_id){
        $query="select * from `platform_pnsn_svng` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllAnnuity($company_id){
        $query="delete from `platform_pnsn_svng` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllAnnuityOpt($company_id){
        $query="delete from `platform_pnsn_svng_opt` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param string $fin_co_no
     * @param string $fin_prdt_cd
     * @param int $company_id
     * @return array
     */
    public function getDetails(string $fin_co_no, string $fin_prdt_cd, int $company_id){
        $query="select * from `platform_pnsn_svng_opt` where `fin_prdt_cd`='$fin_prdt_cd' and `fin_co_no`='$fin_co_no' and `company_id`=$company_id";
        error_log($query);
        return $this->db->query($query);
    }


}