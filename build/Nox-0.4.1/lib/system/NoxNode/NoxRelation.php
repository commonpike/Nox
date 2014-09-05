<?php


	class NoxRelation extends NoxNode {
		
		private $src;
		private $type;
		private $dst;

		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxUser $uri");
			if (!$config) $config = new Config();
			
			// whatever is needed
			parent::__construct(&$service,$uri,$config);
			
			if ($nox) $nox->debug("Inited.",$this);
		}

		
		public function src() 	{ return $this->getSourceNode(); }
		public function dst() 	{ return $this->getDestinationNode(); }
		
		
		
	}
?>