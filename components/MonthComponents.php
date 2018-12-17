<?php
/**
 * Created by PhpStorm.
 * User: varik
 * Date: 16.12.2018
 * Time: 23:06
 */

namespace app\components;


use yii\base\Component;

class MonthComponents extends Component
{
    const RU_MONTH = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    const EN_MONTH = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


    public function getListMonth( string $param )
    {
        $data_months = ($param == 'ru') ? self::RU_MONTH : self::EN_MONTH;
        $html = '';
        foreach ($data_months as $data_month){
            $html .= '<options value="' . $data_month . '">' . $data_month . '</options>';
        }

        return $html;
    }

    public function getDataMonth( string $param ) : array {
        $data_months = ($param == 'ru') ? self::RU_MONTH : self::EN_MONTH;
        return $this->getDubleValueKey($data_months);
    }

    private function getDubleValueKey (array $datas) :array {
        $result = [];

        if (is_array($datas)){
            foreach ($datas as $data){
                $result[$data] = $data;
            }
        }
        return $result;
    }
}