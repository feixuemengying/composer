<?php
    namespace Ioc;
    /**
     * IOC容器
     */
    class Container
    {
        protected $binds;

        /**
         * 
         * 为匿名函数指定名称,进行绑定
         * 
         * @param string $callback_name 函数名
         * @param callback  $callbak_function 匿名函数
         */
        public function bind($callback_name, $callbak_function)
        {
            if ($callbak_function instanceof \Closure) { //判断是否是匿名函数
                $this->binds[$callback_name] = $callbak_function; //匿名函数 绑定名称
            }
        }
        
        /**
         * 执行绑定的匿名函数
         * 
         * @param string $callback_name 函数名
         * @param array  $parameters    传递给匿名函数参数
         */
        public function make($callback_name, $parameters = [])
        {
            //array_unshift($parameters, $this);
            return call_user_func_array($this->binds[$callback_name], $parameters);
        }
    }