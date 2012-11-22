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
			<table cellpadding="0" cellspacing="10px" style="margin:0 auto;">
				<tr>
					<td valign="middle"><input type="text" name="the_url" id="the_url" /></td>
					<td valign="middle"><input type="button" name="get_link" id="get_link" value="beer me" /></td>
				</tr>
			</table>
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

	</div>
			
	<?= (isset($my_links)) ? $my_links : '' ?>	

</div>