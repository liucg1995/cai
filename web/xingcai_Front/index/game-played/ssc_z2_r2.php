<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp" action="tzCombineSelect" length="2" random="combineRandom">
	
	<div id="wei-shu" length="2" class="lotteryMember" >
	<dl id="poschoose"><dt>选择位置:</dt>
		<dd><input type="checkbox" class="posChoose" value="16">万位</dd>
		<dd><input type="checkbox" class="posChoose" value="8">千位</dd>
		<dd><input type="checkbox" class="posChoose" value="4">百位</dd>
		<dd><input type="checkbox" class="posChoose" value="2">十位</dd>
		<dd><input type="checkbox" class="posChoose" value="1">个位</dd>
	</dl>
	<div class="title" style="margin-top: 13px;">选择</div>
	</div>
	&nbsp;&nbsp;&nbsp;
	<div class="code-wrapper">
	<input type="button" value="0" class="code min s" />
	<input type="button" value="1" class="code min d" />
	<input type="button" value="2" class="code min s" />
	<input type="button" value="3" class="code min d" />
	<input type="button" value="4" class="code min s" />
	<input type="button" value="5" class="code max d" />
	<input type="button" value="6" class="code max s" />
	<input type="button" value="7" class="code max d" />
	<input type="button" value="8" class="code max s" />
	<input type="button" value="9" class="code max d" />
</div>
	&nbsp;&nbsp;
	<div class="quick-select-wrapper">
	<input type="button" value="清" class="action none" />
    <input type="button" value="双" class="action even" />
    <input type="button" value="单" class="action odd" />
    <input type="button" value="小" class="action small" />
    <input type="button" value="大" class="action large" />
    <input type="button" value="全" class="action all" />
  </div>  
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
