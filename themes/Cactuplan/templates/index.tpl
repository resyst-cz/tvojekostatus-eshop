{extends file='page.tpl'}

{block name='page_content_container'}
    <section id="content" class="page-home">

        {block name='page_content_top'}{/block}
        <div class="display-hometop">
            {hook h='displayTopColumn'}
        </div>


        {*	<section class="cz-hometabcontent">
                <div class="container">
                        <h2 class="h1 products-section-title text-uppercase">{l s="Featured Products" d='Shop.Theme.Global'}</h2>
                        <div class="tabs">
                            <ul id="home-page-tabs" class="nav nav-tabs clearfix">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#featureProduct" class="nav-link active" data-text="{l s='Featured' d='Shop.Theme'}">
                                        <span>{l s='Featured' d='Shop.Theme.Global'}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#newProduct" class="nav-link" data-text="{l s='Latest' d='Shop.Theme'}">
                                        <span>{l s='Latest' d='Shop.Theme.Global'}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#bestseller" class="nav-link" data-text="{l s='Best Sellers' d='Shop.Theme'}">
                                        <span>{l s='Best Sellers' d='Shop.Theme.Global'}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="featureProduct" class="cz_productinner tab-pane active">
                                    {hook h='displayCzFeature'}
                                </div>
                                <div id="newProduct" class="cz_productinner tab-pane">
                                    {hook h='displayCzNew'}
                                </div>
                                <div id="bestseller" class="cz_productinner tab-pane">
                                    {hook h='displayCzBestseller'}
                                </div>
                            </div>
                        </div>
                    </div>
            </section> *}

        <div class="display-homecenter">
            {block name='page_content'}
                {block name='hook_home'}
                    {$HOOK_HOME nofilter}
                {/block}
            {/block}
        </div>

        <div class="display-homebottom">
            {hook h='displayHomeBottom'}
        </div>
    </section>
{/block}
