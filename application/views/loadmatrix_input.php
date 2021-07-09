<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Dynamic Form Processing with PHP | Tech Stream</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script type="text/javascript" src="assets/js/script1.js"></script>
<style>
table, th{
    border: 1px solid black;
}</style>
<link rel="stylesheet" href="tempelete1.css">

    </head>
<center>
	<img src="sakec_img.png" /></center>
    <body bgcolor="#f5f5f5">   
<center>
<div class="login1">                                                                          
	
		<?php 
			$attr = array('class' => 'register','method' => 'POST');
			echo form_open('Welcome/updateLoadMat',$attr);
		?>
        <!-- <form action=<?php echo base_url(); ?>"updateLoadMat/updateLoadMat1/" class="register" method="POST"> -->
           						
							Faculty Name:

							

							<select id="F_Name" required="required" name="F_name" required="true">
								<?php
								foreach ($NameOfFaculty as $object) {
									echo '<option value="'.$object->NameOfFaculty.'">'.$object->NameOfFaculty.'</option>';
								}
								
								?>
							</select>
						 
									
					
					
					<input type="button" value="Add Class" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Class" onClick="deleteRow('dataTable')"  /> 
					
		<center>	
               <table id="dataTable" class="form" border="1">
                  <tbody>
			<tr bgcolor="#f6f6f6">
			<th rowspan="2">Semester</td>
			<th rowspan="2">Division</td>
			<th rowspan="2">Course</td>
			<th rowspan="2">Theory</td>
			<th rowspan="2">Practical</td>
			<th colspan="4">Batch</td>
		</tr>
		<tr>
			
			
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>

		</tr>
                    <tr>
                      <p>
										
        					 <td>
							<select id="sem1" required="required" name="sem1">
								<option id="opt3" value="3">3</option>
								<option id="opt4" value="4">4</option>
								<option id="opt5" value="5">5</option>
								<option id="opt6" value="6">6</option>
								<option id="opt7" value="7">7</option>
								<option id="opt8" value="8">8</option>
							</select>	

							
						 </td>
						<td>
							<select id="divi1" required="required" name="divi1">
								<option  id="opt1" value="5">5</option>
								<option  id="opt2" value="6">6</option>
						 </td>
						 <td>
						 	<select id="course1" required="required" name="course1">
								<?php
									foreach ($Cname as $object) {
										echo '<option value="'.$object->Cname.'">'.$object->Cname.'</option>';
									}
								?>
						 </td>
						<td>
							<input type="checkbox" id="chkbx_theory1" name="chkbx_theory1"/>
								
						 </td>
						 
						 <td>
							
							<input type="checkbox" id="chkbx_pracs1" name="chkbx_pracs1" onClick="pr_enable()"/>
							</select>
						 </td>
							<td>
								<input type="checkbox" id="chkbx_ba1" name="chkbx_ba1"/>
							</td>
							<td>
								<input type="checkbox" id="chkbx_bb1" name="chkbx_bb1"/>
							</td>
							<td>
								<input type="checkbox" id="chkbx_bc1" name="chkbx_bc1"/>
							</td>
							<td>
								<input type="checkbox" id="chkbx_bd1" name="chkbx_bd1"/>
							</td>
						
							</p>
                    </tr>
                    </tbody>
                </table>
</center>

				<div class="clear"></div>
            <input type="textbox" id="numrow" value="1" hidden="true" name="numrow"/>
			<input class="submit" type="submit" value="Confirm &raquo;" />
						
			<div class="clear"></div>
        </form>
</center>
		
    </body>
	<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=9046834; 
var sc_invisible=1; 
var sc_security="ec55ba17"; 
var scJsHost = (("https:" == document.location.protocol) ? "https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="free hit
counter" href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/9046834/0/ec55ba17/1/"
alt="free hit counter"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
<div id="footer2" style="background-color:lightgrey;">
		<center><b><font color="black">Shah And Anchor Kutchhi Engineering College<br/>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br/>
<br/>
© Shah And Anchor Kutchhi Engineering College.</b></font></center>
						
		</div>
</html>





