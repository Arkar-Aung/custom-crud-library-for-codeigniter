<?php 

/*
 * A simple custom crud library
 * 
 * This library is intend to save our developing time on doing repeatedly crud method.
 * Using it with avoid to do crud in model repeatedly and clean your hand .
 * 
 * @author Arkar Aung
 * @copyright 2012 Arkar Aung
 * @license http://opensource.org/licenses/MIT MIT License
 * @version 1.1
*/

	class Crud 
	{
		
		/** 
		 * Sets $this->ci to get all codeigniter instantiation 
		 * Load codeigniter database library
		 * Load crud_model
		 * @return void 
		 */  	
		 			
		function __construct()
		{
			$this->ci =& get_instance();
			$this->ci->load->database();
			$this->ci->load->model('crud_model');		
		}

		/** 
		 * Getting require data and send to crud_model to insert to a 
		 * specify table in database .
		 * 
		 * Accepts four variables and return inserted id 
		 * 
		 * @param $table_name a name of table which you want to insert
		 * @param $data an array which is insert to above table
		 * @param $uniqid a field name of above table which keep generated
		 *  custom id value . (optional)
		 * @param $prefix a prefix value of your custom id value (optional)
		 * @return $id a id which is last inserted id
		 */ 
     		
		function insert($table_name,$data,$uniqid=null,$prefix=null)
		{
			if($uniqid && $prefix)
			{
				$data[$uniqid] = $this->ci->crud_model->generate_uniqid($table_name,$uniqid,$prefix);
			}
			
			if($id = $this->ci->crud_model->insert($table_name,$data))
			{
				return $id;
			}
			
			return false;
		}
		
		/** 
		 * Getting require data and send to crud_model to update to a 
		 * specify table in database .
		 * 
		 * Accepts four variables 
		 * 
		 * @param $table_name a name of table which you want to update
		 * @param $data an array which is update to above table
		 * @param $where an array which contains field and key to update
		 * @return void
		 */ 		
		
		function update($table_name,$data,$where = array())
		{			
			return $this->ci->crud_model->update($table_name,$data,$where);				
		}

		
		/** 
		 * Getting require data and send to crud_model to delete to a 
		 * specify table in database .
		 * 
		 * Accepts three variables 
		 * 
		 * @param $table_name a name of table which you want to delete
		 * @param $where an array which contains field and key to delete 
		 * @return void
		 */ 
		
		function delete($table_name,$where = array())
		{
			return $this->ci->crud_model->delete($table_name,$where);
		}
		
		/** 
		 * Getting data as your condition define from your selected 
		 * table
		 * 
		 * Accepts three variables 
		 * 
		 * @param $table_name a name of table which you want to delete
		 * @param $where an array to match with it when getting data 		 
		 * @param $rule an array which contains rules to restrict when
		 * getting the data
		 * @param $join an array which contains field and key to join with
		 * another table
		 * @param $select a string which contains field name to get		 
		 * @return void
		 */ 		
		
		function get($table_name,$where = array(),$rule = array(),$join = array(),$select='*')
		{
			return $this->ci->crud_model->get($table_name,$where,$rule,$join);
		}
		
		/** 
		 * Getting data as your condition define from your selected 
		 * table
		 * 
		 * Accepts three variables 
		 * 
		 * @param $table_name a name of table which you want to delete
		 * @param $where an array which contains field and key to delete
		 * @param $join an array which contains field and key to join with
		 * another table
		 * @param $select a string which contains field name to get				 
		 * @return void
		 */ 		
		
		function get_byKey($table_name,$where = array() ,$join = array(),$select='*')
		{
			return $this->ci->crud_model->get_byKey($table_name,$where,$join);
		}

		/** 
		 * Setting empty value in all fields from your selected table .
		 * 
		 * Accepts one variable
		 * 
		 * @param $table_name a name of table which you want to clean up.
		 * @return true , if unsuccessful , return false
		 */ 		
		
		function truncate($table_name)
		{
			return $this->ci->crud_model->truncate($table_name);
		}
		
		function generate_uniqid($table_name,$uniq_id_field,$prefix)
		{
			return $this->ci->crud_model->generate_uniqid($table_name,$uniq_id_field,$prefix);
		}
	}
?>
