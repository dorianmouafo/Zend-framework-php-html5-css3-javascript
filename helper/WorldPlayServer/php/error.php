<?
//include 'outputFormat.php';

class Error {
	private $_code = 0;
	private $_decription;

	public static function withCode($value) {
		$instance = new self();
		$instance -> _code = $value;
		return $instance;
	}

	public static function withMessage($value) {
		$instance = new self();
		$instance -> _decription = $value;
		return $instance;
	}

	public function description() {
		$output = (isset($this -> _decription)) ? ( array('error' => 1, 'description' => $this -> _decription)) : ( array('error' => $this -> _code, 'description' => $this -> get_status_message()));
		return json_encode($output);
	}
	
	public function json($value='')
	{
		$output = (isset($this -> _decription)) ? ( array('error' => 1, 'description' => $this -> _decription)) : ( array('error' => $this -> _code, 'description' => $this -> get_status_message()));
		return $output;
	}

	private function get_status_message() {
		$status = array(0 => 'No error', 1 => 'Unknow Error');
		return ($status[$this -> _code]) ? $status[$this -> _code] : $status[1];
	}
	
	

}
?>