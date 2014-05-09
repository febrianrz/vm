<center><strong style="font-size: 3em">Welcome to Villa Merah<?php //echo $this->session->userdata('user')?></strong></center>
<span id=tick2>
</span>
<script>

function show2(){
	if (!document.all&&!document.getElementById)
		return 
	thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
	var Digital=new Date()
	var hours=Digital.getHours()
	var minutes=Digital.getMinutes()
	var seconds=Digital.getSeconds()
	var dn="PM"
	if (hours<12)
		dn="AM"
	if (hours>12)
		hours=hours-12
	if (hours==0)
		hours=12
	if (minutes<=9)
		minutes="0"+minutes
	if (seconds<=9)
		seconds="0"+seconds
	var ctime=hours+":"+minutes+":"+seconds+" "+dn
	thelement.innerHTML="<center><b style='font-size: 1.5em;color:#000000;'>"+ctime+"</b></center>"
	setTimeout("show2()",1000)
}

window.onload=show2
      //dilarang balik kehalaman sebelumnya
location.hash='#no-';
if(location.hash == '#no-'){
	location.hash='#_';
	window.onhashchange=function(){
      if(location.hash == '#no-')
      	location.hash='#_';
      }
    }

    
</script>
<center>
<div class="back-img">
  <img src="<?=base_url()?>/asset/image/vilmel.png" />
</div>
</center>
<style>
	
</style>

<div class="clear"></div>
