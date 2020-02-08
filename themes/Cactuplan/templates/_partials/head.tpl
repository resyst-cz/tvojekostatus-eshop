{block name='head_charset'}
    <meta charset="utf-8">
{/block}
{block name='head_ie_compatibility'}
    <meta http-equiv="x-ua-compatible" content="ie=edge">
{/block}

{block name='head_seo'}
    <title>{block name='head_seo_title'}{$page.meta.title}{/block}</title>
    <meta name="description" content="{block name='head_seo_description'}{$page.meta.description}{/block}">
    {if $page.meta.robots !== 'index'}
        <meta name="robots" content="{$page.meta.robots}">
    {/if}
    {if $page.canonical}
        <link rel="canonical" href="{$page.canonical}">
    {/if}
    {block name='head_hreflang'}
        {foreach from=$urls.alternative_langs item=pageUrl key=code}
            <link rel="alternate" href="{$pageUrl}" hreflang="{$code}">
        {/foreach}
    {/block}
{/block}

{block name='head_viewport'}
    <meta name="viewport" content="width=device-width, initial-scale=1">
{/block}

{block name='head_icons'}
    <link rel="apple-touch-icon" sizes="76x76" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/favicon-16x16.png">
    <link rel="manifest" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/site.webmanifest">
    <link rel="mask-icon" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="{$urls.shop_domain_url}{$urls.theme_assets}favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="msapplication-config" content="{$urls.shop_domain_url}{$urls.theme_assets}favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
{/block}

{* Codezeel added *}
<link href="//fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Playball:400" rel="stylesheet">

{block name='stylesheets'}
    {include file="_partials/stylesheets.tpl" stylesheets=$stylesheets}
{/block}

{block name='javascript_head'}
    {include file="_partials/javascript.tpl" javascript=$javascript.head vars=$js_custom_vars}
{/block}

{block name='hook_header'}
    {$HOOK_HEADER nofilter}
{/block}

{block name='hook_extra'}{/block}
