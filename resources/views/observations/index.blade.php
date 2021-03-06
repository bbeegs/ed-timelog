@extends ('layout')
@section('content')
  <div class="column table-container is-mobile" style="min-height: 80vh;">
	<div class="box is-mobile has-background-light is-shadowless content" style="font-family: 'Varela Round', sans-serif;">
		<h3 class="ml-2 mb-2"><strong>Total Observation Hours: <span style="color: red;">{{$total_hours}}</span></strong></h3>
		<form method="GET" action="/">
			<div class="field is-horizontal is-align-content-center">
				<div class="field-body is-align-items-center">
					<div class="is-justify-content-space-between m-2">
						<label class="label">From:</label>
				  	</div>
			  		<div class="field">
				  		<input class="input" id="start_date" value="{{$start_date}}"name="start_date" type="date" onblur="submit()">
			  		</div>
			  		<div class="is-justify-content-space-between m-2">
						<label class="label">To:</label>
			  		</div>
			  		<div class="field">
						<input class="input" value="{{$end_date}}" id="end_date" type="date" name="end_date"  onblur="submit()">
					</div>
				</div>
			</div>
		</form>
	</div>
	<table class="table is-striped is-bordered is-hoverable is-fullwidth" style="font-family: 'Lora', serif;">
		<thead class="has-background-info-light" style="font-family: 'Varela Round', sans-serif;">
		    <tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Work Area</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Total Time</th>
			<th>Date</th>
			<th></th>
		    </tr>
		</thead>
		<tbody>
		    @foreach ($observations as $ob)
		    <tr >
			<td class="is-vcentered">{{$ob->first_name}}</td>
			<td class="is-vcentered">{{$ob->last_name}}</td>
			<td class="is-vcentered">{{$ob->area }}</td>
			<td class="is-vcentered">{{date_create($ob->observation_start)->format('H:i') }}</td>
			<td class="is-vcentered">{{date_create($ob->observation_end)->format('H:i')}}</td>
			<td class="is-vcentered">{{$ob->total_hours}}</td>
			<td class="is-vcentered">{{date_create($ob->observation_date)->format('M d, Y')}}</td>
			<td class ="is-vcentered"><div class="is-flex">
			    <form method="GET"
				  action="/observations/{{ $ob->id }}/edit"> 
				
				
				<button class="button is-light is-primary mr-3" type="submit" style="display: inline;">
				<span class="icon is-small">
				    <i class="fas fa-edit"></i>
				</span>
				<span>Edit</span>
				</button>
			    </form>
				<form method="post" 
				      action="/observations/{{$ob->id}}"> 
				    
				    @csrf
				    @method('DELETE')

				    <button
					type="submit"
					onclick="return confirm('Are you sure?')"
					class="button is-light is-danger">
				    <span class="icon is-small">
					<i class="far fa-trash-alt"></i>
				    </span><span>Remove</span></button>
				</form>
			</div>
			</td>
		    </tr>
		    @endforeach
		</tbody>
		</table>
	</div>
	<span class="is-flex is-justify-content-center">{{ $observations->appends($_GET)->links() }}</span>
@endsection 
