<?php
//require_once './Framework/BaseModel.class.php';
class ProductModel extends BaseModel
{
    public function getAllProduct()
    {
        //$db     = MySQLDB::getDB($this->conf);
        $sql    = "select p.*,t.protype_name as leibie from product as p inner join product_type as t on p.protype_id=t.protype_id";
        $result = $this->db->getRows($sql);
        return $result;
    }
    public function deleteProduct($id)
    {
        //$db  = MySQLDB::getDB($this->conf);
        $sql = "delete from product where pro_id=$id";
        $this->db->exec($sql);
        return true;
    }
    public function productDetail($id)
    {
        $sql    = "select p.*,t.protype_name as leibie from product as p inner join product_type as t on p.protype_id=t.protype_id where p.pro_id=$id";
        $result = $this->db->getOneRow($sql);
        return $result;
    }

}
