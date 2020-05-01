<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$names = array('name'=>'date','type'=>'datetime','value'=>$datetime,'id'=>'date','hidden'=>'true');
$id = array('name'=>'id','type'=>'number','value'=>$id,'id'=>'id','hidden'=>'true');

$buttons = array('class'=>'btn btn-warning','onclick'=>'change()');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>demo</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<br>
<div id="container-fluid">
	<div class="row">
	<br>
		<div class="col-sm-12">
			<h2 id="datevalue" class="text-center"></h2>
		</div>
	</div>
	<div class="row container-fluid">
	<div class="col-sm-3"></div>
		<div class="col-sm-2">
			<button type="button" class="btn btn-success" onclick="start()">start</button>
		</div>
		<div class="col-sm-2">
			<button type="button" class="btn btn-primary" onclick="pause()">pause</button>
		</div>
		<div class="col-sm-2">
		<?=form_open('welcome/update')?>
			<?=form_input($names)?>
			<?=form_input($id)?>
	
		<?=form_submit($buttons,'change to 8 days')?>
		<?=form_close()?>
		</div>
	</div>
	<div class="col-sm-3"></div>
</div>

</body>
</html>
<script type="text/javascript">
	var status = 0;
	var datedata = $('#date').val();
	var datetime = new Date(datedata);
	datetime.setDate(datetime.getDate());
	var countDownDate = datetime.getTime();
	$('#datevalue').text(getdate()+" " + gettime());
	function gettime(){

		var hours = Math.floor((countDownDate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((countDownDate % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((countDownDate % (1000 * 60)) / 1000);
		return hours + ":" + minutes + ":" + seconds;
	}
	function getdate(){
		var date = datetime.toJSON().slice(0, 10); 
		var day = date.slice(8, 10);
		var month = date.slice(5, 7);
		var year = date.slice(0, 4);
		return year+"-"+ month+"-"+ day;
	}
	function load() {
		var x = setInterval(function() {
		if(status != 0){
		
			countDownDate = countDownDate+10;
			var format = getdate()+" " + gettime();
			$('#date').val(format);
			$('#datevalue').text(format);
		}
		if(status == 2){
			/*datetime.setDate(datetime.getDate() + 8);
			countDownDate = datetime.getTime();
			date = datetime.toJSON().slice(0, 10); 
			day = date.slice(8, 10);
		    month = date.slice(5, 7);
			year = date.slice(0, 4);*/
			status = 1;
		}
		}, 10);
	}
	function start(){
		status = 1;
	}
	function pause(){
		status = 0;
	}
	function change(){
		status = 2;
	}
</script>
<?= $script?>

