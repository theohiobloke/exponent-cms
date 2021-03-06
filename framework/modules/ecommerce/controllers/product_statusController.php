<?php

##################################################
#
# Copyright (c) 2004-2011 OIC Group, Inc.
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

class product_statusController extends expController {

    function displayname() { return "Ecommerce Product Statuses"; }
    function description() { return "Manage Ecommerce Product Statuses"; }
    function author() { return "OIC Group, Inc"; }
    function hasSources() { return false; }
    function hasContent() { return false; }
    
    public function manage() {
        expHistory::set('viewable', $this->params);
        
        $page = new expPaginator(array(
			'model'=>'product_status',
			'controller'=>$this->params['controller'],
			'action'=>$this->params['action'],
			'where'=>1,
			));

		assign_to_template(array('page'=>$page));
    }
    
    public function showall() {
        redirect_to(array('controller'=>'product_status', 'action'=>'manage'));
    }
    
    public function show() {
        redirect_to(array('controller'=>'product_status', 'action'=>'manage'));
    }
    
}

?>
