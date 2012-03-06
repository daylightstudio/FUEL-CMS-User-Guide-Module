<?php if (!empty($params)) : ?>
<h4>Parameters</h4>
<pre>
<?php 
if (!empty($params))
{
	foreach($params as $key => $param) :
	
	$comment_param = (isset($comment_params[$key])) ? $comment_params[$key] : '';
	$param_comment = '';
	$param_type = '';
	if (isset($comment_params[$key]))
	{
		preg_match('#(\w+)\s+(.+)#', $comment_param, $matches);
		$param_type = (isset($matches[1])) ? $matches[1] : '';
		$param_comment = (isset($matches[2])) ? $matches[2] : '';
	}
	echo"(".$param_type.") <strong>$".$param->name."</strong> ".$param_comment."\n";
	endforeach;
}
?>
</pre>
<?php endif; ?>