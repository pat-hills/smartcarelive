(function(){
	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		context = canvas.getContext('2d'),
		photo = document.getElementById('photo'),
		upload_photo = document.getElementById('upload'),
		vendorUrl = window.URL || window.webkitURL;

	navigator.getMedia = navigator.getUserMedia ||
						 navigator.webkitGetUserMedia ||
						 navigator.mozGetUserMedia ||
						 navigator.msGetUserMedia;	
	
						 
	//Capture Video
	navigator.getMedia({
		video:true,
		audio:false
	}, function(stream){
		//console.log(stream);
		video.src = vendorUrl.createObjectURL(stream);
		video.play();
	}, function(error){
	   //An error occured
	   //error.code
	});	
	
	document.getElementById('capture').addEventListener('click', function(){
		context.drawImage(video, 0, 0, 400, 300);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
	});
	
	var canvasImage = photo.setAttribute('src', canvas.toDataURL('image/png'));
	
	document.getElementById('upload').addEventListener('click', function(){
		
		
		var ajax = new XMLHttpRequest();
		ajax.open("POST",'savephoto.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(canvasImage);
		//alert(canvasImage);
		//console.log(canvasImage);
	});
	
	

})();