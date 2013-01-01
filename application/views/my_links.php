<?php date_default_timezone_set('America/Los_Angeles'); ?>

<?php if ( !empty($links) ) : ?>

<?php $c=1; ?>

<div class="my_links">

	<?php foreach ( $links as $link ) : ?>

	<div class="link">
		<div>
			<table cellborder="0" cellspacing="8px" cellpadding="0">
				<tr>	
					<td width="20%"><a href="http://bmal.me/<?= $link['code'] ?>">http://bmal.me/<?= $link['code'] ?></a></td>
					<td width="35%" class="td-url"><a href="<?= $link['url'] ?>"><?= (strlen($link['url']) > 50) ? substr($link['url'], 0, 50).'...' : $link['url'] ?></a></td>
					<td width="26%" align="right"><div class="short-date"><?= date( 'm/j/y' ) ?></div><div class="long-date"><?= date( 'M j, Y @ h:i A', $link['timestamp'] ) ?></div></td>
					<td width="5%"><div class="x_my_link" mylinkid="<?= $link['id'] ?>"></div></td>
				</tr>
			</table>
		</div>
	</div>

	<?php $c++; ?>

	<?php endforeach; ?>

</div>

<?php endif; ?>