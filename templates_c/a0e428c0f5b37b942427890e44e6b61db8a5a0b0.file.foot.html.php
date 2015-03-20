<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-20 09:18:32
         compiled from "themes/alexya/includes/foot.html" */ ?>
<?php /*%%SmartyHeaderCode:2001261423550b13d350c000-33982063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0e428c0f5b37b942427890e44e6b61db8a5a0b0' => 
    array (
      0 => 'themes/alexya/includes/foot.html',
      1 => 1426857304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2001261423550b13d350c000-33982063',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550b13d3511e72_48794694',
  'variables' => 
  array (
    'Alexya' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550b13d3511e72_48794694')) {function content_550b13d3511e72_48794694($_smarty_tpl) {?>
			<hr>
			<!-- Footer -->
			<footer>
				<div class="row">
					<div class="col-lg-12">
						<p>Copyright &copy; Powered by Alexya</p>
					</div>
					<!-- /.col-lg-12 -->
				</div>
			<!-- /.row -->
			</footer>
		</div>
		<!-- /.container -->
		<!-- jQuery -->
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->js;?>
vendor/jquery.min.js"><?php echo '</script'; ?>
>
		<!-- Bootstrap Core JavaScript -->
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->js;?>
vendor/bootstrap.min.js"><?php echo '</script'; ?>
>
	</body>
</html><?php }} ?>
