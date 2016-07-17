jQuery(document).ready(function($)
	{


		$(document).on('click', '.post-grid-settings .remove_export_content_layout', function()
			{

				var file_url = $(this).attr('file-url');
				
				if(confirm('Do you really want to remove ?')){
					
					
										
					jQuery.ajax(
						{
					type: 'POST',
					url: post_grid_ajax.post_grid_ajaxurl,
					context:this,
					data: {"action": "post_grid_ajax_remove_export_content_layout","file_url":file_url},
					success: function(data)
							{	
								//alert('Deleted');
								$(this).html('Deleted');

							}
						});
					
					}

			})








		$(document).on('click', '#post-grid-upgrade', function()
			{

				jQuery.ajax(
					{
				type: 'POST',
				context: this,
				url: post_grid_ajax.post_grid_ajaxurl,
				data: {"action": "post_grid_upgrade_action",},
				success: function(data)
						{	
							$(this).html('Upgrade Done!');
							$(this).parent().fadeOut();
							

						}
					});
				

			})



		$(document).on('click', '.post-grid-settings .reset-content-layouts', function()
			{
				
				if(confirm("Do you really want to reset ?" )){
					
					jQuery.ajax(
						{
					type: 'POST',
					context: this,
					url: post_grid_ajax.post_grid_ajaxurl,
					data: {"action": "post_grid_reset_content_layouts",},
					success: function(data)
							{	
								$(this).html('Reset Done!');
															
								
							}
						});
					
					}

			})






		$(document).on('click', '.post-grid-settings .export-content-layouts', function()
			{
				
					jQuery.ajax(
						{
					type: 'POST',
					context: this,
					url: post_grid_ajax.post_grid_ajaxurl,
					data: {"action": "post_grid_export_content_layouts",},
					success: function(data)
							{	
								$(this).html('Export Done!');

								window.open(data,'_blank');


							}
						});

			})








		$(document).on('change', '#post_grid_metabox .select-layout-content', function()
			{
				var layout = $(this).val();		
			
				
				jQuery.ajax(
					{
				type: 'POST',
				url: post_grid_ajax.post_grid_ajaxurl,
				data: {"action": "post_grid_layout_content_ajax","layout":layout},
				success: function(data)
						{	
							//jQuery(".layout-content").html(data);
							jQuery("#post_grid_metabox .layer-content").html(data);
						}
					});
				
			})	

		
		
		$(document).on('click', '#post_grid_metabox .meta-query-list .remove', function()
			{
				
				if(confirm("Do you really want remove ?")){
					$(this).parent().parent().remove();
					}				

				
			})			
		
	
		
		
		

		
		
		
		
	
		
		
		$(document).on('click', '#post_grid_metabox .clear-post-types', function()
			{
				//alert('Hello');
				$('.post_types option').prop('selected', false);
				
			})		
		
		
		



	});	







