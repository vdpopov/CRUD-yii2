<?php

namespace app\models;

use yii\base\Model;

class IndexForm extends Model
{
	public $id;
    public $name;
    public $textarea;

    public function rules()
    {
        return [
            [['name', 'id', 'textarea' ], 'required',
			'message'=>'Поле не заполнено'],
            
        ];
    }
}
?>