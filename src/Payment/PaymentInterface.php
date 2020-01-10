<?php
    namespace ShengQianFu\Payment;
    /**
     * 支付接口
     * @author mtf@shengqianfu.com
     */
    interface PaymentInterface{
        /**
         * 支付
         */
        public function doPayment();
    }