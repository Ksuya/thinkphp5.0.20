<?php
// +----------------------------------------------------------------------
// | Time  : 15:39  2018/8/28/028
// +----------------------------------------------------------------------
// | Author: whlphper  备注: 扩展TP REDIS
// +----------------------------------------------------------------------
namespace tool;
use think\cache\driver\Redis;
class PHPRedis extends Redis{

    /**
     * 订阅 key
     * @param $key
     * @return mixed
     */
    public function subscribe(array $key)
    {
        return $this->handler->subscribe($key,[$this,'subCallback']);
    }

    /**
     * 处理订阅事件
     * @param $redis
     * @param $channel
     * @param $msg
     */
    public static function subCallback($redis, $channel, $msg)
    {
        print_r([
            'redis'   => $redis,
            'channel' => $channel,
            'msg'     => $msg
        ]);
    }

    /**
     * 推送消息给key
     * @param $key
     * @param $value
     * @return mixed
     */
    public function publish($key,$value)
    {
        return $this->handler->publish($key,$value);
    }

    /**
     * 插入链表 left
     * @param $key
     * @param $value
     * @return mixed
     */
    public function lPush($key,$value)
    {
        return $this->handler->lPush($key,$value);
    }

    /**
     * 插入链表 right
     * @param $key
     * @param $value
     * @return mixed
     */
    public function rPush($key,$value)
    {
        return $this->handler->rPush($key,$value);
    }

    /**
     * 弹出首元素
     * @param $key
     * @return mixed
     */
    public function lPop($key)
    {
        return $this->handler->lPop($key);
    }

    /**
     * 弹出尾元素
     * @param $key
     * @return mixed
     */
    public function RPop($key)
    {
        return $this->handler->RPop($key);
    }

    /**
     * 获取链表
     * @param $key
     * @param int $start
     * @param int $end
     * @return mixed
     */
    public function lRange($key,$start=0,$end=-1)
    {
        return $this->handler->lRange($key,$start,$end);
    }

    /**
     * 获取链表长度
     * @param $key
     * @return mixed
     */
    public function lSize($key)
    {
        return $this->handler->lSize($key);
    }

    /**
     * 无序集合 添加元素
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sAdd($key,$value)
    {
        return $this->handler->sAdd($key,$value);
    }

    /**
     * 无序集合 元素
     * @param $key
     * @return mixed
     */
    public function sMembers($key)
    {
        return $this->handler->sMembers($key);
    }

    /**
     * 无序集合 长度
     * @param $key
     * @return mixed
     */
    public function sCard($key)
    {
        return $this->handler->sCard($key);
    }

    /**
     * 无序集合 是否包含此值
     * @param $key
     * @param $value
     * @return mixed
     */
    public function sIsMember($key,$value)
    {
        return $this->handler->sIsMember($key,$value);
    }

    /**
     * 无序集合 移动值
     * @param $source  原key
     * @param $target  目标key
     * @param $value   移动的值
     * @return mixed
     */
    public function sMove($source,$target,$value)
    {
        if(!$this->sIsMember($source,$value)){
            return false;
        }
        return $this->handler->sMove($source,$target,$value);
    }

    /**
     * 无序集合 随机移除元素 并返回该元素
     * @param $key
     * @return mixed
     */
    public function sPop($key)
    {
        return $this->handler->sPop($key);
    }

    /**
     * 无序集合 返回随机元素 不会删除次元素
     * @param $key
     * @return mixed
     */
    public function sRandMember($key)
    {
        return $this->handler->sRandMember($key);
    }

    /**
     * 无序集合 获取两个集合交集
     * @param $key1
     * @param $key2
     * @return mixed
     */
    public function sInter($key1,$key2)
    {
        return $this->handler->sInter($key1,$key2);
    }

    /**
     * 无序集合 获取两个集合∪
     * @param $key1
     * @param $key2
     * @return mixed
     */
    public function sUnion($key1,$key2)
    {
        return $this->handler->sUnion($key1,$key2);
    }

    /**
     * 无序集合 获取两个集合差集
     * @param $key1
     * @param $key2
     * @return mixed
     */
    public function sDiff($key1,$key2)
    {
        return $this->handler->sDiff($key1,$key2);
    }

    /**
     * 有序集合 插入元素
     * @param $key
     * @param $score
     * @param $value
     * @return mixed
     */
    public function zAdd($key,$score,$value)
    {
        return $this->handler->zAdd($key,$score,$value);
    }

    /**
     * 获取集合
     * @param $key
     * @param int $start
     * @param int $end
     * @param bool $score
     * @return mixed
     */
    public function zRange($key,$start=0,$end=-1,$score=false)
    {
        return $this->handler->zRange($key,$start,$end,$score);
    }

    /**
     * 删除集合元素
     * @param $key
     * @param $value
     * @return mixed
     */
    public function zDelete($key,$value)
    {
        return $this->handler->zDelete($key,$value);
    }

    /**
     * 从高到低的顺序进行排列
     * @param $key
     * @param int $start
     * @param int $end
     * @param bool $score
     * @return mixed
     */
    public function zRevRange($key,$start=0,$end=-1,$score=false)
    {
        return $this->handler->zRevRange($key,$start,$end,$score);
    }

    /**
     * 返回key对应的有序集合中score介于min和max之间的所有元素
     * @param $key
     * @param int $start
     * @param int $end
     * @param array $option
     * @return mixed
     */
    public function zRangeByScore($key,$start=0,$end=-1,$option=[])
    {
        return $this->handler->zRangeByScore($key,$start,$end,$option);
    }

    /**
     * 返回key对应的有序集合中介于min和max间的元素的个数
     * @param $key
     * @param int $start
     * @param int $end
     * @return mixed
     */
    public function zCount($key,$start=0,$end=-1)
    {
        return $this->handler->zCount($key,$start,$end);
    }


    /**
     * 悲观锁  获取
     * @param  String  $key    锁标识
     * @param  Int     $expire 锁过期时间
     * @return Boolean
     */
    public function pessimisticLock($key = '', $expire = 5) {
        $is_lock = $this->handler->setnx($key, time()+$expire);
        //不能获取锁
        if(!$is_lock){
            //判断锁是否过期
            $lock_time = $this->handler->get($key);
            //锁已过期，删除锁，重新获取
            if (time() > $lock_time) {
                $this->unlock($key);
                $is_lock = $this->handler->setnx($key, time() + $expire);
            }
        }

        return $is_lock? true : false;
    }

    /**
     * 释放锁
     * @param  String  $key 锁标识
     * @return Boolean
     */
    public function unlock($key = ''){
        return $this->handler->del($key);
    }

    /**
     * 乐观锁
     * @param $strKey
     * @return mixed
     */
    public function optimisticLock($strKey,$value)
    {

        $this->handler->set($strKey,$value);
        $this->handler->get($strKey);
        $this->handler->watch($strKey);
        // 开启事务
        $this->handler->multi();
        $this->handler->exec();
        $age =  $this->handler->get($strKey);
        return $age;
    }

}