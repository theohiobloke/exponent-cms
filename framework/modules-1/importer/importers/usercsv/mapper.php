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
/** @define "BASE" "../../../../.." */

//Sanity check
if (!defined('EXPONENT')) exit('');

//Get the post data for future massaging
$post = $_POST;

//Check to make sure the user filled out the required input.
if (!is_numeric($_POST["rowstart"])){
	unset($post['rowstart']);
	$post['_formError'] = gt('The starting row must be a number.');
	expSession::set("last_POST",$post);
	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit('Redirecting...');
}

//Get the temp directory to put the uploaded file
$directory = "framework/modules-1/importer/importers/usercsv/tmp";

//Get the file save it to the temp directory
if ($_FILES["upload"]["error"] == UPLOAD_ERR_OK) {
//	$file = file::update("upload",$directory,null,time()."_".$_FILES['upload']['name']);
	$file = expFile::fileUpload("upload",false,false,time()."_".$_FILES['upload']['name'],$directory);  //FIXME quick hack to remove file model
	if ($file == null) {
		switch($_FILES["upload"]["error"]) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$post['_formError'] = gt('The file you attempted to upload is too large.  Contact your system administrator if this is a problem.');
				break;
			case UPLOAD_ERR_PARTIAL:
				$post['_formError'] = gt('The file was only partially uploaded.');
				break;
			case UPLOAD_ERR_NO_FILE:
				$post['_formError'] = gt('No file was uploaded.');
				break;
			default:
				$post['_formError'] = gt('A strange internal error has occurred.  Please contact the Exponent Developers.');
				break;
		}
		expSession::set("last_POST",$post);
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit("");
	}
}
/*
if (mime_content_type(BASE.$directory."/".$file->filename) != "text/plain"){
	$post['_formError'] = "File is not a delimited text file.";
	expSession::set("last_POST",$post);
	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit("");
}
*/

//split the line into its columns
$fh = fopen(BASE.$directory."/".$file->filename,"r");
for ($x=0; $x<$_POST["rowstart"]; $x++){
	$lineInfo = fgetcsv($fh, 2000, $_POST["delimiter"]);
}

$colNames = array(
	"none"=>gt('--Disregard this column--'),
	"username"=>gt('Username'),
	"password"=>gt('Password'),
	"firstname"=>gt('First Name'),
	"lastname"=>gt('Last Name'),
	"email"=>gt('Email Address')
);

//Check to see if the line got split, otherwise throw an error
if ($lineInfo == null) {
	$post['_formError'] = sprintf(gt('This file does not appear to be delimited by "%s". <br />Please specify a different delimiter.<br /><br />'), $_POST["delimiter"]);
	expSession::set("last_POST",$post);
	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit("");
}else{
	//Setup the mete data (hidden values)
	$form = new form();
	$form->meta("module","importer");
	$form->meta("action","page");
	$form->meta("page","process");
	$form->meta("rowstart", $_POST["rowstart"]);
	$form->meta("importer","usercsv");
	$form->meta("filename",$directory."/".$file->filename);
	$form->meta("delimiter",$_POST["delimiter"]); 
	for ($i=0; $i< count($lineInfo); $i++) {
		$form->register("column[$i]", $lineInfo[$i], new dropdowncontrol("none", $colNames));
	}
	$form->register("submit", "", new buttongroupcontrol(gt('Next'),"", gt('Cancel')));
	$template = New Template("importer", "_usercsv_form_mapping");
	$template->assign("form_html", $form->tohtml());
	$template->output();
}

?>