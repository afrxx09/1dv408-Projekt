<?php
namespace helpers;

class FlashMessages{
	private $sessionHelper;
	private $sessionKey = 'Session::FlashMessages';

	public function __construct($sessionHelper){
		$this->sessionHelper = $sessionHelper;
	}

	public function setFlash($message, $type){
		$this->sessionHelper->add($this->sessionKey, array('message' => $message, 'type' => $type));
	}

	public function getFlash(){
		$messages = $this->sessionHelper->get($this->sessionKey);
		$this->sessionHelper->delete($this->sessionKey);
		return $messages;
	}

	public function renderFlash(){
		$messages = $this->getFlash();
		if(!empty($messages)){
			$html = '';
			foreach($messages as $message){
				$html .= '
					<div class="flash-message flash-' . $message['type'] . '">
						<p>' . $message['message'] . '</p>
					</div>
				';
			}
			unset($this->messages);
			return '
				<div class="flash-messages">
				' . $html . '
				</div>
			';
		}
		return '';
	}
}