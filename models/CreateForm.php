<?php

namespace app\models;

use yii\base\Model;

class CreateForm extends Model
{
    public $name1;
    public $textarea1;

    public function rules()
    {
        return [
            [['name1', 'textarea1' ], 'required',
			'message'=>'Поле не заполнено'],
        ];
    }
}
?>