<?php 
if (!empty($classes)) :
	if (!is_array($classes))
	{
		// force to an array of classes to loop through in case mutliple exist in a file (e.g Fuel_modules)
		$classes = array($classes);
	}
	foreach($classes as $class) :
?>
<?php if (!empty($class)) : ?>
<?php 
$comment = $class->comment();

if (strtoupper($comment->tags('autodoc')) != 'FALSE') :
?>
<h1><?=$class->friendly_name()?> Class</h1>
<?php
$comment->add_filter($user_guide_links_func);
echo $comment->description(array('long', 'periods', 'markdown'));

$example = $comment->example();
if ($example) :
	echo user_guide_block('example', array('example' => $example));
endif;
?>
<?php if ($class->parent()) : ?>
<p>This class extends the <a href="<?=user_guide_url('modules/'.$module.'/'.strtolower($class->parent()))?>"><?=$class->parent()?></a> class.</p>
<?php endif; ?>

<?=user_guide_block('properties', array('class' => $class)) ?>

<?=user_guide_block('function_list', array('class' => $class)) ?>

<?php endif; ?>
<?php endif; ?>
<br /><br />
<?php endforeach; ?>
<?php endif; ?>
