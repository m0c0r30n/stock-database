<?php

namespace App\Lib;

class Category
{
    public static $category_array = [
        ['alias' => 'baseball', 'name' => '野球',],
        ['alias' => 'soccer', 'name' => 'サッカー',],
        ['alias' => 'tennis', 'name' => 'テニス',],
        ['alias' => 'basketball', 'name' => 'バスケ',],
        ['alias' => 'volley', 'name' => 'バレー',],
        ['alias' => 'badminton', 'name' => 'バドミントン',],
        ['alias' => 'fighting', 'name' => '武道格闘技',],
        ['alias' => 'ski', 'name' => 'スキー・スノボ',],
        ['alias' => 'marin', 'name' => 'マリン',],
        ['alias' => 'outdoor', 'name' => 'アウトドア',],
        ['alias' => 'performance', 'name' => 'パフォーマンス',],
        ['alias' => 'play', 'name' => '映像演劇',],
        ['alias' => 'publish', 'name' => '出版企画',],
        ['alias' => 'music', 'name' => '音楽',],
        ['alias' => 'law', 'name' => '法律経済',],
        ['alias' => 'international', 'name' => '語学国際',],
        ['alias' => 'volunteer', 'name' => 'ボランティア',],
        ['alias' => 'sports', 'name' => 'その他スポーツ',],
        ['alias' => 'cultural', 'name' => 'その他文化系',],
    ];
    public static function name_from_alias($alias)
    {
        $index = array_search($alias, (array_column(Category::$category_array, 'alias')));
        return Category::$category_array[$index]['name'];
    }

    public static function alias_from_name($name)
    {
        $index = array_search($name, (array_column(Category::$category_array, 'name')));
        return Category::$category_array[$index]['alias'];
    }


}
