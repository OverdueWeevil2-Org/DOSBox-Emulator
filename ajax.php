error_reporting(0);
$data = $_POST['veri'];
if (isset($data)){
	$dir = 'file/';
	$size_limit = 500000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;
	$extension = explode('/',explode(';',$data)[0])[1];
	if ($extension == '7z' || $extension == 'rar' || $extension == 'zip'){
		$image = file_get_contents($data);
		if (strlen($image) < $size_limit){
			$file_name = $dir."/resim_ismi".rand(9,999).'.'.$extension; //
			$create_file = touch($file_name);
			if ($create_file){
				$create_image = file_put_contents($file_name,$image);
				if ($create_image){
					$result = 'success';
				}else{
					$result = 'error';
				}
			}else{
				$result = 'error message: File NOT Created';
			}
		}else{
			$result = 'error message: Dosya boyutu '.$size_limit.' byte\'dan küçük olmalı';
		}
	}else{
		$result = 'error message: File extension must be rar, zip, 7z!';
	}
}else{
	$result = 'Unknown error!';
}
echo json_encode($result); //json formatında veriyi geri gönder
