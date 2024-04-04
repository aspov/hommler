<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Удалить выделенные', ['class' => 'btn btn-success delete-btn']) ?>        
    </p>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'image',
            'sku',
            'name',
            'count',
            'type',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
<?php
    $js = <<< JS
    $(".delete-btn").on('click', function () {    
        var product_ids = [];
        $('[name*="selection[]"]:checked').each(function(index, item) {
            product_ids.push($(item).val());            
        })
        $.post('delete-selected',{product_ids: product_ids}, function (data) {
            if (data.success) {
                $('[name*="selection[]"]:checked').closest('tr').remove();
            }            
        },"json");
    });
JS;
    $this->registerJs($js);
?>