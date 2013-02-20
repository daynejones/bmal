<div id="main-stuff">

<?php if(isset($my_links)) : ?>

	<div class="links squares">

	<?php foreach($my_links as $link) : ?>
		<?php if (!empty($link['links'])) : ?>
		<div class="section">
			<h3><?= $link['category']; ?></h3>
			<ul>
				<?php foreach($link['links'] as $l) : ?>
				<li>
					<a href="<?= $l['url'] ?>">http://bmal.me/<?= $l['code'] ?></a>
					<span class="url"><?= $l['url'] ?></span>
					<?php if (!empty($l['description'])) : ?>
						<span class="description"><?= $l['description'] ?></span>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>

	</div>

<?php endif; ?>

</div><!-- .main-stuff -->