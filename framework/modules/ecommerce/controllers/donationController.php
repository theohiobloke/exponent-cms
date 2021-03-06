<?php

##################################################
#
# Copyright (c) 2004-2011 OIC Group, Inc.
# Created by Adam Kessler @ 05/28/2008
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

class donationController extends expController {
    public $basemodel_name = 'donation';
    public $useractions = array(
        'showall'=>'Show all Donation Causes',
    );
    // public $useractions = array();
    
    function displayname() { return "Online Donations"; }
    function description() { return "Use this module to accept donations on your website"; }

    function showall() {
        expHistory::set('viewable', $this->params);
        $causes = $this->donation->find('all');
        //eDebug($causes);
        assign_to_template(array('causes'=>$causes));
    }
    
    function metainfo() {
        global $router;
        if (empty($router->params['action'])) return false;
        
        // figure out what metadata to pass back based on the action we are in.
        $action = $_REQUEST['action'];
        $metainfo = array('title'=>'', 'keywords'=>'', 'description'=>'');
        switch($action) {
            case 'donate':
                $metainfo['title'] = 'Make a donation';
                $metainfo['keywords'] = 'donate online';
                $metainfo['description'] = "Make a donation";    
            break;
            default:
                $metainfo = array('title'=>$this->displayname()." - ".SITE_TITLE, 'keywords'=>SITE_KEYWORDS, 'description'=>SITE_DESCRIPTION);
        }
        
        return $metainfo;
    }
    
    function index() {
        redirect_to(array('controller'=>'donations', 'action'=>'showall'));
    }
    
    function show() {
        redirect_to(array('controller'=>'donations', 'action'=>'showall'));
    }
    
    function delete() {
        redirect_to(array('controller'=>'donations', 'action'=>'showall'));
    } 
}

?>
