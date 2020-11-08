<?php

namespace JCORP\Business\Media;
use JCORP\Database\DBConnection as DBConn;

class MediaService extends DBConn
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
            "from `platform_media`, (SELECT @rn:=0) r " .
            // "where `is_delete`=0 order by `id` desc " .
            "where `is_delete`=0 order by `registered_dt` desc, `id` desc " .
            "limit $offset, $size;";
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalListCount(){
        $query="select count(*) as `total` from `platform_media` where `is_delete`=0;";
        error_log('getTotalListCount method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getListById(int $id){
        $query="select * from `platform_media` where `id`=$id and `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalCount(){
        $query="select count(*) as `total` from `platform_media` where `is_delete`=0;";
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
    public function setList(string $title, string $thumbnail=null, string $contents=null, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, string $date=null, string $desc=null){
        $query="insert into `platform_media` (`title`, `thumbnail`, `contents`, `author`, `count`, `external_link`, `link_origin`, `registered_dt`, `desc`) ".
            " values (:title, :thumbnail, :contents, :author, :count, :external_link, :link_origin, :date, :desc);";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':date' => $date,
            ':desc' => $desc
        );

        return $this->db->insert($query, $value);
    }

    public function getListByDate(int $offset, int $size){
        //$query="select * from `platform_media` where `is_delete`=0 order by `registered_dt` desc limit $offset, $size;";
        $query="
                select * from (
                    select `notice`.*, @ROWNUM := @ROWNUM+1 as ROWNUM 
                    from `platform_media` as `notice` , (select @ROWNUM:=0) as `tmp` 
                    where `is_delete`=0 
                    order by `registered_dt` asc 
                ) as `tmp`
                order by `ROWNUM` desc
                limit $offset, $size;";
        error_log('getListByDate method');
        error_log($query);
        return $this->db->query($query);
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
    public function updateList(string $title, string $thumbnail=null, string $contents=null, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, int $id, string $date=null, string $desc=null){
        $query="update `platform_media` set `title`=:title, `thumbnail`=:thumbnail, `contents`=:contents, `author`=:author, `count`=:count, 
                        `external_link`=:external_link, `link_origin`=:link_origin, `registered_dt`=:date, `desc`=:desc 
                        where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':id' => $id,
            ':date' => $date,
            ':desc' => $desc
        );
        return $this->db->update($query, $value);
    }

    /**
     * 공지사항 삭제 처리 is_delete = false 처리
     * @param int $id
     * @return int
     */
    public function delList(int $id){
        $query="update `platform_media` set `is_delete`=true where `id`=:id;";
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
        $query="update `platform_media` set `thumbail`=null where `id`=:id;";
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
        $query="update `platform_media` set `count`=`count`+1 where `id`=$id;";
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
            "select * from `platform_media` where `id` in ( 
             select max(`id`) from `platform_media` where `id` < $id and `external_link` is null and `is_delete`=0)";
        $query_next=
            "select * from `platform_media` where `id` in ( " .
            " select min(`id`) from `platform_media` where `id` > $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $prev=$this->db->query($query_prev);
        $next=$this->db->query($query_next);

        return array(
            'prev' => $prev,
            'next' => $next
        );
    }


}