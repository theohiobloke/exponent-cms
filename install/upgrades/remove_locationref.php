<?php
##################################################
#
# Copyright (c) 2007-2008 OIC Group, Inc.
# Written and Designed by Adam Kessler
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

class remove_locationref extends upgradescript {
	protected $from_version = '1.99.0';
	protected $to_version = '2.0.1';

	function name() { return "Remove the locationref Table"; }

	function description() { return "Beginning with Exponent 2.0.0 RC1, the locationref table is no longer used and is replaced by the sectionref table."; }

	function upgrade() {
	    global $db;

		// copy each locationref entry to the sectionref
	    $srs = $db->selectObjects('sectionref',"module = 'headlineController'");
	    foreach ($srs as $sr) {
		    $sr->module = 'textController';
		    $db->updateObject($sr,'sectionref');
	    }
		$lrs = $db->selectObjects('locationref',"module = 'headlineController'");
	    foreach ($lrs as $lr) {
		    $lr->module = 'textController';
		    $db->updateObject($lr,'locationref');
	    }
	    $gps = $db->selectObjects('grouppermission',"module = 'headlineController'");
        foreach ($gps as $gp) {
	        $gp->module = 'textController';
	        $db->updateObject($gp,'grouppermission');
        }
        $ups = $db->selectObjects('userpermission',"module = 'headlineController'");
        foreach ($ups as $up) {
            $up->module = 'textController';
            $db->updateObject($up,'userpermission');
        }

		// convert each headline module to a text module
	    $modules_converted = 0;
	    $cns = $db->selectObjects('container',"internal LIKE '%headlineController%'");
	    foreach ($cns as $cn) {
		    $cloc = expUnserialize($cn->internal);
	        $cloc->mod = 'textController';
		    $cn->internal = serialize($cloc);
		    $cn->view = 'showall';
		    $cn->action = 'showall';
	        $db->updateObject($cn,'container');
	        $modules_converted += 1;
	    }

		// create a text item for each headline item
	    $headlines_converted = 0;
		$headlines = $db->selectObjects('headline',"1");
		foreach ($headlines as $hl) {
			$text = new text();
			$loc = expUnserialize($hl->location_data);
			$loc->mod = "text";
			$text->location_data = serialize($loc);
			$text->title = $hl->title;
			$text->poster = $hl->poster;
			$text->save();
			$text->created_at = $hl->created_at;
            $text->edited_at = $hl->edited_at;
			$text->update();
			$headlines_converted += 1;
		}

// FIXME - remove when final
return "TEST - We're NOT removing the locationref table nor the files yet...<br>".$modules_converted." Headline modules were converted.<br>".$headlines_converted." Headlines were converted.<br>";

		// delete headline table
		$db->dropTable('locationref');

		// check if the headline controller files are there and remove them
		$files = array(
		    BASE."framework/modules/definitions/headline.php",
		    BASE."framework/modules/models/headline.php",
		    BASE."framework/modules/headline/"
		);

        // delete the files.
        $removed = 0;
        $errors = 0;
		foreach ($files as $file) {
		    if (expUtil::isReallyWritable($file)) {
		        unlink ($file);
		        $removed += 1;
		    } else {
		        $errors += 1;
		    }
		} 
		
		return $modules_converted." Headline modules were converted.<br>".$headlines_converted." Headlines were converted.<br>".$removed." files were deleted.<br>".$errors." files could not be removed.";
		
	}
}

?>
