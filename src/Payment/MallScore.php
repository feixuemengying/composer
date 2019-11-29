<?php
    namespace ShengQianFu\Payment;

    use ShengQianFu\PaymentInterface;

    /**
     * 商城积分支付
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