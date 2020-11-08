<?php

namespace JCORP\Business\Template;
use \JCORP\Database\DBConnection as DBConn;

class TemplateService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param string $template_type
     * @param string $title
     * @param $purpose
     * @param string $image
     * @param int $admin_id
     * @param int $company_id
     * @return string
     */
    public function setImageTemplate(string $template_type, string $title, $purpose=null, string $image, int $admin_id, int $company_id){
        $query=
            "insert into `jp_ld_template` (`template_type`, `title`, `purpose`, `image`, `admin_id`, `company_id`) ".
            "values (:template_type, :title, :purpose, :image, :admin_id, :company_id);";
        $value=array(
            ":template_type" => $template_type,
            ":title" => $title,
            ":purpose" => $purpose,
            ":image" => $image,
            ":admin_id" => $admin_id,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param int $company_id
     * @param int $offset
     * @param int $size
     * @return array
     */
    public function getTemplate(int $company_id, int $offset, int $size){
        $query="select * from `jp_ld_template` where `isDelete`=0 and `company_id`=$company_id limit $offset, $size;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $template_id
     * @return array
     */
    public function getTemplateByItsId(string $template_id){
        $query="select * from `jp_ld_template` where `id` in ($template_id);";
        error_log($query);
        return $this->db->query($query);
    }

}