<?php

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

function getTimeGap($time){
	$current = Carbon\Carbon::now();
	$diff = strtotime($current) - strtotime($time);
	if($diff < 60){
		return "Vừa xong";
	}else if($diff >= 60 && $diff <3600){
		$second = (int)($diff/60);
		return $second." phút trước";
	}else if($diff >= 3600 && $diff < 86400){
		$hour = (int)($diff/(60*60));
		return $hour.' giờ trước';
	}else if($diff >= 86400 && $diff < 2592000){
		$day = (int)($diff/(60*60*24));
		return $day." ngày trước";
	}else if($diff >= 2592000 && $diff < 31536000){
		$month = (int)($diff/(60*60*24*30));
		return $month." tháng trước";
	}else{
		$year = (int)($diff/(60*60*24*365));
		return $year." năm trước";
	}
	return null;

// echo $mytime->toDateTimeString();
}


function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}

function stripUnicode($str){
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}



function convertIdEmp($id_emp)
{
	if($id_emp > 999){
		return 'E'.$id_emp;
	}
	elseif ($id_emp > 99) {
		return 'E0'.$id_emp;
	}elseif ($id_emp > 9) {
		return 'E00'.$id_emp;
	}else{
		return 'E000'.$id_emp;
	}
}

function invertIdEmp($code)
{
	$id = str_replace( 'E', '0', $code);
	// $arr = explode('E', $code);
	// return (Integer)$arr[1];
	return (Integer)$id;
}


function splitName($name)
{
	$array = explode(" ", $name);
	$lenght = count($array);
	$n[0] = $array[0];
	$dem = "";
	for($i=1; $i<($lenght-1); $i++)
	{
		$dem=$dem.$array[$i]." ";
	}
	$n[1] = $dem;
	$n[2] = $array[$lenght-1];
	return $n;
}

function convertString($str, $i)
{
	$lower = '
	a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z
	|á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ
	|đ
	|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ
	|í|ì|ỉ|ĩ|ị
	|ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ
	|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự
	|ý|ỳ|ỷ|ỹ|ỵ';
	$upper = '
	A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z
	|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ
	|Đ
	|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ
	|Í|Ì|Ỉ|Ĩ|Ị
	|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ
	|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự
	|Ý|Ỳ|Ỷ|Ỹ|Ỵ';
	$arrayUpper = explode('|',preg_replace("/\n|\t|\r/","", $upper));
	$arrayLower = explode('|',preg_replace("/\n|\t|\r/","", $lower));
	if($i == 0){
		return str_replace($arrayUpper,$arrayLower,$str);
	}else{
		return str_replace($arrayLower,$arrayUpper,$str);
	}
}


function splitAddress($address)
{
	if($address != null){
		$array = explode(" > ", $address);
		$lenght = count($array);
		$dem = "";
		for($i=0; $i<($lenght-2); $i++)
		{
			$dem=$dem.$array[$i];
		}
		$addr[0] = $dem;
		$addr[1] = $array[$lenght-2];
		$addr[2] = $array[$lenght-1];
		return $addr;
	}
	return $address;
	
}

function showAddress($json){
	// $array = explode(" > ", $address);
	// $lenght = count($array);
	// $addr = "";
	// for($i = 0; $i < ($lenght-1); $i++)
	// {
	// 	$addr=$addr.$array[$i].", ";
	// }
	// $addr = $addr.$array[$lenght - 1];
	// return $addr;

	$addr = json_decode($json);
	$address = $addr->address.', '.$addr->district.', '.$addr->province;
	return $address;

}

function joinAddress($addr, $district, $province)
{
	return $addr." > ".$district." > ".$province;
}

function country()
{
	$country = array(
		'Afghanistan',
		'Albania', 
		'Algeria',
		'Andorra',
		'Angola',
		'Antigua',
		'Argentina', 
		'Armenia', 
		'Australia', 
		'Austria', 
		'Azerbaijan', 
		'Bahamas',
		'Bahrain', 
		'Bangladesh', 
		'Barbados', 
		'Belarus', 
		'Belgium', 
		'Belize', 
		'Benin', 
		'Bhutan', 
		'Bolivia', 
		'Bosnia', 
		'Botswana', 
		'Brazil', 
		'Brunei Darussalam', 
		'Bulgaria', 
		'Burkina Faso', 
		'Burma', 
		'Burundi', 
		'Cambodia', 
		'Cameroon',
		'Canada',
		'Cape Verde', 
		'Central African Republic',
		'Chile', 
		'China', 
		'Colombia', 
		'Comoros',
		'Costa Rica', 
		'Croatia', 
		'Cuba',
		'Cyprus', 
		'Czech Republic',
		'Denmark', 
		'Djibouti', 
		'Dominica',
		'Dominican Republic', 
		'Ecuador',
		'Egypt', 
		'El Salvador',
		'Equatorial Guinea',
		'Eritre', 
		'Estonia',
		'Ethiopia',
		'Fiji',
		'Finland', 
		'France',
		'Gabon',
		'Gambia',
		'Georgia',
		'Germany',
		'Greece',
		'Grenada',
		'Guatemala',
		'Guyana',
		'Haiti',
		'Honduras',
		'Hungary',
		'Iceland',
		'India',
		'Indonesia',
		'Iran',
		'Iraq',
		'Ireland',
		'Israel',
		'Italy',
		'Jamaica',
		'Japan',
		'Kazakhstan',
		'Korea, North',
		'Korea, South',
		'Kuwait',
		'Laos',
		'Luxembourg',
		'Malaysia',
		'Maldives',
		'Mexico',
		'Moldova',
		'Monaco',
		'Mongolia', 
		'Morocco',
		'Myanmar',
		'Nicaragua',
		'Paraguay',
		'Peru',
		'Poland', 
		'Portugal', 
		'Russia',
		'San Marino',
		'Serbia',
		'Singapore', 
		'Slovakia',
		'Slovenia',
		'Solomon Islands',
		'Somalia',
		'South Africa',
		'Spain',
		'Sweden',
		'Switzerland', 
		'Syria',
		'Taiwan',
		'Tajikistan',
		'Thailand', 
		'Tunisia',
		'Turkey',
		'Tuvalu',
		'Uganda',
		'Ukraine',
		'United Kingdom',
		'United States',
		'Uruguay',
		'Venezuela',
		'Việt Nam',
		'Western Sahara',
		'Zaire',
		'Zambia',
		'Zimbabwe'
	);
	return $country;
}




?>