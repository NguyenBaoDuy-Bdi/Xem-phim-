var autoNextInfo = true;
var currentLightOn = 0;
var player;
jQuery(document).ready(function(){
	
	
		
		//--Bật tắt đèn
		if(device.mobile() || device.tablet())
		{
			jQuery('#btn-light').remove();
		}
		else
		{
			jQuery('#light-status').text('Tắt đèn');
			jQuery('#btn-light').click(function(){
				if(currentLightOn==0)//--Nếu hiện tại đèn đang tắt
				{
					jQuery('#watch-block').css("z-index", "1000");
					jQuery('#light-overlay').fadeIn('slow',function(){
						jQuery('#light-status').text('Bật đèn');
						currentLightOn = 1;
					});
				}
				else
				{
					jQuery('#light-overlay').fadeOut('slow',function(){
						jQuery('#light-status').text('Tắt đèn');
						currentLightOn = 0;
						jQuery('body').css('overflow','auto');
					});
				}
			});
		}
		
		//--Phóng to, thu nhỏ
		if(device.mobile() || device.tablet() || window.screen.width<1024)
		{
			jQuery('#btn-resize-player').remove();
		}
		else
		{
			var resizeCheck = 'small';
			var orgBoxWidth=0;
			var orgPlayerSize={'width':0,'height':0};
			var docHeight=34;
			jQuery('#btn-resize-player').click(function(){
				if(resizeCheck=='small'){
					//--Tính toán kích thước trước khi phóng
					orgBoxWidth=jQuery('#block-player').outerWidth();
					orgPlayerSize.width=jQuery('#media-player-box').width();
					orgPlayerSize.height=jQuery('#media-player-box').height();
					//--Tính toán kích thước sau khi phóng
					var newWidth=980;
					var largeSize={'width':newWidth,'height':Math.ceil(newWidth/16*9+docHeight)};
					var sidebarTopMargin=jQuery('#h2-note').offset().top;
					jQuery('#sidebar').animate({marginTop : sidebarTopMargin});
					jQuery('#block-player').animate({width : '1000px'});
					jQuery('#btn-resize-player #resize-status').text('Thu nhỏ');
					jQuery('#block-player #media-player-box').animate({width : largeSize.width,  height : largeSize.height});
					resizeCheck = 'large';
				}
				else{
					
					jQuery('#block-player').animate({width : orgBoxWidth});
					jQuery('#block-player  #media-player-box').animate({width : orgPlayerSize.width,  height : orgPlayerSize.height});
					jQuery('#sidebar').animate({marginTop : "0px"});
					jQuery('#btn-resize-player #resize-status').text('Phóng to');
					resizeCheck = 'small';
				}
			});
		}
});