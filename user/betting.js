function popupdisp(){
	document.getElementById("popup").style.display="none";
}
var popup = document.getElementById("popup");
var loading = document.getElementById("loading");
function loaddisp(){
	loading.style.display="";
}
function loadoff(){
	loading.style.display="none";
}
$(document).ready(function () { 

$("#bettingForm").on('submit',(function(e) {
e.preventDefault();

var finalamount = $('input#finalamount').val();
var counter = $('input#counter').val();
var userid=$('input#userid').val();
var inputgameid=$('input#inputgameid').val();
var tab=$('input#tab').val();


if((finalamount)== 0) {

	$('#payment').modal('hide');
	document.getElementById("popuptext").innerHTML = "Fail! Invalid contract count,please try again!";
	popup.style.display = "";
	setTimeout(popupdisp, 1500);
    return false;
}
if(finalamount<10) {

	$('#payment').modal('hide');
	document.getElementById("popuptext").innerHTML = "Fail! Invalid contract count,please try again!";
	popup.style.display = "";
	setTimeout(popupdisp, 1500);
    return false;
}
if(finalamount>100000) {
  
	$('#payment').modal('hide');
	document.getElementById("popuptext").innerHTML = "Fail! Invalid contract count,please try again!";
	popup.style.display = "";
	setTimeout(popupdisp, 1500);
    return false;
}

if(counter<30){
	$('#payment').modal('hide');
	document.getElementById("popuptext").innerHTML = "Fail! Invalid period,please try again!";
	popup.style.display = "";
	setTimeout(popupdisp, 1500);
    return false;
}

if($('#presalerule').is(':checked')){}
else{
	$('#payment').modal('hide');
	document.getElementById("popuptext").innerHTML = "Please check I agree pre sale";
	popup.style.display = "";
	setTimeout(popupdisp, 1500);
    return false;
	
}				


$.ajax({
			type: "POST", 
			url: "betNow.php",              
			data: new FormData(this), 
			contentType: false,       
			cache: false,             
			processData:false,       

			success: function(html)   
			{ //alert(html);
			var arr = html.split('~');
			if (arr[0]== 1) {
			    waitlist(tab,userid,tab+'wait');
				$('#payment').modal('hide');
				var balance=parseFloat(arr[1]).toFixed(2);
			document.getElementById("popuptext").innerHTML = "Success";
			popup.style.display = "";
			setTimeout(popupdisp, 1500);
			setTimeout(loaddisp, 1500);
			setTimeout(loadoff, 3000);
			setTimeout(function() {
				document.getElementById('balance').innerHTML =balance;
			}, 3000);
            return false;
			}
			else if(arr[0]==2)
			{
				$('#payment').modal('hide');
				document.getElementById("popuptext").innerHTML = "Fail! Invalid action,please try again!";
				popup.style.display = "";
				setTimeout(popupdisp, 1500);
				return false;			
			}
			else if (arr[0]==3){
				$('#payment').modal('hide');
				document.getElementById("popuptext").innerHTML = "Fail! Invalid period,please try again!";
				popup.style.display = "";
				setTimeout(popupdisp, 1500);
				return false;
			}
			else if(arr[0]==4){
				$('#payment').modal('hide');
				document.getElementById("popuptext").innerHTML = "Fail! Invalid contract count,please try again!";
				popup.style.display = "";
				setTimeout(popupdisp, 1500);
				return false;
			}
			else if(arr[0]==5) {  
				$('#payment').modal('hide');
				document.getElementById("popuptext").innerHTML = "Fail! Invalid contract count,please try again!";
				popup.style.display = "";
				setTimeout(popupdisp, 1500);
				return false;
			}
			else if(arr[0]==6) {
				$('#payment').modal('hide');
				document.getElementById("popuptext").innerHTML = "Fail! The balance is not enough!";
				popup.style.display = "";
				setTimeout(popupdisp, 1500);
				return false;
			}		
			}
		});	
}));

//=============================payment detail=========================================================================

});

function waitlist(category,userid,containerid)
{ //alert(containerid);
var inputgameid=$("#futureid").val();

	$.ajax({
    type: "Post",
    data:"category=" + category+ "& userid=" + userid +"& periodid=" + inputgameid,
    url: "getwaitlist.php",
    success: function (html) { //alert(html);
		document.getElementById(containerid).innerHTML=html;
		},
      error: function (e) {}
      });
	}