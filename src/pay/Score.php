<?php
    namespace Feixuemengying\Shengqianfu\shengqianfu;
    use Feixuemengying\Shengqianfu\Payment;
    class Score implements Payment{
        public function __construct()
        {
            echo "score";
        }

        public function pay()
        {
            echo "score pay";
        }
    }