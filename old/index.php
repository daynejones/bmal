<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
?>

<html>
<head>
<title>Beer Me A Link | URL Shortener</title>
<link href='http://fonts.googleapis.com/css?family=Ledger' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="tyler.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	$("#the_url").focus();

	$("#get_link").click(function(){
		getlink.not_a_robot = true;
		getlink.post($("#the_url").val());
	});
	
	$("#the_url").keypress(function(e){
		getlink.not_a_robot = true;
		if (e.which == 13) {
			getlink.post($("#the_url").val());
		}
	});
	
	$("#send_email").click(function(){
		getlink.sendEmail();
	});
	
	$("#your_email").keypress(function(e){
		if (e.which == 13) {
			getlink.sendEmail();
		}
	});
	
	$("#another").click(function(){
		getlink.refresh();
	});
	
});

var getlink = 
{
	not_a_robot : false,
	long_url : '',
	short_url : '',
	post : function(the_url)
	{
		if (getlink.not_a_robot == false)
			return;
	
		the_url = getlink.validateURL(the_url)
		if (!the_url)
			return;
					
		var postdata = 
		{
			the_url : the_url
		};
		$.post('/ajax/getlink.php',postdata,function(data){
			if (data.error != true && data.error != 'true') {
				var url = 'http://bmal.me/'+data.link_code;
				$("#bmal-link").text(url);
				$("#step-two").slideDown();
				$("#step-three").slideDown();
				$("#another").show();
				getlink.long_url = the_url;
				getlink.short_url = url;
				$("#your_email").focus();
				/* getlink.copyToClipboard(url); */
			}
		},'json');
	},
	validateURL : function(url)
	{
		if (url == '') {
			getlink.linkError('You must specify a URL');
			return false;
		}
		
		var re = new RegExp('http:\/\/|https:\/\/');
		if (!re.test(url)) {
			url = 'http://'+url;
		}
		
		return url;
	},
	linkError : function(msg)
	{
		alert(msg);
	},
	sendEmail : function()
	{
		if (getlink.short_url == '' || $("#your_email").val() == '')
			$("#email_error").show();
	
		var email = $("#your_email").val();
		var short_url = getlink.short_url;
		
		var postdata = 
		{
			to : email,
			long_url : getlink.long_url,
			short_url : getlink.short_url
		};
		$.post('/ajax/sendurl.php',postdata,function(data){
			if (data.error != true && data.error != 'true') {
				$("#email-sent").show();
				$("#email-div").hide();
			}
		},'json');
	},
	copyToClipboard : function(url)
	{
		/* Future task */
	},
	refresh : function()
	{
		$('input[type=text]').val('');
		$('textarea').val('');
		$('#step-two').hide();
		$('#step-three').hide();
		$('#another').hide();
		$('#the_url').focus();
		$('#email_div').show();
		$('#email_sent').hide();
	}
}

</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33367343-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</head>
<body>
	
<div id="container" class="container">

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

</div>

<div class="ws_ad" style="display:none;">
	<a href="http://WebStarts.com"><img src="/images/ws_ad.jpg" border="0" /></a>
</div>

</body>
</html>
