function PCAppFunctions(){
	this.get_document_sections = function(parent_id){
	    $('#subSections'+parent_id).html('Loading...').css({borderBottom:'8px solid #F00',padding:'15px 0',marginBottom:'16px'});
	    $.get('/policies/sections/{{$policy->id}}/'+parent_id,null,function(html){
	        $('#subSections'+parent_id).html(html);
	    });
	}
	this.show_comments = function(type,id){
	    $('#'+type+'CommentsBox'+id).slideDown(500);
	}
	this.rate_ajax = function(id,sid,rating){
	    var url = "/";
	    if(sid){
            url = '/rate/d/'+id+'/s/'+sid+'/r/'+rating
	        $.get(url,null,function(data){
	            if(data['calculated']){
	                if(data['calculated'][2]=='section'){
	                    $('#ratingBoxSection'+data['calculated'][0]+' .rating-thumb').removeClass('calculated');
	                    if(data['calculated'][1]){
	                        $('#ratingBoxSection'+data['calculated'][0]).addClass('rating-calculated');
	                        $('#ratingBoxSection'+data['calculated'][0]+' .rating'+data['calculated'][1]).addClass('calculated');
	                    }
	                    else
	                        $('#ratingBoxSection'+data['calculated'][0]).removeClass('rating-calculated');
	                }
	                else if(data['calculated'][2]=='document'){
	                    $('#ratingBoxDocument'+data['calculated'][0]+' .rating-thumb').removeClass('calculated');
	                    if(data['calculated'][1])
	                        $('#ratingBoxDocument'+data['calculated'][0]+' .rating'+data['calculated'][1]).addClass('calculated');
	                }
	            }
	        });
	        $('#ratingBoxSection'+sid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
	        $('#ratingBoxSection'+sid+' .rating'+rating).removeClass('calculated').addClass('selected');
	        $('#ratingBoxSection'+sid).removeClass('rating-calculated');
	    }
	    else{
            url = '/rate/d/'+id+'/r/'+rating
	        $.get(url);
	        $('#ratingBoxDocument'+id+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
	        $('#ratingBoxDocument'+id+' .rating'+rating).addClass('selected');
	    }
	}
	this.post_comment = function(e, textarea, type, id){
	    var code = (e.keyCode ? e.keyCode : e.which);
	    if(code == 13){
	        var comment = textarea.value.replace(/(\r\n|\n|\r)/gm,"");
	        textarea.value = comment;
	        axios.post('/comment/'+type+'/'+id,{type:type, id:id, comment:comment}).then(function(response){ $('#'+type+'CommentsList'+id).append(response.data); textarea.value="" }).catch(function(error){ console.log(error); });
	    }
	}
	this.add_question = function(document_id){
        axios.post('/comment/'+type+'/'+id,{type:type, id:id, comment:comment}).then(function(response){ $('#'+type+'CommentsList'+id).append(response.data); textarea.value="" }).catch(function(error){ console.log(error); });
	}

	this.textarea_auto_size = function(){
	    var text = $('.auto-size');

	    function resize (that) {
	        console.log('resize');
	        if(that){
	            var scrollHeight = that.scrollHeight;
	            that.style.height = scrollHeight+'px';
	        }
	        else{
	            $.each(text,function(index,value){
	                var scrollHeight = this.scrollHeight;
	                this.style.height = scrollHeight+'px';
	            });
	        }
	    }
	    /* 0-timeout to get the already changed text */
	    function delayedResize (that) {
	        window.setTimeout(function(){resize(that);}, 0);
	    }
	    $.each(text,function(index,value){
	        var that = this;
	        $(that).on('change',function(){resize(that);});
	        $(that).on('cut',function(){delayedResize(that);});
	        $(that).on('paste',function(){delayedResize(that);});
	        $(that).on('drop',function(){delayedResize(that);});
	        $(that).on('keydown',function(){delayedResize(that);});
	    });

	    resize();
	}    

}
module.exports= new PCAppFunctions();
