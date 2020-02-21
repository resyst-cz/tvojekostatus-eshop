<table class="product" width="100%" cellpadding="4" cellspacing="0">

    <thead>
    <tr>
        <th class="product header small" width="42%">{l s='Názov tovaru' d='Shop.Pdf' pdf='true'}</th>
        <th class="product header small" width="12%">{l s='Množstvo' d='Shop.Pdf' pdf='true'}</th>
        <th class="product header small" width="12%">{l s='M.j. bez DPH' d='Shop.Pdf' pdf='true'}</th>
        <th class="product header small" width="10%">{l s='Sadzba DPH' d='Shop.Pdf' pdf='true'}</th>
        <th class="product header-right small" width="12%">{l s='Cena bez DPH' d='Shop.Pdf' pdf='true'}</th>
        <th class="product header-right small" width="12%">{l s='Cena s DPH' d='Shop.Pdf' pdf='true'}</th>

    </tr>
    </thead>

    <tbody>

    <!-- PRODUCTS -->
    {foreach $order_details as $order_detail}
        {cycle values=["color_line_even", "color_line_odd"] assign=bgcolor_class}
        <tr class="product {$bgcolor_class}">

            <td class="product left">
                {if $display_product_images}
                    <table width="100%">
                        <tr>
                            <td width="15%">
                                {if isset($order_detail.image) && $order_detail.image->id}
                                    {$order_detail.image_tag}
                                {/if}
                            </td>
                            <td width="5%">&nbsp;</td>
                            <td width="80%">
                                {$order_detail.product_name}
                            </td>
                        </tr>
                    </table>
                {else}
                    {$order_detail.product_name}
                {/if}
            </td>
            <td class="product center">
                {$order_detail.product_quantity}
            </td>

            <td class="product right">
                {displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl_including_ecotax}
                {if $order_detail.ecotax_tax_excl > 0}
                    <br>
                    <small>{{displayPrice currency=$order->id_currency price=$order_detail.ecotax_tax_excl}|string_format:{l s='ecotax: %s' d='Shop.Pdf' pdf='true'}}</small>
                {/if}
            </td>
            <td class="product center">
                {$order_detail.order_detail_tax_label}
            </td>

            <td class="product right">
                {displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl_including_ecotax}
            </td>
            <td class="product right">
                {displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_incl_including_ecotax}
            </td>
        </tr>
    {/foreach}
    <!-- END PRODUCTS -->

    <!-- CART RULES -->

    {assign var="shipping_discount_tax_incl" value="0"}
    {foreach from=$cart_rules item=cart_rule name="cart_rules_loop"}
        {if $smarty.foreach.cart_rules_loop.first}
            <tr class="discount">
                <th class="header" colspan="{$layout._colCount}">
                    {l s='Discounts' d='Shop.Pdf' pdf='true'}
                </th>
            </tr>
        {/if}
        <tr class="discount">
            <td class="white right" colspan="{$layout._colCount - 1}">
                {$cart_rule.name}
            </td>
            <td class="right white">
                - {displayPrice currency=$order->id_currency price=$cart_rule.value_tax_excl}
            </td>
        </tr>
    {/foreach}

    </tbody>

</table>
