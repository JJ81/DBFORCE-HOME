<?php

namespace JCORP\Business\QnAService;
use JCORP\Database\DBConnection as DBConn;

class QnAService extends DBConn
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
//        $query=
//            "select *, @rn:=@rn+1 AS num
//            from `platform_qna`, (SELECT @rn:=0) r
//            where `is_delete`=0 and `type`='Q' order by `id` desc
//            limit $offset, $size;";

//        $query="
//                select `pq`.`id`, `pq`.`type`, `pq`.`title`, `pq`.`contents`, `pq`.`author`, `pq`.`registered_dt`,
//                `pqa`.`id` as `a_id`, `pqa`.`title` as `answer`, `pqa`.`author` as `author_answer`, `pqa`.`contents` as `answer_contents`,`pqa`.`registered_dt` as `answered_dt`,
//                @pq:=@pq+1 AS `num`
//                from `platform_qna` as `pq`
//                left join (
//                    select * from `platform_qna` as `pq2` where `pq2`.`is_delete`=0 and `pq2`.`type`='A'
//                ) as `pqa` on `pqa`.`ref_id` = `pq`.`id`
//                where `pq`.`is_delete`=0 and `pq`.`type`='Q'
//                order by `num` desc, `pq`.`registered_dt` desc, `pq`.`id` desc
//                limit $offset, $size;";

        $query="select `qna`.`id`, `qna`.`type`, `qna`.`title`, `qna`.`contents`, `qna`.`author`, `qna`.`registered_dt`,
                `pqa`.`id` as `a_id`, `pqa`.`title` as `answer`, `pqa`.`author` as `author_answer`, `pqa`.`contents` as `answer_contents`,`pqa`.`registered_dt` as `answered_dt`, `qna`.`rnum` 
                from (
                    SELECT @rownum:=@rownum+1  rnum, `pq`.* 
                    FROM `platform_qna` as `pq`, (SELECT @ROWNUM := 0) `R`
                    WHERE `pq`.`is_delete`=0 and `pq`.`type`='Q'
                    order by `rnum` desc
                ) as `qna`
                left join (
                    select * from `platform_qna` as `pq2` where `pq2`.`is_delete`=0 and `pq2`.`type`='A'
                ) as `pqa` on `pqa`.`ref_id` = `qna`.`id`
                limit $offset, $size;";
        error_log("getList");
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalListCount(){
        $query="select count(*) as `total` from `platform_qna` where `is_delete`=0;";
        error_log('getTotalListCount method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getListById(int $id){
        //$query="select * from `platform_qna` where `id`=$id and `is_delete`=0;";
        $query="select `pq`.`id`, `pq`.`type`, `pq`.`title`, `pq`.`contents`, `pq`.`author`, `pq`.`registered_dt`,
                `pqa`.`id` as `a_id`, `pqa`.`title` as `answer`, `pqa`.`author` as `author_answer`, `pqa`.`contents` as `answer_contents`,`pqa`.`registered_dt` as `answered_dt`, `pq`.`writer_id`, `pq`.`thumbnail` 
                from `platform_qna` as `pq`
                left join (
                    select * from `platform_qna` as `pq2` where `pq2`.`is_delete`=0 and `pq2`.`type`='A'
                ) as `pqa` on `pqa`.`ref_id` = `pq`.`id`
                where `pq`.`is_delete`=0 and `pq`.`type`='Q' and `pq`.`id`=$id;";
        error_log('getListById');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param $id
     * @return array
     */
    public function getAnswerListById($id){
        $query="select * from `platform_qna` where `id`=$id and `type`='A';";
        return $this->db->query($query);
    }


    /**
     * @return array
     */
    public function getTotalCount(){
        $query="select count(*) as `total` from `platform_qna` where `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @param string $title
     * @param string|null $thumbnail
     * @param string $contents
     * @param string|null $author
     * @param int|null $count
     * @param string|null $external_link
     * @param string|null $link_origin
     * @param string|null $date
     * @param string|null $type
     * @return string
     */
    public function setList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, string $date=null, string $type=null, int $ref_id=null){
        $query="insert into `platform_qna` (`title`, `thumbnail`, `contents`, `author`, `count`, `external_link`, `link_origin`, `registered_dt`, `type`, `ref_id`) ".
            " values (:title, :thumbnail, :contents, :author, :count, :external_link, :link_origin, :date, :type, :ref_id);";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':date' => $date,
            ':type' => $type,
            ':ref_id' => $ref_id
        );

        return $this->db->insert($query, $value);
    }

    /**
     * @param string $title
     * @param int $writer_id
     * @param string|null $thumbnail
     * @param string $contents
     * @param string|null $author
     * @param string|null $date
     * @param string|null $type
     * @return string
     */
    public function setListByUser(string $title, int $writer_id, string $thumbnail=null, string $contents, string $author=null, string $date=null, string $type=null){
        $query="insert into `platform_qna` (`title`, `thumbnail`, `contents`, `author`, `registered_dt`, `type`, `writer_id`) ".
            " values (:title, :thumbnail, :contents, :author, :date, :type, :writer_id);";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':date' => $date,
            ':type' => $type,
            ':writer_id' => $writer_id
        );

        return $this->db->insert($query, $value);
    }

    /**
     * 공지사항 수정
     * @param string $title
     * @param string|null $thumbnail
     * @param string $contents
     * @param string|null $author
     * @param int|null $count
     * @param string|null $external_link
     * @param string|null $link_origin
     * @param int $id
     * @param string|null $date
     * @param string|null $type
     * @return int
     */
    public function updateList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, int $id, string $date=null, string $type=null, int $ref_id=null){
        $query="update `platform_qna` set `title`=:title, `thumbnail`=:thumbnail, `contents`=:contents, 
                `author`=:author, `count`=:count, `external_link`=:external_link, `link_origin`=:link_origin, `registered_dt`=:date, `type`=:type, `ref_id`=:ref_id where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':date' => $date,
            ':type' => $type,
            ':ref_id' => $ref_id,
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }


    public function updateListByUser(string $title, string $contents, int $id, string $thumbnail=null){
        $query="update `platform_qna` set `title`=:title, `thumbnail`=:thumbnail, `contents`=:contents where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':id' => $id
        );
        return $this->db->update($query, $value);
    }

    /**
     * @param string $title
     * @param string $author
     * @param string $date
     * @param string $contents
     * @param int $aid
     * @return int|null
     */
    public function updateAnswerList(string $title, string $author, string $date, string $contents, int $aid){
        $query="update `platform_qna` set `title`=:title, `contents`=:contents, `author`=:author, `registered_dt`=:date where `id`=:id;";
        $value=array(
            ':title' => $title,
            ':contents' => $contents,
            ':author' => $author,
            ':date' => $date,
            ':id' => $aid
        );
        return $this->db->update($query, $value);
    }


    /**
     * 공지사항 삭제 처리 is_delete = false 처리
     * @param int $id
     * @return int
     */
    public function delList(int $id){
        $query="update `platform_qna` set `is_delete`=true where `id`=:id;";
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
        $query="update `platform_qna` set `thumbail`=null where `id`=:id;";
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
        $query="update `platform_qna` set `count`=`count`+1 where `id`=$id;";
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
            "select * from `platform_qna` where `id` in ( " .
            " select max(`id`) from `platform_qna` where `id` < $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $query_next=
            "select * from `platform_qna` where `id` in ( " .
            " select min(`id`) from `platform_qna` where `id` > $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $prev=$this->db->query($query_prev);
        $next=$this->db->query($query_next);

        return array(
            'prev' => $prev,
            'next' => $next
        );
    }

}