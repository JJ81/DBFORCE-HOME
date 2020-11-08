<?php

namespace JCORP\Business\FinLifeApi;

use JCORP\Database\DBConnection;

class CompanyService extends DBConnection
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
     * @param $dcls_chrg_man
     * @param $homp_url
     * @param $cal_tel
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setData($topFinGrpNo, $dcls_month, $fin_co_no, $kor_co_nm, $dcls_chrg_man, $homp_url, $cal_tel, $admin_id, $company_id){
        $query=
            "insert into `platform_company` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `kor_co_nm`, `dcls_chrg_man`, `homp_url`, `cal_tel`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :kor_co_nm, :dcls_chrg_man, :homp_url, :cal_tel,  :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":kor_co_nm" => $kor_co_nm,
            ":dcls_chrg_man" => $dcls_chrg_man,
            ":homp_url" => $homp_url,
            ":cal_tel" => $cal_tel,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $topFinGrpNo
     * @param $dcls_month
     * @param $fin_co_no
     * @param $area_cd
     * @param $area_nm
     * @param $exis_yn
     * @param $admin_id
     * @param $company_id
     * @return string
     */
    public function setOptData($topFinGrpNo, $dcls_month, $fin_co_no, $area_cd, $area_nm, $exis_yn, $admin_id, $company_id){
        $query=
            "insert into `platform_company_opt` (`topFinGrpNo`, `dcls_month`, `fin_co_no`, `area_cd`, `area_nm`, `exis_yn`, `admin_id`, `company_id`) ".
            " values (:topFinGrpNo, :dcls_month, :fin_co_no, :area_cd, :area_nm, :exis_yn, :admin_id, :company_id);";
        $value=array(
            ":topFinGrpNo" => $topFinGrpNo,
            ":dcls_month" => $dcls_month,
            ":fin_co_no" => $fin_co_no,
            ":area_cd" => $area_cd,
            ":area_nm" => $area_nm,
            ":exis_yn" => $exis_yn,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getCompanyList($company_id){
        $query="select * from `platform_company` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllCompany($company_id){
        $query="delete from `platform_company` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }

    /**
     * @param $company_id
     * @return bool|null
     */
    public function deleteAllCompanyOpt($company_id){
        $query="delete from `platform_company_opt` where `company_id`=$company_id;";
        return $this->db->delete($query);
    }


}