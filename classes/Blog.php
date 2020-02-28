<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Blog{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function selectAllBlogPost(){
			$query = "SELECT * FROM tbl_blog ORDER BY id DESC";
			$getData = $this->db->select($query);
			return $getData;
		}

		public function getBlogPostById($postid){
			$query = "SELECT * FROM tbl_blog WHERE id = '$postid' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateBlogPost($data, $file, $id){
			$title = $this->fm->validation($data['title']);
			$body = $this->fm->validation($data['body']);
			$author = $this->fm->validation($data['author']);

			$title = mysqli_real_escape_string($this->db->link, $title);
			$body = mysqli_real_escape_string($this->db->link, $body);
			$author = mysqli_real_escape_string($this->db->link, $author);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
		  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "blog-images/".$unique_image;

		  	if ($title == "" || $body == "" || $author == "") {
		  		$msg = "<div class='alert alert-danger'>All fields must be filled.</div>";
				return $msg;
			} else {
		  		if (!empty($file_name)) {
				  	if ($file_size > 3048567) {
				  		echo "<span class='error'>Image Size should be less than 3MB</span>";
				  	} elseif (in_array($file_ext, $permited) === false) {
				  		echo "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
					} else {
				  		$imgDelete = "SELECT * FROM tbl_blog WHERE id = '$id'";
						$deleteImg = $this->db->delete($imgDelete);
						while($result = $deleteImg->fetch_assoc()){
							$dellink = $result['image'];
							unlink($dellink);
						}
						move_uploaded_file($file_temp, $uploaded_image);				  		
				  		$query = "UPDATE tbl_blog
				  					SET
				  					title 		= '$title',
				  					author		= '$author',
				  					body 		= '$body',
				  					image 		= '$uploaded_image'
				  					WHERE id = '$id'";
				  		$updated_row = $this->db->update($query);
				  		if ($updated_row){
							$msg = "<div class='alert alert-danger'>Post Updated Successfully!</div>";
							return $msg;
						}
						else {
							$msg = "<div class='alert alert-danger'>Post Not Updated!</div>";
							return $msg;
						}
					}
				} else {				  		
			  		$query = "UPDATE tbl_blog
			  					SET
			  					title 		= '$title',
			  					author		= '$author',
			  					body 		= '$body'
			  					WHERE id = '$id'";

			  		$updated_row = $this->db->update($query);

					if ($updated_row){
						$msg = "<div class='alert alert-success'>Post Updated Successfully!</div>";
						return $msg;
					}
					else {
						$msg = "<div class='alert alert-danger'>Post Not Updated!</div>";
						return $msg;
					}
				}
			}
		}

		public function deletePostById($id){
			$query = "SELECT * FROM tbl_blog WHERE id = '$id'";
			$getData = $this->db->select($query);
			if ($getData) {
				while ($delImg = $getData->fetch_assoc()) {
					$deleteLink = $delImg['image'];
					unlink($deleteLink);
				}
			}

			$delquery = "DELETE FROM tbl_blog WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
				$msg = "<div class='alert alert-success'>Post Deleted Successfully!</div>";
					return $msg;
			}
			else {
				$msg = "<div class='alert alert-danger'>Post Not Deleted!</div>";
				return $msg;
			}
		}

		public function addNewBlogPost($data, $file){
			$title = $this->fm->validation($data['title']);
			$author = $this->fm->validation($data['author']);
			$body = $this->fm->validation($data['body']);

			$title = mysqli_real_escape_string($this->db->link, $title);
			$author = mysqli_real_escape_string($this->db->link, $author);
			$body = mysqli_real_escape_string($this->db->link, $body);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
		  	$file_name = $file['image']['name'];
		  	$file_size = $file['image']['size'];
		  	$file_temp = $file['image']['tmp_name'];

		  	$div = explode('.', $file_name);
		  	$file_ext = strtolower(end($div));
		  	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		  	$uploaded_image = "blog-images/".$unique_image;

		  	if ($title == "" || $author == "" || $body == "" || $file_name == "") {
		  		$msg = "<div class='alert alert-danger'>Field must not be empty!</div>";
		  		return $msg;
			
			} elseif ($file_size > 3048567) {
		  		echo "<div class='alert alert-danger'>Image Size should be less than 3MB</div>";
		  	
		  	} elseif (in_array($file_ext, $permited) === false) {
		  		echo "<div class='alert alert-danger'>You can upload only:-".implode(', ',$permited)."</div>";
		  	
		  	} else {
		  		move_uploaded_file($file_temp, $uploaded_image);
		      	$query = "INSERT INTO tbl_blog (title, author, body, image) VALUES ('$title', '$author', '$body', '$uploaded_image')";
		      	$result = $this->db->insert($query);
		  		if ($result) {
		  			$msg = "<div class='alert alert-success'>New Post Inserted Successfully.</div>";
		  			return $msg;
		  		} else {
		  			$msg = "<div class='alert alert-danger'>Post Not Inserted!</div>";
		  			return $msg;
		  		}
		  	}
		}

		public function selectBlogPostWithPagination($start, $page){
			$query = "SELECT * FROM tbl_blog ORDER BY id DESC LIMIT $start, $page";
			$result = $this->db->select($query);
			return $result;
		}

		public function pagination(){
			$query = "SELECT * FROM tbl_blog";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateNumberOfViews($new_views, $id){
			$query = "UPDATE tbl_blog SET views='$new_views' WHERE id='$id' LIMIT 1";
            $result = $this->db->update($query);
		}
	}
?>