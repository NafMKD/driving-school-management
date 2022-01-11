if(document.getElementById('myImg_photo') !== null){
	// Get the modal
	var modal_photo = document.getElementById('myModal_photo');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img_photo = document.getElementById('myImg_photo');
	var modalImg_photo = document.getElementById("img01_photo");
	var captionText_photo = document.getElementById("caption_photo");
	img_photo.onclick = function(){
	    modal_photo.style.display = "block";
	    modalImg_photo.src = this.src;
	    captionText_photo.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	modalImg_photo.onclick = function() {
	  modal_photo.style.display = "none";
	} 
}
//#######################################################################################################
if(document.getElementById('myImg_id') !== null){
	// Get the modal
	var modal_id = document.getElementById('myModal_id');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img_id = document.getElementById('myImg_id');
	var modalImg_id = document.getElementById("img01_id");
	var captionText_id = document.getElementById("caption_id");
	img_id.onclick = function(){
	    modal_id.style.display = "block";
	    modalImg_id.src = this.src;
	    captionText_id.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	modalImg_id.onclick = function() {
	  modal_id.style.display = "none";
	} 
}
//#######################################################################################################

if(document.getElementById('myImg_med') !== null){
	// Get the modal
	var modal_med = document.getElementById('myModal_med');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img_med = document.getElementById('myImg_med');
	var modalImg_med = document.getElementById("img01_med");
	var captionText_med = document.getElementById("caption_med");
	img_med.onclick = function(){
	    modal_med.style.display = "block";
	    modalImg_med.src = this.src;
	    captionText_med.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	modalImg_med.onclick = function() {
	  modal_med.style.display = "none";
	} 
}
//#######################################################################################################
if(document.getElementById('myImg_edu') !== null){
	// Get the modal
	var modal_edu = document.getElementById('myModal_edu');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img_edu = document.getElementById('myImg_edu');
	var modalImg_edu = document.getElementById("img01_edu");
	var captionText_edu = document.getElementById("caption_edu");
	img_edu.onclick = function(){
	    modal_edu.style.display = "block";
	    modalImg_edu.src = this.src;
	    captionText_edu.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	modalImg_edu.onclick = function() {
	  modal_edu.style.display = "none";
	} 
}
//#######################################################################################################
if(document.getElementById('myImg_trans') !== null){
	// Get the modal
	var modal_trans = document.getElementById('myModal_trans');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img_trans = document.getElementById('myImg_trans');
	var modalImg_trans = document.getElementById("img01_trans");
	var captionText_trans = document.getElementById("caption_trans");
	img_trans.onclick = function(){
	    modal_trans.style.display = "block";
	    modalImg_trans.src = this.src;
	    captionText_trans.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	modalImg_trans.onclick = function() {
	  modal_trans.style.display = "none";
	} 
}