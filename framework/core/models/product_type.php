<?php

##################################################
#
# Copyright (c) 2007-2008 OIC Group, Inc.
# Created by Adam Kessler @ 09/06/2007
# Updated by Adam Kessler @ 09/06/2007
#
# This file is part of Acorn Web API
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

class product_type extends expNestedNode {
	
	public function __construct($params=array(), $get_assoc=true, $get_attached=true) {
		global $db;
		parent::__construct($params, $get_assoc, $get_attached);

	}
	
	public function saveCategories($catArray, $cat_id, $type) {
	
        global $db;
		$product_type_id = $type . "_id";
        // We need to reset the current category
		$db->delete("{$type}_storeCategories", "storecategories_id =".$cat_id);
			
		if(count($catArray) > 0) {
			foreach($catArray as $item) {
				if($item <> 0) {
					$assoc->storecategories_id  = $cat_id;
					$assoc->$product_type_id    = $item;
					$db->insertObject($assoc, "{$type}_storeCategories");    
				}
			}
		}
		
    }

}

?>