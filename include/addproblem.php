<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
include('./include/mysql_view.php');
error_reporting(-1);

$query="select problem_code from problems";
$res=mysqli_query($db,$query);
$problemcode_array=array();
while($r=mysqli_fetch_array($res))
{
	$problemcode_array[]=$r['problem_code'];
}


if(isset($_GET['prev']))
{
	echo "<div style='text-align: center;' >";
	if($_GET['prev']=="done")
	{
		echo "
		
			<img src='media/valid.png'>
			<h4 style='color: #55bc48; display:inline-block;'> Problem added Successful </h4> 
		
		";
	}
	else if($_GET['prev']=="fail")
	{
		echo "
		
			<img src='media/invalid.png'>
			<h4 style='color: #e74833; display:inline-block;'> Problem addition Unsuccessful </h4> 
		";
	}
	$msg="";
	if(isset($_GET['msg']))
	{
		$msg=$_GET['msg'];
		echo "<p style='color: #8F8F8F;'> $msg </p>";
	}
	echo "</div>";
}
?>
<script language='JavaScript' type='text/javascript'>
	function addMore(tableID) 
	{
		var table = document.getElementById(tableID);
 		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);
 		var cell1 = row.insertCell(0);
		var element1 = document.createElement('input');
		element1.type = 'file';
	
		element1.name='ipfiles[]';
		cell1.appendChild(element1);
 		var cell2 = row.insertCell(1);
		var element2 = document.createElement('input');
		element2.type = 'file';
	
		element2.name='opfiles[]';
		cell2.appendChild(element2);
		var cell3 = row.insertCell(2);
		cell3.className="alt";
		var element3 = document.createElement('none');
		cell3.innerHTML = "<input type='button' value='x' onclick=\"delRow('ioupload',this.parentNode.parentNode)\" />";
		cell3.appendChild(element3);
        }
        function delRow(tableID,toDELETE)
        {
        	var table = document.getElementById(tableID);
        	toDELETE.remove();
        }
</script>

<form  method='post' enctype='multipart/form-data'  action='./functions/makeproblem.php'  name='new_problem'>
	<table id='nptable'>
	<tr>
 		<td valign='top'>
			<label>Problem Code :</label>
 		</td>
		<td>
  			<input  type='text' style='width: 400px;' name='problem_code' required onblur='validate_problemcode(this)'>
  			<script language='javascript' type='text/javascript'>
			function validate_problemcode(input)
			{
				input.value = input.value.toUpperCase();
				var problemcode_list = new Array();
				<?php
					$i=0;
					foreach($problemcode_array as $rn)
					{
						echo "problemcode_list[$i]='$rn';
						";
						$i++;
					}
				?>
				
				for(i=0;i<problemcode_list.length;i++)
				{
					if(problemcode_list[i] == input.value)
					{
						input.setCustomValidity('Sorry, this Problem Code is already taken.');
						return false;
					}
				}
				input.setCustomValidity('');
				return true;
			}
			</script>
 		</td>
	</tr>
	<tr>
 		<td valign='top'>
			<label>Problem Title :</label>
 		</td>
		<td>
  			<input  type='text' style='width: 400px;' name='problem_title' required x-moz-errormessage='Enter Problem Title'>
 		</td>
	</tr>
 
	<tr>
 		<td valign='top'>
  			<label>Problem Statement :</label>
 		</td>
 		<td>
 			<textarea  name='problem_statement' cols='70' rows='15'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Input :</label>
 		</td>
 		<td>
 			<textarea  name='input_desc' cols='50' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Output :</label>
 		</td>
 		<td>
 			<textarea  name='output_desc' cols='50' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Constraints :</label>
 		</td>
 		<td>
 			<textarea  name='constraints' cols='50' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Sample Input :</label>
 		</td>
 		<td>
 			<textarea  name='sampleip' cols='25' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Sample Output :</label>
 		</td>
 		<td>
 			<textarea  name='sampleop' cols='25' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Sample Explanation :</label>
 		</td>
 		<td>
 			<textarea  name='sampleexp' cols='50' rows='5'></textarea>
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Allowed Languages :</label>
 		</td>
 		<td>
		<?php
			ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
			include_once('include/languages.php');
			foreach($languages_names as $code=>$name)
 				echo "<input type='checkbox' value='$code' name='languagesallowed[]'>$name<br>";
		?>		
 		</td>
	</tr>
	
	<tr>
 		<td valign='top'>
  			<label>Time Limit :</label>
 		</td>
 		<td>
 			<input type='text' style='width: 100px;' name='time_limit' required x-moz-errormessage='Enter integer value'>
 			<script language='javascript' type='text/javascript'>
 			function is_int(c)
 			{
 				alert('I am an int');
				var x=c.value;
				var y=parseInt(x);
				alert(y);
				alert(x);
				if (isNaN(y)==true) 
				{
					input.setCustomValidity('Sorry, this Problem Code is already taken.');
					return false;
				}
				if(x.value==y.toString())
				{
					//alert('I am an int');
					input.setCustomValidity('');
					return true;
				}
				else
				{
					//alert('I am NOT an int');
					input.setCustomValidity('Sorry, this Problem Code is already taken.');
					return false;
				}
			}
			</script>
            <span> sec </span>
 		</td>
	</tr>
	<tr> 
 		<td valign='top'>
  			<label>Problem type :</label>
 		</td>
 		<td>
 			<select name='problem_type'>
				<option value='practice'>PRACTICE</option>
				<option value='test'>TEST</option>
			</select>
 		</td>
	</tr>
	<tr>
 		<td valign='top'>
  			<label>Show In-depth View to students :</label>
 		</td>
 		<td>
 			<select name='problem_showmistakes'>
				<option value='true'>Yes</option>
				<option value='false' selected='selected'>No</option>
			</select>
 		</td>
	</tr>
	<tr>
 		<td valign='top'>
  			<label>Make solutions visible to all other students :</label>
 		</td>
 		<td>
 			<select name='problem_visiblesolutions'>
				<option value='true'>Yes</option>
				<option value='false' selected='selected'>No</option>
			</select>
 		</td>
	</tr>
	<tr>
 		<td valign='top'>
  			<label>Upload Test Files :</label>
 		</td>
 		<td>
 			<table id='ioupload'>
 			<tr>
 				<td>
  					<label>Input File :</label>
 				</td>
 				<td>
 					<label>Output File :</label>
 				</td>
 			</tr>
 			<tr id="1">
 				<td>
 					<input type='file' name='ipfiles[]'; />
 				</td>
 				<td>
 					<input type='file' name='opfiles[]'; />
 				</td>
 				<td class='alt'>
 					<input type='button' value='x' onclick="delRow('ioupload',this.parentNode.parentNode)" />
 				</td>
			</tr>
			
			</table>
			<table id='addmore'>
			<tr>
 				<td>
 					<input type='button' value='+' onclick="addMore('ioupload')" />
 				</td>
			</tr>
			</table>
 		</td>
	</tr>
	<tr>
		<td>
  			
 		</td>
 		<td>
  			<input type='submit' value='Save Problem' class='bbutton'>
 		</td>
	</tr>
	
</table>
</form>
