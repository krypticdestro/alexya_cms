<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-26 15:57:57
         compiled from "/home/ubuntu/workspace/themes/alexya/login.html" */ ?>
<?php /*%%SmartyHeaderCode:149232181955118ac87a8fb8-61399615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9acb1c8bc3aa2d6ebc1bbfa4256fc3ba2763f93a' => 
    array (
      0 => '/home/ubuntu/workspace/themes/alexya/login.html',
      1 => 1427380350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149232181955118ac87a8fb8-61399615',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55118ac88242e0_23999056',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55118ac88242e0_23999056')) {function content_55118ac88242e0_23999056($_smarty_tpl) {?>                <!-- First Blog Post -->
                <h2>
                    Login
                </h2>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <form method="post" name="login">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="subaction" value="login" />
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" /> <br/>
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" /> <br/>
                                </div>
                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-primary" value="Login" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form method="post" name="register">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="subaction" value="register" />
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" /> <br/>
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" /> <br/>
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" /> <br/>
                                </div>
                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-primary" value="Register" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr><?php }} ?>
