$('#cities').select2({
width: '100%',placeholder: 'Select cities for promotions'
		 });
$('#citycharge').select2({
width: '100%',placeholder: 'Select cities for promotions'
		 });
		 
$("#cities").change(function() {
	var price = $('select#cities').val();
   prices = String(price);
  if (prices.indexOf(",") > -1)
   {   
   
   $('#charges').val('');
   
	arr = prices.split(',');
	for(i=0; i < arr.length; i++){
	//checkcitystatus(arr[i]);
	charges1(arr[i]);
	}
   }else{
   if (price==null) {
   $('#charges').val('');
   }else{
 //checkcitystatus(price);
  	 charges(price);
  	// $('option:selected', this).remove();
   	}
  	}
	});
	
	
	
	
	
function checkcitystatus(price)
{
	var url = "http://192.168.3.82/b2b/pages/checkcitiesstatus";
	price1 = String(price);
	var fields = price1.split('-');
	var city_id = fields[0];
	var user_id = $('#user_id').val();
	var duration = $('#duration').val();
	$.ajax({
				url:url,
				type: 'POST',
				data: {city_id:city_id,user_id:user_id,duration:duration}
			}).done(function(result){
				if (result==1) {
				var a;					
				}else{
					alert(result);
					$('#cities option[value="'+price+'"]').remove();
					removecharges(price);
					//$('option:selected', "#city").remove();
					
				}
			});
}


function charges1(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1)

if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge);
hiddencharges = $('#charges').val();
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
$('#charges').val(totalcharge1);
}	

function charges(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1)

if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge);
hiddencharges = $('#charges').val();
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
$('#charges').val(totalcharge1);
}