<?php
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require_once '../vendor/autoload.php';

include_once '../../queryHandler.php';
include_once '../../backend/inc/database.php';


class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;

	public $BDD;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
		$this->BDD = bdd::getBDD();
		echo "connected to BDD \n";
		echo "Socket created \n";
		
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		// $this->users[$conn->resourceId] = $conn;
		echo "Client connected \n";
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		// unset($this->users[$conn->resourceId]);
		echo "Client disconnected \n";
	}

	public function onMessage(ConnectionInterface $from,  $data) {
		$from_id = $from->resourceId;
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'chat':
				$user_id = $data->user_id;
				$chat_msg = $data->chat_msg;

				$array_msg = preg_split ('/-/',$chat_msg,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the str_id (prd_all_PWR)

				$t0 = microtime(True);
				$response_from = QueryHandler::getResult($array_msg[0],$array_msg[1],$this->BDD)."-".$array_msg[2];
				$t1 = microtime(True);

				echo $array_msg[0] ." ) ".($t1-$t0)."s\n";
				
				// Output
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));

				break;
		}
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		$conn->close();
	}
}
$server = IoServer::factory(
	new HttpServer(new WsServer(new Chat())),
	5002
);
$server->run();
?>