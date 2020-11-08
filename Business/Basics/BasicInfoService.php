<?php

namespace JCORP\Business\Basics;
use \JCORP\Database\DBConnection as DBconn;

class BasicInfoService extends DBconn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBconn();
    }


    /**
     * 개인정보취급방침
     * @param int $company_id
     * @return array
     */
    public function getPrivacyInfo(int $company_id){
        $query="select `privacy` from `platform_settings` where `company_id`=$company_id limit 0,1;";
        return $this->db->query($query);
    }

    /**
     * @param int $company_id
     * @return array
     */
    public function getMarketingInfo(int $company_id){
        $query="select `marketing` from `platform_settings` where `company_id`=$company_id limit 0,1;";
        return $this->db->query($query);
    }

    /**
     * 이용약관
     * @param int $company_id
     * @return array
     */
    public function getAgreementInfo(int $company_id){
        $query="select `agreement` from `platform_settings` where `company_id`=$company_id limit 0,1;";
        return $this->db->query($query);
    }


    public function getFooterInfo(int $company_id){
        $query="select `footer` from `platform_settings` where `company_id`=$company_id limit 0,1;";
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getBasicInfoByCompany_id($company_id){
        $query="select * from `platform_settings` where `company_id`=$company_id;";
        return $this->db->query($query);
    }

    /**
     * @param $company_id
     * @return array
     */
    public function getBasicInfo($company_id){
        $query=
            "select `title`, `keyword`, `description`, `naver_verification_number`, `google_verification_number`, `deploy_version`, `service_url`, `favicon`, `search_img`, `web_log_source`, `company_id` " .
            "from `platform_settings` " .
            "where `company_id`=1;";
        return $this->db->query($query);
    }


    /**
     * TODO 초기설정
     * TODO 이 외에 추가해야할 대상이 남아 있음.
     * @param string $title
     * @param string|null $description
     * @param string|null $keyword
     * @param string|null $service_url
     * @param string|null $favicon
     * @param string|null $search_img
     * @param string $deploy_version
     * @param string|null $naver_verification
     * @param string|null $google_verification
     * @param int $admin_id
     * @param int $company_id
     * @return string
     */
    public function setBasicsInfo(string $title, string $description=null, string $keyword=null, string $service_url=null, string $favicon=null, string $search_img=null, string $deploy_version, string $naver_verification=null, string $google_verification=null, int $admin_id, int $company_id){
        $query="";
        $value=array(

        );
        return $this->db->insert($query, $value);
    }

    // TODO 초기설정 이후 업데이트
    public function updateBasicsInfo(string $title=null, string $description=null, string $keyword=null, string $service_url=null, string $favicon=null, string $search_img=null, string $deploy_version=null, string $naver_verification=null, string $google_verification=null, int $admin_id, int $company_id, string $last_updated_dt, int $id){
        $query="update `platform_settings` set `google_verification_number`=:google_verification, `last_updated_dt`=:last_updated_dt, `admin_id`=:admin_id where `company_id`=:company_id and `id`=:id";
        $value=array(
            ':google_verification' => $google_verification,
            ':last_updated_dt' => $last_updated_dt,
            ':admin_id' => $admin_id,
            ':company_id' => $company_id,
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }



}