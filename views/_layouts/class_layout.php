<?php if (!empty($class)) : ?>

<h1><?=$class->friendly_name()?> Class</h1>
<?php
$comment = $class->comment();
$comment->add_filter($user_guide_links_func);
echo $comment->description(array('long', 'periods', 'one_line', 'markdown'));
?>
<?php if ($class->parent()) : ?>
<p>This class extends the <a href="<?=user_guide_url('modules/'.$module.'/'.strtolower($class->parent()))?>"><?=$class->parent()?></a> class.</p>
<?php endif; ?>

<?=user_guide_block('properties', array('class' => $class)) ?>

<?=user_guide_block('function_list', array('class' => $class)) ?>

<?php endif; ?>