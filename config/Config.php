<?php
    // to avoid CORS Policy
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=utf-8");
    header("Access-Control-Allow-Methods: POST");   
	header("Access-Control-Max-Age: 3600");
	// header("Access-Control-Max-Headers: Content-Type, Access-Control-Allow-Headers,
	// 	Authorization, X-Requested-Width, X-Auth-User");

	// date_timezone_set("Asia/Manila");
	set_time_limit(10000);
    
    //importing all the php file from models folder
    include_once('./models/Auth.php');
    include_once('./models/Get.php');
    include_once('./models/Global.php');
    include_once('./models/Post.php');

    //
    define("DBASE", "db_sk_management");
	define("USER", "root");
	define("PW", "");
	define("SERVER", "localhost");
	define("CHARSET", "utf8");
	define("SECRET", base64_encode("sampleSecretKey"));

	class Connection {
		protected $connectionString = "mysql:host=".SERVER.";dbname=".DBASE.";charset=".CHARSET;
		protected $options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES => false
		];

		public function connect() {
			return new \PDO($this->connectionString, USER, PW, $this->options);
		}
	}
?>