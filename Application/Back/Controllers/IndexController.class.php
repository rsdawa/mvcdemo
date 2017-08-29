<?php
class IndexController extends BaseController
{
    public function Index()
    {
        $M    = ModelFactory::M("IndexModel");
        $data = $M->GetHello();
        include './Application/Back/Views/index.html';
    }
}
