@extends ('layout')
@section('content')

  <div class="column table-container is-mobile" style="min-height: 70vh;">
	<table class="table is-striped is-bordered is-hoverable is-fullwidth">
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
			<td class="is-vcentered">{{date_create($ob->observation_start)->format('H:i:s') }}</td>
			<td class="is-vcentered">{{date_create($ob->observation_end)->format('H:i:s')}}</td>
			<td class="is-vcentered">{{$ob->total_hours }}</td>
			<td class="is-vcentered">{{date_create($ob->observation_date)->format('M d, Y')}}</td>
			<td class ="is-vcentered"><div class="is-flex">
			    <form method="GET"
				  action="/observations/{{ $ob->id }}/edit"> 
				
				
				<button class="button is-light is-success mr-3" type="submit" style="display: inline;"
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
	<span class="is-flex is-justify-content-center">{{ $observations->links() }}</span>
@endsection 
