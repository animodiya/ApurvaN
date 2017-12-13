<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Your To Do Application</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 39px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container,#container1,#container2 {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	#btn{

	}
	</style>
</head>
<body>

<div id="container">
	<h1>Your Todo Dictionary!</h1>

	<div id="body">
		<label>Enter a task:</label>
		<input type="text" id="add_Todo" placeholder="to Do">
		<label>Enter Description:</label>
		<input type="text" id="description" placeholder="enter description for to Do">
		<br>
		<br>
		<button id="btn_add"><h5 style="color: green;">Add a Todo</h5></button>
		<button id="btn_mark"><h5 style="color: green;">Mark as all done</h5></button>
		<!--<button id="show_todo"><h5 style="color: green;">Show all Todos</h5></button>-->
		<button id="show_done_todo"><h5 style="color: green;">Show all done Tasks</h5></button>
	</div>

	
</div>
<div id="container1">
	<div>
		<table id ="todo"></table>
	</div>

</div>
<div id="container2">
	<div>
		<table id ="already_done_todo"></table>
	</div>

</div>
<?php
echo '<script>
		var t = document.getElementById("todo");
		var roww = t.insertRow(0);
		var cell = roww.insertCell(0);
		cell.innerHTML = "Pending_Todos  &nbsp;  Description";
		
		
	</script>';
?>


<?php
	include 'get_db_con.php';
	include 'json_encode.php';
	include 'clean_input.php';
	
	
	$sql = "SELECT * FROM todos";
	$resultset = $conn->query ( $sql );
	while($row = mysqli_fetch_assoc($resultset)){
		echo '<script>
			var table = document.getElementById("todo");
			var row = table.insertRow(1);
			var cell1 = row.insertCell(0);
			cell1.innerHTML = "'.$row["todos"].'	'.$row["description"].' ";
			
		</script>';     
	}
	
	include 'close_db_con.php';
?>
 <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
 <script src="js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		//$('#todo').show();
		$('#btn_add').on('click',function(){
	        $('#already_done_todo').hide();
              $('#todo').empty();
	        var keyword = $('#add_Todo').val();
	        var description = $('#description').val();
	        $('#todo').html('<tr><th>Pending Todos</th><th>Description</th></tr>');
	        console.log(keyword);
	        $.ajax({
	            url:"add_Todo.php",
	            dataType: 'json',
	            type:'GET',
	            data: {keyword:keyword,description:description},
	            success:function(todoList){
	                for(var i = 0; i < todoList.length; i++){
	                    $('#todo').append('<tr><td>'+todoList[i]['todos']+'</td><td>'+todoList[i]['description']+'</td><td>'+'<button style="background-color:#0BBA36; color:white;" class="btn-view"><span>done</span></button>'+'</td></tr>');
	                }
					document.getElementById("add_Todo").value="";
					document.getElementById("description").value="";
	                $('#todo').show();	
	            }
	        });
	    });

		$('#btn_mark').on('click',function(){
	        $.ajax({
	            url:"all_todo_done.php",
	            dataType: 'text',
	            type:'GET',

	            success:function(message){
                   			
	            }
	        });
	        location.reload();
	    });	    

		/*$('#show_todo').on('click',function(){
	        //$('#todo').hide();
	        $.ajax({
	            url:"get_Todo.php",
	            dataType: "json",
	            type:"GET",
	            
	            success:function(todoList){
	                
	                $('#todo').empty();
	                $('#todo').html('<tr><th>Pending Todos</th><th>Description</th></tr>');
	                for(var i = 0; i < todoList.length; i++){
	                    $('#todo').append('<tr><td>'+todoList[i]['todos']+'</td><td>'+todoList[i]['description']+'</td><td>'+'<button style="background-color:#0BBA36; color:white;" class="btn-view"><span>done</span></button>'+'</td></tr>');
	                }
	                $('#todo').show();
	            },
	        });

	    });
	*/
		$('#container1').on('click', '.btn-view', function(){
        var todo = $('td:first', $(this).parents('tr')).text();
        var description = $('td:nth-last-child(2)', $(this).parents('tr')).text();
        $('#todo').html('<tr><th>Pending Todos</th><th>Description</th></tr>');
        $.ajax({
            url: 'done_todo.php',
            type:'GET',
            dataType: 'json',
            data: {todo:todo,description:description},
            success: function(todoList){
            	for(var i = 0; i < todoList.length; i++){
	                    $('#todo').append('<tr><td>'+todoList[i]['todos']+'</td><td>'+todoList[i]['description']+'</td><td>'+'<button style="background-color:#0BBA36; color:white;" class="btn-view"><span>done</span></button>'+'</td></tr>');
	            }
                $('#todo').show();
            },
            
        });
        //location.reload();
        });

		$('#show_done_todo').on('click', function(){
		//$('#already_done_todo').hide();	
		$('#already_done_todo').html('<tr><th>Completed Todos</th></tr>');
        $.ajax({
            	url: "show_done_todo.php",
            
	            dataType: "json",
	            type:"GET",
	            
	            success:function(donetodoList){ 
				$('#todo').empty();				
	                for(var i = 0; i < donetodoList.length; i++){
	                    $('#already_done_todo').append('<tr><td>'+donetodoList[i]['todo']+'</td><td>'+donetodoList[i]['description']+'</td><td>'+'<button style="background-color:#0BBA36; color:white;" class="btn-delete"><span>delete</span></button>'+'</td></tr>');
	                }
	                $('#already_done_todo').show();
	            },
	           
        });
		
        });

		$('#container2').on('click', '.btn-delete', function(){
        var todo = $('td:first', $(this).parents('tr')).text();
        var description = $('td:nth-last-child(2)', $(this).parents('tr')).text();
        $('#already_done_todo').html('<tr><th>Completed Todos</th></tr>');
        $.ajax({
            url: 'delete_todo.php',
            type:'GET',
            dataType: 'json',
            data: {todo:todo,description:description},
            success: function(donetodoList){
				 $('#todo').empty();
                for(var i = 0; i < donetodoList.length; i++){
                	
	                $('#already_done_todo').append('<tr><td>'+donetodoList[i]['todo']+'</td><td>'+donetodoList[i]['description']+'</td><td>'+'<button style="background-color:#0BBA36; color:white;" class="btn-delete"><span>delete</span></button>'+'</td></tr>');
	            }
	            $('#already_done_todo').show();
            }
        });
        });


	});
</script>
</body>
</html>