<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php foreach(array('万','千','百') as $var){ ?>
<div class="pp" action="tzDXDSq3h3" length="3" random="sscRandom">
	<div class="title"><?=$var?>位</div>
	&nbsp;
	&nbsp;
	<div class="code-wrapper">
		<input type="button" value="大" class="code" />
	<input type="button" value="小" class="code" />
	<input type="button" value="单" class="code" />
	<input type="button" value="双" class="code" />
	</div>
	

</div>
<?php
	}
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>,false,<?=$this->user['fanDianBdw']?>);
})
</script>
