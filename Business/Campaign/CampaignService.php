<?php

namespace JCORP\Business\Campaign;
use \JCORP\Database\DBConnection as DBConn;

class CampaignService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param int $admin_id
     * @param int $company_id
     * @param string $title
     * @param null $purpose
     * @param string $template_id
     * @param null $isOpen
     * @param null $redirect
     * @return string
     */
    public function setCampaign(int $admin_id, int $company_id, string $title, $purpose=null, string $template_id, $isOpen=null, $redirect=null){
        $query=
            "insert into `jp_ld_campaign` (`admin_id`, `company_id`, `title`, `purpose`, `template_id`, `isOpen`, `redirect`) ".
            "values (:admin_id, :company_id, :title, :purpose, :template_id, :isOpen, :redirect);";
        $value=array(
            ":admin_id" => $admin_id,
            ":company_id" => $company_id,
            ":title" => $title,
            ":purpose" => $purpose,
            ":template_id" => $template_id,
            ":isOpen" => $isOpen,
            ":redirect" => $redirect
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param int $company_id
     * @param int $offset
     * @param int $size
     * @return array
     */
    public function getCampaign(int $company_id, int $offset, int $size){
        $query="select * from `jp_ld_campaign` where `company_id`=$company_id order by `id` desc limit $offset, $size;";
        error_log($query);
        return $this->db->query($query);
    }

    public function getCampaignById(int $company_id, int $id){
        $query="select `template_id` from `jp_ld_campaign` where `company_id`=$company_id and `id`=$id;";
        error_log($query);
        return $this->db->query($query);
    }


}