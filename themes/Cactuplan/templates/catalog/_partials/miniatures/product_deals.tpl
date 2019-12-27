{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 
{block name='product_miniature_item'}
<div class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" 
	data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
	  <div class="thumbnail-container col-xs-12 col-md-6">
			{block name='product_thumbnail'}
			  <a href="{$product.url}" class="thumbnail product-thumbnail">
				<img
				  src = "{$product.cover.bySize.large_default.url}"
	            alt = "{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
				  data-full-size-image-url = "{$product.cover.large.url}"
				>
			  </a>
			{/block}

			{block name='product_images'}
			<aside class="product-thumbnails">
				<div class="product-additional-images">
					<div class="bx-wrapper">
					  <ul class="bxslider">
						{foreach from=$product.images item=image}
						  <li class="additional-item">
							<img
							  class="thumb js-thumb {if $image.id_image == $product.cover.id_image} selected {/if}"
							  data-image-medium-src="{$image.bySize.medium_default.url}"
							  data-image-large-src="{$image.bySize.large_default.url}"
							  src="{$image.bySize.home_default.url}"
							  alt="{$image.legend}"
							  title="{$image.legend}"
							  width="100"
							  itemprop="image"
							>
						  </li>
						{/foreach}
					  </ul>
					  <nav class='bxslider-controls'>
					    <a href='#' id='prev' class='bxPrev'></a>
					    <a href='#' id='next' class='bxNext'></a>
					  </nav>
					</div>
				</div>
			</aside>
			{/block}
			
			{block name='product_flags'}
			  <ul class="product-flags">
				{foreach from=$product.flags item=flag}
				  <li class="{$flag.type}">{$flag.label}</li>
				{/foreach}
			  </ul>
			{/block}
			
			<div class="product-counter">
				{hook h='PSProductCountdown' id_product=$product.id_product}
			</div>
	   </div>
	
		<div class="product-description col-xs-12 col-md-6">
			
			{block name='product_reviews'}
				{hook h='displayProductListReviews' product=$product}
			{/block}
		
			  {block name='product_name'}
				<span class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></span>
			  {/block}
			  	
			 {block name='product_description_short'}
				  <div id="product-description-short-{$product.id}" itemprop="description" class="deals-product-description">{$product.description|truncate:200:'...' nofilter}</div>
			 {/block}
		  	
			  {block name='product_price_and_shipping'}
		          {if $product.show_price}
		            <div class="product-price-and-shipping">
		              {if $product.has_discount}
		                {hook h='displayProductPriceBlock' product=$product type="old_price"}

		                <span class="sr-only">{l s='Regular price' d='Shop.Theme.Catalog'}</span>
		                <span class="regular-price">{$product.regular_price}</span>
		                {if $product.discount_type === 'percentage'}
		                  <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
		                {elseif $product.discount_type === 'amount'}
		                  <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
		                {/if}
		              {/if}

		              {hook h='displayProductPriceBlock' product=$product type="before_price"}

		              <span class="sr-only">{l s='Price' d='Shop.Theme.Catalog'}</span>
		              <span itemprop="price" class="price">{$product.price}</span>

		              {hook h='displayProductPriceBlock' product=$product type='unit_price'}

		              {hook h='displayProductPriceBlock' product=$product type='weight'}
		            </div>
		          {/if}
		        {/block}
			
		{*	 {block name='product_reference'}
				{if isset($product.reference_to_display)}
				  <div class="product-reference">
					<label class="label">{l s='Reference' d='Shop.Theme.Catalog'}: </label>
					<span itemprop="sku">{$product.reference_to_display}</span>
				  </div>
				{/if}
			 {/block}
			 
			 {block name='product_quantities'}
				<div class="product-quantities">
				  <label class="label">{l s='In stock' d='Shop.Theme.Catalog'}: </label>
				  <span>{$product.quantity} {l s='Items' d='Shop.Theme.Catalog'}</span>
				</div>
			{/block} *}
			 
			 <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
			  {block name='product_variants'}
				{if $product.main_variants}
				  {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
				{/if}
			  {/block}
			</div>
				
			<div class="outer-functional">
				<div class="functional-buttons">
					{block name='product_buy'}
						{if !$configuration.is_catalog}
							<div class="product-actions">
								  <form action="{$urls.pages.cart}" method="post" class="add-to-cart-or-refresh">
									<input type="hidden" name="token" value="{$static_token}">
									<input type="hidden" name="id_product" value="{$product.id}" class="product_page_product_id">
									<input type="hidden" name="id_customization" value="0" class="product_customization_id">
									<button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if !$product.add_to_cart_url}disabled{/if}>
										<span>{l s='Add to cart' mod='cz_specials'}</span>
									</button>
								</form>
							</div>
						{/if}
					 {/block}

					{block name='quick_view'}
						<div class="quickview">
							<a href="#" class="quick-view" data-link-action="quickview">
								<i class="material-icons search">&#xE417;</i> {l s='Quick view' d='Shop.Theme.Actions'}
							</a>
						</div>
					{/block}
					
					{hook h='displayProductListFunctionalButtons' product=$product}	
				</div>
			</div>
			
		</div>
	</div>
{/block}