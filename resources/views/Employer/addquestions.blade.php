@extends('Employer.layouts.app')
@section('title', 'Add Question')
@section('content')
	@if($questiondetails)
		@php $question=$questiondetails->question;
		$questionid=$questiondetails->id;
		$marks=$questiondetails->marks;
		$is_required=$questiondetails->is_required;
		$is_shuffle=$questiondetails->is_suffle;
		$options=explode(',',$questiondetails->options);@endphp
	@else
	@php $question='';
		$questionid=0;
		$marks='';
		$is_required='';
		$is_shuffle='';
		$options=array();@endphp
	@endif
    <style type="text/css">
	    	#field {
    			/*margin-bottom:20px;*/
			}
			.company{
				width: 100%;
    			border-radius: 0 50px 50px 0;
    			padding: 9px 15px;
			}
	    </style> 
<div class="page-title">
			<div class="container">
				<div class="">
					<div class="page-caption">
						<h2 class="subheader-heading">Add Questions</h2>
					</div>
				</div>
				
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section>
			<div class="container">
				
				<form action="{{route('addnewquestion',[base64_encode($questionnaire_id)])}}" method="post">
					{{csrf_field()}}
					<div class="row">
						<div class="col-sm-12">
							<label>Question Title <span>*</span></label>
							<input type="text" class="form-control" value="{{$question}}" name="questions">
							<input type="hidden" name="questionid" value="{{$questionid}}">
						</div>
						<div class="col-sm-6">
							<label>Marks <span>*</span></label>
							<input type="number" class="form-control" name="marks" value="{{$marks}}">
						</div>
						<div class="col-sm-6">
							<label>Option <span>*</span></label>
							<div id="field">
								@if(sizeof($options)<=0)
		                    	<div class="row" id="field1">
		                    		<div class="col-sm-10 padd-r-0">
		                    			
			                    		<input class="form-control " autocomplete="off" class="input"  name="options[]" type="text"  data-items="8"/>
			                    	
			                    	</div>
			                    	<div class="col-sm-2 padd-l-0">
			                    		<button class="btn theme-btn add-more-company company" type="button">+</button>
			                    	</div>
		                    	</div>
		                    		@else
		                    		@for($i=0;$i<sizeof($options);$i++)
		                    		@if($i==0)
		                    			<div class="row" id="field1">
			                    		<div class="col-sm-10 padd-r-0">
			                    			
				                    		<input class="form-control " autocomplete="off" class="input" value="{{$options[$i]}}" name="options[]" type="text"  data-items="8"/>
				                    	
				                    	</div>
				                    	<div class="col-sm-2 padd-l-0">
				                    		<button class="btn theme-btn add-more-company company" type="button">+</button>
				                    	</div>
			                    	</div>
		                    		@else
			                    	<div class="row" id="field{{$i}}" ><div class="col-sm-10 padd-r-0"><input autocomplete="off" class="input form-control" value="{{$options[$i]}}" name="options[]" type="text"></div><div class="col-sm-2 padd-l-0"> <button id="remove{{$i}}" class="btn btn-danger company  remove-me" >-</button></div>
			                    	@endif
			                    	@endfor
		                    	@endif

		                    </div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<span class="custom-checkbox">
									<input @if($is_required==1) checked="checked" @endif type="checkbox" id="required" name="is_required">
									<label for="required"></label>Required
								</span>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<span class="custom-checkbox">
									<input @if($is_shuffle==1) checked="checked" @endif type="checkbox" id="shuffle_questions" name="is_shuffle">
									<label for="shuffle_questions"></label>Shuffle Questions
								</span>
							</div>
						</div>
					</div>
				<div class="text-right">
                  <a href="{{route('questions',[base64_encode($questionnaire_id)])}}" class="btn btn-m light-gray-btn"> Back </a>
                  <button type="submit" class="btn btn-m theme-btn"> Save </button>
                </div>
				</form>
				
				
			</div>
		</section>

		@endsection
@section('page-footer')
<script type="text/javascript">
			$(document).ready(function(){
		    var next = 1;
		    $(".add-more-company").click(function(e){
		        e.preventDefault();
		        var addto = "#field" + next;
		        var addRemove = "#field" + (next);
		        next = next + 1;
		        var newIn = '<div class="row" id="field' + next + '" ><div class="col-sm-10 padd-r-0"><input autocomplete="off" class="input form-control"  name="options[]" type="text"></div><div class="col-sm-2 padd-l-0"> <button id="remove' + next + '" class="btn btn-danger company  remove-me" >-</button></div>';
		        var newInput = $(newIn);
		        // var removeBtn = '</div><div id="field">';
		      // var removeButton = $(removeBtn);
		        $(addto).after(newInput);
		        // $(addRemove).after(removeButton);
		        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
		        $("#count").val(next);  
		        
		            $('.remove-me').click(function(e){
		                e.preventDefault();
		                var fieldNum = this.id.charAt(this.id.length-1);
		                var fieldID = "#field" + fieldNum;
		                $(this).remove();
		                $(fieldID).remove();
		            });
		    });    
		});
		</script>
@endsection