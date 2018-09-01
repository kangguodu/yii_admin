if($('#banner-type').val() == 4){
	$('.field-banner-store_id').addClass('hidden');
    $('.field-banner-url').addClass('hidden');
}else{
	$('.field-banner-app_page').addClass('hidden');
}
 if($('#banner-type').val() == 1 || $('#banner-type').val() == 3){
    	$('.field-banner-store_id').addClass('hidden');
    	
    }

if($('#banner-type').val() == 2){
	$('.field-banner-url').addClass('hidden');
	
}

$('#banner-type').change(function(){
	$('.field-banner-store_id').removeClass('hidden');
    $('.field-banner-url').removeClass('hidden');
    $('.field-banner-app_page').removeClass('hidden');
    
    if($(this).val() == 4){
    	$('.field-banner-store_id').addClass('hidden');
    	$('.field-banner-url').addClass('hidden');
    }else{
    	$('.field-banner-app_page').addClass('hidden');
    }
    if($(this).val() == 1 || $(this).val() == 3){
    	$('.field-banner-store_id').addClass('hidden');
    	
    }

    if($(this).val() == 2){
    	$('.field-banner-url').addClass('hidden');
    	
    }
})