<?php

namespace JCORP\Business\Review;
use \JCORP\Database\DBConnection as DBConn;

class ReviewService extends DBConn
{
    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param int $offset
     * @param int $size
     * @param int $company_id
     * @return array
     */
    public function getReviewList(int $offset, int $size, int $company_id){
        $query = "select * from `jp_ld_review` ";
        $query .= "where `company_id`=$company_id ";
        $query .= "order by `position` desc, `order` desc, `id` desc, `position` desc ";
        $query .= "limit $offset, $size;";

        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $company_id
     * @return array
     */
    public function getReviewListCount(int $company_id){
        $query="select count(*) as `total` from `jp_ld_review` where `company_id`=$company_id;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * 후기 등록하기
     * @param string|null $title
     * @param string $position
     * @param string $thumbnail
     * @param int|null $order
     * @param int $company_id
     * @return string
     */
    public function setReviewInfo(string $title=null, string $position, string $thumbnail, int $order=null, int $company_id){
        $query="insert into `jp_ld_review` (`title`, `position`, `thumbnail`, `order`, `company_id`) values (:title, :position, :thumbnail, :order, :company_id);";
        $value=array(
            ":title" => $title,
            ":position" => $position,
            ":thumbnail" => $thumbnail,
            ":order" => $order,
            ":company_id" => $company_id
        );
        return $this->db->insert($query, $value);
    }


    /**
     * @param string|null $title
     * @param string $position
     * @param string|null $thumbnail
     * @param int|null $order
     * @param int $company_id
     * @param int $id
     * @return string
     */
    public function updateReviewInfo(string $title=null, string $position, string $thumbnail=null, int $order=null, int $company_id, int $id){
        $query="update `jp_ld_review` set `title`=:title, `position`=:position, `thumbnail`=:thumbnail, `order`=:order where `id`=:id and `company_id`=:company_id;";
        $value=array(
            ":title" => $title,
            ":position" => $position,
            ":thumbnail" => $thumbnail,
            ":order" => $order,
            ":company_id" => $company_id,
            ":id" => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * @param string|null $title
     * @param string $position
     * @param int|null $order
     * @param int $company_id
     * @param int $id
     * @return int
     */
    public function updateReviewInfoWithOutThumbnail(string $title=null, string $position, int $order=null, int $company_id, int $id){
        $query="update `jp_ld_review` set `title`=:title, `position`=:position, `order`=:order where `id`=:id and `company_id`=:company_id;";
        $value=array(
            ":title" => $title,
            ":position" => $position,
            ":order" => $order,
            ":company_id" => $company_id,
            ":id" => $id
        );
        return $this->db->update($query, $value);
    }


    /**
     * 후기 삭제
     * @param int $id
     * @param int $company_id
     * @return bool|null
     */
    public function deleteReviewInfo(int $id, int $company_id){
        $query="delete from `jp_ld_review` where `id`=$id and `company_id`=$company_id";
        return $this->db->delete($query);
    }


    /**
     * TODO 후기 아이디별로 보기
     * @param int $id
     * @return array
     */
    public function getReviewInfoById(int $id){
        $query="select `device_info` from `jp_ld_customer` where `id`=$id;";
        error_log($query);
        return $this->db->query($query);
    }


    public function getReviewListByPosition(int $offset, int $size, string $position, int $company_id){
        $query = "select * from `jp_ld_review` ";
        $query .= "where `company_id`=$company_id and `position`='$position' ";
        $query .= "order by `order` desc ";
        $query .= "limit $offset, $size;";

        error_log($query);
        return $this->db->query($query);
    }



}