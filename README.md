custom-crud-library-for-codeigniter
===================================

This library is intend to save our developing time on doing repeatedly crud method.Using it with avoid to do crud 
in model repeatedly and to clean your hand . There was a lot of crud library for codeigniter . Grocery Crud is the
well-known library . Easy to use and with ready made UI . I highly recommand to you unsing Grocery is the best way
to use for simple database structure . But sometime , when we face the complex database structure , from only my 
point of view , It is slightly difficult to handle that . So , I decided to create that , custom crud library . 
It won't be perfect like grocery library because it was created as I needed at my work . But You can freely use ,
modify and contribute it . 

-------------------------------------------------------------------------------------------------------------

Installation
============
Just download and extract zip file . And then , place crud.php into application/libraries and crud_model.php into
application/models .

-------------------------------------------------------------------------------------------------------------

Basic Usage
===========
Before you use this library , need to load it. So , in autoload.php or in your controller as you like .
	
		$this->load->library('crud');

After loading it ,

-------------------------------------------------------------------------------------------------------------

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
your unique id , eg - aka_ is the prefix of aka_1 , like that . It'll return generated unique id .

-------------------------------------------------------------------------------------------------------------

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

It'll return true if success. If not , return false .

-------------------------------------------------------------------------------------------------------------

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

It'll return true if success. If not , return false .

-------------------------------------------------------------------------------------------------------------
               
Get
===
Get makes you sligtly confuse to you . But don't worry . I'll explain you as much as I can .
Basic syntax is ..

		$this->crud->get($table_name,$where,$rule,$join);


- $table_name is just where you want to get data from .
- $where is just a where clause . You can pass unlimited where statements . But you need to pass it
with two dimensional array . This is because we need to pass both field where you want to and key what you
want to .
- $rule means conditional clauses like order_by ,distinct ,like , group_by ,etc . Some clause need two 
parameters and some need one parameter .
- $join means join clause . It can use unlimited . You also need to pass it with two dimensional array.
But , It takes three fields that are table name where you want to join to , field_1 what you want to join
with , field_2 what you want to join with from selected table .

It looks like that ..

			$join[0]['target_table'] = 'category';
			$join[0]['target_field'] = 'id';
			$join[0]['parent_field'] = 'category_id';
			$join[1]['target_table'] = 'price';
			$join[1]['target_field'] = 'id';
			$join[1]['parent_field'] = 'price_id';			
			$rule['order_by'] = 'desc';
			$rule['order_field'] = 'id'
			$where[0]['where_field'] = 'active';
			$where[0]['where_key'] = '1';
			$table_name = 'test';
			$this->crud->get($table_name,$where,$rule,$join);
			
It'll return array if your passing data is match with database . Use foreach loop to get each segment
of return array . if not , return false .

-------------------------------------------------------------------------------------------------------------

Get by Key
==========
Basic syntax is ..

		$this->crud->get($table_name,$where,$join);

It is same with Get . But We can kick out $rule array .So, it'll take 3 parameters . It intends
to use getting an exact row . In the other way , When we get a certain row by id , we should use it .

			$join[0]['target_table'] = 'category';
			$join[0]['target_field'] = 'id';
			$join[0]['parent_field'] = 'category_id';		
			$where[0]['where_field'] = 'id';
			$where[0]['where_key'] = '1';
			$table_name = 'test';
			$this->crud->get($table_name,$where,$join);
			
It'll return one dimensional array if your passing data is match with database . So , We don't need to
do foreach loop again . Just ready to use . if not , return false .

Truncate
========
Truncate is no need to explain in detail . We all know it that is using for empty the table . So , It'll take
simply one parameter , table name where you want to empty to .
Basic syntax is ..

		$this->crud->truncate($table_name);

-------------------------------------------------------------------------------------------------------------

**Demo will be soon !**


