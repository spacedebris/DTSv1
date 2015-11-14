<?php
class dbfun
{	

	private $db;
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
//#############################################################################################################
	public function login($email, $password)
	{
		$hashed = $this->get_user_hash($email);
		try
		{
			if(password_verify($password,$hashed) == 1){
				$_SESSION['loggedin'] = true;
				$_SESSION['key'] = $email;
				header("location: home.php");
				return true;
			}
            else {
                echo "<div class='alert alert-danger' role='alert' style='text-align:center'>
                <strong>Twoje świadczenia nie są poprawne, bądź nie jesteś zarejestrowany<br/></strong>
                <a href='forgotten_password.php'><strong>Odzyskaj hasło</strong></a><br/><a href='login.php'>
                <strong>Zaloguj jeszcze raz</strong></a></div>";
                session_destroy();
            }
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function logout(){
		session_destroy();
	}
//#############################################################################################################
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}
//#############################################################################################################
	private function get_user_hash($email){	

		try {
			$stmt = $this->db->prepare('SELECT password FROM users WHERE email = :email'); //add active
			$stmt->execute(array('email' => $email));
			
			$row = $stmt->fetch();
			return $row['password'];

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
//#############################################################################################################
	public function forgotten_password($email){
		$length = 10;
        $randomString = substr(str_shuffle(md5(time())),0,$length);
        $encrypted = password_hash($randomString, PASSWORD_DEFAULT);

		try
		{
			$stmt = $this->db->prepare("SELECT email FROM users WHERE email = :email");
        	$stmt->bindParam(':email', $email);
        	$stmt->execute();

	        if($stmt->rowCount() > 0)
	        {
	            $sql = "UPDATE users 
	            SET password=?
	            WHERE email=?";
	        	$query = $this->db->prepare($sql);
	        	$query->execute(array($encrypted,$email));

	        	echo "<div class='alert alert-success' role='alert' style='text-align:center'><strong>Twoje nowe hasło zostanie wysłane na adres email podany w formularzu.</strong><br/><a href='login.php'><strong>Zaloguj</strong></a></div>";
	                        
	        	$to = $email;

	        	$subject = 'Odzyskiwanie hasła DTS';

	        	$headers = "From: kozlowskimarkamil@gmail.com\r\n";
	        	$headers .= "Reply-To: kozlowskimarkamil@gmail.com\r\n";
	                        
	        	$headers .= "Content-Type: text/html; charset=utf-8\r\n";

	        	$message = '<html><body>';
	        	$message .= '<h1>Twoje hasło to:</h1><br/><br/>';
	        	$message .= $randomString;
	        	$message .= '<br/><br/>Powodzenia';
	        	$message .= '</body></html>';


	        	mail($to, $subject, $message, $headers);
	        } 
	        else
	        {
	            echo "<div class='alert alert-danger' role='alert' style='text-align:center'>
	            <strong>Twój adres email nie jest zarejestrowany w bazie!</strong><br/>
	            <a href='register.php'><strong>Zarejestruj się?</strong></a><br/><a href='forgotten_password.php'>
	            <strong>Jeszcze raz?</strong></a></div>";
	        }		
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function register($email)
	{
		try
		{
			$hashedpassword = password_hash($_POST['password2'], PASSWORD_DEFAULT);

            $stmt= $this->db->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                echo "<div class='alert alert-danger' role='alert' style='text-align:center'><strong>Podany adres email już istnieje w bazie!</strong>
                <a href='register.php'><strong>Zarejestruj się ponownie używając innego adresu email.</strong></a>
                <strong>Zapomniałeś hasło ?</strong><a href='forgotten_password.php'><strong> Wygeneruj nowe hasło.</strong>
                </div>";
            }
            else 
            {     
            	$stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
                $stmt->bindParam(':firstname', $_POST['firstname']);
                $stmt->bindParam(':lastname', $_POST['lastname']);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->bindParam(':password', $hashedpassword);

                if($stmt->execute())
                {
                    echo "<div class='alert alert-success' role='alert' style='text-align:center'><strong>Wiadomość została wysłana na adres podany w formularzu.</strong><br/>
                    <a href='login.php'><strong>Zaloguj</strong></a></div>";
                        
            		$to = $email;
            		$subject = 'Witaj w systemie DTS';
            		$headers = "From: kozlowskimarekamil@gmail.com\r\n";
                    $headers .= "Reply-To: kozlowskimarekamil@gmail.com\r\n";
                    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
                    $message = '<html><body>';
                    $message .= '<h3>Witaj w systemie DTS</h3><br/>Twoje dane do logowania to:<br/>Nazwa uzytkownika: ';
                    $message .= $email;
                    $message .='<br/>Haslo: ';
                    $message .= $hashedpassword;//+link do login.php
                    $message .= '<br/><br/>Powodzenia!!';
                    $message .= '</body></html>';
                    mail($to, $subject, $message, $headers);
                }   
            } 			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function changePassword($email, $password)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT id FROM users WHERE email= :email AND password= :password");
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
        	$stmt->execute();

        	$rows = $stmt->fetch(PDO::FETCH_NUM);
        	unset($stmt);
			if (is_array($rows))
			{
				$id = $rows[0];
            	$password = md5($_POST['confirmpassword']);

            	$stmt = $this->db->prepare("UPDATE users SET password= :password WHERE id= :id");
            	$stmt->bindParam(':id', $id);
           		$stmt->bindParam(':password', $password);
            	$stmt->execute();
            	echo "<div class='alert alert-danger' role='alert' style='text-algin:center'>
            	    <strong>Twoje hasło zostało zmienione</strong>.</div>";
        	}
        	else
        	{
            	echo "<div class='alert alert-danger' role='alert' style='text-algin:center'>
                	<strong>Dotychczasowe hasło nie jest poprawne</strong><a href='settings.php'><br /><strong>Jeszcze raz</strong></a></div>";
        	}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function isAdmin($email)
	{
		$isadmin = 1;
		$stmt = $this->db->prepare("SELECT id FROM users WHERE email= :email AND isadmin= :isadmin");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':isadmin', $isadmin);
        $stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_NUM);
		if(is_array($rows))
		{
			return 1;
		}
		else
			return 0;
	}
//#############################################################################################################
	public function showTableUsers()
	{
		$stmt = $this->db->prepare("SELECT * FROM users");
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
		echo '<div class="form-group col-sm-12">';
			echo '<tr>';
            echo '<td>'. $row['id'] .'</td>';
            echo '<td>'. $row['firstname'] . ' ' . $row['lastname'] .'</td>';
            echo '<td>'. $row['email'] .'</td>';
            echo '<td>'. $row['isadmin'] .'</td>';
            echo '<td>
                    <a class="edit_user btn btn-xs btn-info" href="#edit_user" data-toggle="modal" data-id="'.$row['id'].'">Edytuj</a>
                    <a class="delete_user btn btn-xs btn-danger" href="#delete_user" data-toggle="modal" data-id="'.$row['id'].'">Usuń</a>
                    <a class="add_user btn btn-xs btn-primary" href="php/crud/add_user.php?id='. $row['id'] . '">Dodaj</a>
                 </td>';
        	echo '</tr>';
        echo '</div>';
		}
	}

// OLD ONE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	public function create($fname,$lname,$email,$contact)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no) VALUES(:fname, :lname, :email, :contact)");
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":contact",$contact);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$fname,$lname,$email,$contact)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE tbl_users SET first_name=:fname, 
		                                               last_name=:lname, 
													   email_id=:email, 
													   contact_no=:contact
													WHERE id=:id ");
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":contact",$contact);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['first_name']); ?></td>
                <td><?php print($row['last_name']); ?></td>
                <td><?php print($row['email_id']); ?></td>
                <td><?php print($row['contact_no']); ?></td>
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
