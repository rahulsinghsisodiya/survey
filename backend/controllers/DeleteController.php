<?php

namespace backend\controllers;

use Yii;
use backend\models\Currency;
use backend\models\Customer;
use backend\models\CustomerGroup;
use backend\models\CustomerGroupAssign;
use backend\models\ProductGroup;
use backend\models\Campaign;
use backend\models\ProductCategory;
use backend\models\DeleteSearch;
use backend\models\Supplier;
use backend\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * CurrencyController implements the CRUD actions for Currency model.
 */
class DeleteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Currency models.
     * @return mixed
     */
    public function actionIndex()
    { 
        $searchModel = new DeleteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore()
    {
        if (Yii::$app->request->isAjax) {
            $return = '';
            $data = Yii::$app->request->post();
            
            if(!empty($data))
            {
            $type = $data['type'];
            $id   = $data['id'];
                if (!empty($id)) 
                {
                    if($type == 'Customer')
                    {   $Model = new Customer();
                        $model =  $Model->find()->where(['c_id'=> $id])->one();
                        $model->c_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    if($type == 'Customer Group')
                    {   $Model = new CustomerGroup();
                        $model =  $Model->find()->where(['cg_id'=> $id])->one();
                        $model->cg_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);

                        $Assign = new CustomerGroupAssign();
                        $Assign->updateAll(['status' => '1'], ['customer_group_id' => $id]);    
                    }
                    if($type == 'Currency')
                    {   $Model = new Currency();
                        $model =  $Model->find()->where(['c_id'=> $id])->one();
                        $model->c_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    if($type == 'Product Group')
                    {   $Model = new ProductGroup();
                        $model =  $Model->find()->where(['pg_id'=> $id])->one();
                        $model->pg_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    if($type == 'Product Category')
                    {   $Model = new ProductCategory();
                        $model =  $Model->find()->where(['pc_id'=> $id])->one();
                        $model->pc_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    if($type == 'Suppliers')
                    {   $Model = new Supplier();
                        $model =  $Model->find()->where(['s_id'=> $id])->one();
                        $model->s_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    if($type == 'Campaign')
                    {   $Model = new Campaign();
                        $model =  $Model->find()->where(['id'=> $id])->one();
                        $model->delete_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                   if($type == 'Product')
                    {   $Model = new Product();
                        $model =  $Model->find()->where(['p_id'=> $id])->one();
                        $model->delete_status = 1;
                        $model->deleted_at = '';
                        $model->update(false);    
                    }
                    
                 
                    $return = ['message' =>"Restore Successful",'type' => 'success'];
                } 
            }
            else
            {
                $return = ['message' =>"Please select item",'type' => 'error'];
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $return;
        }  

    }
  
  public function actionRemove()
    {
        if (Yii::$app->request->isAjax){

            $return = '';
            $data = Yii::$app->request->post();

            if(!empty($data))
            {
            $selected = $data['checked'];
                if (!empty($selected)) 
                {
                    foreach ($selected as $key => $value)
                     {
                      
                        $arr = Array();
                        $checkId = $value;
                        $arr = explode('-', $checkId);
                        $id = $arr[0];
                        $type = $arr[1];

                        if($type == 'Customer')
                        {   $Model = new Customer();
                            $model =  $Model->find()->where(['c_id'=> $id])->one();
                            $model->delete();  
                            \Yii::$app->db->createCommand()->delete('customer_group_assign', ['customer_id' => $id])->execute();  
                        }
                        if($type == 'Customer Group')
                        {   $Model = new CustomerGroup();
                            $model =  $Model->find()->where(['cg_id'=> $id])->one();
                            $model->delete(); 

                            $Assign = new CustomerGroupAssign();
                            $Assign->deleteAll(['customer_group_id' => $id]);   
                        }
                        if($type == 'Currency')
                        {   $Model = new Currency();
                            $model =  $Model->find()->where(['c_id'=> $id])->one();
                            $model->delete();
                            \Yii::$app->db->createCommand()->delete('currency_rate', ['currency_id' => $id])->execute();   
                        }
                        if($type == 'Product Group')
                        {   $Model = new ProductGroup();
                            $model =  $Model->find()->where(['pg_id'=> $id])->one();
                            $model->delete();    
                        }
                        if($type == 'Product Category')
                        {   $Model = new ProductCategory();
                            $model =  $Model->find()->where(['pc_id'=> $id])->one();
                            $model->delete();    
                        }
                        if($type == 'Suppliers')
                        {   $Model = new Supplier();
                            $model =  $Model->find()->where(['s_id'=> $id])->one();
                            $model->delete();    
                        }
                        if($type == 'Campaign')
                        {   $Model = new Campaign();
                            $model =  $Model->find()->where(['id'=> $id])->one();
                            $model->delete();
                                
                        }
                        if($type == 'Product')
                        {   $Model = new Product();
                            $model =  $Model->find()->where(['p_id'=> $id])->one();
                            $model->delete();

                            \Yii::$app->db->createCommand()->delete('product_category_assign', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_competitor', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_group_assign', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_kit_data', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_media', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_price', ['product_id' => $id])->execute();
                            \Yii::$app->db->createCommand()->delete('product_supplier', ['product_id' => $id])->execute();
                        }
                        
                    }
                    $return = ['message' =>"Delete Successful",'type' => 'success'];
                } 
            }
            else
            {
                $return = ['message' =>"Please select currency",'type' => 'error'];
            }
             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $return;
        }
    }

   
   
   

    
}
