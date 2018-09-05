<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 18:50  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\shop\controller\Shopbase;
class User extends Shopbase{


    protected $beforeActionList = [
        'checkUserSession',
    ];

    public function _initialize()
    {
        parent::_initialize();
        $this->models['carts'] = model('ShopCarts');
        $this->models['user'] = model('ShopMembers');
        $this->models['address'] = model('ShopAddress');
        $this->models['order'] = model('ShopOrder');
        $this->models['orderDetail'] = model('ShopOrderDetail');
    }

    public function index()
    {
        $info = $this->models['user']->where('id',session('shopUserId'))->field('id,nick_name,email,phone,real_name,id_card,region,address')->find()->toArray();
        return view('',['info'=>$info]);
    }

    public function saveInfo()
    {
        $data = $this->request->post();
        $data['id'] = session('shopUserId');
        return $this->models['user']->saveData('修改个人信息',$data,[],'upd');
    }

    public function insertCarts()
    {
        $data = $this->request->post();
        $data['user_id'] = session("shopUserId");
        return $this->models['carts']->saveData('新增购物车',$data,'','ist');
    }

    public function address()
    {
        $address = $this->models['address']->where('user_id','in',session('shopUserId'))->select()->toArray();
        return view('',['address'=>$address]);
    }

    public function modaddr($id=0)
    {
        $address = $this->models['address']->where('id',$id)->find();
        return view('',['address'=>$address]);
    }

    public function saveAddress()
    {
        $data = $this->request->post();
        $data['user_id'] = session("shopUserId");
        if(empty($data['id'])){
            $name = '新增';
            $scene = 'ist';
        }else{
            $name = '更新';
            $scene = 'upd';
        }
        return $this->models['address']->saveData($name.'收货地址',$data,'',$scene);
    }

    public function delAddr()
    {
        $id = input("id");
        return $this->models['address']->deleteData('删除收货地址',['id'=>$id]);
    }

    public function delCarts()
    {
        $id = input("id");
        return $this->models['carts']->deleteData('删除购物车商品',['id'=>$id]);
    }

    public function delOrders()
    {
        $id = input("id");
        return $this->models['order']->deleteData('删除订单',['id'=>$id]);
    }


    public function delfaultAddr()
    {
        $id = input("id");
        $res = $this->models['address']->saveData('设置默认地址-全部非默认',['is_default'=>0],['user_id'=>session("shopUserId")]);
        if($res['errcode'] != '0'){
            return $res;
        }
        return $this->models['address']->saveData('设置默认地址-默认',['is_default'=>1,'id'=>$id]);
    }

    public function carts()
    {
        $list = $this->models['carts']->getUserCarts(session('shopUserId'));
        return view('',['carts'=>$list]);
    }

    public function order()
    {
        $list = $this->models['order']
            ->where('user_id','in',session('shopUserId'))
            ->where('confirm',1)
            ->paginate(10,false,[
            'type'     => 'bootstrap',
            'var_page' => 'page',
        ]);
        // 获取分页显示
        $page = $list->render();
        return view('',['orders'=>$list,'page'=>$page]);
    }

    public function orderdetail($id)
    {
        $order = $this->models['order']->detail($id);
        return view('',['order'=>$order]);
    }

    public function completeOrder()
    {
        $id = input("id");
        return $this->models['order']->saveData('完成订单',['id'=>$id,'progress'=>3]);
    }
}