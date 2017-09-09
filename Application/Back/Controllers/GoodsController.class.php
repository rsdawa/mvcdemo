<?php
class GoodsController extends BaseController
{
    public function index()
    {
        $this->goodsList();
    }
    //显示添加商品表单页面
    public function add()
    {
        include VIEW_PATH . 'goods_add.html';
    }
    //执行商品添加动作
    public function goodsInsert()
    {
        //获取表单数据
        $arr                   = array();
        $arr['goods_name']     = addslashes($_POST['goods_name']);
        $arr['price']          = addslashes($_POST['price']);
        $arr['market_price']   = addslashes($_POST['market_price']);
        $arr['stock_num']      = addslashes($_POST['stock_num']);
        $arr['is_show']        = addslashes($_POST['is_show']);
        $arr['status']         = addslashes(array_sum($_POST['status']));
        $arr['image_original'] = addslashes($_POST['image_original']);
        $arr['detail']         = addslashes($_POST['detail']);
        //调用模型写入数据库
        $model  = ModelFactory::M('GoodsModel');
        $result = $model->goodsInsert($arr);
        //显示执行结果
        $this->MsgAndGo("添加成功", "?m=Back&c=Goods&a=goodsList");
    }
    public function goodsList()
    {
        $model  = ModelFactory::M('GoodsModel');
        $result = $model->goodsList();
        $sum    = $model->getGoodsCount();
        $show   = [1 => '显示', 0 => '不显示'];
        include VIEW_PATH . 'goods_list.html';
    }
}
