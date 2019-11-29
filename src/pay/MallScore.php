<?php
    namespace Feixuemengying\Shengqianfu\Pay;
    use Feixuemengying\Shengqianfu\Payment;
    class MallScore implements Payment{
        public function __construct()
        {
            echo "mall score";
        }

        public function pay()
        {
            echo "mall score pay";
        }
    }