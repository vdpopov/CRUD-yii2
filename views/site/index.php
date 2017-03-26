<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
?>
<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

   <?php echo Alert::widget([
    'options' => [
        'class' => 'alert-success'
    ],
    'body' => '<b>Успешно!</b> Действие выполнено!'
]);
?>
    <?php endif; ?>
	<?php
	$form1 = ActiveForm::begin(); 
Modal::begin([
    'header' => '<h2>Создание новости</h2>',
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'btn btn-lg btn-block btn-success',
        'label' => 'Добавить новость',
    ]
]);
 
	echo $form1->field($model1, 'name1')->label(false)->textInput(['class' => 'form-control', 'style' => 'width:100%']);
	echo $form1->field($model1, 'textarea1')->label(false)->textArea(['style' => 'width: 100%;height: 200px;resize: none;']);
	
	echo Html::submitButton(
	'Сохранить', [
	
	'class' => 'btn btn-success', 
	'name' => 'h-button'
	]);
 
Modal::end();
ActiveForm::end();
?>
<h1>Новости</h1>

<div class="row">
<?php foreach ($news as $new): ?>

    <div class="container">
	
	<div class="panel panel-info">
	<div class="panel-heading">

    <h3 class="panel-title"><?= Html::encode("{$new->name}") ?></h3>
	<small><?php echo date("d.m.Y в H:i", strtotime($new->datepublnews)) ?></small>
	</div>
	<div class="panel-body">
	<?= $new->text ?>
	</div>

	<?= Html::beginForm(['site/index'], 'post', ['data-pjax' => '', 'style' => 'float:left', 'class' => 'form-inline']); ?>

	<?= Html::input('hidden', 'string', $new->id, ['class' => 'form-control']) ?>
    <?= Html::submitButton(
	'Удалить', [
	'data' => ['confirm' => 'Вы действительно хотите удалить новость?'],
	'class' => 'btn btn-danger btn-xs', 
	'name' => 'h-button'
	]) ?>
	
		<?= Html::endForm() ?>

	<?php
	$form = ActiveForm::begin(); 
	Modal::begin([
	'header' => '<h2>Изменение новости</h2>',
	
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'btn btn-primary btn-xs',
        'label' => 'Редактировать'
    ]
	]);
	
	
	echo $form->field($model, 'name')->label(false)->textInput(['value' => Html::encode("{$new->name}"), 'class' => 'form-control', 'style' => 'width:100%']);
	echo $form->field($model, 'textarea')->label(false)->textArea(['value' => $new->text, 'class' => 'form-control', 'style' => 'width: 100%;height: 200px;resize: none;']);
	echo $form->field($model, 'id')->label(false)->hiddenInput(['value' => $new->id]);

	echo Html::submitButton(
	'Сохранить', [
	
	'class' => 'btn btn-success', 
	'name' => 'h-button'
	]);
	  
	Modal::end();
	ActiveForm::end();
?>



</div>

	

		
  </div>
<?php endforeach; ?>
</div>


<?= LinkPager::widget(['pagination' => $pagination]) ?>