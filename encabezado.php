<?php
/*
	Pequeño, muy pequeño sistema de ventas en PHP con MySQL

	@author parzibyte

	No olvides visitar parzibyte.me/blog para más cosas como esta
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
	<link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/estilo.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<style>
		@import url('https://rsms.me/inter/inter.css');

		:root {
			--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
			font-size: 15px;
		}

		body {
			text-rendering: optimizeSpeed;
			/* color: #1d273b; */
			font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto ColorEmoji;
			font-size: var(--tblr-body-font-size);
			font-feature-settings: "cv03", "cv04", "cv11";
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
	</style>
</head>

<body class="border-top-wide border-primary theme-light">
	<script>
		! function(e) {
			"function" == typeof define && define.amd ? define(e) : e()
		}((function() {
			"use strict";
			var e, t = "tablerTheme",
				n = new Proxy(new URLSearchParams(window.location.search), {
					get: function(e, t) {
						return e.get(t)
					}
				});
			if (n.theme) localStorage.setItem(t, n.theme), e = n.theme;
			else {
				var o = localStorage.getItem(t);
				e = o || "light"
			}
			document.body.classList.remove("theme-dark", "theme-light"), document.body.classList.add("theme-".concat(e))
		}));
	</script>

	<div class="d-md-flex ms-auto me-3 float-end">
		<a href="?theme=dark" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Aktifkan mode gelap" data-bs-original-title="Aktifkan mode gelap">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
			</svg>
		</a>
		<a href="?theme=light" class="nav-link px-0 hide-theme-light" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Aktifkan mode terang" data-bs-original-title="Aktifkan mode terang">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<circle cx="12" cy="12" r="4"></circle>
				<path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
			</svg>
		</a>
	</div>
	<!-- <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">POS</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="./listar.php">Productos</a></li>
					<li><a href="./vender.php">Vender</a></li>
					<li><a href="./ventas.php">Ventas</a></li>
				</ul>
			</div>
		</div>
	</nav> -->
	<div class="container mt-5">
		<div class="row">