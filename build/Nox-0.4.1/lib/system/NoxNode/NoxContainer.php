<?php

	class NoxContainer extends NoxNode {
		
		
			
		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxContainer $uri");
			if (!$config) $config = new Config();
			
			// whatever is needed
			parent::__construct(&$service,$uri,$config);
			
			if ($nox) $nox->debug("Inited.",$this);
		}

		
		public function node($uri) 				{ return $this->getNode($uri); }
		public function nodes($options) 		{ return $this->getNodes($options); }
		public function list($format,$options)	{ return $this->getList($format,$options); }

		public function create($uri,$type,$data){ return $this->createNode($uri,$type,$data); }
		public function delete($uri,$type,$data){ return $this->deleteNode($uri,$type,$data); }
		
		
		
	}
?>