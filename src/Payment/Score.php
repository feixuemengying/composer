<?php
    namespace ShengQianFu\Payment;

    use ShengQianFu\Payment\PaymentInterface;

    /**
     * 积分支付
     * @author mtf@shengqianfu.com
     */
    class Score implements PaymentInterface{

        public function __construct()
        {
            echo "score";
        }

        public function doPayment()
        {
            echo "score pay";
        }
    }