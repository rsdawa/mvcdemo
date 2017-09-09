<?php

class GoodsModel extends BaseModel
{
    public function GoodsInsert($arr)
    {
        /*
        $sql = "insert into goods (goods_name,price,market_price,stock_num,is_show,status,image_original) values (";
        $sql .= "'" . $arr['goods_name'] . "',";
        $sql .= "'" . $arr['price'] . "',";
        $sql .= "'" . $arr['market_price'] . "',";
        $sql .= "'" . $arr['stock_num'] . "',";
        $sql .= "'" . $arr['is_show'] . "',";
        $sql .= "'" . $arr['status'] . "',";
        $sql .= "'" . $arr['image_original'] . "')";
         */
        $sql = "insert into goods set ";
        $sql .= "goods_name='{$arr['goods_name']}',";
        $sql .= "price='{$arr['price']}',";
        $sql .= "market_price='{$arr['market_price']}',";
        $sql .= "stock_num='{$arr['stock_num']}',";
        $sql .= "is_show='{$arr['is_show']}',";
        $sql .= "status='{$arr['status']}',";
        $sql .= "time_original=now(),";
        $sql .= "time_modify=now(),";
        $sql .= "admin_user='{$_SESSION['USER']}',";
        $sql .= "detail='{$arr['detail']}',";
        $sql .= "image_original='{$arr['image_original']}'";

        return $this->db->exec($sql);
    }
    public function goodsList()
    {
        $sql = "select * from goods";
        return $this->db->getRows($sql);
    }
    public function getGoodsCount()
    {
        $sql = "select count(*) from goods";
        return $this->db->getOneData($sql);
    }
}
