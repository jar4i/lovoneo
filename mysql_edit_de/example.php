<?php

// Tables for this example.php see file: 'test.sql'

session_start();
require_once("mte/mte.php");
$tabledit = new MySQLtabledit();



		#####################
		# required settings #
		#####################


# database settings:
$tabledit->database = 'projekt';
$tabledit->host = 'localhost:3306';
$tabledit->user = 'root';
$tabledit->pass = 'jvaac2283591';


# table of the database you want to edit:
$tabledit->table = 'de';


# the primary key of the table (must be AUTO_INCREMENT):
$tabledit->primary_key = 'id';


# the fields you want to see in "list view"
# Always add the primary key (`employeeNumber)`: 
$tabledit->fields_in_list_view = array('id', 'phrase');



		#####################
		# optional settings #
		#####################


# Head of the page (<h1>head_1<h1>):
$tabledit->head_1 = "";


# language (en=English, de=German, fr=French, nl=Dutch, sv=Swedish):
$tabledit->language = 'de';


# numbers of rows/records in "list view": 
$tabledit->num_rows_list_view = 10;


# required fields in edit or add record: 
$tabledit->fields_required = array('city','land');


# Fields you want to edit (remove this to edit all the fields).
# $tabledit->fields_to_edit = array('lastName','email','job');


# help texts: 
$tabledit->help_text = array(

);


# visible name of the fields: 
$tabledit->show_text = array(


);


# visible name of the fields in list view: 
$tabledit->show_text_listview = array(
	'employeeNumber' => 'Number',
	'active' => 'Active',
	'firstName' => 'First name',
	'lastName' => 'Last name',
	'email' => 'Email',
	'job' => 'Job'
);


# Make selectlist on inputfield based on another table
# in this example: `employees`.`job` is based on `jobs`.`jobname`: 
$tabledit->lookup_table = array(
	'job' => array(
		'query' => "SELECT `id`, `jobname` FROM `jobs`;",
		'option_value' => 'id',
		'option_text' => 'jobname'
	)
);


$tabledit->width_editor = '100%';
$tabledit->width_input_fields = '500px';
$tabledit->width_text_fields = 'auto';
$tabledit->height_text_fields = 'auto';


# warning no .htaccess ('on' or 'off'): 
$tabledit->no_htaccess_warning = 'off';




		####################################
		# connect, show editor, disconnect #
		####################################


$tabledit->database_connect();

echo "<!DOCTYPE html>
<html lang='en'>
<head>

	<meta charset='utf-8'>

	<title>DEUTSCHE VERSION BEARBEITEN</title>
	</head>
	<body>
";

$tabledit->do_it();

echo "
	</body>
	</html>"
;

$tabledit->database_disconnect();
?>
