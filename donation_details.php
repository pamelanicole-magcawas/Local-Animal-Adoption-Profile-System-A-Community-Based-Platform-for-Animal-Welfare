<?php
$q = $_GET["q"];

$xmlDoc = new DOMDocument();
$xmlDoc->load("data.xml");

$x = $xmlDoc->getElementsByTagName('METHOD');

foreach ($x as $method) {
    if ($method->childNodes->item(0)->nodeValue == $q) {
        $methods = $method->parentNode;
        break;
    }
}

foreach ($methods->childNodes as $childNode) {
    if ($childNode->nodeType == 1) {
        echo("<b>" . $childNode->nodeName . ":</b> ");
        echo($childNode->childNodes->item(0)->nodeValue);
        echo"<br>";
    }
}
?>
