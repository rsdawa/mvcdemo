<?php
//独立图片浏览器输出
//需开启GD库(php_gd2.dll)
$img1 = imageCreateTrueColor(60, 20);

$color1 = imagecolorallocate($img1, rand(0, 255), rand(0, 255), rand(0, 255));
$color2 = imagecolorallocate($img1, rand(0, 255), rand(0, 255), rand(0, 255));

imagefill($img1, 0, 0, $color1);
$validCode = getValidCode();
imagestring($img1, 3, 15, 3, $validCode, $color2);

header("content-type:image/gif"); //也可以是jpeg,png
imagepng($img1);
imagedestroy($img1);

function getValidCode()
{
    $str1 = '';
    $arr1 = range('a', 'z'); //返回一个数组，其范围为0-9字符
    $arr2 = range('A', 'Z');
    $arr3 = range('0', '9');
    $arr  = array_merge($arr1, $arr2, $arr3); //将多个数组合并成一个
    for ($i = 1; $i <= 4; $i++) {
        $index = rand(0, 61);
        $str1 .= $arr[$index];
    }
    $_SESSION['code'] = $str1; //存入session，供验证使用
    return $str1;
}
