<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient Observation Tracker</title>
	<link href="{{secure_asset('css/app.css') }}" rel="stylesheet">
	<style>
		a.navbar-item:hover{
			background-color: hsl(0, 0%, 96%);
		}
	</style>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
</head>
    <body>
	<nav class="navbar has-background-light" role="navigation" aria-label="main navigation" style="font-family: 'Varela Round', sans-serif;">
	    <div class="navbar-brand">
		<a class="navbar-item" href="/">
		    <div class="content">
			<h4 class="has-text-link-dark m-0">
			    <span>
				<i class="fas fa-book-medical"> </i>
			    </span>
				<span>Patient Observation Log</span></h4>
		    </div>
		</a>
		<a role="button" class="navbar-burger mr-3 has-background-light" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
		    <span aria-hidden="true" ></span>
		    <span aria-hidden="true" ></span>
		    <span aria-hidden="true" ></span>
		</a>
	    </div>
	    <div id="navbarBasicExample" class="navbar-menu is-hovered is-shadowless">
		<div class="navbar-end">
		    <a class="navbar-item" href="/observations/create">
				<button class="button is-link" style="width: 100%;" >
			    <span class="icon is-small">
					<i class="fas fa-plus"></i>
			    </span>
			    	<span>Enter Observation Time</span>
				</button>
		    </a>
		    <a class="navbar-item has-text-link-dark" onclick="runExport()">
			<button class="button is-primary" style="width: 100%;">
			    <span class="icon is-small">
				<i class="fas fa-file-download"></i>
			    </span>
			    <span>Export Records</span>
			</button>
		    </a>
	</nav>
	<script>
		function runExport(){
				const start = document.getElementById('start_date').value;
				const end = document.getElementById('end_date').value;
				window.location = '/observations/export?start_date=' + start + '&end_date=' + end;
			}
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
	<footer class="footer">
	    <div class="content has-text-centered">
		<p>
		To request a feature <i class="far fa-smile"></i>
		    Or report a bug <i class="fas fa-bug"></i>
		    Email <a href="mailto: brianbeegan@protonmail.com">Meg's Husband</a>
		</p>
	    </div>
	</footer>
    </body>
</html>
