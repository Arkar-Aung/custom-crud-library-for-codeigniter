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
