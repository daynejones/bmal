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
	delete : function(my_link_id)
	{
		var postdata =
		{
			my_link_id : my_link_id,
			action : 'delete'
		};
		$.post('/ajax/mylink_actions',postdata);
	}
}