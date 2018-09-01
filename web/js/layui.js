yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
// --- Delete action (bootbox) ---
yii.confirm = function (message, ok, cancel) {

	// layer.confirm(message,function(index){
	//   layer.close(index);
 //      !ok || ok();
	// },function(index){
	  
	//   layer.close(index);
 //      !cancel || cancel();
	// });  

    // bootbox.confirm(
    //     {
    //         message: message,
    //         buttons: {
    //             confirm: {
    //                 label: "确定",
    //                 className: 'btn-success'
    //             },
    //             cancel: {
    //                 label: "取消",
    //                 className: 'btn-danger'
    //             }
    //         },
    //         callback: function (confirmed) {
    //             if (confirmed) {
    //                 !ok || ok();
    //             } else {
    //                 !cancel || cancel();
    //             }
    //         }
    //     }
    // );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
}