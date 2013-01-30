custom-crud-library-for-codeigniter
===================================

This library is intend to save our developing time on doing repeatedly crud method.Using it with avoid to do crud 
in model repeatedly and clean your hand .

Installation
============
Just download and extract zip file . And then , place crud.php into application/libraries and crud_model.php into
application/models .


Basic Usage
===========
Before you use this library , need to load it. So , in autoload.php or in your controller as you like .
	
		$this->load->library('crud');

After loading it ,

Insert
======

		$this->crud->insert($table_name,$data);

First parameter $table_name means the table name where you want to insert . Second parameter $data is an array
which contains the data what you want to insert . ( Note - array key must be same with the fields of your table ) 
If the process is successful , it'll return inserted id . If not , return false .

Additional feature for insert method is generating uniqe id . Sometime , we use our custom id which is generated
programatically as we want . eg - aka_1, tuts_27 . For that case , we just solve it with passing two additional
parameters ,

		$this->crud->insert($table_name,$data,$field,$prefix);

Third parameter $field means the field name of custom unique id in your table . The last one $prefix is prefix of
your unique id , eg - aka_ is the prefix of aka_1 , like that .

Update
======

		$data = array(
			'salary' => '5000',
		);
		$where[0]['where_field'] = 'active';
		$where[0]['where_key'] = '1';
	  	$where[1]['where_field'] = 'employer_type';
		$where[1]['where_key'] = '3';      
	     	$table_name = 'test';
		$this->crud->update($table_name,$data,$where);
      
Update method takes three parameters , 
1. $table_name where you want to update.
2. $data what you want to update.
3. $where is an array what you want to rule when updating .

It is similar to be ..

      $this->db->where($where[0]['where_field'],$where[0]['where_key'])
               ->where($where[1]['where_field'],$where[1]['where_key'])
               ->update($table_name,$data);


Delete
======
Deleting closely looks like updating . Only one of the difference is not need to pass data array.
so , syntax will like that .

		$where[0]['where_field'] = 'id';
		$where[0]['where_key'] = '3';     
	     	$table_name = 'test';
		$this->crud->update($table_name,$data,$where);

It is similar to be ..

      $this->db->where($where[0]['where_field'],$where[0]['where_key'])
               ->delete($table_name,$data);
               
Get
===
Get makes you sligtly confusing to you . But don't worry . I'll explain you as much as I can .
Basic syntax is ..

		$this->crud->get($table_name,$where,$rule,$join);

1. $table_name is just where you want to get data from .
2. $where is just a where clause . You can pass unlimited where statements . But you need to pass it
with two two dimensional array .
