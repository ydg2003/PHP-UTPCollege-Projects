<?php
#######################################################################################
# Class Name : PHP-MySQL Class
# Author : Henry Chen
# Last Mofidy Date : 2003-05-03
# License : GPL
# Contact Info
# 	E-Mail : henryi@wowphp.net
# 	ICQ : 55490755
# 	AIM : wowphp
# 	YIM : henryi_chen@yahoo.com
#######################################################################################
# Function List
# 	1.connection	 -->	function connection()
# 	2.disconnect	 -->	function disconnect()
# 	3.insert		 -->	function insert($tb_name,$cols,$val,$astriction)
# 	4.update		 -->	function update($tb_name,$string,$astriction)
# 	5.delete		 -->	function del($tb_name,$astriction)
# 	6.query			 -->	function query($string)
# 	7.num_rows		 -->	function nums($string="",$qid="")
# 	8.object		 -->	function objects($string="",$qid="")
# 	9.insert_id		 -->	function insert_id($qid="")
# 	10.pagecut		 -->	function page_cut($string,$nowpage = "0")
# 	11.show_page_cut -->	function show_page_cut($string="",$num="",$url="")
#######################################################################################
# About this changing
#	1. Add error handling
#	2. Modifing the new code format
#	3. More useful page cut function
#	4. Add the function about getting the ID generated from the previous INSERT operation 
#######################################################################################
# Change Log
#--------------------
#  2002-07-24
#--------------------
# 1. Correct page_cut error. 
# 2. Improve the function nums and function objects these two functions. 
# 3. The new pgae_cut and show_page_cut functions can let you use these functions 
#    with your template 
#
########################################################################################

class mod_db{
	var $setting_file = "setting.inc.php";
	var $sql_link;
	var $db_link;
	var $query_id;
	var $perpage = 5;
	var $total;
	var $pagecut_query;
	var $conn_type = "1"; // 0: mysql_connect ; 1: mysql_pconnect
	var $debug     = "0"; // If your code can't work well just change it to 1, you can see the sql string.

	function connection(){
		// Check if SQL is connect or not
		if(!$this->sql_link){
			// Define SQL Variables
			if(!$this->db_host || !$this->db_name || !$this->db_user || !$this->db_pass){
				include_once("$this->setting_file");
				global $sql_host,$sql_name,$sql_user,$sql_pass,$per_page;
					$this->db_host = $sql_host;
					$this->db_name = $sql_name;
					$this->db_user = $sql_user;
					$this->db_pass = $sql_pass;
				// Define other variables
					$this->perpage=$per_page;
			}
			// SQL Connection
				if($this->conn_type == 0){
					$this->sql_link = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
				}elseif($this->conn_type == 1){
					$this->sql_link = mysql_pconnect($this->db_host,$this->db_user,$this->db_pass);
				}

				if($this->debug == 1){
					echo "Connect to MySQL Server Success<br>ServerHost=$this->db_host<br>";
				}

				if(!$this->sql_link){
					echo "Connect to mysql Server Error";
				}


			// Select Database
			$this->db_link = mysql_select_db($this->db_name);
			
			if($this->debug == 1){
				echo "Connect to MySQL DB:$this->db_name Success<br>";
			}

			if(!$this->db_link){
				echo "Connect to DB Error , DBName = $this->db_name";
			}

			return;
		}else{
			exit;
		}
	}

	function disconnect(){
		mysql_close($this->sql_link);
	}

	function insert($tb_name,$cols,$val,$astriction){
		if(empty($this->sql_link)){
			$this->connection();
		}

		// Check cols is empty or not
		if(!$cols){
			$cols = "";
		}elseif($cols != ""){
			$cols = "(".$cols.")";
		}

		// Check astriction is empty or not
		if(!$astriction){
			$ast = "";
		}elseif($astriction != ""){
			$ast = " WHERE ".$astriction;
		}

		$insert = mysql_query("INSERT INTO $tb_name $cols VALUES($val) $ast",$this->sql_link);
			
			if($this->debug == 1){
				echo "Insert String = Insert into $tb_name $cols Values($val) $ast<br>";
				echo mysql_error();
			}

			if(!$insert){
				 echo "<script>alert('Insert Data Error');</script>"; // English Error Message
				
				
			}

			return;
	}

	function update($tb_name,$string,$astriction){
		if(empty($this->sql_link)){
			$this->connection();
		}

		// Check astriction is empty or not
		if(!$astriction){
			$ast = "";
		}elseif($astriction != ""){
			$ast = " WHERE ".$astriction;
		}
		$update = mysql_query("UPDATE $tb_name SET $string $ast",$this->sql_link);
		
		if($this->debug == 1){
			echo "Update String = Update $tb_name Set $string $ast<br>";
		}

		if(!$update){
			 echo "'<script>alert('Update Data Error');</script>"; // English Error Message
			
			
		}
	}

	function del($tb_name,$astriction){
		if(empty($this->sql_link)){
			$this->connection();
		}

		// Check astriction is empty or not
		if(!$astriction){
			$ast = "";
		}elseif($astriction != ""){
			$ast = " WHERE ".$astriction;
		}
		$del = mysql_query("DELETE FROM $tb_name $ast",$this->sql_link);

		if($this->debug == 1){
			echo "Delete String = Delete From $tb_name $ast<br>";
		}

		if(!$del){
			 echo "<script>alert('Delete Data Error');</script>"; // English Error Message
			
			
		}
	}

	function query($string){
		if(empty($this->sql_link)){
			$this->connection();
		}
		$this->query_id = mysql_query($string,$this->sql_link);

		if($this->debug == 1){
			echo "Query String = $string <br>";
		}

		if(!$this->query_id){
			 echo "<script>alert('Unable to Perform the query:$string');</script>"; // English Error Message
			
			
		}
		return $this->query_id;

	}

	function nums($string="",$qid=""){
		if($string != ""){
			$this->query($string);
			$this->total = mysql_num_rows($this->query_id);
		}elseif($qid != ""){
			$this->total = mysql_num_rows($qid);
		}elseif(empty($sting) && empty($qid)){
			$this->total = mysql_num_rows($this->query_id);
		}
		if($this->debug == 1){
			echo "Number = ".$this->total."<br>";
		}
		return $this->total;
	}

	function objects($string="",$qid=""){
		if($string != ""){
			$this->query($string);
			$objects = mysql_fetch_object($this->query_id);
				if($this->debug == 1){
					echo "qid = ".$qid."<br>";
					echo "obj = ".$objects."<br><br>";
				}
		}elseif($qid != ""){
			$objects = mysql_fetch_object($qid);
				if($this->debug == 1){
					echo "qid = ".$qid."<br>";
					echo "obj = ".$objects."<br><br>";
				}
		}elseif(empty($string) && empty($qid)){
			$objects = mysql_fetch_object($this->query_id);
				if($this->debug == 1){
					echo "qid = ".$qid."<br>";
					echo "obj = ".$objects."<br><br>";
				}
		}
		return $objects;
	}
	
	function insert_id($qid=""){
		if($qid){
			$insert_id = mysql_insert_id($qid);
		}elseif(!$qid){
			$insert_id = mysql_insert_id();
		}
		
		if($this->debug == 1){
			echo "Insert ID = ".$insert_id."<br>";
		}
		return $insert_id;
	}

	function page_cut($string,$nowpage = "0"){
			if(empty($this->sql_link)){
			$this->connection();
		}

			$query_str=$string;

		//Limit
		if(!$nowpage = $_REQUEST[nowpage]){
			$start = "0";
				
		}else{
			$start = ($nowpage-1)*$this->perpage;
		}
			$this->pagecut_query=$query_str." LIMIT $start,".$this->perpage."";
				if($this->debug == 1){
					echo"pagecut string=".$query_str." LIMIT $start,".$this->perpage."";
				}
		Return $this->pagecut_query;
	}

	function show_page_cut($string="",$num="",$url=""){
		global $nowpage;

		if($string){
			$this->nums($string,'');
			$pages = ceil($this->total / $this->perpage);
		}elseif($num){
			$this->total = $num;
			$pages = ceil($this->total / $this->perpage);
		}

		for ($i= 1; $i<= $pages; $i++){
		
		if($nowpage==$i){
		$pagecut .=  $i;
		
		}else{
		$pagecut .=  "<a href='$PHP_SELF?".$url."&nowpage=$i'>";
		$pagecut .=  "<font color = '336600'style = 'font-size:10pt'>";
		$pagecut .=  $i;
		$pagecut .=  "</font>";
		$pagecut .=  "</a>";
		
		}// fin del elese
		}// fin del for
	
		
	
		Return $pagecut;
		}

}
?>