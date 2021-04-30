@extends ('layout')
@section('content')
    <div class="rows is-mobile" style="font-family: 'IBM Plex Serif', serif;">
	<div class="column is-justify-content-center">
	    <form method="POST" action="/observations">
		@csrf
		<div class="field">
		    <label class="label">First Name</label>
		    <div class="control has-icons-left has-icons-right">
			<input class="input @error('first_name') is-danger @enderror"
			       type="text" name="first_name"
			       placeholder="EDTA First Name"
			       value="{{ old('first_name') }}">
			<span class="icon is-small is-left">
			    <i class="fas fa-user"></i>
			</span>
		    </div>
		    @error('first_name')
			<p class="help is-danger">{{$errors->first('first_name')}}</p>
		    @enderror
		</div>
		
		
	    <div class="field">
		<label class="label">Last Name</label>
		<div class="control has-icons-left has-icons-right">
		    <input class="input @error('last_name') is-danger @enderror"
			   type="text"
			   name="last_name"
			   placeholder="EDTA Last Name"
			   value="{{ old('last_name') }}" >
		    <span class="icon is-small is-left">
			<i class="fas fa-user"></i>
		    </span>
		</div>
		@error('last_name')
		<p class="help is-danger">{{$errors->first('last_name')}}</p>
		@enderror
	    </div>
	    
	    
	    <div class="field" >
		<label class="label">Observation Location</label>
		<div class="control">
		    <div class="select">
			<select name="area">
			    <option>A Side</option>
			    <option>B Side</option>
			    <option>C Side</option>
			    <option>Express Care</option>
			    <option>D Hall</option>
			</select>
		    </div>
		</div>
	    </div>
	    <div class="field">
		<label class="label">Date</label>
		<div class="control">
		    <input class="input" name="observation_date" type="date" value="{{ date('Y-m-d') }}" >
		</div>
	    </div>
		
	    <div class="field">
		<label class="label">Start Time</label>
		<div class="control">
		    <input class="input" name="start_time" type="time" value="" >
	    </div>
	    </div>
	    <div class="field">
		<label class="label">End Time</label>
		<div class="control">
		    <input class="input" type="time" name="end_time" value="" >
		</div>
	    </div>
	    <div class="field is-grouped">
		<div class="control">
		    <button class="button is-link">Submit</button>
		</div>
		<div class="control">
		    <button id="cancel" class="button is-link is-light">Cancel</button>
		</div>
	    </div>
	    </form>
	</div>
    </div>
    <script>
     document.getElementById("cancel").addEventListener('click', function(event){
	 event.preventDefault();
	 window.location.replace('/');
     });
    </script>
@endsection
