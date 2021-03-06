<?php

##################################################
#
# Copyright (c) 2004-2011 OIC Group, Inc.
# Written and Designed by James Hunt
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

class profileextension extends expRecord {
	protected $table = 'profileextension';

	/** exdoc
	 * This method queries the ork/modules/users/extensions/ directory for
	 * a list of installed User Profile Extension class files.  It returns the class
	 * names, in an array. This function does not take into account whether or not
	 * the administrator has activated or deactivated certain profiles.
	 *
	 * In order to be picked up by this function (and therefore the rest of the Users
	 * subsystem) a profile extension filename MUST end in 'extension.php', and
	 * therefore the classname MUST end in 'extension'.
	 *
	 * Returns an array of installed (but not necessarily activated) user profile
	 *    extensions.  If this array is empty, either Exponent encountered a problem
	 *    reading the Profile Extensions directory, or there were simply no extensions
	 *    to list.
	 * @node Subsystems:Users
	 * @return array
	 */
	public static function listExtensions() {
		// A holding array to keep the extension class names we find.  This will be returned
		// to the caller when we are completely done.
		$ext = array();
		// Store the base directory in a variable, for readability later on.
		$ext_dir = BASE.'framework/modules/users/extensions';
		// Profiles directory has to be readable by the web server.
		if (is_readable($ext_dir)) {
			$dh = opendir($ext_dir);
			// For each directory entry we find.
			while (($file = readdir($dh)) !== false) {
				if (is_file("$ext_dir/$file") && is_readable("$ext_dir/$file") && substr($file,-4,13) == '.php') {
					// Only include readable, regular files that end in '.php'

					// Store the same data in the key and the value of the array.  This is safe
					// since we are getting file names from a single directory.  The .php
					// suffix needs to be stripped out.
					$ext[substr($file,0,-4)] = substr($file,0,-4);
				}
			}
		}
		// Return the list to the calling scope.  If something went wrong, an empty
		// array will be returned.
		return $ext;
	}
}

?>
