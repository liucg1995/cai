<?php header("Content-type: text/html; charset=utf-8"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <meta http-equiv="refresh" content="5">
</head>
<body>
<?php
echo '<br>演示内容：采用PHP进行JSON格式采集并分析数据。';
echo '<br>默认演示为《开彩网》重庆时时彩免费开奖接口';
echo '<br>付费接口的采集格式与免费接口完全一致';
echo '<br>如需使用付费接口，请修改采集为对应地址';
echo '<br>如有其它疑问请访问<a href="http://www.opencai.net/"><b style="color:#f00">www.opencai.net</b></a>';
echo '<br>';
$src = 'http://r.apiplus.net/newly.do?token=5db65a3cdfd460c0f4d7d6c689c55dd1&code=bjpk10&format=json';
echo '<br>采集地址：'.$src.'<br>';
$src .= '?_='.time();
$json = file_get_contents(urldecode($src));
$json = json_decode($json);
echo "<br>".date('Y-m-d H:i:s')."共采集到{$json->rows}行开奖数据：<br>";

for ($i = 0; $i < count($json->data); $i++) {
	$p = $json ->data[$i]->expect;
	echo '<br>开奖期号：'.substr($p,0,8).'-'.substr($p,-3,3);
	echo '<br>开奖号码：'.$json ->data[$i]->opencode;
	echo '<br>开奖时间：'.$json ->data[$i]->opentime;
	echo '<br>';
}
?>
</body>
</html>