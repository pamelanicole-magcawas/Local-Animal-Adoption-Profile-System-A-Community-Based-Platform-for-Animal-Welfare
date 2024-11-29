<?php
$q = $_GET["q"];

$xmlDoc = new DOMDocument();
$xmlDoc->load("data.xml");

$x = $xmlDoc->getElementsByTagName('METHOD');

for ($i = 0; $i <= $x->length - 1; $i++) {
    if ($x->item($i)->nodeType == 1) {
        if ($x->item($i)->childNodes->item(0)->nodeValue == $q) {
            $methods = ($x->item($i)->parentNode);
        }
    }
}

$paymentMethod = ($methods->childNodes);

for ($i = 0; $i < $paymentMethod->length; $i++) {
    if ($paymentMethod->item($i)->nodeType == 1) {
        echo("<b>" . $paymentMethod-> item($i)->nodeName . ":</b> ");
        echo($paymentMethod->item($i)->childNodes->item(0)->nodeValue);
        echo("<br>");
    }
}
?>