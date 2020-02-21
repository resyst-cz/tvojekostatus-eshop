{$style_tab}
<table style="width: 100%; margin-top:-10pt; border-bottom: 1px solid black;">
    <tr>
        <td style="width: 70%; text-align: left; font-weight: bold; font-size: 14pt; color: #56904b;">{if isset($header)}{$header|escape:'html':'UTF-8'|upper}{/if}</td>
        <td style="width: 30%; text-align: right;" rowspan="8">{if $logo_path}<img src="{$logo_path}" style="width:{$width_logo}px; height:{$height_logo}px;" />{/if}</td>
    </tr>
    <tr>
        <td style="font-size: 12pt; color: #56904b">č. {$title|escape:'html':'UTF-8'}</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; color: #56904b">&nbsp;</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; color: #000">
            <table>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Dátum vyhotovenia:</td>
                    <td style="font-size: 8pt; color: #000">{dateFormat date=$order->invoice_date full=0}</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Dátum splatnosti:</td>
                    <td style="font-size: 8pt; color: #000">{dateFormat date=$order->invoice_date full=0}</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Dátum dodania:</td>
                    <td style="font-size: 8pt; color: #000">{dateFormat date=$order->invoice_date full=0}</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Daň. povinnosť:</td>
                    <td style="font-size: 8pt; color: #000">{dateFormat date=$order->invoice_date full=0}</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Spôsob úhrady:</td>
                    <td style="font-size: 8pt; color: #000">{foreach from=$order_invoice->getOrderPaymentCollection() item=payment}
                            {$payment->payment_method}
                        {/foreach}</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; color: #000" style="width: 40%; text-align: left;">Číslo objednávky:</td>
                    <td style="font-size: 8pt; color: #000">{$order->getUniqReference()}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" id="body" border="0" cellpadding="0" cellspacing="0" style="margin:0;">
    <tr>
        <td colspan="12" height="10">&nbsp;</td>
    </tr>

    <!-- Invoicing -->
    <tr>
        <td colspan="12">

            {$addresses_tab}

        </td>
    </tr>
    <tr>
        <td colspan="12" height="20">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="12" height="40">Dodanie tovaru na základe objednávky č. {$order->getUniqReference()} zo dňa {dateFormat date=$order->date_add full=0}. Spôsob doručenia: {$carrier->name}. Spôsob
            úhrady: {foreach from=$order_invoice->getOrderPaymentCollection() item=payment}{$payment->payment_method}{/foreach}.
        </td>
    </tr>

    <!-- Product -->
    <tr>
        <td colspan="12">

            {$product_tab}

        </td>
    </tr>

    <tr>
        <td colspan="12" height="10">&nbsp;</td>
    </tr>

    <!-- TVA -->
    <tr>
        <!-- Code TVA -->
        <td colspan="6" class="left">

            {$tax_tab}

        </td>
        <td colspan="1">&nbsp;</td>


        <!-- Calcule TVA -->
        <td colspan="5" rowspan="5" class="right">

            {$total_tab}

        </td>
    </tr>
    {$note_tab}
    <tr>
        <td colspan="12" height="10">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="6" class="left">

            {*{$payment_tab}*}

        </td>
        <td colspan="1">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="6" class="left">

            {*{$shipping_tab}*}

        </td>
        <td colspan="1">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="12" height="10">&nbsp;</td>
    </tr>


    {if isset($HOOK_DISPLAY_PDF)}
        <tr>
            <td colspan="6">
                {$HOOK_DISPLAY_PDF}
            </td>
            <td colspan="1">&nbsp;</td>
        </tr>
    {/if}

    <tr>
        <td colspan="7" class="left small">

            <table>
                <tr>
                    <td>
                        <p>{$legal_free_text|escape:'html':'UTF-8'|nl2br}</p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>

    <!-- Hook -->
</table>
