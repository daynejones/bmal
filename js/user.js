$(document).ready(function(){

	var handler = user.data_handler;

	// Get pertinent data via ajax
	user.get_user_data(handler);

});

var user = {
	logged_in : false,
	user_categories : null,
	get_user_data : function(callback)
	{
		$.post('/ajax/get_user_data',{},function(data){
			if (data.logged_in) {
				callback(data);
				user.logged_in = true;
			} else {
				user.logged_in = false;
			}
		},'json');
	},
	data_handler : function(data)
	{
		// Do the user categories
		user.user_categories = data.user_categories;
		getlink.populate_categories(user.user_categories);
	}
};