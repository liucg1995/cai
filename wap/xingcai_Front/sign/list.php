<?php

$sql="select * from {$this->prename}sign_time where isdelete = 0 and uid = {$this->user['uid']} ";
$list=$this->getPage($sql, $this->page, $this->pageSize);
$params=http_build_query($_REQUEST, '', '&');
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
	<thead>
	<tr class="table_b_th">
		<td width="60">签到日期</td>
		<td>奖励</td>
		<td class="tl">IP</td>
		<td>时间</td>
	</tr>
	</thead>
	<tbody>
	<?php if($list['data']) foreach($list['data'] as $var){ ?>
		<tr class="viewbox" >
			<td><?=$var['date']?></td>
			<td><?=$var['money']?></td>
			<td><?=$var['ip']?></td>
			<td><?=$var['add_time']?></td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="5" align="center">暂无消息。</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php
$this->display('inc_page.php',0,$list['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/{$this->type}?$params");
?>
</div>
<div class="boxdetail"></div>