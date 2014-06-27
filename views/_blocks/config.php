<?php if ($config) : ?>
<h2><?=humanize($module)?> Configuration</h2>
<p>The following configuration parameters can be found in the <dfn>modules/<?=$module?>/config/<?=$module?>.php</dfn> configuration file. 
	It is recommended that you copy the config file and place it in your <dfn>fuel/application/config</dfn> directory which will override the defaults and make it easier for future updates.</p>
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