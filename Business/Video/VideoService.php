<?php

namespace JCORP\Business\Video;

use JCORP\Database\DBConnection;

class VideoService extends DBConnection
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConnection();
    }


    /**
     * @return array
     */
    public function getAllVideo(){
        $query="select * from `jp_ld_video` order by `order` desc, `id` desc;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param string $title
     * @param string $url
     * @return string
     */
    public function setVideo(string $title, string $url){
        $query=
            "insert into `jp_ld_video` (`video_title`, `video_url`) values (:video_title, :video_url);";
        $value=array(
            ":video_title" => $title,
            ":video_url" => $url
        );
        return $this->db->insert($query, $value);
    }

    /**
     * @param $title
     * @param $url
     * @param $id
     * @return int
     */
    public function updateVideoById(string $title, string $url, int $id){
        $query="update `jp_ld_video` set `video_title`=:title, `video_url`=:url where `id`=:id";
        $value=array(
            ":title" => $title,
            ":url" => $url,
            ":id" => $id
        );
        return $this->db->update($query, $value);
    }


    /**
     * @param int $id
     * @return array
     */
    public function getVideoById(int $id){
        $query="select * from `jp_ld_video` where `id`=$id";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function deleteVideo(int $id){
        $query="delete from `jp_ld_video` where `id`=$id;";
        return $this->db->delete($query);
    }

    /**
     * @return array
     */
    public function getRepresentativeVideo(){
        $query="select * from `jp_ld_video` where `representative`=1;";
        error_log($query);
        return $this->db->query($query);
    }

    /**
     * @param int $id
     * @param null $db
     * @return int
     */
    public function setRepresentativeVideo(int $id, $db=null){
        $query="update `jp_ld_video` set `representative`=1 where `id`=$id;";
        error_log($query);
        if(!empty($db)){
            return $db->update($query);
        }else{
            return $this->db->update($query);
        }
    }

    /**
     * @param null $db
     * @return int
     */
    public function removeRepresentativeVideo($db=null){
        $query="update `jp_ld_video` set `representative`=0;";
        error_log($query);
        if(!empty($db)){
            return $db->update($query);
        }else{
            return $this->db->update($query);
        }
    }

    /**
     * @param int $id
     * @param int $order
     * @return int
     */
    public function setOrderVideo(int $id, int $order){
        $query="update `jp_ld_video` set `order`=$order where `id`=$id;";
        error_log($query);
        return $this->db->update($query);
    }

}