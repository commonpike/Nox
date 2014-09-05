<?php
	class NoxNode {
		
		// All things in Fox (including $fox itself) are Nodes.
		// A node is just a thing with properties that you can
		// get() and set(). A node interfaces with its core.
		// The actual implementation of something extends the
		// core. This wrapper only does caching and versioning
		// etc.
		
		// You never create a new Node. you get a Node from
		//		$something->getNode()
		
		// Node does not check any privileges. If you want to 
		// dissalow people to do something, do it in your 
		// core extension.
		
		private $service;	// ref to nodes service, always available
		private $container; // ref to (opt) container, cached from getContainer()
		private $core;		// ref to core interface object
		
		public $uri;		// contains ref to service nss
		public $id;			// unqiue id within container
		public $label;		// humanly stripped id, not versioned
		public $title;

		private $inited = false;
		
		// properties used in get() and set()
		private $propertyTable 	= array(); // hash propname => [label, permissions]
		private $propertyCache 	= array(); // cache (or pregen) hashtable name,value,orgvalue
		
		// methods used in exec()
		private $methodNames 	= array(); 
		
		// formats used in render()
		private $formatNames 	= array(); 
		
		// versions used in get() and set(), like "lang" and "rev"
		private $versionTable 	= array(); // array of available tag=>value hashes
		private $currentVersion = array(); // hash of tag=>value
		
		//$node->setVersion($node->versionTable[3])
		//	print $node->currentVersion["rev"]; 	// de
		//	print $node->currentVersion["lang"]  	// 3.22

		
		/* these are the methods you call, but never extend */
			
		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxNode $service->uri,$uri");
			if (!$config) $config = new Config();
			
			$this->uri 			= $uri;
			$this->id 			= $config['id'];
			$this->label 		= $config['label'];
			
			if (get_class($this)!="NoxService") {
			
				// for plain nodes, the service is given
				$nox->debug("Setting service as container",$this);
				$this->service = &$service;
				if (!$this->id) $this->id = $service->parseURI($uri)['id'];

			} else {
			
				// for services, the service is itself
				// and the container is nox
				
				$this->service   = &$this;
				if ($nox) {
				
					$nox->debug("Setting nox as container",$this);
					$this->container = &$nox;
					if (!$this->id) {
						$this->id = $nox->parseURI($uri)['id'];
					}
					
				} else {

					// there is one rare occasion that nox
					// does not exist yet: if this *is* nox
					// we cannot debug this.
					$this->container = &$this;
					$this->id = 'nox'; 
					
				} 
				
			}
			
			if (!$this->label) $this->label = $this->id;
			
			
			// create the core and init it
			// the core will in turn set values on the node,
			// like propertieNames, pregen propValues, versionTable, etc
			$cc = $config['constructor'];
			if (!$cc) $cc = "NoxNodeCore";
			$this->core = new $cc($this,$config);

			$this->inited = true;
			if ($nox) $nox->debug("Inited.",$this);
		}

		public function properties() 	{ return $this->getPropertyNames(); }
		public function has($name) 		{ return $this->hasProperty($name); }
		public function get($name) 		{ return $this->getProperty($name); }
		public function set($name,$value) { return $this->setProperty($name,$value); }
		public function unset($name) 	{ return $this->unsetProperty($name); }
		public function reset($name) 	{ return $this->resetProperty($name); }
		
		public function container()		{ return $this->getContainer(); }
		public function containers()	{ return $this->getContainers(); }
		public function service()		{ return $this->getService(); }

		public function related($params)		{ return $this->getRelatedNodes(); }
		public function relations($params)		{ return $this->getRelationNodes(); }
		public function add($target,$params)	{ return $this->addRelation($target,$params); }
		public function remove($target,$params)	{ return $this->removeRelation($target,$params); }

		public function methods() 			{ return $this->getMethodNames(); }
		public function exec($name,$params) { return $this->executeMethod($name,&$params); }
		public function call($fn,$params)	{ return $this->callMethod($fn,&$params);}

		public function commit()		{ return $this->commitNode($tags); }

		public function versions()		{ return $this->getVersionTable(); }
		public function version($tags)	{ return $this->getVersion($tags); }
		public function publish($tags)	{ return $this->publishVersion($tags); }
		public function revert($tags)	{ return $this->revertVersion($tags); }
		
		public function formats()				{ return $this->getFormatNames(); }
		public function data($format)			{ return $this->getData($format); }
		public function render($params)			{ return $this->renderNode($params); }

		public function report() 		{ return $this->getReport(); }
		
		
		
		
	}
?>