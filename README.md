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
Before you use this library , need to load it.
$this->load->library('crud');

After loading it ,

$this->crud->insert($table_name,$data);

First parameter $table_name means the table name where you want to insert . Second parameter $data is an array
which contains the data what you want to insert . ( Note - array key must be same with the fields of your table ) 
