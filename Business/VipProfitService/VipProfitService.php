<?php

namespace JCORP\Business\VipProfitService;
use JCORP\Database\DBConnection as DBConn;

class VipProfitService extends DBConn
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
            "from `platform_vip_profit`, (SELECT @rn:=0) r " .
            "where `is_delete`=0 order by `id` desc " .
            "limit $offset, $size;";
        return $this->db->query($query);
    }


    public function getProbability(){
        $query="select 
                count(if(CAST(`profit_rate` as signed) > 0, CAST(`profit_rate` as signed), null)) as `profit_rate_plus`,
                count(if(CAST(`profit_rate` as signed) < 0, CAST(`profit_rate` as signed), null)) as `profit_rate_minus`  
                from `platform_vip_profit` where `is_delete`=0;";
        return $this->db->query($query);
    }


    /**
     * @return array
     */
    public function getTotalListCount(){
        $query="select count(*) as `total` from `platform_vip_profit` where `is_delete`=0;";
        error_log('getTotalListCount method');
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getListById(int $id){
        $query="select * from `platform_vip_profit` where `id`=$id and `is_delete`=0;";
        return $this->db->query($query);
    }

    /**
     * @return array
     */
    public function getTotalCount(){
        $query="select count(*) as `total` from `platform_vip_profit` where `is_delete`=0;";
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
    public function setList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, string $date=null, string $stock_title=null, string $max_profit_rate=null, string $max_profit_price=null){
        $query="insert into `platform_vip_profit` (`title`, `thumbnail`, `contents`, `author`, `count`, `external_link`, `link_origin`, `registered_dt`, `stock_title`, `max_profit_rate`, `max_profit_price`) ".
            " values (:title, :thumbnail, :contents, :author, :count, :external_link, :link_origin, :date, :stock_title, :max_profit_rate, :max_profit_price);";
        $value=array(
            ':title' => $title,
            ':thumbnail' => $thumbnail,
            ':contents' => $contents,
            ':author' => $author,
            ':count' => $count,
            ':external_link' => $external_link,
            ':link_origin' => $link_origin,
            ':date' => $date,
            ':stock_title' => $stock_title,
            ':max_profit_rate' => $max_profit_rate,
            ':max_profit_price' => $max_profit_price
        );

        return $this->db->insert($query, $value);
    }


    public function setList2(string $stock_title, string $purchase_price, string $purchase_date, string $sell_price, string $sell_date, string $profit_rate, string $author){
        $query="insert into `platform_vip_profit` (`stock_title`, `purchase_price`, `purchase_date`, `sell_price`, `sell_date`, `profit_rate`, `author`) ".
            " values (:stock_title, :purchase_price, :purchase_date, :sell_price, :sell_date, :profit_rate, :author);";
        $value=array(
            ':stock_title' => $stock_title,
            ':purchase_price' => $purchase_price,
            ':purchase_date' => $purchase_date,
            ':sell_price' => $sell_price,
            ':sell_date' => $sell_date,
            ':profit_rate' => $profit_rate,
            ':author' => $author
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
    public function updateList(string $title, string $thumbnail=null, string $contents, string $author=null, int $count=null, string $external_link=null, string $link_origin=null, int $id, string $date=null, string $stock_title=null, string $max_profit_rate=null, string $max_profit_price=null){
        $query="update `platform_vip_profit` set `title`=:title, `thumbnail`=:thumbnail, `contents`=:contents, `author`=:author, `count`=:count, 
                `external_link`=:external_link, `link_origin`=:link_origin, `registered_dt`=:date, `stock_title`=:stock_title, `max_profit_rate`=:max_profit_rate, `max_profit_price`=:max_profit_price 
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
            ':stock_title' => $stock_title,
            ':max_profit_rate' => $max_profit_rate,
            ':max_profit_price' => $max_profit_price
        );
        return $this->db->update($query, $value);
    }

    public function updateList2(string $stock_title, string $purchase_price, string $purchase_date, string $sell_price, string $sell_date, string $profit_rate, string $author, int $id){
        $query="update `platform_vip_profit`  set `stock_title`=:stock_title, `purchase_price`=:purchase_price, `purchase_date`=:purchase_date, 
                `sell_price`=:sell_price, `sell_date`=:sell_date, `profit_rate`=:profit_rate, `author`=:author where `id`=:id";
        $value=array(
            ':stock_title' => $stock_title,
            ':purchase_price' => $purchase_price,
            ':purchase_date' => $purchase_date,
            ':sell_price' => $sell_price,
            ':sell_date' => $sell_date,
            ':profit_rate' => $profit_rate,
            ':author' => $author,
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
        $query="update `platform_vip_profit` set `is_delete`=true where `id`=:id;";
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
        $query="update `platform_vip_profit` set `thumbail`=null where `id`=:id;";
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
        $query="update `platform_vip_profit` set `count`=`count`+1 where `id`=$id;";
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
            "select * from `platform_vip_profit` where `id` in ( " .
            " select max(`id`) from `platform_vip_profit` where `id` < $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $query_next=
            "select * from `platform_vip_profit` where `id` in ( " .
            " select min(`id`) from `platform_vip_profit` where `id` > $id and `external_link` is null and `is_delete`=0 " .
            ")";
        $prev=$this->db->query($query_prev);
        $next=$this->db->query($query_next);

        return array(
            'prev' => $prev,
            'next' => $next
        );
    }


    public function getTotalStock(){
        $query="select count(*) as `total` from (
                    select * from `platform_vip_profit`
                    where `is_delete`=0
                    group by `stock_title`
                ) as `tmp_table`;";
        return $this->db->query($query);
    }

    public function getTotalProfitRate(){
        $query="select sum(`profit_rate`) as `total` from `platform_vip_profit`
                where `is_delete`=0;";
        return $this->db->query($query);
    }


}