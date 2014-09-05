<?php

	/*
		this is exceptional and should not be replicated.
		it allows nox to be a service, but be instantiated
		by saying new Nox(), and have some additional methods
		on top of the normal service api
	*/

	class Nox extends NoxService {
		
		private $user;

		function __construct() {

			$this->debug("Nox nox, whos there");
			
			// read the ini files
			if (!$config) $config = new Config();
			
			// wake up nox
			parent::__construct($this,'nox',[
				'constructor' => 'NoxNoxCore'
			]);

			// determine which services should
			// autoconnect and do that

			// determine the active user service
			// and attach the current user.

		}
		
		public function debug($msg,$context=null) {
			print $msg;
		}

	}

	

?>