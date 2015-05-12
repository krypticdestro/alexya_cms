<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-11 17:26:36
         compiled from "/home/ubuntu/workspace/themes/alexya/posts.html" */ ?>
<?php /*%%SmartyHeaderCode:607019654551c59f01b0eb8-43461764%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2bd65b7b5a2d48842acebb254c262682a1c78e9' => 
    array (
      0 => '/home/ubuntu/workspace/themes/alexya/posts.html',
      1 => 1431365193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '607019654551c59f01b0eb8-43461764',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_551c59f02fba53_41699700',
  'variables' => 
  array (
    'database' => 0,
    'post' => 0,
    'catID' => 0,
    'category' => 0,
    'cat_str' => 0,
    'cat_posts' => 0,
    'Alexya' => 0,
    'author' => 0,
    'jbbcode' => 0,
    'comments' => 0,
    'comment' => 0,
    'comment_author' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551c59f02fba53_41699700')) {function content_551c59f02fba53_41699700($_smarty_tpl) {?><?php if (isset($_GET['posts'])&&!empty($_GET['posts'])) {?>
    <?php $_smarty_tpl->tpl_vars['post'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("posts","*",array("permalink"=>$_GET['posts'])), null, 0);?>
    <?php if (is_array($_smarty_tpl->tpl_vars['post']->value)) {?>
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
            <?php $_smarty_tpl->tpl_vars['cat_str'] = new Smarty_variable(Functions::concatenate(array($_smarty_tpl->tpl_vars['cat_str']->value,'<a href="/category/',$_smarty_tpl->tpl_vars['category']->value->data["permalink"],'">',$_smarty_tpl->tpl_vars['category']->value->data["name"],' (',$_smarty_tpl->tpl_vars['cat_posts']->value,')</a>')), null, 0);?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['categories']['last']==false) {?>
                <?php $_smarty_tpl->tpl_vars['cat_str'] = new Smarty_variable(Functions::concatenate(array($_smarty_tpl->tpl_vars['cat_str']->value,", ")), null, 0);?>
            <?php }?>
        <?php } ?>
        <!-- de aquí en adelante el post existe -->
        <h1><?php echo $_smarty_tpl->tpl_vars['post']->value["title"];?>
</h1>
        
        <p>
            by <a href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
user/<?php echo $_smarty_tpl->tpl_vars['author']->value["username"];?>
"><?php echo $_smarty_tpl->tpl_vars['author']->value["username"];?>
</a> on <small><?php echo $_smarty_tpl->tpl_vars['cat_str']->value;?>
</small>
            <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $_smarty_tpl->tpl_vars['post']->value["date"];?>

        </p>
        <hr>
        
        <img class="img-responsive" src="http://placehold.it/900x300&text=<?php echo $_smarty_tpl->tpl_vars['post']->value["title"];?>
" alt="" />
        <hr>
        <!-- content op -->
        <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->parse($_smarty_tpl->tpl_vars['post']->value["content"]);?>

        <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->getAsHtml();?>

        <hr>
        <!-- Blog Comments -->
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post" action="/posts/<?php echo $_smarty_tpl->tpl_vars['post']->value["permalink"];?>
">
                <input type="hidden" name="subaction" value="post_comment" />
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <hr>
        <!-- Posted Comments -->
        <?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value) {
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars['comment_author'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("users","*",array("userID"=>$_smarty_tpl->tpl_vars['comment']->value["authorID"])), null, 0);?>
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="/users/<?php echo $_smarty_tpl->tpl_vars['comment_author']->value["username"];?>
">
                <img class="media-object" src="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->img;?>
default_avatar.jpg" style="width: 150px; heigh: 150px">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $_smarty_tpl->tpl_vars['comment_author']->value["username"];?>

                    <small><?php echo $_smarty_tpl->tpl_vars['comment']->value["date"];?>
</small>
                </h4>
                <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->parse($_smarty_tpl->tpl_vars['comment']->value["content"]);?>

                <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->getAsHtml();?>

            </div>
        </div>
        <?php }
if (!$_smarty_tpl->tpl_vars['comment']->_loop) {
?>
        <div class="media">
            <div class="media-body">
                No comments yet!
            </div>
        </div>
        <?php } ?>
    <?php } else { ?>
        <p>The post wasn't found in the database!</p>
    <?php }?>
<?php } else { ?>
    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = Posts::getAll(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("users","*",array("authorID"=>$_smarty_tpl->tpl_vars['post']->value["authorID"])), null, 0);?>
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
            </ul> -->
<?php }?><?php }} ?>
