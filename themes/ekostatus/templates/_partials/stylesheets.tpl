{foreach $stylesheets.external as $stylesheet}
    <link rel="stylesheet" href="{$stylesheet.uri}" type="text/css" media="{$stylesheet.media}">
{/foreach}

<link rel="stylesheet" href="{$urls.shop_domain_url}{$urls.theme_assets}css/styles.min.css" type="text/css" media="all">

{foreach $stylesheets.inline as $stylesheet}
    <style>
        {$stylesheet.content}
    </style>
{/foreach}
