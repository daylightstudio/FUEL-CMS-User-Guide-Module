<?php if ($config) : ?>
<h2><?=ucfirst($module)?> Configuration</h2>

<table border="0" cellspacing="1" cellpadding="0" class="tableborder">
	<tbody>
		<tr>
			<th>Property</th>
			<th>Default Value</th>
			<th>Description</th>
		</tr>
	<?php foreach($config as $key => $c) : ?>
		<tr>
			<td><strong><?=$key?></strong></td>
			<td>
				<?=$c->default_value?>
			</td>
			<td><?=$c->comment?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<br />
<?php endif; ?>