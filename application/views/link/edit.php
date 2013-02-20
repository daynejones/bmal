<?php if (isset($link)) : ?>
<div id="edit-link" class="container">
	<div class="container-inner">
		<h3>Edit Link</h3>
		<form action="/link/edit/<?=$link['id']?>" method="POST" id="edit-link-form">
			<div>
				<div class="url">http://bmal.me/<?= $link['code'] ?></div>
				<div class="url"><?= $link['url'] ?></div>
			</div>
			<div id="description-title">
				<label>Description</label>
				<textarea id="description" name="description"><?= $link['description'] ?></textarea>
			</div>
			<?php if (isset($categories)) : ?>
			<div>
				<label>Category</label>
				<select name="category_id" id="category">
					<?php foreach($categories as $category) : ?>
					<option value="<?=$category['category_id']?>"><?=$category['name']?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>
			<div>
				<label>New Category</label>
				<input type="text" name="category" />
			</div>
			<div>
				<input type="submit" name="submit" value="Save" />
			</div>
		</form>
	</div>
</div>
<?php endif; ?>