$(document).ready(function(){
	$(".edit_event_class").click(function(){
		var idarr=this.id.split('_');
		var id=idarr[3];
		
		$.ajax({
		       url: 'events/geteventbyid',
		       type: 'get',
		       data: {
		    	   eventid: id
		             },
		       success: function (data) {
		          $("#edit_event_name").val(data.event_name);
		          $("#edit_event_date").val(data.event_date);
		          $("#eventid").val(id);
		       }
		  });
	})
	$(".like_event_class").click(function(){
		var idarr=this.id.split('_');
		var id=idarr[3];
		
		$.ajax({
		       url: 'events/geteventlikeuserbyeventid',
		       type: 'get',
		       data: {
		    	   eventid: id
		             },
		       success: function (data) {
		    	   $("#likesByUser").html();
		    	   var likestr='<ul>';
		          for(var i in data){
		        	  likestr+='<li>'+data[i]+'</li>';
		          }
		          likestr+='</ul>';
		          $("#likesByUser").html(likestr);
		       }
		  });
	})
	
	
	$(".comment_event_class").click(function(){
		var idarr=this.id.split('_');
		var id=idarr[3];
		
		$.ajax({
		       url: 'events/geteventcommentuserbyeventid',
		       type: 'get',
		       data: {
		    	   eventid: id
		             },
		       success: function (data) {
		    	   
		    	   $("#CommentByUser").html();
		    	   var likestr='<ul>';
		          for(var i in data){
		        	  
		        	  if(data[i].commentreply.length>0){
		        		  likestr+='<li>'+data[i].user+'<ul><li>'+data[i].comment+'<ul>';
		        		  for(var j in data[i].commentreply)
		        			  {
		        			  likestr+='<li>'+data[i].commentreply[j].user+'<ul><li>'+data[i].commentreply[j].comment+'</li></ul></li>';
		        			  }
		        		  likestr+='</ul></li></ul></li>';
		        	  }else{
		        		  likestr+='<li>'+data[i].user+'<ul><li>'+data[i].comment+'</li></ul></li>';
		        	  }
		        	  
		          }
		          likestr+='</ul>';
		          $("#CommentByUser").html(likestr);
		    	   
		       }
		  });
	})
	
	
	$(".edit_gallery_class").click(function(){
		var idarr=this.id.split('_');
		var id=idarr[3];
		
		$.ajax({
		       url: 'gallery/gatgalleryid',
		       type: 'get',
		       data: {
		    	   gallery_id: id
		             },
		       success: function (data) {
		          $("#edit_image_title").val(data.image_title);
		          $("#edit_image_alt").val(data.image_alt);
		          $("#gallery_id").val(id);
		          $("#yearspanidedit").val(data.yearspanid).attr("selected", "selected");;
		       }
		  });
	})
	
	$(".edit_featuregallery_class").click(function(){
		var idarr=this.id.split('_');
		var id=idarr[3];
		
		$.ajax({
		       url: 'featuregallery/gatgalleryid',
		       type: 'get',
		       data: {
		    	   featuregallery_id: id
		             },
		       success: function (data) {
		          $("#edit_image_title").val(data.image_title);
		          $("#edit_image_alt").val(data.image_alt);
		          $("#featuregallery_id").val(id);
		       }
		  });
	})
	
	
	
	    	$("#new_event_submit").click(function(){
            var event_date=$("#event_date").val();
            var event_name=$("#event_name").val();
            
            if(event_date==''){
                alert("Please insert event date");
                $("#event_date").focus();
                return false;
            }
            
            if(event_name==''){
                alert("please insert event name");
                $("#event_name").focus();
                return false;
            }
             
        })
        
        $("#edit_event_submit").click(function(){
            var event_date=$("#edit_event_date").val();
            var event_name=$("#edit_event_name").val();
            
            if(event_date==''){
                alert("Please insert event date");
                $("#edit_event_date").focus();
                return false;
            }
            
            if(event_name==''){
                alert("please insert event name");
                $("#edit_event_name").focus();
                return false;
            }
             
        })
        
        
        
        $(".deleteEvent").on("click", function(e) {
        	var r = confirm("Sure want to delete this event!");
        	if (r == true) {
        		var idarr=$(this).attr('id').split('_');
        		var id=idarr[1];
        		
        		$.ajax({
        		       url: 'events/deleteeventbyidajax',
        		       type: 'get',
        		       data: {
        		    	   eventid: id
        		             },
        		       success: function (data) {
        		    	   if(data.action=='success'){
        		    		   alert('Successfully deleted!');
        		    		   location.reload();
        		    	   }else{
        		    		   alert('Not deleted!');
        		    	   }
        		       }
        		  });
        	} else {
        		 return false;
        	}
        });
	
})