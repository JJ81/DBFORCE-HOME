<?php

namespace JCORP\Business\FaqService;
use JCORP\Database\DBConnection as DBConn;

class FaqService extends DBConn
{
    private $db=null;

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
        $query=
            "select *, @rn:=@rn+1 AS num " .
            "from `platform_faq`, (SELECT @rn:=0) r " .
            "where `is_delete`=0 order by `id` desc " .
            "limit $offset, $size;";
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalListCount(){
        $query="select count(*) as `total` from `platform_faq` where `is_delete`=0;";
        error_log('getTotalListCount method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getListById(int $id){
        $query="select * from `platform_faq` where `id`=$id and `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalCount(){
        $query="select count(*) as `total` from `platform_faq` where `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @param string $title
     * @param string $contents
     * @return string
     */
    public function setList(string $title, string $contents){
        $query="insert into `platform_faq` (`title`, `contents`) values (:title, :contents);";
        $value=array(
            ':title' => $title,
            ':contents' => $contents
        );

        return $this->db->insert($query, $value);
    }

    /**
     * @param string $title
     * @param string $contents
     * @param int $id
     * @return int
     */
    public function updateList(string $title, string $contents, int $id){
        $query="update `platform_faq` set `title`=:title, `contents`=:contents where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':contents' => $contents,
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * 공지사항 삭제 처리 is_delete = false 처리
     * @param int $id
     * @return int
     */
    public function delList(int $id){
        $query="update `platform_faq` set `is_delete`=true where `id`=:id;";
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
        $query="update `platform_faq` set `thumbail`=null where `id`=:id;";
        $value=array(
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * @param $id
     * @return int
     */
    public function increaseCount($id){
        $query="update `platform_faq` set `count`=`count`+1 where `id`=$id;";
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
            "select * from `platform_faq` where `id` in ( " .
            " select max(`id`) from `platform_faq` where `id` < $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $query_next=
            "select * from `platform_faq` where `id` in ( " .
            " select min(`id`) from `platform_faq` where `id` > $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $prev=$this->db->query($query_prev);
        $next=$this->db->query($query_next);

        return array(
            'prev' => $prev,
            'next' => $next
        );
    }


}