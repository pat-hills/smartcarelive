<?php
/*
This file takes data about the company (walter gates) from the database and the data
maybe used to display company info where necessary
*/

function comp(){
	$query="SELECT * FROM tbl_company_info";

	$result = mysql_query($query);

		while($display = mysql_fetch_array($result)){

			$cname = $display['name'];
			$cadd = $display['address'];
		}
	


}









?>