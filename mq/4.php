<?php

// 订单总和
$order = [
    ['product_id' => 1, 'price' => 99, 'count' => 1],
    ['product_id' => 2, 'price' => 50, 'count' => 2],
    ['product_id' => 2, 'price' => 17, 'count' => 3],
];
 
$sum = array_sum(array_map(function ($product_row) {
    return $product_row['price'] * $product_row['count'];
}, $order));
 
print_r($sum);// 250


/*
     *  生成随机字符串
     *
     *   $length    字符串长度
     */
    function random_str($length) {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i < $length; $i++)
        {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
//            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }


    /**
 * 生成随机字符串，数字，大小写字母随机组合
 *
 * @param int $length  长度
 * @param int $type    类型，1 纯数字，2 纯小写字母，3 纯大写字母，4 数字和小写字母，5 数字和大写字母，6 大小写字母，7 数字和大小写字母
 */
function random($length = 6, $type = 1)
{
    // 取字符集数组
    $number = range(0, 9);
    $lowerLetter = range('a', 'z');
    $upperLetter = range('A', 'Z');
    // 根据type合并字符集
    if ($type == 1) {
        $charset = $number;
    } elseif ($type == 2) {
        $charset = $lowerLetter;
    } elseif ($type == 3) {
        $charset = $upperLetter;
    } elseif ($type == 4) {
        $charset = array_merge($number, $lowerLetter);
    } elseif ($type == 5) {
        $charset = array_merge($number, $upperLetter);
    } elseif ($type == 6) {
        $charset = array_merge($lowerLetter, $upperLetter);
    } elseif ($type == 7) {
        $charset = array_merge($number, $lowerLetter, $upperLetter);
    } else {
        $charset = $number;
    }
    $str = '';
    // 生成字符串
    for ($i = 0; $i < $length; $i++) {
        $str .= $charset[mt_rand(0, count($charset) - 1)];
        // 验证规则
        if ($type == 4 && strlen($str) >= 2) {
            if (!preg_match('/\d+/', $str) || !preg_match('/[a-z]+/', $str)) {
                $str = substr($str, 0, -1);
                $i = $i - 1;
            }
        }
        if ($type == 5 && strlen($str) >= 2) {
            if (!preg_match('/\d+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                $str = substr($str, 0, -1);
                $i = $i - 1;
            }
        }
        if ($type == 6 && strlen($str) >= 2) {
            if (!preg_match('/[a-z]+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                $str = substr($str, 0, -1);
                $i = $i - 1;
            }
        }
        if ($type == 7 && strlen($str) >= 3) {
            if (!preg_match('/\d+/', $str) || !preg_match('/[a-z]+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                $str = substr($str, 0, -2);
                $i = $i - 2;
            }
        }
    }
    return $str;
}


/**
 *  1. sucaihuo.com  suca***huo.com
 *  2. 13112882528    131****2528
 *  3. 2966636619@qq.com  296***366@qq.com
 * 
 * [hideStar description]
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function hideStar($str) { //用户名、邮箱、手机账号中间字符串以*隐藏 
    if (strpos($str, '@')) { 
        $email_array = explode("@", $str); 
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀 
        $count = 0; 
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count); 
        $rs = $prevfix . $str; 
    } else { 
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i'; 
        if (preg_match($pattern, $str)) { 
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4); 
        } else { 
            $rs = substr($str, 0, 3) . "***" . substr($str, -1); 
        } 
    } 
    return $rs; 
}