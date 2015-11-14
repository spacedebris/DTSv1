<?php
if (isset($_POST['delete_user_btn'])){
	$id = strip_tags($_POST['deleted_id']);
	echo $id;
}
?>