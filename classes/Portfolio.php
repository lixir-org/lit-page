<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Portfolio{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAllPortfolio(){
			$query = "SELECT * FROM tbl_folio ORDER BY id DESC LIMIT 6";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPortfolioById($id){
			$query = "SELECT * FROM tbl_folio WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updatePortfolio($file, $data, $id){			
			$title = $this->fm->validation($data['title']);		
			$link = $this->fm->validation($data['link']);

			$title = mysqli_real_escape_string($this->db->link, $title);
			$link = mysqli_real_escape_string($this->db->link, $link);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
	 	  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "portfolio-images/".$unique_image;

		  	if ($title == "" || $link == "") {
		  		$msg = "<div class='alert alert-danger'>All fields must be filled.</div>";
				return $msg;
			} else {
		  		if (!empty($file_name)) {
				  	if ($file_size > 3048567) {
				  		echo "<div class='alert alert-danger'>Image Size should be less than 3MB</div>";
				  	} elseif (in_array($file_ext, $permited) === false) {
				  		echo "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
					} else {
				  		$imgDelete = "SELECT * FROM tbl_folio WHERE id = '$id'";
						$deleteImg = $this->db->delete($imgDelete);
						while($result = $deleteImg->fetch_assoc()){
							$dellink = $result['image'];
							unlink($dellink);
						}
						move_uploaded_file($file_temp, $uploaded_image);				  		
				  		$query = "UPDATE tbl_folio
				  					SET
				  					image 		= '$uploaded_image',
				  					title 		= '$title',
				  					link 		= '$link'
				  					WHERE id = '$id'";
				  		$updated_row = $this->db->update($query);
				  		if ($updated_row){
							$msg = "<div class='alert alert-success'>Portfolio Item Successfully!</div>";
							return $msg;
						}
						else {
							$msg = "<div class='alert alert-danger'>Portfolio Item Not Updated!</div>";
							return $msg;
						}
					}
				} else {				  		
			  		$query = "UPDATE tbl_folio
			  					SET
			  					title 		= '$title',
			  					link 		= '$link'
			  					WHERE id = '$id'";

			  		$updated_row = $this->db->update($query);

					if ($updated_row){
						$msg = "<div class='alert alert-success'>Portfolio Item Successfully!</div>";
						return $msg;
					}
					else {
						$msg = "<div class='alert alert-danger'>Portfolio Item Updated!</div>";
						return $msg;
					}
				}
			}		
		}

		public function deletePortfolio($id){
			$getImage = "SELECT * FROM tbl_folio WHERE id = '$id'";
			$ImgResult = $this->db->select($getImage);
			while($row = $ImgResult->fetch_assoc()){
				$dellink = $row['image'];
				unlink($dellink);
			}

			$query = "DELETE FROM tbl_folio WHERE id = '$id'";
			$result = $this->db->delete($query);
			
			if ($result) {
				$msg = "<div class='alert alert-success'>Portfolio Item Deleted Successfully!</div>";
				return $msg;
			} else {
				$msg = "<div class='alert alert-danger'>Portfolio Item Not Deleted!</div>";
				return $msg;
			}
		}

		public function addPortfolio($file, $data){
			$title = $this->fm->validation($data['title']);		
			$link = $this->fm->validation($data['link']);

			$title = mysqli_real_escape_string($this->db->link, $title);
			$link = mysqli_real_escape_string($this->db->link, $link);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
		  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "portfolio/".$unique_image;

		  	if ($title == "" || $link == "") {
		  		$msg = "<div class='alert alert-danger'>Field must not be empty!</div>";
		  		return $msg;
			
			} elseif ($file_size > 3048567) {
		  		echo "<div class='alert alert-danger'>Image Size should be less than 3MB</div>";
		  	
		  	} elseif (in_array($file_ext, $permited) === false) {
		  		echo "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
		  	
		  	} else {
		  		move_uploaded_file($file_temp, $uploaded_image);
		      	$query = "INSERT INTO tbl_folio (image, title, link) VALUES ('$uploaded_image', '$title', '$link')";
		      	$result = $this->db->insert($query);
		  		if ($result) {
		  			$msg = "<div class='alert alert-danger'>Portfolio Item Inserted Successfully.</div>";
		  			return $msg;
		  		} else {
		  			$msg = "<div class='alert alert-danger'>Portfolio Item Not Inserted!</div>";
		  			return $msg;
		  		}
		  	}
		}
	}
?>