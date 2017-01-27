$(function () {
	$('.event-list').slimscroll({
            height: '305px',
            wheelStep: 20
        });
		
    $('.evnt-input').keypress(function (e) {
        var p = e.which;
        var inText = $('.evnt-input').val();
        if (p == 13) {
            if (inText == "") {
                alert('Empty Field');
            } else {
				$.ajax({
					url: 'functions.php?method=addnotes&data='+inText,
					type: 'GET',
					dataType: 'json',
					success: function(s){
						if(s.status == 'success')
                         $('<li id="'+s.id+'">' + inText + '<a href="#"" class="event-close"> &#10005; </a> </li>').appendTo('.event-list');
					},
					error: function(e)
					{
						console.log('error');
					}
				});
            }
            $(this).val('');
            $('.event-list').scrollTo('100%', '100%', {
                easing: 'swing'
            });
            return false;
            e.epreventDefault();
            e.stopPropagation();
        }
    });
	
	 $(document).on('click', '.event-close', function () {
		var id = $(this).closest("li").attr('id');
				$.ajax({
					url: 'functions.php?method=delnotes&id='+id,
					type: 'GET',
					dataType: 'json',
					success: function(s){
						if(s.status == 'success')
						 $('#'+id).remove();
					},
					error: function(e)
					{
						console.log('error');
					}
				});
        return false;
    });
});
