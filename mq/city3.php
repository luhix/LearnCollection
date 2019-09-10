<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/5
 * Time: 17:41
 */



class Citys
{
    /**
     * 二维数组根据首字母分组排序
     * @param  array  $data      二维数组
     * @param  string $targetKey 首字母的键名
     * @return array             根据首字母关联的二维数组
     */
    public function groupByInitials(array $data, $targetKey = 'name')
    {
        $data = array_map(function ($item) use ($targetKey) {
            return array_merge($item, [
                'initials' => $this->getInitials($item[$targetKey]),
            ]);
        }, $data);


        $data = $this->sortInitials($data);
        return $data;
    }

    /**
     * 按字母排序
     * @param  array  $data
     * @return array
     */
    public function sortInitials(array $data)
    {
        $sortData = [];
        foreach ($data as $key => $value) {

            if ($value['name'] == '重庆市') {
                $value['initials'] = 'C';
            }


            $sortData[$value['initials']][] = $value;
        }
        ksort($sortData);
        return $sortData;
    }

    /**
     * 获取首字母
     * @param  string $str 汉字字符串
     * @return string 首字母
     */
    public function getInitials($str)
    {

        if (empty($str)) {return '';}
        $fchar = ord($str{0});


        if ($fchar >= ord('A') && $fchar <= ord('z')) {
            return strtoupper($str{0});
        }

        $s1  = iconv('UTF-8', 'gb2312', $str);
        $s2  = iconv('gb2312', 'UTF-8', $s1);
        $s   = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
     

        if($asc>=-20319&&$asc<=-20284) return 'A';
        if($asc>=-20283&&$asc<=-19776 || $asc==-9743) return 'B';
        if($asc>=-19775&&$asc<=-19219) return 'C';
        if($asc>=-19218&&$asc<=-18711 || $asc==-9767) return 'D';
        if($asc>=-18710&&$asc<=-18527) return 'E';
        if($asc>=-18526&&$asc<=-18240) return 'F';
        if($asc>=-18239&&$asc<=-17923) return 'G';
        if($asc>=-17922&&$asc<=-17418) return 'H';
        if($asc>=-17417&&$asc<=-16475) return 'J';
        if($asc>=-16474&&$asc<=-16213) return 'K';
        if($asc>=-16212&&$asc<=-15641 || $asc==-7182 || $asc==-6928 ) return 'L';
        if($asc>=-15640&&$asc<=-15166) return 'M';
        if($asc>=-15165&&$asc<=-14923) return 'N';
        if($asc>=-14922&&$asc<=-14915) return 'O';
        if($asc>=-14914&&$asc<=-14631 || $asc==-6745) return 'P';
        if($asc>=-14630&&$asc<=-14150 || $asc==-7703) return 'Q';
        if($asc>=-14149&&$asc<=-14091) return 'R';
        if($asc>=-14090&&$asc<=-13319) return 'S';
        if($asc>=-13318&&$asc<=-12839) return 'T';
        if($asc>=-12838&&$asc<=-12557) return 'W';
        if($asc>=-12556&&$asc<=-11848) return 'X';
        if($asc>=-11847&&$asc<=-11056) return 'Y';
        if($asc>=-11055&&$asc<=-10247) return 'Z';

        return null;
    }

}


// 按首字母排序
$data = [
    ['id' => 1, 'name' => '山东'],
    ['id' => 2, 'name' => '江苏'],
    ['id' => 3, 'name' => '安徽'],
    ['id' => 4, 'name' => '福建'],
    ['id' => 5, 'name' => '江西'],
    ['id' => 6, 'name' => '广东'],
    ['id' => 7, 'name' => '广西'],
    ['id' => 8, 'name' => '海南'],
    ['id' => 9, 'name' => '河南'],
    ['id' => 10, 'name' => '湖南'],
    ['id' => 11, 'name' => '湖北'],
    ['id' => 12, 'name' => '重庆市'],
    ['id' => 13, 'name' => '珠海市'],
];
// 初始化，然后调用分组方法
$datas = (new Citys)->groupByInitials($data, 'name');

echo "<pre>";
print_r($datas);