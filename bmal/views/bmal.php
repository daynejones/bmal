<div id="main-stuff">	

	<div id="label">
		<h1>Beer Me A Link</h1>
		<h2>Shortening URLs since a few days ago</h2>
	</div>

	<div style="height:50px; clear:both;"></div>

	<div id="step-one" class="step">

		<h3>Step 1 <span class="step-desc">- Paste the long URL</h3>

		<div id="the-link">
			<table cellpadding="0" cellspacing="10px" style="margin:0 auto;">
				<tr>
					<td valign="middle"><input type="text" name="the_url" id="the_url" /></td>
					<td valign="middle"><input type="button" name="get_link" id="get_link" value="Beer Me" /></td>
				</tr>
			</table>
		</div>

	</div>

	<div id="step-two" class="step" style="display:none;">

		<h3>Step 2 <span class="step-desc">- Get your short URL</h3>

		<div id="bmal-link" onclick="this.focus();this.select()" readonly="readonly"></div>

		<div id="url-copied" style="display:none;"></div>

	</div>

	<div id="step-three" class="step" style="display:none;">

		<h3>Step 3 <span class="step-desc">- Get a copy of your short URL</h3>

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
			
	<a id="another" style="display:none;">Another round?</a>
	

</div>