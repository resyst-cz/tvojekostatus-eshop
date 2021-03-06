{block name='header_banner'}
    <div class="header-banner">
        {hook h='displayBanner'}
    </div>
{/block}

{block name='header_nav'}
    <nav class="header-nav">
        <div class="container">

            {*<div class="hidden-sm-down">*}
            <div class="left-nav">
                {hook h='displayNav1'}
            </div>

            <div class="right-nav">
                {hook h='displayNav2'}
            </div>
            {*</div>*}

            {*<div class="hidden-md-up text-xs-center mobile">
                <div class="pull-xs-left" id="menu-icon">
                    <i class="material-icons menu-open">&#xE5D2;</i>
                    <i class="material-icons menu-close">&#xE5CD;</i>
                </div>
                <div class="pull-xs-right" id="_mobile_cart"></div>
                <div class="pull-xs-right" id="_mobile_user_info"></div>
                <div class="top-logo" id="_mobile_logo"></div>
                <div class="clearfix"></div>
            </div> *}

        </div>
    </nav>
{/block}

{block name='header_top'}
    <div class="header-top">
        <div class="container">


        </div>
        <div class="header-top-wrapper">
            <div class="container">
                <div class="header-top-inner">
                    <div class="header_logo">
                        <a href="{$urls.base_url}">
                            <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
                        </a>
                    </div>
                    {hook h='displayTop'}
                </div>
            </div>
        </div>

        {hook h='displayNavFullWidth'}
    </div>
{/block}
