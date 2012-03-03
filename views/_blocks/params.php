<?php if (!empty($params)) : ?>
<h4>Parameters</h4>
<pre>
<?php 
if (!empty($params))
{
	foreach($params as $param) :
	echo "* @param ".$param."\n";
	endforeach;
}
?>
</pre>
<?php endif; ?>