<div class="menu">
	<div class="menu-inner">
		<ul class="menu-left">
			<li><a href="/">home</a></li>
		</ul>
		
		<ul class="menu-right">
			<li>Welcome<?= !empty($user['firstname']) ? ' ,'.$user['firstname'] : ' back' ?></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>