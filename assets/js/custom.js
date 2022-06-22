//search function for buidings
$( function() {
	$( "#bld_search" ).autocomplete({
		source: "scripts/search_building.php",
		minLength: 2,
		select: function( event, ui ) {
			$('#bld_id').val(ui.item.id);
		}
	});
});