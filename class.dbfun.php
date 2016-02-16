<?php
class dbfun
{	

	private $db;
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
//#############################################################################################################
	public function login($email, $password){
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
	                <strong>Twoje świadczenia nie są poprawne, nie jesteś zarejestrowany, bądź konto nie jest aktywne.<br/></strong>
	                <a href='forgotten_password.php'><strong>Odzyskaj hasło</strong></a><br/>
	                <a href='login.php'><strong>Zaloguj jeszcze raz</strong></a><br/>
	                <a href='index.php'><strong>Zarejestruj</strong></a></div>";
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
			$stmt = $this->db->prepare('SELECT password FROM users WHERE email = :email AND verification="Yes" '); //add active
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
	public function register($email){
		
			$hashedpassword = password_hash($_POST['password2'], PASSWORD_DEFAULT);
			$verification = md5(uniqid(rand(),true));

            $stmt= $this->db->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                echo "<div class='alert alert-danger' role='alert' style='text-align:center'><strong>Podany adres email już istnieje w bazie!</strong>
                <a href='index.php'><strong>Zarejestruj się ponownie używając innego adresu email.</strong></a>
                <strong>Zapomniałeś hasło ?</strong><a href='forgotten_password.php'><strong> Wygeneruj nowe hasło.</strong>
                </div>";
            }
            else 
            {     
            	$stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, password, verification) VALUES (:firstname, :lastname, :email, :password, :verification)");
                $stmt->bindParam(':firstname', $_POST['firstname']);
                $stmt->bindParam(':lastname', $_POST['lastname']);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->bindParam(':password', $hashedpassword);
                $stmt->bindParam(':verification', $verification);

                if($stmt->execute())
                { 
            		$to = $email;
            		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$subject = "DTS -> Potwierdzenie rejestracji";
					$body = "Dzięki za rejestrację w DTS.\n\n Aby aktywować konto, przejdź w poniższy adres:\n\n ".DIR."activate.php?x=$email&y=$verification\n\n Powodzenia ! \n\n";
					$additionalheaders = "From: <".SITEEMAIL.">\r\n";
					$additionalheaders .= "Reply-To: ".SITEEMAIL."";
					mail($to, $subject, $body, $additionalheaders, $headers);

                    header('Location: index.php?action=joined');
                    exit;
                }   
            } 			
	}
//#############################################################################################################
	public function changePassword($email, $password, $newpassword){
		$hashed = $this->get_user_hash($email);
		try
		{	
			if(password_verify($password, $hashed) == 1){
            	$stmt = $this->db->prepare("UPDATE users SET password=? WHERE email=?");
            	$stmt->execute(array($newpassword, $email));
            	echo "<div class='alert alert-danger' role='alert' style='text-algin:center'>
            	    <strong>Twoje hasło zostało zmienione</strong>.</div>";
        	}
        	else
        	{
            	echo "<div class='alert alert-danger' role='alert' style='text-algin:center'>
                	<strong>Dotychczasowe hasło nie jest poprawne</strong><a href='profile.php'><br /><strong>Jeszcze raz</strong></a></div>";
        	}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function changeEmail($email){
		try
		{
			$stmt = $this->db->prepare("UPDATE users SET email=? WHERE email=?");
			$stmt->execute(array($email, $_SESSION['key']));
			$_SESSION['key'] = $email;
			header('Location: profile.php');
			// mejl wysylajacy info
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function get_id($email){
		try{
			$stmt = $this->db->prepare("SELECT id FROM users WHERE email= :email");
			$stmt->bindParam(':email', $email);
			$stmt->execute();

			$row = $stmt->fetch();
			return $row['id'];
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
		}
	}
//#############################################################################################################
	public function isAdmin($email){	
		$isadmin = 1;
		$stmt = $this->db->prepare("SELECT id FROM users WHERE email=? AND isadmin=?");
        $stmt->execute(array($email, $isadmin));
		$rows = $stmt->fetch(PDO::FETCH_NUM);
		if(is_array($rows))
		{
			return 1;
		}
		else
			return 0;
	}
//#############################################################################################################
	public function getUserDetails($email){
		try{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email");
			$stmt->bindParam('email', $email);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);	
			
			return $result;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function getUserDetailsbyID($id){
		try{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
			$stmt->execute(array(":id"=>$id));
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
	public function addUser($firstname, $lastname, $email, $password, $isadmin){
		$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
		$verification = "YES";

		try{
			$stmt = $this->db->prepare("INSERT INTO users 
				(firstname, lastname, email, password, verification, isadmin) VALUES 
				(:firstname, :lastname, :email, :password, :verification, :isadmin) ");
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam('password', $hashedpassword);
			$stmt->bindParam('verification', $verification);
			$stmt->bindParam('isadmin', $isadmin);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}

	}
//#############################################################################################################
	public function deleteUser($id){
		$stmt = $this->db->prepare("DELETE FROM users WHERE id=:id");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		return true;
	}
//#############################################################################################################
	public function updateUser($id, $firstname, $lastname, $email, $isadmin){
		try{
			$stmt=$this->db->prepare("UPDATE users SET firstname=:firstname, 
		                                               lastname=:lastname, 
													   email=:email,
													   isadmin=:isadmin
													WHERE id=:id ");
			$stmt->bindValue(':firstname',$firstname);
			$stmt->bindValue(':lastname',$lastname);
			$stmt->bindValue(':email',$email);
			$stmt->bindValue(':isadmin',$isadmin);
			$stmt->bindValue(':id',$id);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
//#############################################################################################################
	public function usersview($query){
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['firstname']); ?></td>
                <td><?php print($row['lastname']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['isadmin']) ?></td>
                <td align="center">
                <a href="edit_user.php?edit_id=<?php print($row['id']); ?>"><i class="icon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete_user.php?delete_id=<?php print($row['id']); ?>"><i class="icon-trash"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Brak danych</td>
            </tr>
            <?php
		}
	}
//GROUPS
//#############################################################################################################
	public function groupsview($query){
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id_group']); ?></td>
                <td><?php print($row['name']); ?></td>
                <td><?php print($row['tasks_qty']); ?></td>
                <td><?php print($row['created']); ?></td>
                <td><?php print($row['createdby']) ?></td>
                <td align="center">
                <a href="edit_group.php?edit_id=<?php print($row['id_group']); ?>"><i class="icon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete_group.php?delete_id=<?php print($row['id_group']); ?>"><i class="icon-trash"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Brak danych</td>
            </tr>
            <?php
		}
	}
//#############################################################################################################
	public function addGroup($name){
		//temporary
		$tasks_qty = 0;
		$created = date("Y-m-d H:i:s");
		try{
			$stmt = $this->db->prepare("INSERT INTO groups 
				(name, tasks_qty, created, createdby) VALUES 
				(:name, :tasks_qty, :created, :createdby) ");
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':tasks_qty', $tasks_qty);
			$stmt->bindParam(':created', $created);
			$stmt->bindParam(':createdby', $_SESSION['key']);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}

	}
//#############################################################################################################
	public function deleteGroup($id_group){
		$stmt = $this->db->prepare("DELETE FROM groups WHERE id_group=:id_group");
		$stmt->bindParam(":id_group", $id_group);
		$stmt->execute();
		return true;
	}
//#############################################################################################################
	public function updateGroup($id_group, $name){
		try{
			$stmt=$this->db->prepare("UPDATE groups SET name=:name
													WHERE id_group=:id_group");
			$stmt->bindValue(':name',$name, PDO::PARAM_STR);
			$stmt->bindValue(':id_group',$id_group);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
//#############################################################################################################
	public function getGroupDetailsbyID($id_group){
		try{
			$stmt = $this->db->prepare("SELECT * FROM groups WHERE id_group=:id_group");
			$stmt->execute(array(":id_group"=>$id_group));
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//TASKS
//#############################################################################################################
	public function tasksview($query){
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['id_task']); ?></td>
	                <td><?php print($row['title']); ?></td>
	                <td><?php print($row['tags']); ?></td>
	                <td><?php print($row['created']); ?></td>
	                <td><?php print($row['createdby']) ?></td>
	                <td align="center">
	                <a href="edit_task.php?edit_id=<?php print($row['id_task']); ?>"><i class="icon-edit"></i></a>
	                </td>
	                <td align="center">
	                <a href="delete_task.php?delete_id=<?php print($row['id_task']); ?>"><i class="icon-trash"></i></a>
	                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Brak danych</td>
            </tr>
            <?php
		}
	}
//#############################################################################################################
	public function addTask($title, $content){
		//temporary
		$tags = "temporary no tags";
		$created = date("Y-m-d H:i:s");
		try{
			$stmt = $this->db->prepare("INSERT INTO tasks 
				(title, content, tags, created, createdby) VALUES 
				(:title, :content, :tags, :created, :createdby)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':content', $content);
			$stmt->bindParam(':tags', $tags);
			$stmt->bindParam(':created', $created);
			$stmt->bindParam(':createdby', $_SESSION['key']);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}

	}
//#############################################################################################################
	public function deleteTask($id_task){
		$stmt = $this->db->prepare("DELETE FROM tasks WHERE id_task=:id_task");
		$stmt->bindParam(":id_task", $id_task);
		$stmt->execute();
		return true;
	}
//#############################################################################################################
	public function updateTask($id_task, $title, $content, $tags){
		try{
			$stmt=$this->db->prepare("UPDATE tasks SET title=:title,
														content=:content,
														tags=:tags
													WHERE id_task=:id_task");
			$stmt->bindValue(':id_task',$id_task);
			$stmt->bindValue(':title',$title);
			$stmt->bindValue(':content',$content);
			$stmt->bindValue(':tags',$tags);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
//#############################################################################################################
	public function getTaskDetailsbyID($id_task){
		try{
			$stmt = $this->db->prepare("SELECT * FROM tasks WHERE id_task=:id_task");
			$stmt->execute(array(":id_task"=>$id_task));
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
//#############################################################################################################
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
//#############################################################################################################
	public function paginglink($query,$records_per_page){
		
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
				echo "<li><a href='".$self."?page_no=1'>Pierwszy</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Poprzedni</a></li>";
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
				echo "<li><a href='".$self."?page_no=".$next."'>Następny</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Ostatni</a></li>";
			}
			?>		 
				</ul>
			<?php
		}
	}
}
