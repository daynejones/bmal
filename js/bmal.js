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
	
	$("#bmal-link-x").click(function(){
		getlink.refresh();
	});

	// Update link details
	$("#update-bmal-link-details").click(function(){
		mylinks.update();
	});
	
});

var getlink = 
{
	not_a_robot : false,
	long_url : '',
	short_url : '',
	link_id : '',
	link_code : '',
	user_links_id : '',
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
		$.post('/ajax/getlink',postdata,function(data){
			if (data.error != true && data.error != 'true') {
				var url = 'http://bmal.me/'+data.link_code;
				getlink.link_code = data.link_code;
				getlink.link_id = data.link_id;
				getlink.user_links_id = data.user_links_id;
				$("#bmal-link").val(url);
				$("#step-two").slideDown();
				// $("#another").show();
				getlink.long_url = the_url;
				getlink.short_url = url;
				// $("#your_email").focus();
				// getlink.copyToClipboard(url);
				if (user.logged_in) {
					$("#step-three").slideDown();
					mylinks.reload();
				}
			}
		},'json');
	},
	validateURL : function(url)
	{
		if (url == '') {
			getlink.linkError('You must specify a URL');
			return false;
		}
		
		var re = new RegExp('http:\/\/|https:\/\/','i');
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
		$.post('/ajax/sendurl',postdata,function(data){
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
	populate_categories : function(cats)
	{
		if (cats.length < 1) {
			$("#existing-categories-div").hide();
			return;
		}	

		var html = '';
		for(var i=0;i<cats.length;i++) {
			html += '<option value="'+cats[i].name+'">'+cats[i].name+'</option>';
		}

		$("#existing-category").append(html);
	},
	error_message : function(msg)
	{
		alert(msg);
		console.log(msg);
	},
	success_message : function(msg)
	{
		var html = '<div id="success-message" style="padding:10px 0;width:800px;background-color:#fafafa;position:fixed;top:0;left:50%;margin-left:-400px;text-align:center;font-size:15px;color:#555;display:none;z-index:1000">';
		html += msg;
		html += '</div>';

		$("BODY").prepend(html);

		$("#success-message").slideDown(500).delay(4000).slideUp(500);
	},
	refresh : function()
	{
		$('input[type=text]').val('');
		$('#bmal_link').val('');
		$('#step-two').hide();
		$('#step-three').hide();
		$('#another').hide();
		$('#the_url').focus();
		$('#email_div').show();
		$('#email_sent').hide();
	}
}