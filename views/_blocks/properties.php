<?php if ($class->properties(array('public', 'protected'))) : ?>
<h2>Properties Reference</h2>
<table border="0" cellspacing="1" cellpadding="0" class="tableborder">
	<tbody>
		<tr>
			<th>Property</th>
			<th>Default Value</th>
			<th>Description</th>
		</tr>
	<?php 
	$types = array('public', 'protected');
	foreach($types as $type) : 
	$props = $class->properties($type);
	if (!empty($props)) :
	?>
		<tr>
			<td colspan="3" class="hdr"><?=$type?></td>
		</tr>
	<?php endif; ?>
	<?php foreach($props as $prop => $prop_obj) : ?>
			<tr>
				<td><strong><?=$prop?></strong></td>
				<td>
					<?php
					if ($type != 'public') 
					{
						echo 'N/A';
					}
					else if (is_array($prop_obj->value))
					{
						echo "<pre>";
						if (!empty($prop_obj->value))
						{
							$last = count($prop_obj->value) - 1;
							echo "array(";
							foreach($prop_obj->value as $key => $val)
							{
								$is_last = $key == $last;
								if (!is_int($key))
								{
									echo "'".$key."' => ";
								}
								
								if (!is_object($val))
								{
									if (is_string($val)) echo "'";
									echo str_replace('Array', 'array', print_r($val, TRUE));
									if (is_string($val)) echo "'";
									if (!$is_last) echo ', ';
								}
								//echo "\n";
							}
							echo ')';	
							// echo "<pre>";
							// print_r($prop_obj->value);
							// echo "</pre>";
						}
						else
						{
							echo "array()";
						}

						echo "</pre>";
						
					}
					else if (empty($prop_obj->value))
					{
						echo 'none';
					}
					else if (is_object($prop_obj->value))
					{
						echo 'object';
					}
					else if (is_string($prop_obj->value))
					{
						echo str_replace(array("\n", "\t"), array('\n', '\t'), htmlentities($prop_obj->value));
					} 
					else if (!empty($prop_obj->value))
					{
						echo htmlentities($prop_obj->value);
					}
					?>
				</td>
				<td><?=$prop_obj->comment->description(array('entities', 'ucfirst'))?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	</tbody>
</table>

<br />
<?php endif; ?>