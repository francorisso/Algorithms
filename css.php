<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Lalala</title>
<style type="text/css">
	.csstransforms .cn-wrapper {
  font-size:1em;
  width: 26em;
  height: 26em;
  overflow: hidden;
  position: fixed;
  z-index: 10;
  bottom: -13em;
  left: 50%;
  border-radius: 50%;
  margin-left: -13em;
  transform: scale(0.1);
  transition: all .3s ease;
}
/* class applied to the container via JavaScript that will scale the navigation up */
.csstransforms .opened-nav {
  border-radius: 50%;
  transform: scale(1);
}

.csstransforms .cn-wrapper li {
  position: absolute;
  font-size: 1.5em;
  width: 10em;
  height: 10em;
  transform-origin: 100% 100%;
  overflow: hidden;
  left: 50%;
  top: 50%;
  margin-top: -1.3em;
  margin-left: -10em;
  transition: border .3s ease;
}
 
.csstransforms .cn-wrapper li a {
  display: block;
  font-size: 1.18em;
  height: 14.5em;
  width: 14.5em;
  position: absolute;
  position: fixed; /* fix the "displacement" bug in webkit browsers when using tab key */
  bottom: -7.25em;
  right: -7.25em;
  border-radius: 50%;
  text-decoration: none;
  color: #fff;
  padding-top: 1.8em;
  text-align: center;
  transform: skew(-50deg) rotate(-70deg) scale(1);
  transition: opacity 0.3s, color 0.3s;
}
 
.csstransforms .cn-wrapper li a span {
  font-size: 1.1em;
  opacity: 0.7;
}
/* for a central angle x, the list items must be skewed by 90-x degrees
in our case x=40deg so skew angle is 50deg
items should be rotated by x, minus (sum of angles - 180)2s (for this demo) */
 
.csstransforms .cn-wrapper li:first-child {
  transform: rotate(-10deg) skew(50deg);
}
 
.csstransforms .cn-wrapper li:nth-child(2) {
  transform: rotate(30deg) skew(50deg);
}
 
.csstransforms .cn-wrapper li:nth-child(3) {
  transform: rotate(70deg) skew(50deg)
}
 
.csstransforms .cn-wrapper li:nth-child(4) {
  transform: rotate(110deg) skew(50deg);
}
 
.csstransforms .cn-wrapper li:nth-child(5) {
  transform: rotate(150deg) skew(50deg);
}
 
.csstransforms .cn-wrapper li:nth-child(odd) a {
  background-color: #a11313;
  background-color: hsla(0, 88%, 63%, 1);
}
 
.csstransforms .cn-wrapper li:nth-child(even) a {
  background-color: #a61414;
  background-color: hsla(0, 88%, 65%, 1);
}
 
/* active style */
.csstransforms .cn-wrapper li.active a {
  background-color: #b31515;
  background-color: hsla(0, 88%, 70%, 1);
}
 
/* hover style */
.csstransforms .cn-wrapper li:not(.active) a:hover,
.csstransforms .cn-wrapper li:not(.active) a:active,
.csstransforms .cn-wrapper li:not(.active) a:focus {
  background-color: #b31515;
  background-color: hsla(0, 88%, 70%, 1);
}

</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	});
</script>
</head>
<body>
	<div class="cn-wrapper opened-nav" id="cn-wrapper">
	<ul>
		<li><a href="#"><span></span></a></li>
		<li><a href="#"><span></span></a></li>
		<li><a href="#"><span></span></a></li>
		<li><a href="#"><span></span></a></li>
		<li><a href="#"><span></span></a></li>
	</ul>
	</div>
</body>
</html>