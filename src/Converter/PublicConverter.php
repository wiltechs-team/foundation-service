<?php
namespace wiltechsteam\FoundationService\Converter;

use Illuminate\Support\Facades\Schema;

class PublicConverter
{
    /**
     * 需插入书库数据转换
     * @param $table 需插入表
     * @param $data 数据源
     * @return array 转换后数据
     */
    public static function transform($table, $data)
    {
        $columns = Schema::getColumnListing($table);

        $transformData = [];

        foreach ($data as $key => $value)
        {

            $mqLowerCaseString = str_replace('_', '', strtolower($key));
            foreach ($columns as $column)
            {
                $dbLowerCaseString = str_replace('_', '', strtolower($column));

                if($mqLowerCaseString == $dbLowerCaseString)
                {
                    $transformData[$column] = $value;
                }

                else if($mqLowerCaseString == strstr($table, 's_', true).$dbLowerCaseString)
                {
                    $transformData[$column] = $value;
                }
            }
        }

        return $transformData;
    }
}