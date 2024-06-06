<script src="http://s2tg.vn/jquery.min.js" type="text/javascript"></script> 
<script src="http://s2tg.vn/jquerycookie.js" type="text/javascript"></script> 

<script type="text/javascript">
$(document).ready(function() {    
    //select all the a tag with name equal to modal
        //Cancel the link behavior
        //e.preventDefault();
        var remember_popup = $.cookie('popup_cookie1');
        //Get the A tag
    if(!remember_popup){
        var id = '#dialog';
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHei  ght});
        //transition effect        
        $('#mask').fadeIn(1000);    
        $('#mask').fadeTo("slow",0.8);    
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
        //transition effect
        $(id).fadeIn(2000); 
    }
    //if close button is clicked
    $('.window .close').click(function () {
        //Cancel the link behavior
        //e.preventDefault();
        $('#mask').fadeOut(1000);
        $('.window').fadeOut(1000);
    });        
    //if mask is clicked
    $('#mask').click(function () {
        $(this).fadeOut(1000);
        $('.window').fadeOut(1000);
    });        
    //check cookie
});
</script>
<script type="text/javascript">
    $(document).ready(function() {    
            var cookie_check = 1;
            $.cookie('popup_cookie1', cookie_check);
    });    
</script>
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:740px;
  display:none;
  z-index:9999;
  padding:10px;
  margin-top:0px;
}
#boxes #dialog {
  width:740px;
  margin: 10px; 
  background-color:#ffffff;
}
</style>
<div id="boxes">
        <div id="dialog" class="window">
              <span><table style="width:740px;" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <a href="http://s2tg.vn/forum/showthread.php?p=139755"  target="_blank"><img src="http://s2tg.vn/linhtinh/trungthu.jpg"  width="740" height="480" alt="" border="0" class="close"  style="margin-top:5px;cursor:pointer;"></a></td>
    </tr>
</table></span>
             <a href="http://s2tg.vn/forum/showthread.php?p=139755"  target="_blank"><img src="http://s2tg.vn/linhtinh/lyr_close.gif"  border="0" align="right" class="close"  style="margin-top:5px;cursor:pointer;"></a>
    </div>
<div id="mask"></div>
</div>