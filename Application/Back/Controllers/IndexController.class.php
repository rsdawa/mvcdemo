<?php
class IndexController extends BaseController
{
    public function Index()
    {
        $M    = ModelFactory::M("IndexModel");
        $data = $M->GetHello();
        include VIEW_PATH . 'index.html';
    }
}
