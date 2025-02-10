<?php
/* Smarty version 5.4.1, created on 2024-10-29 20:16:41
  from 'file:C:\MAGAZYN\Serwery\xampp\htdocs\php_04_uproszczony/app/calc.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_67213499548255_59815333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '804d1a7ea7baaa4f3d1d862a12549564796f82f3' => 
    array (
      0 => 'C:\\MAGAZYN\\Serwery\\xampp\\htdocs\\php_04_uproszczony/app/calc.html',
      1 => 1490291280,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67213499548255_59815333 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\MAGAZYN\\Serwery\\xampp\\htdocs\\php_04_uproszczony\\app';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_166550855467213499530fe6_28535973', 'footer');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_24735075467213499535428_82811586', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "../templates/main.html", $_smarty_current_dir);
}
/* {block 'footer'} */
class Block_166550855467213499530fe6_28535973 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\MAGAZYN\\Serwery\\xampp\\htdocs\\php_04_uproszczony\\app';
?>
przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_24735075467213499535428_82811586 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\MAGAZYN\\Serwery\\xampp\\htdocs\\php_04_uproszczony\\app';
?>


<h3>Prosty kalkulator</h2>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->getValue('app_url');?>
/app/calc.php" method="post">
	<fieldset>
		<label for="x">Pierwsza liczba</label>
		<input id="x" type="text" placeholder="wartość x" name="x" value="<?php echo $_smarty_tpl->getValue('form')['x'];?>
">
		<label for="op">Operacja</label>
		<select id="op" name="op">

<?php if ((null !== ($_smarty_tpl->getValue('form')['op_name'] ?? null))) {?>
<option value="<?php echo $_smarty_tpl->getValue('form')['op'];?>
">ponownie: <?php echo $_smarty_tpl->getValue('form')['op_name'];?>
</option>
<option value="" disabled="true">---</option>
<?php }?>
			<option value="plus">(+) dodaj</option>
			<option value="minus">(-) odejmij </option>
			<option value="times">(*) pomnóż</option>
			<option value="div">(/) podziel</option>
		</select>
					
		<label for="y">Druga liczba</label>
		<input id="y" type="text" placeholder="wartość y" name="y" value="<?php echo $_smarty_tpl->getValue('form')['y'];?>
">
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

<?php if ((null !== ($_smarty_tpl->getValue('messages') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('messages')) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('infos') ?? null))) {?>
	<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('infos')) > 0) {?> 
		<h4>Informacje: </h4>
		<ol class="inf">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('infos'), 'msg');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach1DoElse = false;
?>
		<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((null !== ($_smarty_tpl->getValue('result') ?? null))) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->getValue('result');?>

	</p>
<?php }?>

</div>

<?php
}
}
/* {/block 'content'} */
}
