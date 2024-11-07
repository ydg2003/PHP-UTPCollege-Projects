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
class mod_db {
    private $pdo;
    private $setting_file = "setting.inc.php";

    function connection() {
        include_once($this->setting_file);
        global $sql_host, $sql_name, $sql_user, $sql_pass;

        try {
            $dsn = "mysql:host=$sql_host;dbname=$sql_name";
            $this->pdo = new PDO($dsn, $sql_user, $sql_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error connecting to MySQL: " . $e->getMessage();
        }
    }

    function disconnect() {
        $this->pdo = null; // Close connection
    }

    function insert($tb_name, $cols, $val) {
        if (!$this->pdo) {
            $this->connection();
        }
        $consulta = "INSERT INTO $tb_name ($cols) VALUES ($val)";
        try {
            $this->pdo->exec($consulta);
        } catch (PDOException $e) {
            echo "Error during insert: " . $e->getMessage();
        }
    }

    function query($query) {
        if (!$this->pdo) {
            $this->connection();
        }
        try {
            return $this->pdo->query($query);
        } catch (PDOException $e) {
            echo "Error during query: " . $e->getMessage();
            return false;
        }
    }
}
?>