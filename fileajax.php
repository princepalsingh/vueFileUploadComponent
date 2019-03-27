<?php 
	print_r($_FILES);
	print_r($_POST);
	exit;
	function moveUploadedFiles($files,$key,$folder = '../uploads/'){

		if ($folder == "") 
		{
			$folder = "../uploads/";
		}

		if(!is_dir($folder))
		{
		  mkdir($folder, 0755);
		}

		$file_arr = array();

	    /* Rename file if already exist */
		$fname = $files['name'][$key];
		$fname = str_replace(" ", "-", $fname);
		$rawBaseName = pathinfo($fname, PATHINFO_FILENAME );
		$extension = pathinfo($fname, PATHINFO_EXTENSION );
		$counter = 0;
		while(file_exists($folder.$fname))
		{
			$fname = $rawBaseName . $counter . '.' . $extension;
			$counter++;
		}
		/* Rename file if already exist */
			
		move_uploaded_file($files['tmp_name'][$key], $folder.$fname);
		$file_arr = array('new_file_name'=>$fname);

	  	return $file_arr;
		
	}

	for ($i=0; $i < sizeof($_FILES['myFile']['name']); $i++) { 
		$result = moveUploadedFiles($_FILES['myFile'],$i,'uploads/');
		echo $result['new_file_name'];
		echo '<br>';
	}

	function base64_to_jpeg($base64_string, $output_file) {
	    // open the output file for writing
	    $ifp = fopen( $output_file, 'wb' ); 

	    // split the string on commas
	    // $data[ 0 ] == "data:image/png;base64"
	    // $data[ 1 ] == <actual base64 string>
	    $data = explode( ',', $base64_string );

	    // we could add validation here with ensuring count( $data ) > 1
	    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

	    // clean up the file resource
	    fclose( $ifp ); 

	    return $output_file; 
	}
?>