<?php

	/* 
		This is the first file you include in your script.
		Don't change anything here. This starts the Nox service.
		
	*/
	
	define('NOX_TRON',($_REQUEST["tron"])?true:false);
	define('NOX_DIR',dirname(__FILE__));

	if (NOX_TRON) print("<!--*D".Date("H:i:s ")." init -->\n");

	include("$noxdir/lib/compat.php");
	
	// system
	require("$noxdir/lib/system/NoxNode.php");
	require("$noxdir/lib/system/NoxNodeCore.php");
	require("$noxdir/lib/system/NoxChain.php");
	require("$noxdir/lib/system/NoxURI.php");

	require("$noxdir/lib/system/NoxNode/NoxContainer.php");
	require("$noxdir/lib/system/NoxNode/NoxRelation.php");
	require("$noxdir/lib/system/NoxNode/NoxUser.php");

	require("$noxdir/lib/system/NoxNodeCore/NoxContainerCore.php");
	require("$noxdir/lib/system/NoxNodeCore/NoxRelationCore.php");
	require("$noxdir/lib/system/NoxNodeCore/NoxUserCore.php");

	require("$noxdir/lib/system/NoxNode/NoxContainer/NoxService.php");
	require("$noxdir/lib/system/NoxNodeCore/NoxContainerCore/NoxServiceCore.php");
	
	
	// nox
	require("$noxdir/lib/modules/services/Nox/NoxNoxCore.php");
	require("$noxdir/lib/modules/services/Nox/Nox.php");
	$nox = &new Nox();
	
	
	
?>