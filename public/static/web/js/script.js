function toasts(){					
				setTimeout(function() {
					var ss = document.getElementsByClassName("mui-toast-container");
					if(ss.length>0){
					ss.style.display = "none";	
					}
				
				}, 5000);				
			}
//			$(document).bind("contextmenu copy selectstart", function(){
//				return false;
//			});
//			/*禁用ctrl+c ctrl+v*/
//			$(document).keydown(function(e){
//				if(e.ctrlKey &&(e.keyCode ==65|| e.keyCode ==67)){
//					return false;
//				}
//			})