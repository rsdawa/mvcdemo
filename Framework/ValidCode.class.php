<?php
//独立图片浏览器输出
//需开启GD库(php_gd2.dll)
class ValidCode
{
    private $width  = 0;
    private $height = 0;
    public function createCode($len)
    {
        //$width  = 145;
        //$height = 20;
        //$img1   = imageCreateTrueColor($width, $height);
        //改用背景创建图片
        $type = rand(1, 2);
        $n    = rand(1, 5);
        if ($type == 1) {
            $img1 = imagecreatefromgif("./web/back/images/captcha/captcha_bg{$n}.gif");
        } else {
            $img1 = imagecreatefromjpeg("./web/back/images/captcha/captcha_bg{$n}.jpg");
        }

        $this->width  = imagesx($img1);
        $this->height = imagesy($img1);

        //$color1 = imagecolorallocate($img1, rand(0, 255), rand(0, 255), rand(0, 255));
        $color2 = imagecolorallocate($img1, rand(0, 255), rand(0, 255), rand(0, 255));
        //添加干扰点线
        $this->addGanRao($img1, $color2);
        //imagefill($img1, 0, 0, $color1);
        $validCode = $this->getValidCode($len);
        imagestring($img1, 3, 50, 3, $validCode, $color2);

        header("content-type:image/png"); //也可以是jpeg,png
        imagepng($img1);
        imagedestroy($img1);
        return $validCode;
    }
    private function addGanRao($img, $color)
    {
        //添加10个干扰点
        for ($i = 1; $i < 10; $i++) {
            $x = rand(0, $this->width - 1);
            $y = rand(0, $this->height - 1);
            imagerectangle($img, $x, $y, $x + 2, $y + 2, $color);
        }
        //添加4个干扰线
        for ($i = 1; $i < 4; $i++) {
            $x1 = rand(0, $this->width - 1);
            $y1 = rand(0, $this->height - 1);
            $x2 = rand(0, $this->width - 1);
            $y2 = rand(0, $this->height - 1);
            imageLine($img, $x1, $y1, $x2, $y2, $color);
        }
    }
    private function getValidCode($len)
    {
        $str1 = '';
        $arr1 = range('a', 'z'); //返回一个数组，其范围为0-9字符
        $arr2 = range('A', 'Z');
        $arr3 = range('0', '9');
        $arr  = array_merge($arr1, $arr2, $arr3); //将多个数组合并成一个
        for ($i = 1; $i <= $len; $i++) {
            $index = rand(0, 61);
            $str1 .= $arr[$index];
        }
        $_SESSION['code'] = $str1; //存入session，供验证使用
        return $str1;
    }
}
