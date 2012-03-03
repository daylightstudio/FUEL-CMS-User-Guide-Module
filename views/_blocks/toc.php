<?php if (!empty($libraries)) : ?>
<h2>Libraries</h2>
<ul>
	<?php foreach($libraries as $link => $library): ?>
	<li><?=anchor($link, $library)?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

<?php if (!empty($helpers)) : ?>
<h2>Helpers</h2>
<ul>
	<?php foreach($helpers as $link => $helper): ?>
	<li><?=anchor($link, $helper)?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>