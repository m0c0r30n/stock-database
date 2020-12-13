<?php

namespace App\Lib;

class Area
{
    public static $area_array = [
        ['alias' => 'sibuya_area', 'name' => '渋谷',],
        ['alias' => 'sinjuku_area', 'name' => '新宿',],
        ['alias' => 'takadanobaba_area', 'name' => '高田馬場',],
        ['alias' => 'tamachi_area', 'name' => '田町',],
        ['alias' => 'yokohama_area', 'name' => '横浜',],
        ['alias' => 'hatiouji_area', 'name' => '八王子',],
        ['alias' => 'ikebukuro_area', 'name' => '池袋',],
        ['alias' => 'kokubunji_area', 'name' => '国分寺',],
        ['alias' => 'ichigaya_area', 'name' => '市ヶ谷',],
        ['alias' => 'saitama_area', 'name' => '埼玉',],
    ];
    public static function name_from_alias($alias)
    {
        $index = array_search($alias, (array_column(Area::$area_array, 'alias')));
        return Area::$area_array[$index]['name'];
    }

    public static function alias_from_name($name)
    {
        $index = array_search($name, (array_column(Area::$area_array, 'name')));
        return Area::$area_array[$index]['alias'];
    }


}
