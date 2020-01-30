{*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- Block links module -->
<div id="links_block_left" class="col-md-4 links block">
	{*
	<h3 class="h3 title_block">
		{if $url}
			<a href="{$url}" title="{$title}">{$title}</a>
		{else}
			{$title}
		{/if}
	</h3>
	*}
	<h3 class="h3 title_block hidden-md-down">
		{if $url}
			<a href="{$url}" title="{$title}">{$title}</a>
		{else}
			{$title}
		{/if}
	</h3>
	
	<div class="title h3 block_title hidden-lg-up" data-target="#cz_blocklink" data-toggle="collapse">
		<span class="">
			{if $url}
				<a href="{$url}" title="{$title}">{$title}</a>
			{else}
				{$title}
			{/if}
		</span>
		<span class="pull-xs-right">
		  <span class="navbar-toggler collapse-icons">
			<i class="fa-icon add"></i>
			<i class="fa-icon remove"></i>
		  </span>
		</span>
	</div>
	
		
	<ul id="cz_blocklink" class="block_content collapse">
	{foreach from=$cz_blocklink_links item=cz_blocklink_link}
		{if isset($cz_blocklink_link.$lang)} 
			<li>
				<a href="{$cz_blocklink_link.url}" title="{$cz_blocklink_link.$lang}" {if $cz_blocklink_link.newWindow} onclick="window.open(this.href);return false;"{/if}>{$cz_blocklink_link.$lang}</a></li>
		{/if}
	{/foreach}
	</ul>
</div>
<!-- /Block links module -->
