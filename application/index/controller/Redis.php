<?php
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:51  2018/8/28/028
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\index\controller;

use think\Controller;
use tool\PHPRedis;
class Redis extends Controller{

    public function testList()
    {
        $redis = new PHPRedis();
        /*
         * 添加队列 LIST
         */
        $lpushRes = $redis->lPush('mylist','L'.mt_rand(1,99999));
        $rpushRes = $redis->rPush('mylist','R'.mt_rand(1,99999));
        dump($lpushRes);
        dump($rpushRes);
        /**
         * 弹出首尾
         */
        dump($redis->lPop('mylist'));
        dump($redis->rPop('mylist'));
        /**
         * 获取队列 LIST
         */
        dump($redis->lRange('mylist'));
        /**
         * 获取队列长度
         */
        dump($redis->lSize('mylist'));
        /**
         * 删除链表
         */
        dump($redis->lRemove('mylist'));
        dump($redis->lSize('mylist'));
    }

    public function testSet()
    {
        $redis = new PHPRedis();
        dump($redis->sAdd('myset','whlphper'.mt_rand(9,9999)));
        dump($redis->sAdd('myset','whlphper85888/'));
        dump($redis->sAdd('myset2','whlphper2'.mt_rand(9,9999)));
        dump($redis->sAdd('myset2','whlphper85888/'));
        dump($redis->sCard('myset'));
        dump($redis->sIsMember('myset','whlphper6068'));
        dump($redis->sMove('myset','myset2','whlphper6068---'));
        dump($redis->sMembers('myset'));
        dump($redis->sMembers('myset2'));
        dump($redis->sPop('myset2'));
        dump($redis->sMembers('myset2'));
        dump($redis->sRandMember('myset2'));
        dump($redis->sMembers('myset2'));
        dump($redis->sInter('myset','myset2'));
    }

    public function testPublish()
    {
        $redis = new PHPRedis();
        if($redis->publish('phpstudy','hello~')){
            echo 'publish success';
        }else{
            echo 'publish error';
        }
    }

    public function testSubscrib()
    {

        $redis = new PHPRedis();
        /* redis 订阅消息
        $redis->subscribe(['phpstudy']);*/

        /*
         * 乐观锁
         */
        while (true)
        {
            $res = $redis->optimisticLock('hahaha',1);
            if($res){
                echo $res.' === success'.PHP_EOL;
            }else{
                echo $res.'failure'.PHP_EOL;
            }
            sleep(10);
        }

    }
}