<!DOCTYPE html>
<html>
<?php if(isset($_FILES["file1"]["tmp_name"])){
		$b64e = 'data:'.mime_content_type($_FILES["file1"]["tmp_name"]).';base64,'.base64_encode(file_get_contents($_FILES["file1"]["tmp_name"]));
	} else {
		$b64e = 'data:'.mime_content_type('shibaimg.jpg').';base64,'.base64_encode(file_get_contents('shibaimg.jpg'));
	}
?>
<head>
<style>
	* {
 		outline: none;
 	}
	canvas {
		border: 1px solid #666;
	}
 	body {
 		background: url('shibebg.jpg'); 
 		color: white; 
 		text-align: center; 
 		font-family: Verdana, Geneva, sans-serif; 
 		font-size: 10px; 
 		color: black;
 	}
   	form {
   		margin-bottom: 0px;
   	}
  	textarea {
  		padding: 0px; 
  		margin: 0px;
  	}
  	#hueslider, #lightslider {
  		display: inline-block; 
  		background: blue; 
  		height: 20px; 
  		width: 200px;}
 	#sb-wrapper {
 		background: black;
 	}
 	.file_button_container,.file_button_container input, #form1 {
    	height: 16px;
       	width: 57px;
   	}
  	.file_button_container:hover {
		background-position-y: -16px;  
  	}
 	.file_button_container {
    	background: transparent url('shibebuttons.png') 0px 0px no-repeat;
	   	display: inline-block;
   	}
 	.random_button_container:hover {
		background-position-y: -16px;  
  	}
 	.random_button_container {
       	background: transparent url('shibebuttons.png') -391px 0px no-repeat;
	   	display: inline-block;
   	}
  	.random_button_container,.random_button_container input {
       	height: 16px;
       	width: 92px;
   	}
 	.file_button_container input {
       	opacity: 0;
   	}
   	.random_button_container input {
     	opacity: 0;
   	}
   	.button, .transctl {
	   	display: block;
	   	float: left;
   	}
   	.button {margin-right: 1px; background: url('shibebuttons.png'); height: 22px;}
   	.transctl {margin-right: 10px; background: url('shibebuttons.png'); height: 16px;}
   	.footerbtn {background: url('shibebuttons.png'); height: 16px;}
   	.gamebtn {border: 1px solid #666; margin-right: 5px; float: left;}
   	.gamebtn:hover {border: 1px solid #999;}
   	.gamebtn.selected {border: 1px solid #FC7D3A;}
   	.resizebtn { background-position: -126px 0; width: 34px; height: 16px;}
   	.movebtn {background-position: -62px 0; width: 43px;}
   	.rotatebtn {background-position: -160px 0; width: 35px; height: 16px;}
   	.colorbtn {background-position: -195px 0; width: 30px; height: 16px;}
   	.brightbtn {background-position: -260px 0; width: 92px; height: 16px;}
   	.transbtn {background-position: -708px 0; width: 35px; height: 16px;}
   	.offbtn { background-position: -41px 0; width: 20px;}
   	.onbtn {background-position: 0 0; width: 16px;}
   	.semibtn {background-position: -15px 0; width: 27px;}
   	.save {width: 46px; display: inline-block; background-position: 223px 0px;}
   	.post {width: 85px; display: inline-block; background-position: 177px 0px;}
   	.button:hover {background-position-y: -16px;}
   	.transctl:hover, .footerbtn:hover {background-position-y: -16px}
   	.button.selected {background-position-y: -32px;}
   	#container {width: 728px; margin-left: auto; margin-right: auto;}
   	#controlbox {float: right; height: 80px; width: 573px;}
   	#buttonbox {float: left;}
   	.adjustbox {width: 218px; height: 12px;float: left; margin: 2px 0 2px 0;}
   	.adjustbox2 {width: 218px; height: 12px; margin: 2px 0 2px 0;}
   	#resize-smaller {height: 12px; width: 49px; float: left; background: url('shibebuttons.png') no-repeat -746px 0px;}
   	#resize-larger 	{height: 12px; width: 41px; float: right; background: url('shibebuttons.png') no-repeat -705px 0px;}
   	#rotate-cw 		{height: 12px; width: 113px; float: left; background: url('shibebuttons.png') no-repeat -592px 0px;}
   	#rotate-ccw 	{height: 12px; width: 60px; float: right; background: url('shibebuttons.png') no-repeat -532px 0px;}
   	#huelbl 		{height: 12px; width: 22px; float: left; background: url('shibebuttons.png') no-repeat -649px -32px;}
   	#brightlbl 		{height: 12px; width: 33px; float: left; background: url('shibebuttons.png') no-repeat -694px -32px;}
   	#satlbl 		{height: 12px; width: 23px; float: left; background: url('shibebuttons.png') no-repeat -671px -32px;}
   	#resize-slider 	{width: 134px; float: left; margin: 2px 4px 0 4px;}
   	#rotate-slider 	{width: 162px; float: left; margin: 2px 4px 0 4px;}
   	#hue-slider 	{width: 140px; float: right; margin: 2px 10px 0 5px;}
   	#bright-slider 	{width: 140px; float: right; margin: 2px 10px 0 5px;}
   	#sat-slider 	{width: 140px; float: right; margin: 2px 10px 0 5px;}
   	#sb-info, #sb-title {display: none !important;}
   	#canvas2 {display: none;}
   	#canvas:hover {cursor: move;}
   	.hidden {display: none;}
  	.selected {display: block;}
  	#inputarea {float: left; text-align: left;}
 </style>
<link rel="stylesheet" type="text/css" href="jquery-custom.css" />
<link rel="stylesheet" type="text/css" href="shadowbox.css">
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js' type='text/javascript'></script>
<script src='./pixastic.custom.js' type='text/javascript'></script>
<script type="text/javascript" src="shadowbox.js"></script>
<script>
Shadowbox.init({
    modal: true,
	displayNav: false,
	enableKeys: false
});
var tool = 'MOVE';
var trans = 'OFF';
var game = 'WC';
var canvas;
var canvas2;
var canvas3;
var ctx;
var ctx2;
var ctx3;

var imgd;

var x;
var y;
var prevX = x;
var prevY = y;
var hue = 0;
var sat = 0;

<?php
	if (isset($_FILES["file1"]["tmp_name"])){
		$file=$_FILES["file1"]["tmp_name"];
	} else {
		$file='shibaimg.jpg';
	}
	$size=getimagesize($file);
    switch($size["mime"]){
        case "image/jpeg":
            $img = imagecreatefromjpeg($file); //jpeg file
        break;
        case "image/gif":
            $img = imagecreatefromgif($file); //gif file
    	break;
      	case "image/png":
        	$img = imagecreatefrompng($file); //png file
      	break;
    break;
    } ?>
var imgW = <?php echo imagesx($img);?>;
var imgH = <?php echo imagesy($img);?>;      
      
var scale = 100;
var rotate = 0;    
var trans = 100;
var hue = 0;   
var bright = 0;      
var centerX = 500/2 - imgW/2;
var centerY = 500/2 - imgH/2;

var myImage = new Image();
myImage.src = '<?php echo $b64e;?>';

var origImage = myImage;

var bg = new Image();
bg.src = './black.png';

var oldval=0;

var resettext;

var tr = [];
var tg = [];
var tb = [];
var ty = [];
var tx = [];
var txmax = [];
var arrayoflines = [];

var resettext=1;

window.onload = function() {

	$('.button').live("click", function(){ 
		$('.button').removeClass('selected');
		$(this).addClass('selected');
	});
	$('.transctl').live("click", function(){ 
		$('.transctl').removeClass('selected');
		$(this).addClass('selected');
	});
	$('.gamebtn').live("click", function(){ 
		$('.gamebtn').removeClass('selected');
		$(this).addClass('selected');
	});
	$('#file1').live("change", function(){ 
  		$('#form1').submit();
	});
	$('.transbtn').live("click", function(){ 
		$('.adjustbox').hide();
		$('.adjustbox2').hide();
		$('.trans').show();
	});
	$('.resizebtn').live("click", function(){ 
		$('.adjustbox').hide();
		$('.adjustbox2').hide();
		$('.resize').show();
	});
	$('.rotatebtn').live("click", function(){ 
		$('.adjustbox').hide();
		$('.adjustbox2').hide();
		$('.rotate').show();
	});
	$('.colorbtn').live("click", function(){ 
		$('.adjustbox').hide();
		$('.adjustbox2').hide();
		$('.color').show();
	});
	$('#resize-slider').slider({ value:0, min: -30, max: 30}).bind( "slide", function(event, ui) {resize=ui.value;resizeTool();}).bind( "slidechange", function(event, ui) {if(event.originalEvent!=undefined) {$("#resize-slider").slider('value', 0);}startDraw();});
	$('#rotate-slider').slider({ value:0, min: -90, max: 90}).bind( "slide", function(event, ui) {rotate = -ui.value;startDraw();}).bind( "slidechange", function(event, ui) {if(event.originalEvent!=undefined) {$("#rotate-slider").slider('value', 0);}startDraw();});
	$('#hue-slider').slider({ value:0, min: -180, max: 180}).bind( "slidechange", function(event, ui) {hue = ui.value;colorTool();});
	$('#bright-slider').slider({ value:0, min: -100, max: 100}).bind( "slidechange", function(event, ui) {bright = ui.value;colorTool();});
	$('#sat-slider').slider({ value:0, min: -100, max: 100}).bind( "slidechange", function(event, ui) {sat = ui.value;colorTool();});
	
	initCanvas(true);
}
function initCanvas()
{
	canvas = document.getElementById('canvas'); 
	canvas2 = document.getElementById('canvas2'); 
	ctx2 = canvas2.getContext('2d');
	ctx = canvas.getContext('2d');
	ctx.fillStyle = "#333";
	ctx.fillRect(0,0,500,500);  
	ctx2.canvas.width  = imgW;
	ctx2.canvas.height = imgH;
	ctx2.drawImage(myImage,0,0,imgW,imgH); 
	var first = 1;
	startDraw(first);
 
   	canvas.onmousedown = function(e) {
   		x = e.clientX - canvas.offsetLeft;
   		y = e.clientY - canvas.offsetTop;
   		prevX = x;
   		prevY = y;
   	}

   	canvas.onmouseup = function(e) {
  	 	x = null; 
   		y = null;
   		prevX = null;
   		prevY = null;
   	}
	
 	canvas.onmousemove = function(e) {
		if (x == null || y == null) {
        	return;
        }
         
		x = e.clientX - canvas.offsetLeft;
        y = e.clientY - canvas.offsetTop;
        if (prevX == null) { prevX = x; }
        if (prevY == null) { prevY = y; }
        centerX = centerX + (x - prevX);
        prevX = x;
        centerY = centerY + (y - prevY);
        prevY = y;
        startDraw(); 
   	}   
}
function my_callback_function(response) {
	myImage.src = response;
	origImage.src = response;
	Shadowbox.close();
	imgW = 500;
	imgH = 500;
	canvas2 = document.getElementById('canvas2'); 
	ctx2 = canvas2.getContext('2d');
	ctx2.canvas.width  = imgW;
	ctx2.canvas.height = imgH;
	ctx2.drawImage(myImage,0,0,imgW,imgH); 
	var t=setTimeout("startDraw()",1);
}
function resizeTool() {
	scale = scale * (1+(resize/100));
	startDraw();
}
function colorTool() {
	canvas2 = document.getElementById('canvas2'); 
	ctx2 = canvas2.getContext('2d');
	ctx2.drawImage(origImage,0,0,imgW,imgH); 
    Pixastic.process(canvas2, "hsl", {hue:hue,saturation:sat,lightness:bright},function(){myImage = document.getElementById('canvas2');startDraw()});	
}
function rotateTool() { 
	rotate = rotateval;
	startDraw();
}
function startDraw() {
		 ctx.clearRect (0,0,500,500);
		 ctx.translate(0,0);
         ctx.fillRect(0,0,500,500);
		 ctx.globalAlpha = 1;
		 ctx.drawImage(bg, 0, 0, 500,500);	
		 drawMyImage();
}
function drawMyImage() {
		 ctx.save();
         ctx.translate( centerX, centerY );
         ctx.rotate(rotate * Math.PI / 180);
         ctx.scale(scale/100, scale/100);
		 ctx.globalAlpha = trans/100; 
		 ctx.drawImage(myImage,0,0,imgW,imgH);
		 ctx.restore();	 	
		 drawFace();
}    
function drawFace() {
		ctx.globalAlpha = 1;
		makeWords();	 
} 
function makeWords() {
	arrayOfLines = $('#phrases').val().split('\n');
		if (resettext==1) {
			for (var i=0;i<arrayOfLines.length;i++) {
				tr[i] = Math.floor(Math.random() * (255 - 50 + 1)) + 50;
				tg[i] = Math.floor(Math.random() * (255 - 50 + 1)) + 50;
				tb[i] = Math.floor(Math.random() * (255 - 50 + 1)) + 50;
				ty[i] = Math.floor(Math.random() * (476 - 20 + 1)) + 20;
				txmax[i] = 500 - arrayOfLines[i].length * 14;
				tx[i] = Math.floor(Math.random() * (txmax[i] - 0 + 1)) + 0;
			}
			resettext = 0;
		}
		for (var i=0;i<arrayOfLines.length;i++)
		{ 
			ctx.fillStyle = "rgb(" + tr[i] + ", " + tg[i] + ", " + tb[i] + ")";
			ctx.font = "bold 24px 'Comic Sans MS'";
			ctx.fillText(arrayOfLines[i], tx[i], ty[i]);
		}	
}
function changeTool(opt) {
   tool = opt;
}
function changeTrans(opt) {
   trans = opt;
   startDraw();
}
function changeGame(opt) {
   game = opt;
   startDraw();
}
function step3(opt) {
   save = opt;
   outputFile();
}
function outputFile() {
   if (save == 'SAVE'){
	   var canvas = document.getElementById('canvas');
	   window.open(canvas.toDataURL("image/jpeg"));
	}
   if (save == 'POST'){
	   share();
	}
}
function share(accessToken){
    try {
        var img = canvas.toDataURL('image/jpeg', 0.9).split(',')[1];
    } catch(e) {
        var img = canvas.toDataURL().split(',')[1];
    }
    // open the popup in the click handler so it will not be blocked
    alert("uploading to imgur, please be patient.");
    // upload to imgur using jquery/CORS
    // https://developer.mozilla.org/En/HTTP_access_control
    $.ajax({
        url: 'http://api.imgur.com/2/upload.json',
        type: 'POST',
        data: {
            type: 'base64',
            key: '0ecc2f4b693f32b8278b48efffd21729',
            name: 'shibe.jpg',
            title: 'Shibe',
            caption: '',
            image: img
        },
        dataType: 'json'
    }).success(function(data) {
		window.location = data['upload']['links']['original'];
    }).error(function() {
        alert('Could not reach api.imgur.com. Sorry :(');
    });
}
</script>
</head>
<body>
<div id="container">
<div id="inputarea">
<div style="clear: both; height: 10px; text-align: left; padding-bottom: 2px;">shibeGen v1 by webrender</div>
<div class="file_button_container"><form name="form1" enctype="multipart/form-data" method="post" id="form1" action="index.php"><input type="file" name="file1" id="file1" /></form></div>&nbsp;<div class="random_button_container"><input name="randomize" type="button" value="place/shuffle" class="randombtn" onClick="resettext=1;startDraw();"></div>
<div style="clear:both;height: 2px;"></div><textarea name="phrases" cols="25" rows="15" id="phrases" style="float: left;">omg hi
so puppy
wow
so many fur
nice
</textarea>
<div style="clear:both; text-align: left;">drag image to move<BR><BR>image adjustment:</div>
<div id="buttonbox">
    <div class="button resizebtn"></div>
    <div class="button rotatebtn"></div>
    <div class="button colorbtn"></div>
</div>
<div style="clear: both; height: 4px;"></div>
<div class="adjustbox trans hidden">
	<div style="float: left;">darker</div><div id="trans-slider"></div><div style="float: left;">darker</div>
</div>
<div class="adjustbox rotate hidden">
	<div style="float: left;">left</div><div id="rotate-slider"></div><div style="float: left;">right</div>
</div>
<div class="adjustbox resize hidden">
	<div style="float: left;">smaller</div><div id="resize-slider"></div><div style="float: left;">larger</div>
</div>
<div class="adjustbox2 color hidden">
	<div style="float: left;">hue</div><div id="hue-slider"></div><div style="clear:both; height:5px;"></div><div style="float: left;">saturation</div><div id="sat-slider"></div><div style="clear:both; height:5px;"></div><div style="float: left;">brightness</div><div id="bright-slider"></div><div style="clear:both; height:5px;"></div>
</DIV>
<div style="clear:both;"></div>
<div style="clear:both; text-align: left;"><BR>all done?</div>
<div style="float: left;">
<div class="footerbtn save" onClick="step3('SAVE');"></div>
<div class="footerbtn post" onClick="step3('POST');"></div>
</div>
</div>
<div style="width:500px; height:500px; border: 1px solid #999; background: #111; margin-bottom:10px; float: right;"><canvas id="canvas" width="500" height="500"></canvas></div>
<canvas id="canvas2" width="500" height="500"></canvas>
<div style="clear: both;"></div>
</div>
</div>
</body>
</html>


