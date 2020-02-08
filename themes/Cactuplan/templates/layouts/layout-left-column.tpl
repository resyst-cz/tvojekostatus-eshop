{extends file='layouts/layout-both-columns.tpl'}

{block name='right_column'}{/block}

{block name='content_wrapper'}
    <div id="content-wrapper" class="left-column col-xs-12 col-sm-8 col-md-9" style="width:75.6%">
        {hook h="displayContentWrapperTop"}
        {block name='content'}
            <p>Hello world! This is HTML5 Boilerplate.</p>
        {/block}
        {hook h="displayContentWrapperBottom"}
    </div>
{/block}
