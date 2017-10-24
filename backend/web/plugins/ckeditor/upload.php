
<?php
echo ;
exit;
if(isset($_FILES['upload'])){
	$_FILES['upload'];	
	time().uniqid();
	move_uploaded_file(time().$_FILES['upload'], $_SERVER['DOCUMENT_ROOT'].'/ckeditor_st/pulic_image')
}

?>