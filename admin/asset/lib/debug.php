<?php
echo '<h3> echo de $_SERVER </h1>';
var_dump($_SERVER);
echo '<hr />';

if(isset($_SESSION))
{
	echo '<h3> echo de $_SESSION</h1>';
	var_dump($_SESSION);
	echo '<hr />';
}

echo '<h3> echo de get_defined_constants()</h1>';
var_dump(get_defined_constants());
echo '<hr />';


echo '<h3> echo de ROOT; </h1>';
var_dump(ROOT);
echo '<hr />';


echo realpath($_SERVER['REQUEST_URI']);
?>