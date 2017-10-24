<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\Components\CommonFunction;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Delete Items';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary">
      <div class="campaign-index">
          <div class="row">
              <!-- general form elements -->
              <div class="col-sm-4 col-xs-4">
                <ul class="action-menu">
                    <li class="show-records">
                      <label for="followup_table_data_length">Show</label>
                        <?php echo \nterms\pagesize\PageSize::widget(['sizes'=>CommonFunction::getCustomConfigItem('gridViewSizes'),'defaultPageSize'=>CommonFunction::getCustomConfigItem('defaultGridPageSize')]); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
              <div class="right-menu-container">
                  <ul class="action-menu">
                      <li>
                          <span>Search:</span>
                          <?=Html::activeInput("search", $searchModel,'searchQuery', ["id" => "search-box", "class" => "form-control header-control", "placeholder" => "", "aria-controls" => "followup_table_data"])?>
                      </li>
                      <li>
                         <button class="btn btn-danger remove" data-url="<?=Url::to(['delete/remove'])?>">Delete</button>
                      </li>
                     
                  </ul>
                </div>
            </div>
          </div>
           <?php
            $layout = "
              <div class='row'>
                <div class='col-xs-12'> \n
                    {items}\n
                </div>\n
              </div>
              <div class='row'>
                <div class='col-md-6 col-md-6 col-xs-12 record-info'>\n
                  {summary}\n
                </div>\n
                <div class='col-md-6 col-md-6 col-xs-12 right-paging-container'>\n
                  {pager}\n
                </div>\n
              </div>";
          ?>
          <?php Pjax::begin(['id' => 'pjax-grid-view']); 
          //prd($dataProvider);?>    
          <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'filterSelector' => '#search-box,select[name="per-page"]',
                'filterRowOptions' => ['class'=> 'display-none'],
                'layout' => $layout,
                'columns' => [
                    [ 
                      
                      'class' => 'yii\grid\CheckboxColumn',
                      'headerOptions' => ['style' => 'width:5%;'],
                      'checkboxOptions' => function($model, $key, $index, $widget) {
                                           return ["value" => $model['did'].'-'.$model['type']];
                                        },
                    ],
                    'title',
                    
                    'type',
                    [
                   'attribute' => 'deleted_at',
                   'format' => ['date' , 'php:d/m/Y'],
                   'label' => Yii::t('app','Deleted On'),
                   'headerOptions' => ['style' => 'width:10%;'],
                    ],
                    [
                     'attribute' => 'deleted_by',
                     'label' => Yii::t('app','Deleted By'),
                     'headerOptions' => ['style' => 'width:10%;'],
                     'value' => function($model){
                      $name =  CommonFunction::getUsername($model['deleted_by']);
                      return empty($name) ? '' : $name ;
                      }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Restore',
                        'headerOptions' => ['style' => 'width:10%;'],
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model, $key){
                                      return "<a href='javascript:void(0)' title='Restore' aria-label='Restore' aria-label='Restore' class='restore' data-type = '".$model['type']."' data-url='".Url::to(['delete/restore'])."' data-id = '".$model['did']."' >
                                        <i class = 'fa fa-repeat '></i></a>";
                                  },
                             
                        ]
                    ],
                    ],

            ]); ?>
          <?php Pjax::end(); ?>
        
    </div> 
</div>    
 <?php
$script =<<<JS
    // for ckeditor
    $(document).on('click','.restore',function(){
        var url = $(this).data('url');
        var type = $(this).data('type');
        var id = $(this).data('id');
        
         if(id != ""){
            if (confirm("Are you sure you want to restore")) 
            {
            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                data: {
                     type: type,
                     id:id,                 
                 },
                success: function (data) {
                toaster(data);
                $.pjax({container: '#pjax-grid-view'})
                }
             });       
            }
        }
        else
        {
            $.toaster({ priority : 'error', message : "Please select currency"});
        }
        
       });

    $(document).on('click','.remove',function(){
        console.log($(this).data('url'));
     var checked = []
     $("input[name='selection[]']:checked").each(function ()
            {
                checked.push($(this).val());
            });
         if(checked != ""){
            if (confirm("Are you sure you want to delete Item")) 
            {
            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                data: {
                     checked: checked ,                 
                 },
                success: function (data) {
                toaster(data);
                $.pjax({container: '#pjax-grid-view'})
                }
             });       
            }
        }
        else
        {
            $.toaster({ priority : 'error', message : "Please select currency"});
        }
        
       });
JS;
$this->registerJs($script);
?>
  




