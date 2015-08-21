class DES {
	public static function genIvParameter() {  
		return mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_CBC), MCRYPT_RAND);  
	}  

	private static function pkcs5Pad($text, $blocksize) {  
		$pad = $blocksize - (strlen($text) % $blocksize); // in php, strlen returns the bytes of $text  
		return $text . str_repeat(chr($pad), $pad);  
	}  

	private static function pkcs5Unpad($text) {  
		$pad = ord($text{strlen($text)-1});  
		if ($pad > strlen($text)) return false;  
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;  
		return substr($text, 0, -1 * $pad);  
	}  

	public static function encrypt($plain_text, $key, $iv) {  
		$padded = static::pkcs5Pad($plain_text, mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC));  
		$str = mcrypt_encrypt(MCRYPT_DES, $key, $padded, MCRYPT_MODE_CBC, $iv);  
		return bin2hex($str);
	}  

	public static function decrypt($cipher_text, $key, $iv) {  
		$cipher_text = hex2bin($cipher_text);
		$plain_text = mcrypt_decrypt(MCRYPT_DES, $key, $cipher_text, MCRYPT_MODE_CBC, $iv);  
		$str = static::pkcs5Unpad($plain_text);  
		return $str;
	} 
}
class encode{
	private $_renrenKey = 'oe7aZhnk';
	private $_renrenIv = "t\x02n\x04h\x06a\x08";
	public function encrypt($str) {
		return DES::encrypt($str, $this->_renrenKey, $this->_renrenIv);
	}

	public function decrypt($str) {
		return DES::decrypt($str, $this->_renrenKey, $this->_renrenIv);
	}
}
