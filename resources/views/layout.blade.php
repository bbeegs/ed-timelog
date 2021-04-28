<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Observation Tracker</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
	<nav class="navbar" role="navigation" aria-label="main navigation">
	    <div class="navbar-brand">
		<a class="navbar-item" href="/">
		    <h1 class="title has-text-link-dark">Emergency Department Patient Observation Logbook</h1>
		</a>
		<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
		    <span aria-hidden="true"></span>
		    <span aria-hidden="true"></span>
		    <span aria-hidden="true"></span>
		</a>
	    </div>
		<div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-end">
		    
		    <a class="navbar-item" href="/observations/create">
			<button class="button is-link is-light is-outlined">
			    <span class="icon is-small">
				<i class="fas fa-plus"></i>
			    </span>
			    <span>Enter Observation Time</span>
			</button>
		    </a>
		    <a class="navbar-item">
			<button class="button is-link is-light is-outlined">
			    <span class="icon is-small">
				<i class="fas fa-file-download"></i>
			    </span>
			    <span>Export Records</span>
			</button>
		    </a>
		    <a class="navbar-item">
      			<div class="field">
			    <div class="select is-link">
				<select>
				    <option>Sort Records By:</option>
				    <option>Day</option>
				    <option>Week</option>
				    <option>Month</option>
				    <option>Year</option>
				</select>
			    </div>
			</div>
		    </a>
	</nav>
	@yield ('content')
	
    </body>
</html>
