<?php
    require_once('./config/Config.php');

    $db = new Connection();
    $pdo = $db->connect();
    $globalMethod = new GlobalMethods($pdo);
    $auth = new Auth($pdo);

    if (isset($_REQUEST['request'])) {
		$req = explode('/', rtrim($_REQUEST['request'], '/'));
	} else {
		$req = array("errorcatcher");
	}
    switch($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			switch ($req[0]) {

                //PULLING DATA
				case 'position':
					if (count($req) > 1) {
						echo json_encode($globalMethod->select("sk_".$req[0], $req[1]), JSON_PRETTY_PRINT);
					} else {
						echo json_encode($globalMethod->select("sk_".$req[0], null), JSON_PRETTY_PRINT);
					}
				break;

                //INSERTING DATA
				case 'insertposition':
					$d = json_decode(file_get_contents("php://input"));
					echo json_encode($globalMethod->insert("sk_position", $d), JSON_PRETTY_PRINT);
				break;

                //UPDATING DATA
				case 'updateposition':
					if (count($req) > 1) {
						$d = json_decode(file_get_contents("php://input"));
						echo json_encode($globalMethod->update("sk_position", $d, "pos_id=".$req[1]));
					} else {
						http_response_code(403);
					}
				break;

				//DELETE DATA
				case 'deleteposition':
					if (count($req) > 1) {
						$d = json_decode(file_get_contents("php://input"));
						echo json_encode($globalMethod->delete("sk_position", $d, "pos_id=".$req[1]));
					}else{
						http_response_code(403);
					}
				break;
				
				default:
					http_response_code(403);
					echo "Invalid Route/Endpoint";
				break;
			}

		break;

		default:
			http_response_code(403);
			echo "Please contact the Systems Administrator";
		break;
	}




?>