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
	this.add_policy_section = function(policy_id,parent_section_id){
		if(!parent_section_id)
			parent_section_id=0;
        axios.post('/add/policy/section',{policy_id:policy_id,parent_section_id:parent_section_id}).then(function(response) {$('#subSections'+parent_section_id).append(response.data) }).catch(function(error){ console.log(error); });
	}
	this.add_rfp_section = function(rfp_id,parent_section_id){
		if(!parent_section_id)
			parent_section_id=0;
        axios.post('/add/rfp/section',{rfp_id:rfp_id,parent_section_id:parent_section_id}).then(function(response) {$('#subSections'+parent_section_id).append(response.data) }).catch(function(error){ console.log(error); });
	}
	this.add_question_section = function(question_id){
        axios.post('/add/question/section',{question_id:question_id}).then(function(response) {$('#questionsContainer').append(response.data) }).catch(function(error){ console.log(error); });
	}

	this.update_policy_section = function(policy_id,section_id,title,content){
		if(typeof(this.update_timeouts[section_id]) === 'undefined')
			this.update_timeouts[section_id]={timeout:null,title:title,content:content};
		if(this.update_timeouts[section_id]['timeout']){
			clearTimeout(this.update_timeouts[section_id]['timeout']);
		}
		var that = this;
		this.update_timeouts[section_id]['timeout'] = setTimeout(
			function(){
				if(that.update_timeouts[section_id]['title'] != title || that.update_timeouts[section_id]['content'] != content){
					console.log('update policy section',policy_id,section_id,title,content);
					that.update_timeouts[section_id]['title'] = title;
					that.update_timeouts[section_id]['content'] = content;
				}
			},3000);

//		if(!parent_section_id)
//			parent_section_id=0;
//        axios.post('/update/policy/section',{_method:'PUT',policy_id:policy_id,parent_section_id:parent_section_id}).then(function(response) {$('#subSections'+parent_section_id).append(response.data) }).catch(function(error){ console.log(error); });
	}
	this.update_rfp_section = function(rfp_id,section_id,title,content){
		if(typeof(this.update_timeouts[section_id]) === 'undefined')
			this.update_timeouts[section_id]={timeout:null,title:title,content:content};
		if(this.update_timeouts[section_id]['timeout']){
			clearTimeout(this.update_timeouts[section_id]['timeout']);
		}
		var that = this;
		this.update_timeouts[section_id]['timeout'] = setTimeout(
			function(){
				if(that.update_timeouts[section_id]['title'] != title || that.update_timeouts[section_id]['content'] != content){
					console.log('update rfp section',rfp_id,section_id,title,content);
					that.update_timeouts[section_id]['title'] = title;
					that.update_timeouts[section_id]['content'] = content;
				}
			},3000);
	}
	this.update_question_section = function(question_id,section_id,content){
        axios.post('/update/question/section',{_method:'PUT',question_id:question_id,section_id:section_id,staged_content:content}).then(function(response){}).catch(function(error){ console.log(error); });
	}
	this.update_timeouts = {};

	this.textarea_auto_size = function(){
	    var text = $('.auto-size');

	    function resize (that) {
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
