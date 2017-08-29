<?php
class ProductController extends BaseController
{
    //显示所有商品
    public function Index()
    {
        $obj    = ModelFactory::M("ProductModel");
        $result = $obj->getAllProduct();
        include "./Views/productlist.html";
    }
    //删除单个商品
    public function Delete()
    {
        $id     = $_GET['id'];
        $obj    = ModelFactory::M("ProductModel");
        $result = $obj->deleteProduct($id);
        $this->MsgAndGo("删除成功!", "?c=Product", 2);
    }

}
