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

<section class="special-products">

	<div class="container">
		<h1 class="h3 products-section-title text-uppercase">
				{l s='Deal Of The Day' mod='cz_specials'}
		</h1>
		<div class="special-products-wrapper">
			<div class="products">			
				{assign var='sliderFor' value=2} <!-- Define Number of product for SLIDER -->
				<ul id="special-carousel" class="cz-carousel product_list">
				{foreach from=$products item="product"}
					<li class="item">
						{include file="catalog/_partials/miniatures/product_deals.tpl" product=$product}
					</li>
				{/foreach}
				</ul>
				
				{if $slider == 1 && $no_prod >= $sliderFor}
					<div class="customNavigation">
						<a class="btn prev special_prev">&nbsp;</a>
						<a class="btn next special_next">&nbsp;</a>
					</div>
				{/if}
			</div>
		</div>
	</div>
</section>
