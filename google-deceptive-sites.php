<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
*{padding:0;margin:0;word-wrap:break-word;font:inherit}#wrap{width:90%;padding:0 5%}.main{border:1px solid #000;border-bottom:none}.left{float:left;width:48%;border-right:1px solid #000;padding:0 0 0 1%}.ok,.warning{color:#fff;padding:0 5%}.right{float:right;width:50%}.warning{background:red}.ok{background:green}.link,.style1,h3{padding:10px 0}.clear{clear:both}h3{font-size:32px}.style1{background:#D3D3D3;border-bottom:2px solid #000}
</style>
</head>
<body>

<?php
$sites = fopen("sites.txt", "r");
$apikey = "YOUR-API-KEY";
$url_api ="https://safebrowsing.googleapis.com/v4/threatMatches:find?key=".$apikey."";

function GETData($url, $post){
 $ch=curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", 'Content-Length: ' . strlen($post)));
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $result=curl_exec($ch);
 return $result;
}
echo '<div id="wrap">';
echo '<h3>Below provided data are based on Google Safe Browsing and may not be 100% accurate.</h3>';
echo '<div class="main">';
if($sites){
        while (($line = fgets($sites)) !== false){
  $data = <<<EOJSON
{
    "client": {
     "clientId": "TestClient",
     "clientVersion": "1.0"
    },
    "threatInfo": {
     "threatTypes":      ["THREAT_TYPE_UNSPECIFIED","MALWARE", "SOCIAL_ENGINEERING","UNWANTED_SOFTWARE","POTENTIALLY_HARMFUL_APPLICATION"],
     "platformTypes":    ["LINUX"],
     "threatEntryTypes": ["URL"],
     "threatEntries":    [
      {"url": "$line"}
     ]
  }
}
EOJSON;

$GOtest=GETData($url_api, $data);
$str=json_decode($GOtest);
echo '<div class="style1">';
 echo '<div class="left">' . $line . '</div>';
    echo '<div class="right">';
    if (property_exists($str, 'matches')) {
        echo '<span class="warning">' . $str->matches[0]->threatType . '<br></span></div>';
    }
    else {
       echo '<span class="ok">Looks OK<br></span></div>';
    }
        echo '<div class="clear"></div>';
        echo '</div>';
}
echo '</div>';
fclose($sites);
echo '<br>';
echo '</div>';
}
?>
</body>
</html>