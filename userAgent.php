function curl_get_file_contents($URL) {
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	//    curl_setopt($c, CURLOPT_HEADER, 1);//输出远程服务器的header信息
	curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (MeeGo; NokiaN9) AppleWebKit/534.13 (KHTML, like Gecko) NokiaBrowser/8.5.0 Mobile Safari/534.13');
	curl_setopt ($ch, CURLOPT_REFERER, "http://www.fromdomain.cn/");
	curl_setopt($c, CURLOPT_URL, $URL);
	$contents = curl_exec($c);
	curl_close($c);
	if ($contents) {
		return $contents;
	} else {
		return FALSE;
	}
}
//$f=curl_get_file_contents('http://www.baidu.com');
//var_dump($f);
