$(function () {
	
	$('.subnavbar').find ('li').each (function (i) {
	
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
		
	});

    /* ********** */
    /* Data Table */
    /* ********** */
    $(document).ready(function() {
        $('.data-table').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
	
});