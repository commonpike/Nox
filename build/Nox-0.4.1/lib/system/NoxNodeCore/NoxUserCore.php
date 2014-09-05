<?php


	class NoxUserCore extends NoxNodeCore {
		
		function __construct(&$service,$uri,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxUserCore $uri");
			if (!$config) $config = new Config();
			
			// whatever is needed
			parent::__construct(&$service,$uri,$config);
			
			if ($nox) $nox->debug("Inited.",$this);
		}
	}
	
?>