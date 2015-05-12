<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-12 19:41:59
         compiled from "/home/ubuntu/workspace/themes/alexya/users.html" */ ?>
<?php /*%%SmartyHeaderCode:19802893105522bcdf84e8c5-78214391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '070b20ac311c4bd927aff50300dc8b2b8981b19a' => 
    array (
      0 => '/home/ubuntu/workspace/themes/alexya/users.html',
      1 => 1431459710,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19802893105522bcdf84e8c5-78214391',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5522bcdf95cf20_40804005',
  'variables' => 
  array (
    'database' => 0,
    'user_page' => 0,
    'Alexya' => 0,
    'comment' => 0,
    'post' => 0,
    'catID' => 0,
    'category' => 0,
    'cat_str' => 0,
    'cat_posts' => 0,
    'comments' => 0,
    'author' => 0,
    'jbbcode' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5522bcdf95cf20_40804005')) {function content_5522bcdf95cf20_40804005($_smarty_tpl) {?><?php if (isset($_GET['users'])&&!empty($_GET['users'])) {?>
    <?php $_smarty_tpl->tpl_vars['user_page'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("users","*",array("username"=>$_GET['users'])), null, 0);?>
    <?php if (is_array($_smarty_tpl->tpl_vars['user_page']->value)) {?>
        <h1><?php echo $_smarty_tpl->tpl_vars['user_page']->value["username"];?>
</h1>
        <div>
            <div class="user_header" >
                <img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->img;?>
default_avatar.jpg" style="float: left; width: 250px; heigh: 250px" />
                <p style="padding-left: 20px">
                    Registered on <?php echo $_smarty_tpl->tpl_vars['user_page']->value["date"];?>
<br/>
                    Last login on <?php echo Functions::getTimeStamp($_smarty_tpl->tpl_vars['user_page']->value["lastLogin"]);?>

                </p>
                <br style="clear: both;" />
            </div>
            <div class="user_comments">
                <h2>Comments</h2>
            <?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value->select("comments","*",array("authorID"=>$_smarty_tpl->tpl_vars['user_page']->value["userID"])); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value) {
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
                <?php $_smarty_tpl->tpl_vars['where_post'] = new Smarty_variable(Functions::concatenate(array("WHERE postID=",$_smarty_tpl->tpl_vars['comment']->value["postID"])), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['post'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("posts","*",array("postID"=>$_smarty_tpl->tpl_vars['comment']->value["postID"])), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->get("users","*",array("userID"=>$_smarty_tpl->tpl_vars['post']->value["authorID"])), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['comments'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->select("comments","*",array("authorID"=>$_smarty_tpl->tpl_vars['user_page']->value["userID"])), null, 0);?>
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
                <hr>
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
                    <?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->parse(Functions::trim_text($_smarty_tpl->tpl_vars['comment']->value["content"]));?>

                    <p><?php echo $_smarty_tpl->tpl_vars['jbbcode']->value->getAsHtml();?>
</p>
                    <a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
posts/<?php echo $_smarty_tpl->tpl_vars['post']->value["permalink"];?>
">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                </div>
            <?php } ?>
            </div>
            <div class="user_comments">
                <h2>Posts</h2>
            <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value->select("posts","*",array("authorID"=>$_smarty_tpl->tpl_vars['user_page']->value["userID"])); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                <?php $_smarty_tpl->tpl_vars['comments'] = new Smarty_variable($_smarty_tpl->tpl_vars['database']->value->select("comments","*",array("postID"=>$_smarty_tpl->tpl_vars['comment']->value["postID"])), null, 0);?>
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
                <hr>
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
"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
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
            </div>
        </div>
        <!-- Blog Comments -->
    <?php } else { ?>
        <p>The user wasn't found in the database!</p>
    <?php }?>
<?php } else { ?>
    <?php  $_smarty_tpl->tpl_vars['user_page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user_page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['database']->value->select("users","*"); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user_page']->key => $_smarty_tpl->tpl_vars['user_page']->value) {
$_smarty_tpl->tpl_vars['user_page']->_loop = true;
?>
        <div id="<?php echo $_smarty_tpl->tpl_vars['user_page']->value["userID"];?>
" style="position: relative;">
            <!-- First Blog Post -->
            <h2>
                <a href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->url;?>
users/<?php echo $_smarty_tpl->tpl_vars['user_page']->value["username"];?>
"><?php echo $_smarty_tpl->tpl_vars['user_page']->value["username"];?>
</a>
            </h2>
            <img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->img;?>
default_avatar.jpg" style="float: left; width: 150px; heigh: 150px" />
                <p style="padding-left: 20px">
                    Registered on <?php echo $_smarty_tpl->tpl_vars['user_page']->value["date"];?>
<br/>
                    Last login on <?php echo Functions::getTimeStamp($_smarty_tpl->tpl_vars['user_page']->value["lastLogin"]);?>

                </p>
                <br style="clear: both;" />
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
