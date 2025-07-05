(function(){
	//Grab elements, create settings, etc.
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
		context.drawImage(video, 0, 0, 640, 480);
		// Littel effects
		//photo.setAttribute('src', canvas.toDataURL('image/png'));
		$('#video').fadeOut('slow');
		$('#canvas').fadeIn('slow');
		$('#capture').show();
		$('#new').show();
		// Allso show upload button
		$('#upload').show();
	});
	
	document.getElementById('new').addEventListener('click', function(){
		// Littel effects
		//photo.setAttribute('src', canvas.toDataURL('image/png'));
		$('#video').fadeIn('slow');
		$('#canvas').fadeOut('slow');
		$('#capture').show();
		$('#new').show();
		// Allso show upload button
		$('#upload').show();
	});
	
	document.getElementById('upload').addEventListener('click', function(){
		
		var patient_id = $('span#patient_id').text();
		//var patient_url = "";
		//alert(patient_url);
		var dataUrl = canvas.toDataURL();
		$.ajax({
			type:"POST",
			url: "../../patients/saveImage.php",
			data: {
				imgBase64: dataUrl,
			}
		}).done(function(msg){
		
			$.gritter.removeAll({
				after_close: function(){
				  $.gritter.add({
					position: 'top-right',
					title: 'Success Message',
					text: msg,
					class_name: 'clean'
				  });
				}
			});
			//console.log('saved');
			//alert(patient_id);
		});
	});
})();