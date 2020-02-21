<table id="addresses-tab" cellspacing="0" cellpadding="0" style="font-size:10pt;">
    <tr>
        <td width="52%">
            <table width="100%">
                <tr>
                    <td style="width:100%; color: #56904b; text-decoration:underline; font-weight: bold;" colspan="2">Dodávateľ:</td>
                </tr>
                <tr>
                    <td style="width:100%" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:100%; font-weight: bold;" colspan="2">STATUS S, s.r.o.,</td>
                </tr>
                <tr>
                    <td style="width:20%">Sídlo:</td>
                    <td style="width:80%">Lipová 10927/21, 036 08 Martin</td>
                </tr>
                <tr>
                    <td style="width:20%">IČO:</td>
                    <td style="width:80%">44015828</td>
                </tr>
                <tr>
                    <td style="width:20%">IČ DPH:</td>
                    <td style="width:80%">SK2022560287</td>
                </tr>
                <tr>
                    <td style="width:20%">DIČ:</td>
                    <td style="width:80%">2022560287</td>
                </tr>
                <tr>
                    <td style="width:20%">Zápis:</td>
                    <td style="width:80%">OR OS Žilina, Oddiel: Sro, vložka č. 20333/L</td>
                </tr>
                <tr>
                    <td style="width:20%">P.ú.:</td>
                    <td style="width:80%">Tatra banka, a.s.</td>
                </tr>
                <tr>
                    <td style="width:20%">Č.ú./kód:</td>
                    <td style="width:80%">2948067022/1100</td>
                </tr>
                <tr>
                    <td style="width:20%">IBAN:</td>
                    <td style="width:80%">SK09 1100 0000 0029 4806 7022</td>
                </tr>
                <tr>
                    <td style="width:20%">SWIFT:</td>
                    <td style="width:80%">TATRSKBX</td>
                </tr>
                <tr>
                    <td style="width:20%">Variab.</td>
                    <td style="width:80%">s.: Číslo faktúry</td>
                </tr>
                <tr>
                    <td style="width:20%">Kód s.:</td>
                    <td style="width:80%">0308</td>
                </tr>
                <tr>
                    <td style="width:20%">Kontakt:</td>
                    <td style="width:80%">+421911504820</td>
                </tr>
                <tr>
                    <td style="width:20%">Email:</td>
                    <td style="width:80%">status.ecobag@gmail.com</td>
                </tr>
            </table>
        </td>
        <td width="48%">
            <table width="100%">
                <tr>
                    <td style="width:100%; color: #56904b; text-decoration:underline; font-weight: bold;" colspan="2">Odberateľ:</td>
                </tr>
                <tr>
                    <td style="width:100%" colspan="2">&nbsp;</td>
                </tr>
                {*{if (!$addresses.delivery->company && !$addresses.invoice->company) || ($addresses.delivery->company eq ' ' && $addresses.delivery->company eq ' ')}*}
                {if $delivery_address eq $invoice_address}

                    {if $addresses.delivery->company}
                        <tr>
                        <td style="width:30%">Název:</td>
                        <td style="width:70%">{$addresses.delivery->company}</td></tr>{/if}
                    <tr>
                        <td style="width:30%">Meno:</td>
                        <td style="width:70%">{$addresses.delivery->firstname} {$addresses.delivery->lastname}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Sídlo:</td>
                        <td style="width:70%">{$addresses.delivery->address1}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">PSČ, mesto:</td>
                        <td style="width:70%">{$addresses.delivery->postcode} {$addresses.delivery->city}</td>
                    </tr>
                    {if $addresses.delivery->vat_number}
                        <tr>
                        <td style="width:30%">IČ DPH:</td>
                        <td style="width:70%">{$addresses.delivery->vat_number}</td></tr>{/if}
                    {if $addresses.delivery->dni}
                        <tr>
                        <td style="width:30%">IČO:</td>
                        <td style="width:70%">{$addresses.delivery->dni}</td></tr>{/if}
                    <tr>
                        <td style="width:30%">Kontakt:</td>
                        <td style="width:70%">{$addresses.delivery->phone}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Email:</td>
                        <td style="width:70%">{$customer->email}</td>
                    </tr>
                {else}

                    {if $addresses.invoice->company}
                        <tr>
                        <td style="width:30%">Název:</td>
                        <td style="width:70%">{$addresses.invoice->company}</td></tr>{/if}
                    <tr>
                        <td style="width:30%"></td>
                        <td style="width:70%">{$addresses.invoice->firstname} {$addresses.invoice->lastname}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Sídlo:</td>
                        <td style="width:70%">{$addresses.invoice->address1}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">PSČ, mesto:</td>
                        <td style="width:70%">{$addresses.invoice->postcode} {$addresses.invoice->city}</td>
                    </tr>
                    {if $addresses.invoice->vat_number}
                        <tr>
                        <td style="width:30%">IČ DPH:</td>
                        <td style="width:70%">{$addresses.invoice->vat_number}</td></tr>{/if}
                    {if $addresses.invoice->dni}
                        <tr>
                        <td style="width:30%">IČO:</td>
                        <td style="width:70%">{$addresses.invoice->dni}</td></tr>{/if}
                    <tr>
                        <td style="width:30%">Kontakt:</td>
                        <td style="width:70%">{$addresses.invoice->phone}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Email:</td>
                        <td style="width:70%">{$customer->email}</td>
                    </tr>
                    <tr>
                        <td style="width:100%" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:100%; font-weight: bold;" colspan="2">Dodacia adresa:</td>
                    </tr>
                    <tr>
                        <td style="width:100%" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:100%" colspan="2">
                            {if $addresses.delivery->company}{$addresses.delivery->company}, {/if}{$addresses.delivery->firstname} {$addresses.delivery->lastname}<br/>{$addresses.delivery->address1}, {$addresses.delivery->postcode} {$addresses.delivery->city}<br/>{$addresses.delivery->country}
                        </td>
                    </tr>
                {/if}
            </table>
        </td>
    </tr>
</table>
