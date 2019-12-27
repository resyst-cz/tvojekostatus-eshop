<div class="footer-before">
    <div class="container">
        {block name='hook_footer_before'}
            {hook h='displayFooterBefore'}
        {/block}
    </div>
</div>
<div class="footer-container">
    <div class="container">
        <div class="row footer">
            {block name='hook_footer'}
                {hook h='displayFooter'}
            {/block}
        </div>
    </div>
</div>
</div>

<div class="footer-after">
    <div class="container">

        <div class="copyright">
            {block name='copyright_link'}
                <a class="_blank" href="http://www.prestashop.com" target="_blank">
                    {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
                </a>
            {/block}
        </div>
        {block name='hook_footer_after'}
            {hook h='displayFooterAfter'}
        {/block}

    </div>
</div>

<a class="top_button" href="#" style="">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</a>
