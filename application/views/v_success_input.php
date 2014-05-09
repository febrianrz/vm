<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      Berhasil Input Siswa
    </title>
  </head>
  <body>
    <h3>Data berhasil dimasukkan</h3>
    <br />
     <h5>Anda akan diarahkan kehalaman utama dalam 
	<span id="timer"></span>
      </h5>
    <script>
      //countdown 
	    var count=5;
	
	    var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
	    document.getElementById("timer").innerHTML=count + " secs";
	    function timer() {
	      
			count=count-1;
			document.getElementById("timer").innerHTML=count + " secs";
			if (count < 0) {
		  		clearInterval(counter);
		  		//counter ended, do something here
		  		return;
			} else if(count == 0){
		  		window.location = "<?=base_url()?>"
		  		//alert('tes');
		  		//return;
			}
			//Do code for showing the number of seconds here
			//redirect 
      	}
      	//document.getElementById("timer").innerHTML=count + " secs";
      
      	location.hash='#no-';
      		if(location.hash == '#no-'){
				location.hash='#_';
				window.onhashchange=function(){
      				if(location.hash == '#no-')
      					location.hash='#_';
      				}
      			}
    </script>
  </body>
</html>