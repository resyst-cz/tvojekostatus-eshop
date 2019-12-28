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

<main id="page">
    {block name='product_activation'}
        {include file='catalog/_partials/product-activation.tpl'}
    {/block}

    <header id="header">
        {block name='header'}
            {include file='_partials/header.tpl'}
        {/block}
    </header>

    {block name='notifications'}
        {include file='_partials/notifications.tpl'}
    {/block}

    {block name='breadcrumb'}
        {include file='_partials/breadcrumb.tpl'}
    {/block}

    <section id="wrapper">
        {hook h="displayWrapperTop"}
        <div class="{if $page.page_name == 'index'}home-container{else}container{/if}">
            <div id="columns_inner">
                {block name="left_column"}
                    <div id="left-column" class="col-xs-12" style="width:24.4%">
                        {if $page.page_name == 'product'}
                            {hook h='displayLeftColumnProduct'}
                        {else}
                            {hook h="displayLeftColumn"}
                        {/if}
                    </div>
                {/block}

                {block name="content_wrapper"}
                    <div id="content-wrapper" class="left-column right-column">
                        {hook h="displayContentWrapperTop"}
                        {block name="content"}
                            <p>Hello world! This is HTML5 Boilerplate.</p>
                        {/block}
                        {hook h="displayContentWrapperBottom"}
                    </div>
                {/block}

                {block name="right_column"}
                    <div id="right-column" class="col-xs-12" style="width:24.4%">
                        {if $page.page_name == 'product'}
                            {hook h='displayRightColumnProduct'}
                        {else}
                            {hook h="displayRightColumn"}
                        {/if}
                    </div>
                {/block}
            </div>
        </div>
        {hook h="displayWrapperBottom"}
    </section>

    <footer id="footer">
        {block name="footer"}
            {include file="_partials/footer.tpl"}
        {/block}
    </footer>

</main>

{block name='javascript_bottom'}
    {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
{/block}

<script type="text/javascript" src="{$urls.shop_domain_url}{$urls.theme_assets}js/scripts.min.js"></script>

{block name='hook_before_body_closing_tag'}
    {hook h='displayBeforeBodyClosingTag'}
{/block}
</body>
</html>
