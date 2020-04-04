<?php
/**
 * Created by Phpstorm
 * User HHj
 * Date 2020/4/4
 * Time 1:34 下午
 */

namespace Hano\swoole\core;


class Request extends \think\Request
{
    public function setPathinfo($pathinfo)
    {
        $this->pathinfo = $pathinfo;
        return $this;
    }

    /**
     * 设置GET数据
     * @access public
     * @param  array $get 数据
     * @return $this
     */
    public function withGet(array $get)
    {
        $this->get = $get;
        return $this;
    }

    /**
     * 设置POST数据
     * @access public
     * @param  array $post 数据
     * @return $this
     */
    public function withPost(array $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * 设置COOKIE数据
     * @access public
     * @param  array $cookie 数据
     * @return $this
     */
    public function withCookie(array $cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    /**
     * 设置SERVER数据
     * @access public
     * @param  array $server 数据
     * @return $this
     */
    public function withServer(array $server)
    {
        $this->server = array_change_key_case($server, CASE_UPPER);
        return $this;
    }

    /**
     * 设置HEADER数据
     * @access public
     * @param  array $header 数据
     * @return $this
     */
    public function withHeader(array $header)
    {
        $this->header = array_change_key_case($header);
        return $this;
    }

    /**
     * 设置ENV数据
     * @access public
     * @param  array $env 数据
     * @return $this
     */
    public function withEnv(array $env)
    {
        $this->env = $env;
        return $this;
    }

    /**
     * 设置ROUTE变量
     * @access public
     * @param  array $route 数据
     * @return $this
     */
    public function withRoute(array $route)
    {
        $this->route = $route;
        return $this;
    }


}