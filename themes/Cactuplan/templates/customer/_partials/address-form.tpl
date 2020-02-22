{block name="address_form"}
    <div class="js-address-form">
        {include file='_partials/form-errors.tpl' errors=$errors['']}

        {block name="address_form_url"}
        <form method="POST"
              action="{url entity='address' params=['id_address' => $id_address]}"
              data-id-address="{$id_address}"
              data-refresh-url="{url entity='address' params=['ajax' => 1, 'action' => 'addressForm']}"
        >
            {/block}

            {block name="address_form_fields"}
                <section class="form-fields">
                    <script>
                        {literal}
                        function showCompanyInfo() {
                            var x = document.getElementById('form-group-podnikatele');
                            if (x.style.display === 'none') {
                                x.style.display = 'block';
                            } else {
                                x.style.display = 'none';
                            }
                        }
                        {/literal}
                    </script>

                    {block name='form_fields'}
                        {foreach from=$formFields item="field"}
                            {if $field.name eq "id_customer"}
                            {elseif $field.name eq "company"}
                                <div id="sup-podnikatel" onclick="showCompanyInfo()">
                                    <div id="zobrazitfirmu">Nakupujete na firmu? Klikněte zde!</div>
                                </div>
                                <div id="form-group-podnikatele" style="display: none;">
                                    {block name='form_field'}
                                        {form_field field=$field}
                                    {/block}
                                    {elseif $field.name eq "dni"}
                                    {block name='form_field'}
                                        {form_field field=$field}
                                    {/block}
                                    {elseif $field.name eq "vat_number"}
                                    {block name='form_field'}
                                        {form_field field=$field}
                                    {/block}
                                </div>
                            {else}
                                {block name='form_field'}
                                    {form_field field=$field}
                                {/block}
                            {/if}
                        {/foreach}
                    {/block}
                </section>
            {/block}

            {block name="address_form_footer"}
                <footer class="form-footer clearfix">
                    <input type="hidden" name="submitAddress" value="1">
                    {block name='form_buttons'}
                        <button class="btn btn-primary float-xs-right" type="submit" class="form-control-submit">
                            {l s='Save' d='Shop.Theme.Actions'}
                        </button>
                    {/block}
                </footer>
            {/block}

        </form>
    </div>
{/block}
