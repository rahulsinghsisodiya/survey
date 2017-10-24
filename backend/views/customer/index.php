<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\Components\CommonFunction;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">
  <div class="box box-primary">
      <div class="">
        <div class="row">
           
          <div class="col-md-12">
              <div class="right-menu-container">
                  <ul class="action-menu_button">
                    <li>
                        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
                    </li>
                      
                  </ul>
                </div>
            </div>
        </div>
<div class="col-sm-12 col-xs-12">
                
            </div>
   
   <?php
            $layout = "
              <div class='row'>
                <div class='col-xs-12'> \n
                    {items}\n
                </div>\n
              </div>
              <div class='row'>
                <div class='col-md-4 col-md-4 col-xs-12 record-info'>\n
                  {summary}\n
                </div>\n
                <div class='col-md-4 col-md-4 col-xs-12 right-paging-container'>\n
                  {pager}\n
                </div>\n
                <div class='col-md-4 col-md-4 col-xs-12 right-paging-container'>\n
                  <ul class='action-menu'>\n
                    <li class='show-records'>\n
                      <label for='followup_table_data_length'>Show</label>
                        ".\nterms\pagesize\PageSize::widget(['sizes'=>CommonFunction::getCustomConfigItem('gridViewSizes'),'defaultPageSize'=>CommonFunction::getCustomConfigItem('defaultGridPageSize')])."
                    </li>
                </ul>
                </div>\n
              </div>";
          ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        
        'layout' => $layout,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'dob',
            'address:ntext',
            // 'city',
            // 'email:email',
            // 'phone_number',
            // 'shoe_size',
            // 'jeans_size',
            // 'shirt_size',
            // 'blouse_size',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
  </div>
</div>

</div>
