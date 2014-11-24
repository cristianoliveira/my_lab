<?php
 if(!function_exists('apache_get_modules') ){ phpinfo(); exit; }
 $res = 'Module Unavailable';
 if(in_array('mod_rewrite',apache_get_modules())) 
 $res = 'Module Available';
?>
<html>
<head>
<title>A mod_rewrite availability check !</title></head>
<body>
<p><?php echo apache_get_version(),"</p><p>mod_rewrite $res"; ?></p>
<?php
print_r(apache_get_modules());

if (function_exists('apache_get_modules')) {
  $modules = apache_get_modules();
  $mod_rewrite = in_array('mod_rewrite', $modules);
} else {
  $mod_rewrite =  getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
}

echo $mod_rewrite? 'sim':'não';
?>
</body>
</html>