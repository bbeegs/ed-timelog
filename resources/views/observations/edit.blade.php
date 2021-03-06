@extends ('layout')
@section('content')
    <div class="rows is-mobile" style="font-family: 'IBM Plex Serif', serif; min-height: 100vh;">
	<div class="column is-justify-content-center">
	    <form method="POST" action="/observations/{{ $observation->id }}">
		@csrf
		@method('PUT')
		<div class="field">
		<label class="label">First Name</label>
		<div class="control has-icons-left has-icons-right">
		    <input class="input " type="text" name="first_name" placeholder="EDTA First Name" value="{{ $observation->first_name }}">
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
		    <input class="input " type="text" name="last_name" placeholder="EDTA Last Name" value="{{ $observation->last_name }}">
		    <span class="icon is-small is-left">
			<i class="fas fa-user"></i>
		    </span>
		</div>
		@error('last_name')
		<p class="help is-danger">{{$errors->first('first_name')}}</p>
		@enderror
	    </div>
	    
	    
	    <div class="field">
		<label class="label">Observation Location</label>
		<div class="control">
		    <div class="select">
			<select value="{{ $observation->area }}" name="area">
			    <option {{ $observation->area == 'A Side' ? 'selected' : '' }}>A Side</option>
			    <option {{ $observation->area == 'B Side' ? 'selected' : '' }}>B Side</option>
			    <option {{ $observation->area == 'C Side' ? 'selected' : '' }}>C Side</option>
			    <option {{ $observation->area == 'Express Care' ? 'selected' : '' }}>Express Care</option>
			    <option {{ $observation->area == 'D Hall' ? 'selected' : '' }}>D Hall</option>
			</select>
		    </div>
		</div>
		 @error('area')
		<p class="help is-danger">{{$errors->first('area')}}</p>
		@enderror
	    </div>
	     <div class="field">
		<label class="label">Date</label>
		<div class="control">
		    <input class="input" name="observation_date" type="date" value="{{ $observation->observation_date }}" >
		</div>
		@error('observation_date')
		<p class="help is-danger">{{$errors->first('observation_date')}}</p>
		@enderror
	     </div>
	     
	    
	    <div class="field">
		<label class="label">Start Time</label>
		<div class="control">
		    <input class="input" name="start_time" type="time" value="{{date("H:i", strtotime($observation->observation_start))  }}">
		</div>
		@error('start_time')
		<p class="help is-danger">{{$errors->first('start_time')}}</p>
		@enderror
	    </div>
	    <div class="field">
		<label class="label">End Time</label>
		<div class="control">
		    <input class="input" type="time" name="end_time" value="{{date("H:i", strtotime($observation->observation_end))  }}">
		</div>
		@error('end_time')
		<p class="help is-danger">{{$errors->first('end_time')}}</p>
		@enderror
	    </div>
	    <div class="field is-grouped">
		<div class="control">
		    <button class="button is-link">Submit</button>
		</div>
		<div class="control">
		    <button class="button is-link is-light">Cancel</button>
		</div>
	    </div>
	    </form>
	</div>
    </div>
@endsection
