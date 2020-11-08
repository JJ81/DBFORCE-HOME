<?php

namespace JCORP\Business\Profit;
use JCORP\Database\DBConnection as DBConn;

class ProfitService extends DBConn
{
    private $db=null;
    private $DB_NAME='platform_profit';

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * @param int $offset
     * @param int $size
     * @return array
     */
    public function getList(int $offset, int $size){
        $query="select * from `$this->DB_NAME` where `is_delete`=0 order by `pickup` desc, `pickup_order` desc, `id` desc limit $offset, $size;";
        error_log('getList method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $offset
     * @param int $size
     * @return array
     */
    public function getListByDate(int $offset, int $size){
        $query="select * from `$this->DB_NAME` where `is_delete`=0 order by `registered_dt` desc limit $offset, $size;";
        error_log('getListByDate method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalListCount(){
        $query="select count(*) as `total` from `$this->DB_NAME` where `is_delete`=0;";
        error_log('getTotalListCount method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $offset
     * @param int $size
     * @return array
     */
    public function getListWithThumbnail(int $offset, int $size){
        $query="select * from `$this->DB_NAME` where `is_delete`=0 and `thumbnail` is not null order by `pickup` desc, `pickup_order` desc, `id` desc limit $offset, $size;";
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getListById(int $id){
        $query="select * from `$this->DB_NAME` where `id`=$id and `is_delete`=0;";
        return $this->db->query($query);
    }



    /**
     * @return array
     */
    public function getTotalCount(){
        $query="select count(*) as `total` from `$this->DB_NAME` where `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @param string $title
     * @param string|null $thumbnail
     * @param string $contents
     * @param string|null $author
     * @param int $count
     * @param string|null $external_link
     * @return string
     */
    public function setList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count, string $external_link=null, string $link_origin=null, string $date=null){
        $query="insert into `$this->DB_NAME` (`title`, `thumbnail`, `contents`, `author`, `count`, `external_link`, `link_origin`, `registered_dt`) ".
            " values (:title, :thumbnail, :contents, :author, :count, :external_link, :link_origin, :date);";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':link_origin' => $link_origin,
            ':external_link' => $external_link,
            ':date' => $date
        );

        return $this->db->insert($query, $value);
    }

    /**
     * 공지사항 수정
     * @param string $title
     * @param string|null $thumbnail
     * @param string $contents
     * @param string|null $author
     * @param int $count
     * @param string|null $external_link
     * @param int $id
     * @return int
     */
    public function updateList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count, string $external_link=null, string $link_origin=null, int $id, string $date=null){
        $query="update `$this->DB_NAME` set `title`=:title, `thumbnail`=:thumbnail, `contents`=:contents, `author`=:author, `count`=:count, `external_link`=:external_link, `link_origin`=:link_origin, `registered_dt`=:registered_dt where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':id' => $id,
            ':registered_dt' => $date
        );
        return $this->db->update($query, $value);
    }

    /**
     * 공지사항 삭제 처리 is_delete = false 처리
     * @param int $id
     * @return int
     */
    public function delList(int $id){
        $query="update `$this->DB_NAME` set `is_delete`=true where `id`=:id;";
        $value=array(
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * 썸네일만 삭제할 경우
     * @param $id
     * @return int
     */
    public function delThumbnailById($id){
        $query="update `$this->DB_NAME` set `thumbail`=null where `id`=:id;";
        $value=array(
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * @param int $id
     * @param int $order
     * @return int
     */
    public function setMainExpose(int $id, int $order){
        $query="update `$this->DB_NAME` set `pickup`=true, `pickup_order`=$order where `id`=$id;";
        error_log($query);
        return $this->db->update($query);
    }

    /**
     * @param int $id
     * @return int
     */
    public function removeMainExpose(int $id){
        $query="update `$this->DB_NAME` set `pickup`=false, `pickup_order`=0 where `id`=$id;";
        error_log($query);
        return $this->db->update($query);
    }

    /**
     * @param $id
     * @return int
     */
    public function increaseCount($id){
        $query="update `$this->DB_NAME` set `count`=`count`+1 where `id`=$id;";
        error_log('increaseCount');
        error_log($query);
        return $this->db->update($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getBoardPrevAndNext(int $id){
        // 현재 보고 있는 게시글보다 작은 애들 중 가능 큰 애를 찾아올 것.
        // 현재 보고 있는 게시글보다 큰 애들 중에 가장 작은 애를 찾아올 것.
        $query_prev=
            "select * from `$this->DB_NAME` where `id` in ( " .
            " select max(`id`) from `$this->DB_NAME` where `id` < $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $query_next=
            "select * from `$this->DB_NAME` where `id` in ( " .
            " select min(`id`) from `$this->DB_NAME` where `id` > $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $prev=$this->db->query($query_prev);
        $next=$this->db->query($query_next);

        return array(
            'prev' => $prev,
            'next' => $next
        );
    }

    /**
     * @return array
     */
    public function getProfitAccumulation(){
        $query="select * from `platform_profit_accum` order by `id` asc limit 0,5";
        error_log($query);
        return $this->db->query($query);

    }

    /**
     * @return array
     */
    public function getProfitByMonth(){
        $query="select * from `platform_profit_month` order by `id` asc limit 0,5";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getProfitByWeek(){
        $query="select * from `platform_profit_week` order by `id` asc limit 0,5";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $name
     * @param string $percentage
     * @param int $id
     * @return int
     */
    public function modProfitList(string $name, string $percentage, int $id){
        $query="update `platform_profit_accum` set `name`=:name, `percentage`=:percentage where `id`=:id;";
        $value=array(
            ':name' => $name,
            ':percentage' => $percentage,
            ':id' => $id
        );

        return $this->db->update($query, $value);
    }

    public function modProfitList2(string $name, string $percentage, int $id){
        $query="update `platform_profit_month` set `name`=:name, `percentage`=:percentage where `id`=:id;";
        $value=array(
            ':name' => $name,
            ':percentage' => $percentage,
            ':id' => $id
        );

        return $this->db->update($query, $value);
    }

    public function modProfitList3(string $name, string $percentage, int $id){
        $query="update `platform_profit_week` set `name`=:name, `percentage`=:percentage where `id`=:id;";
        $value=array(
            ':name' => $name,
            ':percentage' => $percentage,
            ':id' => $id
        );

        return $this->db->update($query, $value);
    }

}