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
		$.post('/ajax/getlink',postdata,function(data){
			if (data.error != true && data.error != 'true') {
				var url = 'http://bmal.me/'+data.link_code;
				$("#bmal-link").text(url);
				$("#step-two").slideDown();
				// $("#step-three").slideDown();
				// $("#another").show();
				getlink.long_url = the_url;
				getlink.short_url = url;
				mylinks.reload();
				// $("#your_email").focus();
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