<?php

namespace JCORP\Business\Coupon;
use \JCORP\Database\DBConnection as DBConn;

class CouponService extends DBConn
{

    private $db=null;

    public function __construct()
    {
        $this->db=new DBConn();
    }

    /**
     * 쿠폰 발행 대상자 중복 확인
     * @param string $phone
     * @return array
     */
    public function checkDuplicatePhoneNumber(string $phone){
        $query="select count(*) as `total` from `jp_ld_customer` where `phone`='$phone';";
        return $this->db->query($query);
    }

    /**
     * 쿠폰 발생 중복 여부 확인
     * @param string $coupon
     * @return array
     */
    public function checkDuplicatedCouponNumber(string $coupon){
        $query="select count(*) as `total` from `jp_ld_coupon` where `coupon`='$coupon';";
        return $this->db->query($query);
    }




}