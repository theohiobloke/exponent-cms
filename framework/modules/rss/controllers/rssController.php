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

class rssController extends expController {
    public  $basemodel_name = 'expRss';
    public $useractions = array(
        'showall'=>'Show all RSS Feeds'
    );

	public $remove_configs = array(
        'aggregation',
        'comments',
        'files',
        //'rss',
        'tags'
    );

    function displayname() { return "RSS Syndication"; }
    function description() { return "This module will allow you to display a list of your syndicated RSS feeds on a web page"; }
    
    function showall() {
        $rss = new expRss();
        assign_to_template(array('feeds'=>$rss->getFeeds()));
    }
    
    function show() {
        redirect_to(array('controller'=>'rss', 'action'=>'showall'));
    }
}

?>
