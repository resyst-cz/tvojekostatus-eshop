<nav data-depth="{$breadcrumb.count}" class="breadcrumb hidden-sm-down">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList">
        {block name='breadcrumb'}
            {foreach from=$breadcrumb.links item=path name=breadcrumb}
                {block name='breadcrumb_item'}
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{$path.url}">
                            <span itemprop="name">{$path.title}</span>
                        </a>
                        <meta itemprop="position" content="{$smarty.foreach.breadcrumb.iteration}">
                    </li>
                {/block}
            {/foreach}
        {/block}
    </ol>
</nav>
