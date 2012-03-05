<?php if (!empty($class)) : ?>

<h1><?=$class->friendly_name()?> Class</h1>
<?=$class->comment()->description(array('long', 'periods', 'one_line', 'markdown'))?>


<?=user_guide_block('properties', array('class' => $class)) ?>

<?=user_guide_block('function_list', array('class' => $class)) ?>

<?php endif; ?>