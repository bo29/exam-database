<?php
include "connect.php";
if($_SESSION['ExamAdmin']=="") header("location:login.php");
include "header.php";
if($_REQUEST['subval'])
{
	$update="insert into questions(Question,TestCases,Keywords,Points,Difficulty,Type) values ('".mysql_real_escape_string($_REQUEST['details'])."','".$_REQUEST['testCases']."','".$_REQUEST['keywords']."','".$_REQUEST['points']."','".$_REQUEST['difficulty']."','".$_REQUEST['type']."')";
	$message="Copied Successfully";
	mysql_query($update) or die("Cannot Execute Query".mysql_error());
	$qid=mysql_insert_id();
	$insert_solution="insert into solutions (QID,Solution) values('".$qid."','".mysql_real_escape_string($_REQUEST['answer'])."')";
	mysql_query($insert_solution) or die("Cannot execute query".mysql_error());
	?>
	<script>
	document.location="questionlist.php?msg=<?php echo $message;?>";
	</script>
	<?php
}
?>
<!--<script src="ckeditor/ckeditor.js"></script>
<!-- start content-outer ........................................................................................................................START -->
<div class="leftColumn">
  	<div class="operation"></div>
  	<ul class="subMenu">
    	
  		<li><?php
          if($_REQUEST['id']) echo "Edit Question"; else echo "Add Question";?></li>
    </ul>
    
    <div class="clear"></div>
    <div id="form" style="width:700px;">
    <?php
          if($_REQUEST['id'])
          {
          $select="select * from questions where QID='".$_REQUEST['id']."'";
          $select_rs=mysql_query($select) or die("Cannot Execute Query".mysql_error());
          $select_row=mysql_fetch_array($select_rs);
          
          $answer="select * from solutions where QID='".$_REQUEST['id']."'";
          $answer_rs=mysql_query($answer) or die("Cannot Execute Query".mysql_error());
          $answer_row=mysql_fetch_array($answer_rs);
          }
		  ?>
          
		<form id="events" name="events"  method="post" action='copy_question.php?id=<?php echo $_REQUEST['id'];?>' enctype="multipart/form-data">
	      <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="coRight" style="vertical-align: top;">Number of Points:</td>
				<td colspan="2">
                <input type="text" name="points" id="points" value="<?php  if($_REQUEST['points']){ echo $_REQUEST['points'];} else { echo $select_row['Points'];}?>" required>
                </td>
            </tr>
            <tr>
                <td class="coRight" style="vertical-align: top;">Difficulty:</td>
				<td colspan="2">
                <input type="text" name="difficulty" id="difficulty" value="<?php  if($_REQUEST['difficulty']){ echo $_REQUEST['difficulty'];} else { echo $select_row['Difficulty'];}?>" required>
                </td>
            </tr>
			<tr>
                <td class="coRight" style="vertical-align: top;">Type:</td>
				<td colspan="2">
                <input type="text" name="type" id="type" value="<?php  if($_REQUEST['type']){ echo $_REQUEST['type'];} else { echo $select_row['Type'];}?>" required>
                </td>
            </tr>
			<tr>
				<td class="coRight" style="vertical-align: top;">Question:</td>
				<td colspan="2" >
                <textarea aria-required="true" rows="15" cols="45" name="details" id="details" class="form-control requiredField mezage" style="tab-size: 4;-moz-tab-size: 4;" required><?php  if($_REQUEST['details']){ echo $_REQUEST['details'];} else { echo $select_row['Question'];}?></textarea>
                                           
   	                <script>
          CKEDITOR.replace( 'details' );
        </script>
                <br /><br />
                </td>
			
			</tr>
            	<tr>
				<td class="coRight" style="vertical-align: top;">Solution:</td>
				<td colspan="2" >
                <textarea aria-required="true" rows="15" cols="45" name="answer" id="answer" class="form-control requiredField mezage" style="tab-size: 4;-moz-tab-size: 4;" required><?php  if($_REQUEST['details']){ echo $_REQUEST['details'];} else { echo $answer_row['Solution'];}?></textarea>
                                           
   	                <script>
            CKEDITOR.replace( 'answer' );
        </script>
                <br /><br />
                </td>
			
			</tr>
            
			<tr>
                <td class="coRight" style="vertical-align: top;">Test cases:<br><br>Enter test cases as<br>numbers separated<br>by spaces.</td>
				<td colspan="2">
                <input type="text" name="testCases" id="testCases" value="<?php  if($_REQUEST['testCases']){ echo $_REQUEST['testCases'];} else { echo $select_row['TestCases'];}?>">
                </td>
            </tr>
			<tr>
                <td class="coRight" style="vertical-align: top;">Keywords:<br><br>Enter keywords as<br>words separated<br>by spaces.</td>
				<td colspan="2">
                <input type="text" name="keywords" id="keywords" value="<?php  if($_REQUEST['keywords']){ echo $_REQUEST['keywords'];} else { echo $select_row['Keywords'];}?>">
                </td>
            </tr>
            
		<tr>
		<td>&nbsp;</td>
		<td valign="top">
			<input type="button" value="Submit" id="big_button" name="subfrm" onclick="check()" class="form-submit" />
            <input type="button" id="big_button" value="Back" class="form-reset" onclick="document.location='questionlist.php'"  />
			
		</td>
		<td>
        <input type="hidden" name="imageIndex" id="imageIndex" value="<?php echo $j-1?>">
		<input type="hidden" name="subval" id="subval" value="">
		</td>
	</tr>
		  </table>
			</form>
			 </div>
  </div>
  </div>
<?php
include "footer.php";
?>
<script>
var j=0;
function check()
{
   if(document.getElementById("keywords").value=="")
    {
        alert("Please fill in the keywords.");
        document.getElementById("keywords").focus();
    } 
	else if(document.getElementById("testCases").value=="")
    {
        alert("Please fill in the test cases.");
        document.getElementById("testCases").focus();
    } 
	else if((document.getElementById("difficulty").value!=="Easy" && document.getElementById("difficulty").value!=="Medium" && document.getElementById("difficulty").value!=="Hard")  || document.getElementById("difficulty").value==""){
		alert("Please enter a valid difficulty level.\n\nOptions are: Easy, Medium, Hard.");
		document.getElementById("difficulty").focus();
	}
	else if(document.getElementById("type").value=="")
    {
        alert("Please enter a question type.");
        document.getElementById("type").focus();
    } 
	else if(document.getElementById("points").value=="")
    {
        alert("Please enter a point value.");
        document.getElementById("points").focus();
    } 
	else if(allnumeric(document.getElementById("points").value)==false)
    {
        alert("Please enter the number of points as a number.");
        document.getElementById("points").focus();
    } 
	else if(document.getElementById("details").value=="")
    {
        alert("Please fill out a question description.");
        document.getElementById("details").focus();
    } 
	else if(document.getElementById("answer").value=="")
    {
        alert("Please fill out a question description.");
        document.getElementById("answer").focus();
    } 
	else
	{
		document.getElementById("subval").value=1;
		document.events.submit();
	}
}
function enableTab(id) {
    var el = document.getElementById(id);
    el.onkeydown = function(e) {
        if (e.keyCode === 9) { // tab was pressed

            // get caret position/selection
            var val = this.value,
                start = this.selectionStart,
                end = this.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.value = val.substring(0, start) + '\t' + val.substring(end);

            // put caret at right position again
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            return false;

        }
    };
}

// Enable the tab character onkeypress (onkeydown) inside textarea...
// ... for a textarea that has an `id="my-textarea"`
enableTab('details');
enableTab('answer');
</script>
