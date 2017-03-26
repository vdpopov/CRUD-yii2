<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Expression;
use app\models\Newsitems;
use app\models\IndexForm;
use app\models\CreateForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
		$model1 = new CreateForm();
		if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
				$query = new Newsitems();
				$query->name = $model1['name1'];
				$query->text = $model1['textarea1'];
				$query->datepublnews = new Expression("NOW()");
				$query->save();

				Yii::$app->session->setFlash('contactFormSubmitted');
				return $this->refresh();
		}
		
		$model = new IndexForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$query= Newsitems::find()->where(['id' => $model['id']])->one();
				$query->name = $model['name'];
				$query->text = $model['textarea'];
				$query->save();
				Yii::$app->session->setFlash('contactFormSubmitted');
				return $this->refresh();
		}
		
		$string = Yii::$app->request->post('string');
		if(!empty($string)){
				$query= Newsitems::find()->where(['id' => $string])->one();
				$query->delete();
				Yii::$app->session->setFlash('contactFormSubmitted');
				return $this->refresh();
		
		}
        $query = Newsitems::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $news = $query->orderBy('id desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'news' => $news,
            'pagination' => $pagination,
			'model' => $model,
			'model1' => $model1,
			
        ]);
		
		
    }
	
	
}

?>