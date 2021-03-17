<?php
    class Auth{
        protected $globalMethods, $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
			$this->globalMethods = new GlobalMethods($pdo);
        }

        public function generateHeader(){
            $header = [
                "typ" => "JWT",
                "alg" => "HS256",
                "app" => "SK Management",
                "dev" => "Austin Ray Aranda"
            ];
            return str_replace("=", "", base64_encode(json_encode($h)));
         }

        public function generatePayload($uc, $ue, $ito){
            $payload = [
				"uc" => $uc,
				"ue" => $ue,
				"ito" => $ito,
				"iby" => "Austin Ray Aranda",
				"ie" => "austinaranda27@gmail.com",
				"exp" => date("Y-m-d H:i:s")
			];
			return str_replace("=", "", base64_decode(json_encode($p)));
        }

        protected function generateToken($userCode, $userEmail, $fullName) {
			$header = $this->generateHeader();
			$payload = $this->generatePayload($userCode, $userEmail, $fullName);
			$signature = hash_hmac("sha256", "$header.$payload", base64_encode(SECRET));
			return "$header.$payload." .str_replace("=", "", base64_encode($signature));
		}
        
        public function showToken() {
			return $this->generateToken("201810144", "201810144@gordoncollege.edu.ph", "Austin Ray Aranda");
		}

    } 

?>