@extends ('layout')
@section('content')
    <div class="rows is-mobile" style="font-family: 'IBM Plex Serif', serif;">
	<div class="content ml-3 is-flex is-justify-content-space-between">
	    <h3>
		<?php
		date_default_timezone_set('US/Eastern');
		echo date("l - F j, Y - g:i a");
		?>
	    </h3>
	</div>

	
	<div class="column is-justify-content-center">
	    <table class="table is-striped is-bordered is-fullwidth is-hoverable">
		<thead class="has-background-info-light">
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
			<td class="is-vcentered">{{$ob->observation_start }}</td>
			<td class="is-vcentered">{{$ob->observation_end }}</td>
			<td class="is-vcentered">{{$ob->total_hours }}</td>
			<td class="is-vcentered">{{$ob->observation_date }}</td>
			<td class ="is-flex">
			    <form method="GET" 
				  action="/observations/{{ $ob->id }}/edit"> 
				
				
				<button class="button is-light is-success mr-3" type="submit"
					@if($ob->observation_date <  \Carbon\Carbon::today()->subDays(31)) title="Disabled button"  disabled @endif>
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

				    <button @if($ob->observation_date <  \Carbon\Carbon::today()->subDays(31)) title="Disabled button"  disabled @endif
					type="submit"
					onclick="return confirm('Are you sure?')"
					class="button is-light is-danger">Remove</button>
				</form>
			</td>
		    </tr>
		    @endforeach
		</tbody>
	    </table>
	    <span>{{ $observations->links() }}</span>
	</div>
    </div>
@endsection 
