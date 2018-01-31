<?php
$max_filesize = 2048; //KB
$allowed_types = ['image/jpeg', 'image/png'];
$allowed_extensions = ['jpg', 'jpeg', 'png'];

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

if(empty($name) OR empty($email) OR empty($message))
{
	die('Пожалуйста, заполните все поля!');
}
elseif(mb_strlen($name) > 250 OR mb_strlen($email) > 250)
{
	die('Слишком длинное имя или email');
}
elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
{
	die('Введите правильный email');
}
else
{
	header('Location: index.php');

	$image = $_FILES['image'];
	$tmp_name = $image['tmp_name'];
	$original_name = $image['name'];

	$files_amount = count($original_name);

	for($i = 0; $i < $files_amount; $i++)
	{
		if($original_name[$i])
		{
			$dotpos = strripos($original_name[$i], '.');
			$extension = substr($original_name[$i], $dotpos+1);

			if(filesize($tmp_name[$i]) > ($max_filesize * 1024))
			{
				die('Размер загружаемого файла превышает максимально допустимый');
			}
			elseif(!in_array($image['type'][$i], $allowed_types) OR !in_array($extension, $allowed_extensions))
			{
				
				die('Этот файл запрещен к загрузке');
			}
			else
			{
				$dir = 'uploads';
				$subdir = mt_rand(0, 10);
				$path = $dir . '/' . $subdir;
				
				if(!is_dir($path))
					mkdir($path);

				do {
					$fname = random_string(8);
					$filename = $fname . '.' . $extension;
					$is_exists = file_exists($path . '/' . $filename);
				} while($is_exists);

				$result = move_uploaded_file($tmp_name[$i], $path . '/' . $filename);

				if(!$result)
				{
					die('Произошла ошибка');
				}



				do {
				$file_count = 'Файл #' . ($i+1) . ':'; // создаем переменную с номером файла
				$temp_path = __DIR__ . '\\' . $dir . '\\' . $subdir . '\\' . $filename.PHP_EOL; //создаем переменную с путем
				$path_count[] = $file_count . ' ' . $temp_path; // объединяем значение переменных $file_count и $temp_path  
				$exist = file_exists(__DIR__ . $dir . '/' . $subdir . '/' . $filename); //проверка наличия файла
				} while($exist);
			}
		}
	}	
	$paths[] = $path_count; // создание массива с номерами файлов и путями
				foreach($paths as $path) //перебирам массив
					$realpath = implode($path); //объединяем элементы массива в строку
				$fh = fopen('requests.txt', 'a');
				$date = date('F d, Y, G:i');
				$delimiter = '==============================================='.PHP_EOL;//создаем строку с разделителем
				$cont = [$date, $name, $email, $message, $realpath, $delimiter]; //создаем массив с датой, именем, почтой, сообщением, путем и разделителем
				$string = implode(PHP_EOL, $cont); //объединяем элементы массива в строку
				fwrite($fh, $string); //запись переменной в файл
				fclose($fh);
				header('Location: index.php');

}

function random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}