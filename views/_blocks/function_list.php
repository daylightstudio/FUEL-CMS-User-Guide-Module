<h2>Function Reference [<a href="#" class="toggler">+</a>]</h2>

<?php 
$class_name = $class->name;
foreach($class->methods() as $method => $method_obj) :
	$comment = $method_obj->comment;
	$comment->add_filter($user_guide_links_func);
	$parameters = $method_obj->params();
	$description = $comment->description(array('periods', 'one_line', 'markdown'));
	$comment_params = $comment->tags('param', 'type');
	$comment_return = $comment->tags('return');
	$ci_obj_name = (preg_match('#^Fuel_#i', $class_name)) ? 'fuel->'.str_replace('fuel_', '', strtolower($class_name)) : strtolower($class_name);
	
	$example = $comment->example();
	if (empty($example) AND isset($examples[$method]))
	{
		$example = $examples[$method];
	}
?>	
<?=user_guide_block('function', array('function' => $method_obj, 'prefix' => '$this->'.$ci_obj_name.'->')) ?>
<div class="toggle_block">
<?=$description?>

<?=user_guide_block('return', array('return' => $comment_return)) ?>

<?=user_guide_block('params', array('params' => $parameters, 'comment_params' => $comment_params)) ?>

<?=user_guide_block('example', array('example' => $example)) ?>
</div>
<?php endforeach; ?>