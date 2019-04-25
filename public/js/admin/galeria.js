$(document).ready(function () {
	var assets = $("#assets").val();
	$( "#fileList" ).sortable({
		placeholder: "highlight",
		start: function (event, ui) {
			ui.item.toggleClass("highlight");
		},
		stop: function (event, ui) {
			ui.item.toggleClass("highlight");
		}
	});

	$( "#fileList" ).disableSelection();


	$('#upload').on('click', function () {
		var form_data = new FormData();
		var ins = document.getElementById('multiFiles').files.length;
		for (var x = 0; x < ins; x++) {
			form_data.append("files[]", document.getElementById('multiFiles').files[x]);
		}
		imgLoadUrl = $('#uploadUrl').val();
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});
		$.ajax({
            url: imgLoadUrl, // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
            	var totalElements = $('#fileList').children().length;
            	var myarray = response.split(';');
            	for(var i = 0; i < myarray.length; i++)
            	{
            		var elem = document.createElement("img");
            		elem.src="storage/uploads/"+myarray[i];            		                
            		elem.className="img-fluid img-element";                    
            		var elementLi = document.createElement("li");
            		elementLi.setAttribute("title",myarray[i]);
            		elementLi.setAttribute("idgaleria",0);
            		elementLi.append(elem);
            		var deleteButton = document.createElement("div");
            		deleteButton.id = "delete_"+(i+totalElements);
            		deleteButton.className = "img-delete";
            		var deleteIcon = document.createElement("img");
            		deleteIcon.src="img/delete.png";
            		deleteIcon.className="img-fluid";
            		deleteButton.append(deleteIcon);
            		elementLi.append(deleteButton);
            		elementLi.id = "imgCont_"+(i+totalElements);
            		elementLi.className="element-content";
                    $('#fileList').append(elementLi); // display success response from the PHP script
                }
                $("#multiFiles").val('');
                $("#inputFilesModal").modal("hide");
            },
            error: function (response) {

            }
        });
	});

	$("#fileList").on("click",".img-delete",function(){
		var elemID = $(this)[0].id.replace("delete_","");		
		var idGal = $("#imgCont_"+elemID).attr("idgaleria");
		var deleteUrl = $('#deleteUrl').val();
		var url = deleteUrl.replace('idElement', elemID);
		if(idGal==0)
		{
			var title = $("#imgCont_"+elemID).attr("title");
			var deleteUrl = $('#removeUrl').val();
			var url = deleteUrl.replace('idElement', title);
		}
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});									

		$.ajax({					
			url: url,
			type: 'POST',
			success: function () {				
				var alert="<div id='custom-alert' class='alert alert-danger'>imatge eliminada</div>";
				var child = $('#fileList').find("#imgCont_"+elemID).remove();
				$("#main").prepend(alert);
				setTimeout(function(){
					$('#custom-alert').remove();
				}, 5000);
			}
		});
		
	});

	$("#submitGallery").click(function (e) {	
		var imgSaveUrl = $('#saveUrl').val();
		var formData = new FormData();  
		var imgChildrens = $("#fileList").children();
		for(i=0;i<imgChildrens.length;i++){
			var child = imgChildrens[i];
			var nombre = child.title;
			formData.append('file[]',nombre);
		}            
		formData.append("totalElements",imgChildrens.length);
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});	
		$.ajax({
			url: imgSaveUrl,
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function (){
				$('#loadingDiv').show();
			},			
			success: function () {
				var alert="<div id='custom-alert' class='alert alert-success'>Galeria Actualitzada</div>";
				$('#loadingDiv').hide();
				$("#main").prepend(alert);
				setTimeout(function(){
					$('#custom-alert').remove();
				}, 5000);
			}
		});

	});
});
