<?php
	class NoxService extends NoxContainer {
		
		private $options;	// service options, credentials etc
		private $handle; 	// connection handle
		private $state;		// connection state
		private $cached;	// local node cache

		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxService $uri");
			if (!$config) $config = new Config();
			
			// do whatever is needed
			parent::__construct($this,$uri,$config);
			if ($nox) $nox->debug("Inited.",$this);
		}

		public function canonize($uri) 			{ return $this->canonizeURI($uri); }
		public function connect($options) 		{ return $this->connectService($options); }
		public function disconnect() 			{ return $this->disconnectService($options); }
		public function cache($nodes)			{ return $this->cacheNodes($nodes); }
		public function flush($nodes)			{ return $this->flushCache($nodes); }

		
	}
?>