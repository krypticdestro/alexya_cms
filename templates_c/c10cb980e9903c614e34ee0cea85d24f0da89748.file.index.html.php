<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-11 17:21:36
         compiled from "/home/ubuntu/workspace/themes/alexya/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1745965288550ff8dd9e40b5-92460262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c10cb980e9903c614e34ee0cea85d24f0da89748' => 
    array (
      0 => '/home/ubuntu/workspace/themes/alexya/index.html',
      1 => 1431364894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1745965288550ff8dd9e40b5-92460262',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550ff8dda1e450_96629214',
  'variables' => 
  array (
    'post' => 0,
    'database' => 0,
    'catID' => 0,
    'category' => 0,
    'cat_str' => 0,
    'cat_posts' => 0,
    'comments' => 0,
    'Alexya' => 0,
    'author' => 0,
    'jbbcode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550ff8dda1e450_96629214')) {function content_550ff8dda1e450_96629214($_smarty_tpl) {?>        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = Posts::getAll(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("users","*",array("userID"=>$_smarty_tpl->tpl_vars['post']->value["authorID"])), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['comments'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->select("comments","*",array("postID"=>$_smarty_tpl->tpl_vars['post']->value["postID"])), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['cat_str'] = new Smarty_variable('', null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['catID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['catID']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['post']->value["categories"]); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['catID']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['catID']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['catID']->key => $_smarty_tpl->tpl_vars['catID']->value) {
$_smarty_tpl->tpl_vars['catID']->_loop = true;
 $_smarty_tpl->tpl_vars['catID']->iteration++;
 $_smarty_tpl->tpl_vars['catID']->last = $_smarty_tpl->tpl_vars['catID']->iteration === $_smarty_tpl->tpl_vars['catID']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['categories']['last'] = $_smarty_tpl->tpl_vars['catID']->last;
?>
                <?php $_smarty_tpl->tpl_vars['category'] = new Smarty_variable(SmartyLoader::instance_object("Category",$_smarty_tpl->tpl_vars['catID']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['cat_posts'] = new Smarty_variable(count(json_decode($_smarty_tpl->tpl_vars['category']->value->data["posts"])), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['cat_str'] = new Smarty_variable(Functions::concatenate(array($_smarty_tpl->tpl_vars['cat_str']->value,'<a href="{$Alexya->url}category/',$_smarty_tpl->tpl_vars['category']->value->data["permalink"],'">',$_smarty_tpl->tpl_vars['category']->value->data["name"],' (',$_smarty_tpl->tpl_vars['cat_posts']->value,')</a>')), null, 0);?>
                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['categories']['last']==false) {?>
                    <?php $_smarty_tpl->tpl_vars['cat_str'] = new Smarty_variable(Functions::concatenate(array($_smarty_tpl->tpl_vars['cat_str']->value,", ")), null, 0);?>
                <?php }?>
            <?php } ?>
            <div id="<?php echo $_smarty_tpl->tpl_vars['post']->value["permalink"];?>
" style="position: relative;">
                <a class="btn btn-primary" style="float: right;"><?php echo count($_smarty_tpl->tpl_vars['comments']->value);?>
 Comments</a>
                <!-- First Blog Post -->
                <h2>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
posts/<?php echo $_smarty_tpl->tpl_vars['post']->value["permalink"];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value["title"];?>
</a>
                </h2>
                <p>
                    by <a href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
users/<?php echo $_smarty_tpl->tpl_vars['author']->value["username"];?>
"><?php echo $_smarty_tpl->tpl_vars['author']->value["username"];?>
</a> on <small><?php echo $_smarty_tpl->tpl_vars['cat_str']->value;?>
</small>
                    <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $_smarty_tpl->tpl_vars['post']->value["date"];?>

                </p>
                <hr>
                
                <img class="img-responsive" src="http://placehold.it/900x300&text=<?php echo $_smarty_tpl->tpl_vars['post']->value["title"];?>
" alt="">
                <hr>
                <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->parse(Functions::trim_text($_smarty_tpl->tpl_vars['post']->value["content"]));?>

                <p><?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->getAsHtml();?>
</p>
                <a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
posts/<?php echo $_smarty_tpl->tpl_vars['post']->value["permalink"];?>
">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            </div>
        <?php } ?>
                <!-- Pager --
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> --><?php }} ?>
