 $("#submit").click(function(event){
		 event.preventDefault();
	 
	 $('form').fadeOut(500);
         $('h1').empty();
         $('h1').append('Welcome Cantara')
	 $('.wrapper').addClass('form-success');
        
});