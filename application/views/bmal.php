<div id="bg" style="display:none;"></div>

<div id="main-stuff">

	<div id="label">
		<h1>beer me a link.</h1>
	<!--<h2>Shortening URLs since a few days ago</h2>-->
	</div>

	<div style="clear:both;"></div>

	<div id="step-one" class="step">

		<div id="the-link">
			<h3>Paste the long URL</h3>
			<div class="beer-me">
				<input type="text" name="the_url" id="the_url" />
				<input type="button" name="get_link" id="get_link" value="beer me" />
				<div class="clear"></div>
			</div>
		</div>

	</div>

	<div id="step-two" class="step" style="display:none;">

		<div class="bmal-link-outer">
			<div id="bmal-link-x"></div>
			<textarea id="bmal-link" readonly="readonly" onclick="this.focus();this.select()"></textarea>
		</div>
		<div id="url-copied" style="display:none;"></div>

	</div>

	<div id="step-three" class="step" style="display:none;">

		<div class="bmal-link-details">
			<h3>Add link details</h3>
			<div>
				<label>add a new category</label>
				<input type="text" name="new-category" id="new-category" />
			</div>
			<div id="existing-category-div">
				<label>or choose and existing category</label>
				<select name="existing-category" id="existing-category">
					<option value="" selected=selected>choose category</option>
				</select>
			</div>
			<div>
				<label>description (optional)</label>
				<textarea name="description" id="description"></textarea>
			</div>
			<div>
				<input type="button" id="update-bmal-link-details" value="update details" class="" />
			</div>
		</div>

		<?php /*
		<h3>Get a copy of your short URL</h3>

		<div id="email-me">

			<div id="email-div">
				
				Your email: <input type="text" name="your_email" id="your_email" />

				<input type="button" name="send_email" id="send_email" value="send email" /><br />

				<input type="checkbox" CHECKED name="get_offers" id="get_offers" /> <span class="offer-text">I do not want to avoid not getting no marketing emails and offers.</span><br />
			
			</div>
			
			<div id="email-sent" style="display:none;">
			
				Email was sent!
			
			</div>

		</div>
		*/ ?>

	</div>
			
	<?= (isset($my_links)) ? $my_links : '' ?>	

</div>