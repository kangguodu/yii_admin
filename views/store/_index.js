(function(){
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	};

	$(".store-charge").on("click",function(){
		var url = $(this).parent().attr('data-url');
		var id = $(this).parent().attr('data-id');
		console.log(url);
		layer.prompt({
			 title: '请輸入儲值的金額',
			 formType: 0,
			 btn: [ '確定','取消'],
			 id: 'charge-amount',
		},function(value, index, elem){
		 // alert(value); //得到value
		 if(value == ""){
		 	alert("請輸入儲值的金額");
		 	return false;
		 }
		  if(isNaN(value) ){
		  	alert("請輸入正確的數字");
		  	$("#charge-amount input[type='text']").focus();
		  	return false;
		  }
		  if(value <= 0){
		  	alert("儲值金額應大於0");
		  	$("#charge-amount input[type='text']").focus();
		  	return false;
		  }

		  $.ajax({
		  	type: 'POST',
		  	url: url,
		  	data:{
		  		amount: value
		  	},
		  	success: function(data){
		  		toastr.success(data.meesage);
		  		$('#store-return-'+id).text(data.data);
		  	},
		  	error:function(XMLHttpRequest, textStatus, errorThrown){
		  		if(XMLHttpRequest.responseJSON.message != undefined){
		  			toastr.warning(XMLHttpRequest.responseJSON.message);
		  		}else{
		  			toastr.warning(data.meesage);
		  		}
		  		
		  	}
		  });
		  layer.close(index);
		});
	});
})();