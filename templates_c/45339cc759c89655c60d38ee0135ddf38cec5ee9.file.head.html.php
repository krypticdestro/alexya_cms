<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-23 17:32:17
         compiled from "themes/alexya/includes/head.html" */ ?>
<?php /*%%SmartyHeaderCode:719934045550ff8dd9242c8-94956882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45339cc759c89655c60d38ee0135ddf38cec5ee9' => 
    array (
      0 => 'themes/alexya/includes/head.html',
      1 => 1427131617,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '719934045550ff8dd9242c8-94956882',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550ff8dd9c3c90_21694119',
  'variables' => 
  array (
    'Alexya' => 0,
    'menu' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550ff8dd9c3c90_21694119')) {function content_550ff8dd9c3c90_21694119($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->site_description;?>
">
		<meta name="author" content="Kryptic Destro">
		<title><?php echo $_smarty_tpl->tpl_vars['Alexya']->value->site_name;?>
</title>
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->css;?>
bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?php echo $_smarty_tpl->tpl_vars['Alexya']->value->theme->paths->css;?>
main.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
		<![endif]-->
	</head>
	<body>
         <!-- Navigation -->
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $_smarty_tpl->tpl_vars['Alexya']->value->site_name;?>
</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value["link"];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value["text"];?>
</a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- Page Content -->
        <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    <?php echo $_smarty_tpl->tpl_vars['Alexya']->value->site_name;?>
<br/>
                    <small><?php echo $_smarty_tpl->tpl_vars['Alexya']->value->site_description;?>
</small>
                </h1><?php }} ?>
