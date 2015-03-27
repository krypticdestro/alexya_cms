<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-26 12:31:38
         compiled from "themes/alexya/includes/foot.html" */ ?>
<?php /*%%SmartyHeaderCode:2125926208550ff8dda68104-31055734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bcd78ed1d7ddf424d1272bb80d8706ab2bfee8d' => 
    array (
      0 => 'themes/alexya/includes/foot.html',
      1 => 1427373088,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2125926208550ff8dda68104-31055734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550ff8dda7c3c3_20491123',
  'variables' => 
  array (
    'database' => 0,
    'Alexya' => 0,
    'cat' => 0,
    'alexya' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550ff8dda7c3c3_20491123')) {function content_550ff8dda7c3c3_20491123($_smarty_tpl) {?>			</div>
	        <!-- Blog Sidebar Widgets Column -->
	        <div class="col-md-4">
	            <!-- Blog Search Well -->
	            <div class="well">
	                <h4>Blog Search</h4>
	                <div class="input-group">
	                    <input type="text" class="form-control">
	                    <span class="input-group-btn">
	                        <button class="btn btn-default" type="button">
	                            <span class="glyphicon glyphicon-search"></span>
	                        </button>
	                    </span>
	                </div> <!-- /.input-group -->
	            </div>
	            <!-- Blog Categories Well -->
	            <div class="well">
	                <h4>Blog Categories</h4>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <ul class="list-unstyled">
	                    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value->get("categories"); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['cat_sidebar']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['cat_sidebar']['iteration']++;
?>
	                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
category/<?php echo $_smarty_tpl->tpl_vars['cat']->value["permalink"];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value["name"];?>
</a></li>
	                        <?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['cat_sidebar']['iteration']%6)==0) {?>
	                        	</ul>
	                        </div> <!-- /.col-lg-6 -->
	                        <div class="col-lg-6">
	                            <ul class="list-unstyled">
	                        <?php }?>
	                    <?php } ?>
	                            </ul>
	                        </div> <!-- /.col-lg-6 -->
	                    </div> <!-- /.row -->
	                </div>
	                <!-- Side Widget Well -->
	                <div class="well">
	                    <h4>Latest users</h4>
	                    <ul>
	                    <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value->get("users","ORDER BY date DESC"); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
	                    	<li><a href="<?php echo $_smarty_tpl->tpl_vars['alexya']->value->url;?>
user/<?php echo $_smarty_tpl->tpl_vars['u']->value["username"];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value["username"];?>
 (<?php echo $_smarty_tpl->tpl_vars['u']->value["date"];?>
)</a></li>
	                    <?php }
if (!$_smarty_tpl->tpl_vars['u']->_loop) {
?>
	                    	<li>No users registered yet!</li>
	                    <?php } ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <!-- /.row -->
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
