<?php
	class NoxServiceCore extends NoxContainerCore {
		
		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxServiceCore $node->uri");
			if (!$config) $config = new Config();
			
			// whatever is needed
			parent::__construct($this,$uri,$config);
			if ($nox) $nox->debug("Inited.",$this);
		}

		
	}
?>