<?php 
/*
 * A simple custom crud model
 * 
 * This model is intend to save our developing time on doing repeatedly crud method.
 * Using it with avoid to do crud in model repeatedly and clean your hand .
 * 
 * @author Arkar Aung
 * @copyright 2012 Arkar Aung
 * @license http://opensource.org/licenses/MIT MIT License
 * 
*/

  class Crud_model extends CI_Model
	{

		/** 
		 * Inserting data to a specify table in database .
		 * 
		 * Accepts two variables 
		 * 
		 * @param $table_name a name of table which you want to insert
		 * @param $data an array which is update to above table
		 * @return inserted id if unsuccessful , return false
		 */ 
					
		function insert($table_name,$data)
		{
			if($this->db->insert($table_name,$data))
			{
				return $this->db->insert_id($table_name);
			}
			return false;
		}
		
		/** 
		 * Updating data to a specify table in database .
		 * 
		 * Accepts four variables 
		 * 
		 * @param $table_name a name of table which you want to update
		 * @param $data an array which is update to above table
		 * @param $where an array which contains field and key to update
		 * @return true , if unsuccessful , return false
		 */ 		
			
		
		function update($table_name,$data,$where = array())
		{
			if(isset($where))
			{
				foreach($where as $w)
				{
					if(isset($w['where_field']) && isset($w['where_key']))
					{
						$this->db->where($w['where_field'],$w['where_key']);
					}
				}
			}			
			if($this->db->update($table_name,$data))
			{
				return true;
			}
			return false;			
		}
		
		/** 
		 * Getting require data and send to crud_model to delete to a 
		 * specify table in database .
		 * 
		 * Accepts three variables 
		 * 
		 * @param $table_name a name of table which you want to delete
		 * @param $where an array which contains field and key to delete 
		 * @return true , if unsuccessful , return false
		 */ 		
		
		function delete($table_name,$where = array())
		{
			if(isset($where))
			{
				foreach($where as $w)
				{
					if(isset($w['where_field']) && isset($w['where_key']))
					{
						$this->db->where($w['where_field'],$w['where_key']);
					}
				}
			}
			if($this->db->delete($table_name))
			{
				return true;
			}
			return false;
		}
		
		/** 
		 * Generating custom unique id .
		 * 
		 * Get and check the last id . If it exists , plus one and append 
		 * to your custom prefix . If not exists, return prefix and 1 . 
		 * 
		 * Accepts three variables 
		 * 
		 * @param $table_name a name of table which exist your unique id .
		 * @param $field a field name of above table which is an uniqe value 
		 * @param $prefix a prefix value of your custom id  
		 * @return $uniqid a generated custom unique id
		 */ 		
		
		function generate_uniqid($table_name,$field,$prefix)
		{
			$query = $this->db->order_by($field,'desc')->limit(1)->get($table_name)->result_array();
			if($query)
			{			
				$query = array_shift($query);			
				$uniqid = $query[$field];
				$temp = substr($uniqid,strlen($prefix),strlen($prefix)+1);
				$temp = $temp + 1;
				$uniqid	= $prefix.$temp;		
			
			}
			else
			{
				$uniqid = $prefix.'1';
			}
			return $uniqid;
		}
		
		/** 
		 * Getting all data from your selected table .
		 * 
		 * Get all record from your selected table as your defined rules 
		 * 
		 * Accepts two variables 
		 * 
		 * @param $table_name a name of table from which you want to get data .
		 * @param $rule an array for order_by , limit , like  
		 * @return data match with $rule
		 */ 		
		
		function get($table_name,$rule = array())
		{
			if(isset($rule['order_by']) && isset($rule['order_field']))
			{
				$rule['order_by'] = 'desc';
				$this->db->order_by($rule['order_field'],$rule['order_by']);
			}

			if(isset($rule['limit']))
			{
				$this->db->limit($rule['limit']);
			}	
			
			if(isset($rule['like_field']) && isset($rule['like_key']))	
			{
				$this->db->like($rule['like_field'],$rule['like_key']);	
			}	
				
			if(isset($rule['group_by']))	
			{
				$this->db->group_by($rule['group_by']); 
			}	
			
			if(isset($rule['having_field'] && $rule['having_key'])
			{
				$this->db->having($rule['having_field'], $rule['having_key']); 
			}
			
			if(isset($rule['distinct']) && $rule['distinct'] == true)
			{
				$this->db->distinct();
			}
				
			$query = $this->db->get($table_name)->result_array();
			if($query)
			{
				return $query;
			}
			return false;
		}
		
		/** 
		 * Getting data match with $where from your selected table .
		 * 
		 * Get all record from your selected table as your defined rules 
		 * 
		 * Accepts two variables 
		 * 
		 * @param $table_name a name of table from which you want to get data .
		 * @param $where an array which is a rule for getting data 
		 * @return data match with $rule
		 */ 		
		
		function get_byKey($table_name,$where = array(),$join = array())
		{		
			if(isset($join))
			{		
				foreach($join as $j)
				{
					if(isset($j['target_field']) && isset($j['target_table']) && isset($j['parent_field']))
					{
						$this->db->join($j['target_table'],$j['target_table'].'.'.$j['target_field'].'='.$table_name.'.'.$j['parent_field']);
					}
				}
			}
			if(isset($where))
			{
				foreach($where as $w)
				{
					if(isset($w['where_field']) && isset($w['where_table']))
					{
						$this->db->where($w['where_field'],$w['where_key']);
					}
				}
			}
			$query = $this->db->get($table_name)->result_array();
			if($query)
			{
				return array_shift($query);
			}
			return false;
		}
		
	}
?>