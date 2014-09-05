<?php
	class NoxNodeCore {
		
		
			
		function __construct(&$node,$config) {
			global $nox;
						
			if ($nox) $nox->debug("new NoxNodeCore $node->uri");
			if (!$config) $config = new Config();
			
			// whatever is needed

			if ($nox) $nox->debug("Inited.",$this);
		}

		
		
		
		
		
	}
?>