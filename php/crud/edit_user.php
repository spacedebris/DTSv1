<?php

if (isset($_POST['edit_user_btn'])) {
$firstname = strip_tags($_POST['firstname']);
$lastname = strip_tags($_POST['lastname']);
$email = strip_tags($_POST['email']);

echo "<span class=\"alert alert-success\" >Your message has been received. Thanks! Here is what you submitted:</span><br><br>";
echo "<stong>Name:</strong> ".$firstname."<br>";	
echo "<stong>Lastname:</strong> ".$lastname."<br>";
echo "<stong>Email:</strong> ".$email."<br>";	


}?>