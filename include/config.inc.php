<?php

include "include/version.inc.php";

// load machine specific configuration

	global $ROM_VARIANTS;
	global $MODEL_VARIANTS;

require "config/".$_SERVER['SERVER_NAME']."-".$_SERVER['SERVER_PORT'].".php";

	if(!$ROM_VARIANTS)
		$ROM_VARIANTS=array("Any",
								 "---",
								 "Sharp ROM",
								 "Cacko", 
								 "pdaXrom", 
								 "Open Zaurus",
								 "QuantumSTEP",
								 "MacOS X",
								 "Linux x86", 
								 "Other",
								 );
	
	if(!$MODEL_VARIANTS)
		$MODEL_VARIANTS=array("Any",
												"---",
												"SL5x00",
												"C7x0", 
												"C860", 
												"C1000",
												"C3000",
												"SL6000",
												);

?>
