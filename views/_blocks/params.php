<?php if (!empty($params)) : ?>
<?php 
$str = '';

foreach($params as $key => $param) :

$comment_param = (isset($comment_params[$key])) ? $comment_params[$key] : '';
$param_comment = '';
$param_type = '';
if (isset($comment_params[$key]))
{
	preg_match('#(\w+)\s*(.*)#', $comment_param, $matches);
	
	$param_type = (isset($matches[1])) ? $matches[1] : '';
	$param_comment = (isset($matches[2])) ? $matches[2] : '';
	
	if (!empty($param_type)) $str .= "(";
	$str .= $param_type;
	if (!empty($param_type)) $str .= ") ";
	$str .= "<strong>$".$param->name."</strong> ".$param_comment."\n";
}
endforeach;
?>
<?php if (!empty($str)) : ?>
<h4>Parameters</h4>
<pre>
<?=$str?>
</pre>
<?php endif; ?>
<?php endif; ?>