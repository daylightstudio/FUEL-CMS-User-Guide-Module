<h1>User Guide Documentation</h1>
<p>Yes... the User Guide, has it's own User Guide documentation. This is because not only is it the main source of FUEL CMS documentation, but it also
provides functionality for you to easily create and incorporate your own documentation.</p>

<h2>Creating Site Documentation</h2>
<p>Documentation specific for your site, should be placed in the <span class="file">fuel/application/views/_docs/index.php</span> folder. This will be accessible from the <a href="<?=user_guide_url('general/dashoard')?>">CMS dashboard</a> page.</p>

<h2>Creating Advanced Module Documentation</h2>
<p>You can create documentation for your own modules by creating an index.php file containing your documentatin and placing it in the <span class="file">fuel/{module}/views/_docs/</span>.
The User Guide module provides <a href="<?=user_guide_url('modules/user_guide/user_guide_helper')?>">several functions</a> that can automatically generate documentation for your own modules including,
creating a <a href="<?=user_guide_url('modules/user_guide/user_guide_helper#generate_toc')?>">table of contents</a>, 
<a href="<?=user_guide_url('modules/user_guide/user_guide_helper#generate_docs')?>">libraries</a>, 
<a href="<?=user_guide_url('modules/user_guide/user_guide_helper#generate_docs')?>">classes</a>, and 
<a href="<?=user_guide_url('modules/user_guide/user_guide_helper#generate_config_info')?>">configuration files</a>.
</p>

<p>To prevent auto generation of a class or helper, add <dfn>* @autodoc FALSE</dfn> in the class or helpers doc block like so:</p>
<pre class="brush:php">
/**
 * My class
 *
 * @autodoc		FALSE
 */
</pre>

<p class="important">For a class library's documentation to be automatically generated, the class cannot be abstract and must not require parameters to be passed to the constructor method.</p>

<p class="important"><strong>Where is the file?</strong> If you are looking for a user guide file and can't find it, chances are it is being automatically generated so you may want to check the source file and it's comments.</p>

<?=generate_config_info()?>

<?=generate_toc();?>
