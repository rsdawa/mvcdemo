<?php
class GoodsController extends BaseController
{
    public function index()
    {
        $this->goodsList();
    }
    public function goodsList()
    {

    }
    public function add()
    {
        include VIEW_PATH . 'goods_add.html';
    }
}
