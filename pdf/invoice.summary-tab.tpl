<table width="100%">
    <tr>
        <td width="100%">
            <table id="summary-tab"> z
                <tr>
                    <th class="header small" valign="middle" width="16%">{l s='Číslo faktury' pdf='true'}</th>
                    <th class="header small" valign="middle" width="16%">{l s='Datum vystavení' pdf='true'}</th>
                    <th class="header small" valign="middle">{l s='Číslo objednávky' pdf='true'}</th>
                    <th class="header small" valign="middle">{l s='Datum vystavení' pdf='true'}</th>
                    <th class="header small" valign="middle" width="28%">{l s='Datum zdanitelného plnění' pdf='true'}</th>
                </tr>
                <tr>
                    <td class="center small white">{$title|escape:'html':'UTF-8'}</td>
                    <td class="center small white">{dateFormat date=$order->invoice_date full=0}</td>
                    <td class="center small white" border="0.2pt" style="font-weight:bold;">{$order->getUniqReference()}</td>
                    <td class="center small white">{dateFormat date=$order->date_add full=0}</td>
                    <td class="center small white">{dateFormat date=$order->invoice_date full=0}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

