<?php
class ProductController extends BaseController
{
    //显示所有商品
    public function Index()
    {
        $obj    = ModelFactory::M("ProductModel");
        $result = $obj->getAllProduct();
        include "./Application/Front/Views/productlist.html";
    }
    //删除单个商品
    public function Delete()
    {
        $id     = $_GET['id'];
        $obj    = ModelFactory::M("ProductModel");
        $result = $obj->deleteProduct($id);
        $this->MsgAndGo("删除成功!", "?c=Product", 2);
    }
    //显示商品详情
    public function Detail()
    {
        $id     = $_GET['id'];
        $obj    = ModelFactory::M("ProductModel");
        $result = $obj->productDetail($id);
        include "./Application/Front/Views/productDetail.html";
    }

}
