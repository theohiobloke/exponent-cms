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
/** @define "BASE" "../../../.." */

if (!defined('EXPONENT')) exit('');
global $router;

//expHistory::flowSet(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);
expHistory::set('viewable', $router->params);

$title = $db->selectValue('container', 'title', "internal='".serialize($loc)."'");

$template = new template("calendarmodule","_viewweek",$loc,false);

$time = (isset($_GET['time']) ? $_GET['time'] : time());
$time = intval($time);

$startweek = expDateTime::startOfWeekTimestamp($time);
$days = array();
$counts = array();
$startinfo = getdate($startweek);

$locsql = "(location_data='".serialize($loc)."'";
// look for possible aggregate
$config = $db->selectObject("calendarmodule_config","location_data='".serialize($loc)."'");
if (!empty($config->aggregate)) {
	$locations = unserialize($config->aggregate);
	foreach ($locations as $source) {
		$tmploc = null;
		$tmploc->mod = 'calendarmodule';
		$tmploc->src = $source;
		$tmploc->int = '';
		$locsql .= " OR location_data='".serialize($tmploc)."'";
	}
}
$locsql .= ')';
for ($i = 0; $i < 7; $i++) {
	$start = mktime(0,0,0,$startinfo['mon'],$startinfo['mday']+$i,$startinfo['year']);
	$days[$start] = array();
//	$dates = $db->selectObjects("eventdate","location_data='".serialize($loc)."' AND date = $start");
	$dates = $db->selectObjects("eventdate",$locsql." AND date = $start");	
	for ($j = 0; $j < count($dates); $j++) {
		$o = $db->selectObject("calendar","id=".$dates[$j]->event_id);
		if ($o != null) {
			$o->eventdate = $dates[$j];
			$o->eventstart += $o->eventdate->date;
			$o->eventend += $o->eventdate->date;
			$thisloc = expCore::makeLocation($loc->mod,$loc->src,$o->id);
			$o->permissions = array(
				"administrate"=>(expPermissions::check("administrate",$thisloc) || expPermissions::check("administrate",$loc)),
				"edit"=>(expPermissions::check("edit",$thisloc) || expPermissions::check("edit",$loc)),
				"delete"=>(expPermissions::check("delete",$thisloc) || expPermissions::check("delete",$loc))
			);

			//Get the image file if there is one.
			if (isset($o->file_id) && $o->file_id > 0) {
				$file = $db->selectObject('file', 'id='.$o->file_id);
				$o->image_path = $file->directory.'/'.$file->filename;
			}
		
			$days[$start][] = $o;
		}
	}
	$counts[$start] = count($days[$start]);
}

$template->register_permissions(
	array("post","edit","delete","administrate","manage_approval"),
	$loc
);


if (!$config) {
	$config->enable_categories = 0;
	$config->enable_ical = 1;
}

$template->assign("config",$config);
if (!isset($config->enable_ical)) {$config->enable_ical = 1;}
$template->assign("enable_ical", $config->enable_ical);
		
$template->assign("days",$days);
$template->assign("counts",$counts);
$template->assign("startweek",$startweek);
$template->assign("startprevweek3",(strtotime('-3 weeks',$startweek)));
$template->assign("startprevweek2",(strtotime('-2 weeks',$startweek)));
$template->assign("startprevweek",(strtotime('-1 weeks',$startweek)));
$template->assign("startnextweek",(strtotime('+1 weeks',$startweek)));
$template->assign("startnextweek2",(strtotime('+2 weeks',$startweek)));
$template->assign("startnextweek3",(strtotime('+3 weeks',$startweek)));

$template->assign('moduletitle',$title);
$template->output();

?>
