<div class="container">
    <div class="row">
        {block name='hook_footer_before'}
            {hook h='displayFooterBefore'}
        {/block}
    </div>
</div>
<div class="footer-container">
    <div class="container">
        <div class="row">
            {block name='hook_footer'}
                {hook h='displayFooter'}
            {/block}
        </div>
        <div class="row">
            {block name='hook_footer_after'}
                {hook h='displayFooterAfter'}
            {/block}
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-sm-center">
                    {block name='copyright_link'}
                        <a class="_blank" href="http://www.prestashop.com" target="_blank">
                            {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
                        </a>
                    {/block}
                </p>
            </div>
        </div>
    </div>
</div>
