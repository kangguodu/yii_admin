if($('#activity-platform_type').val() == 2){
	$('.field-activity-type').addClass('hidden');
	$('#activity-type').val(1);
	$('.field-activity-url').addClass('hidden');
	$('#activity-url').val('');
}

if($('#activity-type').val() == 1){
	$('.field-activity-url').addClass('hidden');
}
if($('#activity-type').val() == 2){
	$('.field-activity-content').addClass('hidden');
	$('#activity-content').val('');
}

$('#activity-platform_type').change(function(){
	$('.field-activity-type').addClass('hidden');
	if($(this).val() != 2){
		$('.field-activity-type').removeClass('hidden');
	}
	if($(this).val() == 2){
		$('.field-activity-type').addClass('hidden');
		$('#activity-type').val(1);
		$('.field-activity-url').addClass('hidden');
		$('#activity-url').val('');
		$('.field-activity-content').removeClass('hidden');
	}

})


$('#activity-type').change(function(){
	$('.field-activity-url').removeClass('hidden');
	$('.field-activity-content').removeClass('hidden');

	if($(this).val() == 1){
		$('.field-activity-url').addClass('hidden');
		$('#activity-url').val('');
	}
	if($(this).val() == 2){
		$('.field-activity-content').addClass('hidden');
		
		$('#activity-content').val('');
	}



})