class ToggleHeader{
	constructor(maxwidth,minwidth,menubarlink,menubarform){
		this.maxwidth = "(max-width: "+maxwidth+"px)";
		this.minwidth = "(min-width: "+minwidth+"px)"
		this.menubarlink = menubarlink;
		this.menubarform = menubarform;
		this.toggleFunction();
	}
	toggleFunction(){
		var obj = this;
		$(document).ready(function(){
			if(window.matchMedia(obj.maxwidth).matches){
				$("#mobile_bars").click(function(){
	        		$(obj.menubarlink).toggle(0, function() {
	        			$(obj.menubarform).css('display','none');
	    			});
	    		});
	    		$(window).resize(function(){
					if(window.matchMedia(obj.minwidth).matches){
						$(obj.menubarlink).css('display','block');
					}
				});
			}
		});
		$(window).resize(function(){
			if(window.matchMedia(obj.maxwidth).matches){
				$("#mobile_bars").click(function(){
	        		$(obj.menubarlink).toggle(0, function() {
	        			$(obj.menubarform).css('display','none');
	    			});
	    		});
			}
			else{
				$(obj.menubarlink).css('display','block');
			}
		});

	}
}

