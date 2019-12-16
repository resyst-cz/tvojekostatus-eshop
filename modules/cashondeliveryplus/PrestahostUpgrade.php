<?php
  class PrestahostUpgrade {
      
   
   public static function displayInfo($modulename, $version, $language) {
if (! extension_loaded('soap')) {
  return 'Prestahost.cz';
}
$soap = new SoapClient(null, array(
    "location" => "http://www.prestahost.eu/upgrade/server.php",
    "uri" => "http://test/",
));

if(!is_object($soap))
  return 'Prestahost.cz';

try { 
$retval='<table><tr>
<td>'.$soap->getContact($language).'</td>
<td>'.$soap->getInfo($language).'</td>
<td>'.$soap->getModuleMessage($modulename, $version).'</td>
<td>'.$soap->getOtherMessages($modulename, $version).'</td>
</tr></table>';
        } catch (SoapFault $fault) { 
            return 'Prestahost.cz';
        }


return $retval.'<br />';
  }
 
  }