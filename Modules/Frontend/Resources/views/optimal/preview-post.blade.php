<!DOCTYPE html>
<html><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Content Live Preview</title>
	<style type="text/css" media="screen">
		@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600,300);

		html{
			height:100%;
		}

		body {
			font-family: 'Open Sans', sans-serif;
			height:100%;
			color:#fff;
			background: #1b1b1b!important;
			margin: 0;
		}

		#container{
			background: #1b1b1b!important;
		}
		div#inner_wrap {
			position: relative;
			padding-top: 100px;
		}

		/*Basic Phone styling*/

		.phone {
			border: 40px solid #121212;
			border-width: 55px 7px;
			border-radius: 40px;
			margin: 0 auto;
			overflow: hidden;
			-webkit-transition: all 0.5s ease;
			transition: all 0.5s ease;
			-webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
			-moz-animation: fadein 2s; /* Firefox < 16 */
			-ms-animation: fadein 2s; /* Internet Explorer */
			-o-animation: fadein 2s; /* Opera < 12.1 */
			animation: fadein 2s;
		}

		.phone iframe {
			border: 0;
			width: 100%;
			height: 100%;
			background-color:#000;
		}

		/*Different Perspectives*/
		div#views {
			display: flex;
		}

		/* Table View */
		.phone.view_1 {
			-webkit-transform: rotateX(50deg) rotateY(0deg) rotateZ(-30deg);
			transform: rotateX(50deg) rotateY(0deg) rotateZ(-30deg);
			box-shadow: -3px 3px 0 #000, -6px 6px 0 #000, -9px 9px 0 #000, -12px 12px 0 #000, -14px 10px 20px #000;
		}
		/*  Front View */
		.phone.view_2 {
			-webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
			transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
			box-shadow: 0px 3px 0 #000, 0px 4px 0 #000, 0px 5px 0 #000, 0px 7px 0 #000, 0px 10px 20px #000;
		}


		@-webkit-keyframes rotate {

			0%{-webkit-transform: rotateX(50deg) rotateY(0deg) rotateZ(-30deg);}
			50%{-webkit-transform: rotateX(50deg) rotateY(0deg) rotateZ(-40deg);}
			100%{-webkit-transform: rotateX(50deg) rotateY(0deg) rotateZ(-30deg);}
		}

		/* Rotate Animation */

		.view_1.rotate
		{
			-webkit-animation-name:            rotate;
			-webkit-animation-duration:        15s;
			-webkit-animation-iteration-count: infinite;
			-webkit-animation-timing-function: linear;
		}


		/*Controls*/

		#controls {
			position: absolute;
			top: 80px;
			left: 20px;
			font-size: 0.9em;
			color: #333;
			width:17px;
		}

		#controls div {
			margin: 10px;
		}

		#controls div label {
			width: 150px;
			display: block;
			float: left;
			color: #fff;
		}

		#phone-controls{
			position: fixed;
			top: 0;
			right: 0;
			font-size:14px;
			left: 0;
			display: flex;
			width: 100%;
			justify-content: center;
			align-items: center;
			background: #000;
			padding: 10px;
		}

		#phones {
			display: flex;
		}

		#phones button {
			outline: none;
			width: 100px;
			border-radius:5px;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			-o-border-radius:5px;
			background-color: #1b1b1b;
			border: none;
			height: 40px;
			color: #fff;
			-webkit-transition: all 0.2s;
			transition: all 0.2s;
			margin: 0 10px;
			cursor: pointer;
		}

		#phones button:hover {
			color: #444;
			background-color: #eee;
		}

		#views button {
			outline: none;
			width: 94px;
			border-radius:5px;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			-o-border-radius:5px;
			background-color: #1b1b1b;
			border: none;
			height: 40px;
			margin: 10px 0;
			color: #fff;
			-webkit-transition: all 0.2s;
			transition: all 0.2s;
			margin: 0 10px;
			cursor: pointer;
		}


		#views button:hover {
			color: #444;
			background-color: #eee;
		}

		@media (max-width:900px) {
			#wrapper {
				-webkit-transform: scale(0.8, 0.8);
				transform: scale(0.8, 0.8);
			}
		}

		@media (max-width:700px) {
			#wrapper {
				-webkit-transform: scale(0.6, 0.6);
				transform: scale(0.6, 0.6);
			}
			.phone { margin: 0 0 0 -70px; }
		}

		@media (max-width:500px) {
			#wrapper {
				-webkit-transform: scale(0.4, 0.4);
				transform: scale(0.4, 0.4);
			}
		}

		/* Fade In Animation */

		@keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}

		/* Firefox < 16 */
		@-moz-keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}

		/* Safari, Chrome and Opera > 12.1 */
		@-webkit-keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}

		/* Internet Explorer */
		@-ms-keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}

		/* Opera < 12.1 */
		@-o-keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}
	</style>
</head>
<body>
	<div id="inner_wrap">

		<!--The Main Thing-->
		<div id="wrapper" style="perspective: 1300px;">
			<div class="phone view_2" id="phone_1" style="width: 1200px; height: 768px;">
				<iframe src="{{$url}}" id="frame_1"></iframe>
			</div>
		</div>

		<!--Controls etc.-->
		<div id="controls">
			<!--Idea by /u/aerosole-->
			<div style="display:none;">
				<label for="iframePerspective">Add perspective:</label>
				<input type="checkbox" id="iframePerspective" checked="true">
			</div>

		</div>

		<div id="phone-controls">

			<div id="views">
				<button value="1">Table View</button>
				<button value="2">Front View</button>
			</div>

			<div id="phones">
				<button value="1">iPhone 6</button>
				<button value="2">Android</button>
				<button value="3">iPad Mini</button>
				<button value="4">Macbook</button>
				<button type="button" onclick="window.location='{{ $url }}'">Full Window</button>
			</div>
		</div>
	</div>

	<script>
		/*Only needed for the controls*/
		phone = document.getElementById("phone_1"),
		iframe = document.getElementById("frame_1");


		/*View*/
		function updateView(view) {
			if (view) {
				phone.className = "phone view_" + view;
			}
		}

		/*Controls*/
		function updateIframe() {

			// preload iphone width and height
			phone.style.width = "375px";
			phone.style.height = "667px";

			/*Idea by /u/aerosole*/
			document.getElementById("wrapper").style.perspective = (
				document.getElementById("iframePerspective").checked ? "1300px" : "none"
				);

		}

		updateIframe();

		/*Events*/
		document.getElementById("controls").addEventListener("change", function() {
			updateIframe();
		});

		document.getElementById("views").addEventListener("click", function(evt) {
			updateView(evt.target.value);
		});

		document.getElementById("phones").addEventListener("click", function(evt) {

			if(evt.target.value == 1){
    			// iphone 6
    			width = 375;
    			height = 667;
    		}
    		if(evt.target.value == 2){
    			// htc
    			width = 480;
    			height = 767;
    		}
    		if(evt.target.value == 3){
    			// ipad mini
    			width = 768;
    			height = 1024;
    		}

    		if(evt.target.value == 4){
    			// Mackbook
    			width = 1200;
    			height = 768;
    		}

    		phone.style.width = width + "px";
    		phone.style.height = height + "px";

    	});


		iframe = document.getElementById('frame_1');

		if (iframe.attachEvent){
			iframe.attachEvent("onload", function(){
				afterLoading();
			});
		} else {
			iframe.onload = function(){
				afterLoading();
			};
		}


	</script>

</body></html>