<?php

namespace common\components;
use Yii;
use yii\base\Component ;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\behaviors\TimestampBehavior;
use common\models\UserProfile;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use backend\models\Supplier;
use backend\models\ProductGroup;
use backend\models\SupplierSearch;
use backend\models\CompetitorType;
use backend\models\Currency;
use backend\models\Product;
use backend\models\ProductCategory;
use common\models\User;
use yii\helpers\ArrayHelper;



use Imagine\Gd;


/**
*
*/
class CommonFunction extends Component {

   /**
    * CommonFunction::getCustomConfigItem
    * This function will set custom page size to retrive records
    * @param $element
    * @param $sub_element
    * @return price, title and image url
    */

	public  function getCustomConfigItem($element,$sub_element=""){
	    $config_element=Yii::$app->params[$element];
	    return empty($sub_element) ? $config_element : $config_element[$sub_element];
	}

    /**
    * CommonFunction::keyBasedDecrypt
    * Description : Decrypt value on Key base stroed in Params Config
    * @param string $value
    * @return string Decryprted value
    **/

    public static function keyBasedDecrypt($value){
        $securityKey = Yii::$app->params['SecuritySaltKey'];
        return Yii::$app->security->validateData(base64_decode($value), $securityKey);
    }

    /**
    * CommonFunction::keyBasedEncrypt
    * Description : Encrypt value on Key base stroed in Params Config
    * @param string $value
    * @return string Encryprted value
    **/

    public static function keyBasedEncrypt($value){
        $securityKey = Yii::$app->params['SecuritySaltKey'];
        return base64_encode(Yii::$app->security->hashData($value, $securityKey));
    }

    /**
    * CommonFunction::generateRandomString
    * Description : This will be use for generate random password string
    * @param string $length requrie length of string.
    * @return string $randomString
    **/

    public static function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /*calculate time different between two dates*/
    public static function timeAgo($originTime){
       $timestamp = strtotime($originTime);

       $strTime = array("second", "minute", "hour", "day", "month", "year");
       $length = array("60","60","24","30","12","10");
       /*$currentTime = time();*/
       $expression = new \yii\db\Expression('NOW()');
       $now = (new \yii\db\Query)->select($expression)->scalar();
       $currentTime = strtotime($now);

       if($currentTime >= $timestamp) {
            $diff     = $currentTime- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            $singular = "";
            if($diff > 1){
                $singular = "s";
            }
            return $diff . " " . $strTime[$i] . $singular." ago ";
       }

    }

    /**
    * This function will
    * @param
    * @return
    */
    public static function sparkpostAPI($productUrl = '') {
        if($productUrl) {

            //echo "Signed URL: \"".$request_url."\"";echo "<br/><br/>";
            try {
                $ch = curl_init();
                //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/xml',
                    'charset:utf-8'
                ));
                $result = curl_exec($ch);

                curl_close($ch);
                if($result) {
                    $xml=simplexml_load_string($result);  //or die('Cannot create object');
                } else {
                    return ['status' => 400, 'message'=>'Cannot create object'];
                }
            } catch(Exception $e) {
                return ['status' => 400];
            }

        	return false;
    	}
    }


public static function getSupplierList()
    {
        $model = new Supplier();

        $supplier = Supplier::find()->where(['s_status' => '1'])->all();
    
        $listsupplier = ArrayHelper::map($supplier,'s_id','s_name'); 
        return $listsupplier;  
    }
public static function getSupplierAccountList()
    {
        $model = new Supplier();

        $supplier = Supplier::find()->where(['s_status' => '1'])->all();
    
        $listsupplier = ArrayHelper::map($supplier,'s_id','s_account_number'); 
        return $listsupplier;  
    }
public static function getSupplierNameList()
    {
        $model = new Supplier();

        $supplier = Supplier::find()->where(['s_status' => '1'])->all();
    
        $listsupplier = ArrayHelper::map($supplier,'s_id','s_name'); 
        return $listsupplier;  
    }
public static function getProductGroupList()
    {
        $model = new ProductGroup();

        $productGroup = ProductGroup::find()->where(['pg_status' => '1'])->all();
    
        $listProductGroup = ArrayHelper::map($productGroup,'pg_id','pg_name'); 
        return $listProductGroup;  
    }
public static function getProductCategoryList()
    {
        $model = new ProductCategory();

        $productCategory = ProductCategory::find()->where(['pc_status' => '1'])->all();
    
        $listProductCategory = ArrayHelper::map($productCategory,'pc_id','pc_name'); 
   
        return $listProductCategory;  
    }
public static function getCompetitorList()
    {
        $model = new CompetitorType();

        $competitor = CompetitorType::find()->all();
    
        $listCompetitor = ArrayHelper::map($competitor,'id','title'); 
        return $listCompetitor;  
    }
public static function getCurrencyList()
    {
        $model = new Currency();

        $currency = Currency::find()->where(['c_status' => '1'])->all();
    
        $listCurrency = ArrayHelper::map($currency,'c_id','c_title'); 
        return $listCurrency;  
    }
public static function getProductCodeList()
    {
        $model = new Product();

        $product = Product::find()->all();
    
        $listproductCode = ArrayHelper::map($product,'p_id','p_code'); 
        return $listproductCode;  
    }

public static function getProductList()
    {
        $model = new Product();
        $product = Product::find()->all();
        $listproduct = ArrayHelper::map($product,'p_id','p_name'); 
        return $listproduct;  
    }
public static function getUsername($id = null)
    {
        $model = new User();
        $return = '';
        $user = $model->find()->where(['id' => $id])->one();
        if(!empty($user))
        {
           $return = $user->username; 
        }
        
        return $return;  
    }

public static  function uploadFile($file_element,$file_element_name,$extra=array()){
    $return=false;

    // p(Yii::$app->security->generateRandomString(10));
    if(!empty($file_element) && !empty($file_element_name)){
        //create Instance
        if(empty($extra['multiple'])){
            $uploaded_file = UploadedFile::getInstance($file_element, $file_element_name);
        }else{
            $uploaded_file = UploadedFile::getInstances($file_element, $file_element_name);    
        }
       
        if(!empty($uploaded_file)){
            //Get File Configs
            $file_config = CommonFunction::getCustomConfigItem("upload_config",$file_element_name);
            
            $upload_file_folder = "uploads/".(empty($file_config['upload_folder']) ? "other" : $file_config['upload_folder'])."/"; 
    
            if(!is_array($uploaded_file))
            {
                $uploaded_file=[$uploaded_file];
            }
            foreach($uploaded_file as $file)
            {
                $file_name=((empty($file_config['file_name_element']) || empty($file_element->$file_config['file_name_element'])) ? Yii::$app->security->generateRandomString(5).strtotime(date("YmdHis")) : $file_element->$file_config['file_name_element']).".".$file->extension;

                //Create Folder
                FileHelper::createDirectory($upload_file_folder);

                //Upload File

                if($file->saveAs($upload_file_folder.$file_name) && array_key_exists("current_file",$extra) && is_file($upload_file_folder.$extra['current_file']) && $extra['current_file'] != $file_name)
                {
                    unlink($upload_file_folder.$extra['current_file']);
                }

                if(array_key_exists('resize_arr', $file_config) && !empty($file_config['resize_arr'])){
                    foreach($file_config['resize_arr'] as $resize_element){
                        $resized_file_folder=$upload_file_folder."/".$resize_element['folder_name']."/";
                        $resized_file=$resized_file_folder.$file_name;

                        //Create Folder
                        FileHelper::createDirectory($resized_file_folder);

                        Image::getImagine()->open($upload_file_folder.$file_name)->thumbnail(new Box($resize_element['width'], $resize_element['height']))->save($resized_file, ['quality' => 90]);

                        if(array_key_exists("current_file",$extra) && is_file($resized_file_folder.$extra['current_file']) && $extra['current_file'] != $file_name)
                        {
                            unlink($resized_file_folder.$extra['current_file']);
                        }
                    }
                }

                $return[]=$file_name;
            }
            
        }
        if(empty($extra['multiple'])){
            $return=$return[0];
        }
        
    }
    // p("hello");
    return $return;
}
public function getUploadedFile($file_name,$file_config,$file_type="original",$default=false) {
        $return =false;
        if(!empty($file_name) && !empty($file_config)){
            $file_config=CommonFunction::getCustomConfigItem("upload_config",$file_config);
            $file_folder=(empty($file_config['upload_folder']) ? "other" : $file_config['upload_folder'])."/";
            if($file_type!="original" && !empty($file_config['resize_arr']) && array_key_exists($file_type, $file_config['resize_arr'])){
                $file_folder.=$file_config['resize_arr'][$file_type]['folder_name']."/";
            }
            if(is_file(Yii::getAlias('@uploads')."/".$file_folder.$file_name)){
                $return="@web/uploads/".$file_folder.$file_name;
            }
        }
        $default_image=$file_type=="original" ? "default.png" : $file_type."_default.png";
        $return = empty($return) && !empty($default) ? '@web/images/default/'.$default_image : $return;
        return $return;         
    }

public function removeUploadedFiles($file_names,$file_config) {
        $return =false;
        if(!is_array($file_names)){
            $file_names=[$file_names];
        }
        if(!empty($file_names) && !empty($file_config)){
            $file_config=getCustomConfigItem("upload_config",$file_config);
            $file_folder=Yii::getAlias('@uploads')."/".(empty($file_config['upload_folder']) ? "other" : $file_config['upload_folder'])."/";
            foreach($file_names as $file_name){
                if(is_file($file_folder.$file_name)){
                    unlink($file_folder.$file_name);               
                }
                if(!empty($file_config['resize_arr'])) {
                    foreach($file_config['resize_arr'] as $resize_element){
                        $resized_file_folder=$file_folder."/".$resize_element['folder_name']."/";
                        if(is_file($resized_file_folder.$file_name)){
                            unlink($resized_file_folder.$file_name);               
                        }
                        
                    }
                }
            }
            return true;
        }
        return $return;         
    }
}
