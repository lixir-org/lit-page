<?php
class Format{

	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 300){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text."...";
		return $text;
	}

	public function rewriteText($string) {
        $text = preg_replace('/[^-a-z0-9-]+/', '-', strtolower($string));
        return $text;
    }

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data); 
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		//$title = str_replace('_', ' ', $title);
		if ($title == 'index') {
			$title = 'Welcome to Lixir';
		} elseif ($title == 'project-request') {
			$title = 'Request Request Form';
		} elseif ($title == 'contact-us') {
			$title = 'contact Lixir';
		} elseif ($title == 'about-us') {
			$title = 'About Lixir';
		}
		return $title = ucfirst($title);
	}
}


define("TITLE", "Lixir");

define("KEYWORDS", "Lixir, lit, lixir, Lixir Tech, Lixir Team, lixir.com.ng, lixir technologies, lixir web");

define("DESCRIPTION", "Lixir is technology forward company with a group of agile talents from diverse backgrounds as UX/UI, Digital Marketing, Web, Mobile and Software Devs, IOT devs, AR, VR devs & content creators.");

?>