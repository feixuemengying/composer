<?php
    namespace ShengQianFu;
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