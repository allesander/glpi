<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT','..');
//$AJAX_INCLUDE=1;
$NEEDED_ITEMS=array("tracking");
include (GLPI_ROOT."/inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
header_nocache();

checkLoginUser();

// Make a select box                                            
if (isset($LINK_ID_TABLE[$_POST["itemtype"]])&&$_POST["itemtype"]>0&&(isPossibleToAssignType($_POST["itemtype"]))){
	$table=$LINK_ID_TABLE[$_POST["itemtype"]];

	if (!isset($_POST["admin"])||$_POST["admin"]==0){
		echo "<div align='center'>".$LANG['help'][23].":&nbsp;";
	}
	$rand=mt_rand();

	ajaxDisplaySearchTextForDropdown($_POST['myname'].$rand,15);
	echo "</div>";
	if (isset($_POST["admin"])&$_POST["admin"]==1){
		echo "<br>";
	}

	$paramstrackingdt=array('searchText'=>'__VALUE__',
			'myname'=>$_POST["myname"],
			'table'=>$table,
			'itemtype'=>$_POST["itemtype"],
			'entity_restrict'=>$_POST['entity_restrict'],
	);
	ajaxUpdateItemOnInputTextEvent("search_".$_POST['myname'].$rand,"results_ID$rand",$CFG_GLPI["root_doc"]."/ajax/dropdownFindNum.php",$paramstrackingdt,false);

	echo "<span id='results_ID$rand'>";
	echo "<select name='ID'><option value='0'>------</option></select>";
	echo "</span>";	
}		
?>