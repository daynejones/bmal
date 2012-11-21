<?php date_default_timezone_set('America/Los_Angeles'); ?>

<?php if ( !empty($links) ) : ?>

<?php $c=1; ?>

<div class="my_links">

	<?php foreach ( $links as $link ) : ?>

	<div class="link">
		<div>
			<table cellborder="0" cellspacing="8px" cellpadding="0">
				<tr>	
					<td width="140px"><a href="http://bmal.me/<?= $link['code'] ?>">http://bmal.me/<?= $link['code'] ?></a></td>
					<td width="400px"><a href="<?= $link['url'] ?>"><?= (strlen($link['url']) > 50) ? substr($link['url'], 0, 50).'...' : $link['url'] ?></a></td>
					<td width="200px"><?= date( 'M j, Y @ h:i A', $link['timestamp'] ) ?></td>
					<td width="16px"><div class="x_my_link" mylinkid="<?= $link['id'] ?>"></div></td>
				</tr>
			</table>
		</div>
	</div>

	<?php $c++; ?>

	<?php endforeach; ?>

</div>

<?php endif; ?>