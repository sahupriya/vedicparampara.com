function decrease(){
	var id=$("#increase").attr("pid");
	var max=$("#number").attr("max");
	var qun = $(".qun").val();
	qun--;
	var command="decrement_quantity";
	if(qun==0){
		return false;
		qun=1;
	}else{
		$.ajax({
			url: 'component/command.php',
			type: 'POST',
			data: {command:command,id:id,max:max,new_quantity:qun},
			success:function(data){
				$("#divLoading").hide();
				if(data=="OK"){
					$(".qun").val(qun);
				}else{
					alert(data);
					$(".qun").val(qun);
					// swal({
						// title: 'Warning',
						// text: data,
						// type: 'warning',
						// timer: 7000,
					// },function(){
						// $(".qun").val(qun);
					// });
				}
			}
		})
	}		
}	
function increase(){
	var p_id=$("#increase").attr("pid");
	var max=$("#number").attr("max");
	var qun = $(".qun").val();	
	qun=parseInt(qun)+1;
	var new_qun=qun;
	if(new_qun>max){
		new_qun=max;
	}else{
		new_qun=qun;
	}
	var command="increment_quantity";
	if(qun==0){
		return false;
	}else{
		$.ajax({
			url: 'component/command.php',
			type: 'POST',
			data: {command:command,id:p_id,max:max,new_quantity:qun},
			success:function(data){
				$("#divLoading").hide();
				// alert(data);
				if(data=="OK"){
					$(".qun").val(new_qun);
				}else{
					alert(data);
					$(".qun").val(new_qun);
					// swal({
						// title: 'Warning',
						// text: data,
						// type: 'warning',
						// timer: 7000,
					// },function(){
						// $(".qun").val(new_qun);
					// });
				}
			}
		})
	}		
}