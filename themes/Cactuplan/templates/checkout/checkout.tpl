<!doctype html>
<html lang="{$language.iso_code}">

<head>
    {block name='head'}
        {include file='_partials/head.tpl'}
    {/block}
</head>

<body id="{$page.page_name}" class="{$page.body_classes|classnames}">

{block name='hook_after_body_opening_tag'}
    {hook h='displayAfterBodyOpeningTag'}
{/block}

<header id="header">
    {block name='header'}
        {include file='_partials/header.tpl'}
    {/block}
</header>

{block name='notifications'}
    {include file='_partials/notifications.tpl'}
{/block}

<section id="wrapper">
    {hook h="displayWrapperTop"}
    <div class="container ggdg">

        {block name='content'}
            <section id="content">
                <div class="row">
                    <div class="col-md-8">
                        {block name='cart_summary'}
                            {render file='checkout/checkout-process.tpl' ui=$checkout_process}
                        {/block}
                    </div>
                    <div class="col-md-4">

                        {block name='cart_summary'}
                            {include file='checkout/_partials/cart-summary.tpl' cart = $cart}
                        {/block}

                        {hook h='displayReassurance'}
                    </div>
                </div>
            </section>
        {/block}
    </div>
    {hook h="displayWrapperBottom"}
</section>

<footer id="footer">
    {block name='footer'}
        {include file='_partials/footer.tpl'}
    {/block}
</footer>

{block name='javascript_bottom'}
    <script type="text/javascript" src="/js/jquery/jquery-1.11.0.min.js"></script>
    {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    <script type="text/javascript" src="{$urls.shop_domain_url}{$urls.theme_assets}js/scripts.min.js"></script>
{/block}

{block name='hook_before_body_closing_tag'}
    {hook h='displayBeforeBodyClosingTag'}
{/block}

</body>

</html>
