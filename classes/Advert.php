<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Advert{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAllAdverts(){
			$query = "SELECT * FROM tbl_adverts ORDER BY id DESC LIMIT 3";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAdvertById($id){
			$query = "SELECT * FROM tbl_adverts WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateAdvert($file, $id){
			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
	 	  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "advert-images/".$unique_image;

		  	if (!empty($file_name)) {
		  		if ($file_size > 3048567) {
		  		echo "<div class='alert alert-danger'>Image Size should be less than 3MB</div>";
								  	
		  		} elseif (in_array($file_ext, $permited) === false) {
		  		echo "<div class='alert alert-danger'>You can upload only:- ".implode(', ',$permited)."</div>";
								  	
		  		} else {
		  			$query = "SELECT * FROM tbl_adverts WHERE id = '$id'";
					$result = $this->db->select($query);
					if ($result) {
						while($row = $result->fetch_assoc()){
							$dellink = $row['image'];
							unlink($dellink);
						}
					}
		  			
			  		move_uploaded_file($file_temp, $uploaded_image);
					$ask = "UPDATE tbl_adverts SET 
					image = '$uploaded_image'
					WHERE id = '$id'";

					$updated_row = $this->db->update($ask);

					if ($updated_row) {
			  			$msg = "<div class='alert alert-success'>Advert Updated Successfully.</div>";
			  			return $msg;
					} else {
						$msg = "<div class='alert alert-danger'>Advert Not Updated!</div>";
						return $msg;
					}
		  		}
		  	}			
		}

		public function deleteAdvert($id){
			$getImage = "SELECT * FROM tbl_adverts WHERE id = '$id'";
			$ImgResult = $this->db->select($getImage);
			while($row = $ImgResult->fetch_assoc()){
				$dellink = $row['image'];
				unlink($dellink);
			}

			$query = "DELETE FROM tbl_adverts WHERE id = '$id'";
			$result = $this->db->delete($query);
			
			if ($result) {
				$msg = "<div class='alert alert-success'>Advert Deleted Successfully!</div>";
				return $msg;
			} else {
				$msg = "<div class='alert alert-danger'>Advert Not Deleted!</div>";
				return $msg;
			}
		}

		public function addAdvert($file){
			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
		  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "advert-images/".$unique_image;

		  	if ($file_name == "") {
		  		echo "<div class='alert alert-danger'>Field must not be empty!</div>";

		  	} elseif ($file_size > 3048567) {
		  		echo "<div class='alert alert-danger'>Image Size should be less than 3MB</div>";
		  	
		  	} elseif (in_array($file_ext, $permited) === false) {
		  		echo "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
		  	
		  	} else {
		  		move_uploaded_file($file_temp, $uploaded_image);
		      	$query = "INSERT INTO tbl_adverts (image) VALUES ('$uploaded_image')";
		      	$result = $this->db->insert($query);
		  		if ($query) {
		  			$msg = "<div class='alert alert-success'>Advert Inserted Successfully.</div>";
		  			return $msg;
		  		} else {
		  			$msg = "<div class='alert alert-danger'>Advert Not Inserted!</div>";
		  			return $msg;
		  		}
		  	}
		}
	}
?>