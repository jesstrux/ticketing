<?php 
/**
* A class for uploading File to a server
* Written by Daniel Kindimba
*/

class FileUploader
{
	function __construct($fieldname, $target_dir)
	{
		$this->fieldname = $fieldname;
		$this->target_dir = $target_dir;
	}

	function upload(){
		$error_list = array();

		$target_file = $this->target_dir . basename($_FILES[$this->fieldname]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES[$this->fieldname]["tmp_name"]);
	    
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $error_list[] = "File is not an image.";
	        $uploadOk = 0;
	    }
		
		// Check if file already exists
		if (file_exists($target_file)) {
		    return json_encode([
				"success" => true, 
				"target_file" => basename($_FILES[$this->fieldname]["name"])
			]);
		}

		// Check file size
		if ($_FILES[$this->fieldname]["size"] > 8000000) {
		    $error_list[] = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return json_encode([
				"success" => false,
				"errors" => $error_list
			]);
		}else{
		    if(move_uploaded_file($_FILES[$this->fieldname]["tmp_name"], $target_file)) {
		        return json_encode([
					"success" => true, 
					"target_file" => basename($_FILES[$this->fieldname]["name"])
				]);
		    }else{
		        return json_encode([
					"success" => false, 
					"errors" => ["Failed to move uploaded file"]
				]);
		    }
		}
	}
}
?>
