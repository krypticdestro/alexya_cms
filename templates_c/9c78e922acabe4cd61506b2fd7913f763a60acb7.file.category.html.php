<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-12 19:35:23
         compiled from "/home/ubuntu/workspace/themes/alexya/category.html" */ ?>
<?php /*%%SmartyHeaderCode:63341865521796bd109d0-07446357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c78e922acabe4cd61506b2fd7913f763a60acb7' => 
    array (
      0 => '/home/ubuntu/workspace/themes/alexya/category.html',
      1 => 1431459318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63341865521796bd109d0-07446357',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5521796bdd14d5_47448336',
  'variables' => 
  array (
    'Category' => 0,
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
<?php if ($_valid && !is_callable('content_5521796bdd14d5_47448336')) {function content_5521796bdd14d5_47448336($_smarty_tpl) {?><?php if (isset($_GET['category'])&&!empty($_GET['category'])) {?>
    <?php $_smarty_tpl->tpl_vars['Category'] = new Smarty_variable(SmartyLoader::instance_object("Category",$_GET['category']), null, 0);?>
    
    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Category']->value->getPosts(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
        <?php }
if (!$_smarty_tpl->tpl_vars['post']->_loop) {
?>
            <p>The category doesn't exists or hasn't got any post yet!</p>
        <?php } ?>
                <!-- Pager --
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->
<?php } else { ?>
    <p>Please select a category!</p>
<?php }?><?php }} ?>
