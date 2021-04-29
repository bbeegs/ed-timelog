<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Observation Tracker</title>
	<link href="{{asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
	<nav class="navbar" role="navigation" aria-label="main navigation">
	    <div class="navbar-brand">
		<a class="navbar-item" href="/">
		    <div class="content">
			<h3 class="has-text-link-dark m-0">Patient Observation Logbook</h3>
		    </div>
		</a>
		<a role="button" class="navbar-burger mr-3" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
		    <span aria-hidden="true" style="background-color: dodgerblue;"></span>
		    <span aria-hidden="true" style="background-color: dodgerblue;"></span>
		    <span aria-hidden="true" style="background-color: dodgerblue;"></span>
		</a>
	    </div>
	    <div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-end">
		    
		    <a class="navbar-item" href="/observations/create">
			<button class="button is-link is-light is-outlined" style="width: 100%;" >
			    <span class="icon is-small">
				<i class="fas fa-plus"></i>
			    </span>
			    <span>Enter Observation Time</span>
			</button>
		    </a>
		    <a class="navbar-item">
			<button class="button is-link is-light is-outlined" style="width: 100%;">
			    <span class="icon is-small">
				<i class="fas fa-file-download"></i>
			    </span>
			    <span>Export Records</span>
			</button>
		    </a>
		    <a class="navbar-item">
      			<div class="field">
			    <div class="select is-link" style="width: 100%;">
				<select style="width: 100%;">
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
	<script>
	 document.addEventListener('DOMContentLoaded', () => {

	     // Get all "navbar-burger" elements
	     const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

	     // Check if there are any navbar burgers
	     if ($navbarBurgers.length > 0) {

		 // Add a click event on each of them
		 $navbarBurgers.forEach( el => {
		     el.addEventListener('click', () => {

			 // Get the target from the "data-target" attribute
			 const target = el.dataset.target;
			 const $target = document.getElementById(target);

			 // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
			 el.classList.toggle('is-active');
			 $target.classList.toggle('is-active');

		     });
		 });
	     }

	 });
	</script>
	@yield ('content')
	
    </body>
</html>
