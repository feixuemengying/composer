<?php
    namespace ShengQianFu\Payment;

    use ShengQianFu\PaymentInterface;

    /**
     * 商城积分支付
     * @author mtf@shengqianfu.com
     */
    class MallScore implements PaymentInterface{

        public function __construct()
        {
            echo "mall score";
        }

        public function doPayment()
        {
            echo "mall score pay";
        }
    }