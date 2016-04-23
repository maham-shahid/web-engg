
function check(){
	var cat=[];
	var min_val;
	var max_val;
	var checked = $("a.nav-custom input:checked[name = 'categories']");
	
	for( var i=0;i<checked.length;i++){
		cat[i] = checked.eq(i).val();
	}
	if(cat.length == 0){
		cat[0] = "unset"
	}
	var st = JSON.stringify(cat);
	console.log(st);
	min_val = $("a.nav-custom input[ name='price_min']").val();
	max_val = $("a.nav-custom input[ name='price_max']").val();
	if(min_val.length == 0){
		min_val = "unset"
	}
	if(max_val.length == 0){
		max_val = "unset"
	}
	$.ajax({
		url: "editing.php",
		type: "POST",
		data: {
			category: st,
			m_val: min_val,
			x_val: max_val
		},                                              
		success: filter,
		dataType:"json"
	})
}

function filter(data){
			console.log(data[0]);
			var x = $("div.col-md-3");
			x.remove();
			var i = 0
			while(data[i] != null){
				var node = $("div.col-md-10").append("<div class=\"col-md-3\"><div class=\"panel panel-default\"><div class=\"panel-heading\">"+data[i]["Prod_Name"]+"</div><div class=\"panel-body\"><a href=\"#\" class=\"thumbnail\"><img src= "+ data[i]["Image"] +"></a><a href=\"#\">Price: $"+ data[i]["Price"] +"</a></br><a href=\"#\">Quantity: "+ data[i]["Quantity"] +"</a></br><a class=\"btn btn-default\" href=\"#\" style=\"width:100%\" onclick = \"AddToCart()\">Add To Cart</a></div></div></div>");
				i++;
			}
}

function search(){
	var s_string = $("div.form-group :text#s_txt").val();
	console.log(s_string);
	
	$.ajax({
		url: "editing.php",
		type: "POST",
		data: {
			s_str: s_string
		},                                              
		success: filter,
		dataType:"json"
	});
}

function AddToCart(){
	var select = $(this).parent();
	var val = select.prev();
	var value = val.html();
	//console.log(value);
	
	$.ajax({
		url: "editing.php",
		type: "POST",
		data: {
			name: value
		},                                              
		success: function(data){
			console.log(data);
		}
	});
}