My Model
==========

Simple wrapper to acess data from mysql.

Usage
===
```
class FooModel extends Model{
	
	function __construct(){
		$this->table  = "foo_table";
		$this->col_id = "idfoo";
	}
}

-----

 $foos     = new FooModel();
 $listFoo  = $foos->getAll();

 $otherfoo = $foos->getById($id);

```

Autor - www.cristianoliveira.com.br
