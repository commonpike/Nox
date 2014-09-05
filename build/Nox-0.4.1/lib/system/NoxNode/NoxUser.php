<?php


	class NoxUser extends NoxNode {
		
		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxUser $uri");
			if (!$config) $config = new Config();
			
			// whatever is needed
			parent::__construct(&$service,$uri,$config);
			
			if ($nox) $nox->debug("Inited.",$this);
		}

		
		public function can($src,$op,$dst) 		{ return $this->hasCapability($src,$op,$dst); }
		public function may($src,$op,$dst) 		{ return $this->hasPermission($src,$op,$dst); }
		public function debug($msg,$context)	{ return $this->log($msg,'debug',$context); }
		
		
		
	}
?>