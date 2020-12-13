<?php

namespace App\Lib;

class Univ
{
    public static $univ_array = [
        ['alias' => 'aoyama_univ', 'name' => '青山学院大学',],
        ['alias' => 'keio_univ', 'name' => '慶應義塾大学',],
        ['alias' => 'sophia_univ', 'name' => '上智大学',],
        ['alias' => 'daito_univ', 'name' => '大東文化大学',],
        ['alias' => 'chuo_univ', 'name' => '中央大学',],
        ['alias' => 'tokyo_univ', 'name' => '東京大学',],
        ['alias' => 'housei_univ', 'name' => '法政大学',],
        ['alias' => 'meiji_univ', 'name' => '明治大学',],
        ['alias' => 'rikkyo_univ', 'name' => '立教大学',],
        ['alias' => 'waseda_univ', 'name' => '早稲田大学',],
    ];
    public static function name_from_alias($alias)
    {
        $index = array_search($alias, (array_column(Univ::$univ_array, 'alias')));
        return Univ::$univ_array[$index]['name'];
    }

    public static function alias_from_name($name)
    {
        $index = array_search($name, (array_column(Univ::$univ_array, 'name')));
        return Univ::$univ_array[$index]['alias'];
    }


}
