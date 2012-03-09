<?php if (!empty($libraries)) : ?>
<h2>Libraries</h2>
<ul>
	<?php foreach($libraries as $link => $library): ?>
	<li><a href="<?=$link?>"><?=$library?> Class</a></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

<?php if (!empty($helpers)) : ?>
<h2>Helpers</h2>
<ul>
	<?php foreach($helpers as $link => $helper): ?>
	<li><a href="<?=$link?>"><?=$helper?></a></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>