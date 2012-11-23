$(document).ready(function(){

	$('div.x_my_link').live('click',function(e){
		// remove the element
		var $p = $(this).parents('div.link');
		$p.fadeOut(600,function(){
			$p.remove();
		});
		// ajax it
		var my_link_id = $(this).attr('mylinkid');
		mylinks.delete(my_link_id);
	});

});

var mylinks =
{
	reload : function()
	{
		$.post('/ajax/reload_mylinks',{},function(data){
			if(!data.error) {
				if ( $('.my_links').length > 0 )
					$('.my_links').html(data.html);
				else
					$('#main-stuff').append(data.html);
			}
		},'json');
	},
	update : function()
	{
		var category = '';
		var description = '';

		// Validate the details
		if (getlink.user_links_id == '') {
			console.log("getlink.link_id not set");
		}

		// Determine the category to be used - new category takes precedence
		if ($("#new-category").val() != '')
			category = $("#new-category").val();
		else if ($("#existing-category").val() != '')
			category = $("#existing-category").val();	 

		if (category != '') {
			var alphanumeric = /^[0-9a-zA-Z\s]+$/;  
			if (!category.match(alphanumeric)) {
				getlink.error_message("Your category must contain only letters, numbers, and spaces.");
				return false;
			}
		}

 		// Get the description
 		description = $("#description").val();

 		if (description == '' && category == '') {
 			getlink.error_message("You must add a category or description.");
 			return false;
 		}

 		getlink.success_message("Link details were successfully added.");

 		$("#step-three").slideUp();

 		var postdata = {
 			action : 'update_details',
 			user_links_id : getlink.user_links_id
 		};

 		if (category != '')
 			postdata.category = category;

 		if (description != '')
 			postdata.description = description;

 		$.post('/ajax/mylink_actions',postdata);
	},
	delete : function(user_links_id)
	{
		var postdata =
		{
			user_links_id : user_links_id,
			action : 'delete'
		};
		$.post('/ajax/mylink_actions',postdata);
	}
}