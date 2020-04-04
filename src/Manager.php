<?php
/**
 * Created by Phpstorm
 * User HHj
 * Date 2020/4/4
 * Time 1:29 下午
 */

namespace Hano\swoole;


use Swoole\Server;
use think\App;
use think\facade\Hook;
use think\helper\Str;
use think\swoole\PidManager;

class Manager
{
    /**
     * @var App
     */
    protected $container;

    /**
     * Server events.
     *
     * @var array
     */
    protected $events = [
        'start',
        'shutDown',
        'workerStart',
        'workerStop',
        'workerError',
        'packet',
        'task',
        'finish',
        'pipeMessage',
        'managerStart',
        'managerStop',
        'request',
    ];

    /**
     * Manager constructor.
     * @param App        $container
     * @param PidManager $pidManager
     */
    public function __construct(App $app)
    {
        $this->container  = $app->container();
        var_dump($this->container);
//        $this->pidManager = $pidManager;
    }

    /**
     * 启动服务
     */
    public function run(): void
    {
        $this->initialize();
        if ($this->getConfig('hot_update.enable', false)) {
            //todo:热更新
        }

        $this->getServer()->start();
    }
    

    /**
     * 初始化.
     */
    protected function initialize(): void
    {
//        $this->createTables();
//        $this->prepareWebsocket();
        $this->setSwooleServerListeners();
//        $this->prepareRpc();
    }

    /**
     * 获取配置
     * @param string $name
     * @param null   $default
     * @return mixed
     */
    public function getConfig(string $name, $default = null)
    {
        return $this->container->config->get("swoole.{$name}", $default);
    }

    /**
     * @return Server
     */
    public function getServer()
    {
        return $this->container->make(Server::class);
    }

    /**
     * 触发事件
     * @param $event
     * @param $params
     */
    protected function triggerEvent(string $event, $params = null): void
    {
        $callback = $this->getConfig($event);
        $result = $this->container->invoke($callback, [$this]);
//        $this->container->event->trigger("swoole.{$event}", $params);
    }

    /**
     * Set swoole server listeners.
     */
    protected function setSwooleServerListeners()
    {
        foreach ($this->events as $event) {
            $listener = Str::camel("on_$event");
            $callback = method_exists($this, $listener) ? [$this, $listener] : function () use ($event) {
                $this->triggerEvent($event, func_get_args());
            };

            $this->getServer()->on($event, $callback);
        }
    }
}