<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['user_id'])){
  redirect(base_url());
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Classwise Feedback</title>
  </head>
  <body>
  <?php $this->load->view('loader'); ?>
  <script>
	   function excel(type){
		   window.location.href = "<?=base_url();?>/index.php/ctrl_admin/downloadexcelsheet/<?php echo $semister . "/" . $division; ?>/"+type;
	   }
	   function goHome(){
		   window.location.href = "<?=base_url();?>";
	   }
  </script>
  <div class="blur">
  <h1>Classwise Feedback</h1>
    <select id="sem">
      <option  value="0">Select SEM</option>
      <?php
      foreach ($sem as $key => $value) {
        echo "<option value=\"".$value->Sem."\">".$value->Sem."</>";
      }
      ?>
    </select>
    <select id="divi">
      <option value="0">Select Division</option>
    </select>
    <button type="button" id="final">Get Table Data</button>
	<?php
	if($semister != 0 && $division != 0){
	?>
    <button type="button" id="print1">Print Theory</button>
    <button type="button" id="print2">Print Practical</button>
    <button type="button" onClick="excel('Th');">Download Excel(Th)</button>
    <button type="button" onClick="excel('Pr');">Download Excel(Pr)</button>
	<?php
	}
	?>
	<button type="button" onClick="goHome();">Go Back</button>
	<div id="content1">
	<div id="similar">
	<?php
	if($semister != 0 && $division != 0){
	?>
	<img id="header" src="<?=base_url();?>/dist/img/header.jpg" style="display: none;"></img>
	<?php
	}
	?>
	<h1><u>Feedback:</u></h1>
	<h4 id="cla">Class: <?=$class?></h4>
	</div>
    <h2>Theory:</h2>
    <table border="1px">
      <tr>
	  <th>Sr no.</th>
        <th>Faculty/Question</th>
        <?php
        foreach ($questions_th as $key => $value) {
          echo "<th>Q".($key+1)."</th>";
        }
		echo "<th>Avg.</th>";
        ?>
      </tr>
      <?php
	  $i = 1;
      foreach ($staffListTh as $key => $value) {
        echo "<tr>";
        echo "<td>$i</td><td>".$value->F_name." / ".$value->course."</td>";
        foreach ($thdata[$value->Fid] as $key => $value2) {
          echo "<td>".$value2."%</td>";
        }
		$i++;
		echo "<td>".$thavg[$value->Fid]."%</td>";
        echo "</tr>";
      }
      ?>
    </table>
	<br><strong>Students count:</strong> <?=$stud_count_th;?>
    <div class="">
      <h2>Questions List Theory</h2>
      <?php
      foreach ($questions_th as $key => $value) {
        echo "<p>".$value->Qid.")".$value->Ques."</p>";
      }
      ?>
    </div>
	</div>
	<div id = "content2">
    <h2>Practical:</h2>
    <table border="1px">
      <tr>
	  <th>Sr no.</th>
        <th>Faculty/Question</th>
        <?php
        foreach ($questions_pr as $key => $value) {
          echo "<th>Q".($key+1)."</th>";
        }
		echo "<th>Avg.</th>";
        ?>
      </tr>
      <?php
	  $i = 1;
      foreach ($staffListPr as $key => $value) {
        echo "<tr>";
        echo "<td>$i</td><td>".$value->F_name." / ".$value->course."</td>";
        foreach ($prdata[$value->Fid] as $key => $value2) {
          echo "<td>".$value2."%</td>";
        }
		$i++;
		echo "<td>".$pravg[$value->Fid]."%</td>";
        echo "</tr>";
      }
      ?>
    </table>
	<br><strong>Students count:</strong> <?=$stud_count_pr;?>
    <div class="">
      <h2>Questions List Practical</h2>
      <?php
      foreach ($questions_pr as $key => $value) {
        echo "<p>".$value->Qid.")".$value->Ques."</p>";
      }
      ?>
    </div>
	</div>
	</div>
  </body>
  <script src=" <?=base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#final").on('click',function(){
		$('#loader').css('display', 'inline');
		$('#changeText').css('display', 'inline');
		$('.blur').css('filter', 'blur(8px)');
        window.location.href = "<?=base_url();?>/index.php/ctrl_admin/table/"+$("#sem").val()+"/"+$("#divi").val();
      });
	  $("#print1").on('click',function(){
		var prtContent = document.getElementById("content1");
		var content = prtContent.innerHTML;
		content = "<img src='<?=base_url();?>/dist/img/header.jpg'/>" + content;
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(content);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
      });
	  $("#print2").on('click',function(){
		var prtContent = document.getElementById("content2");
		var similar = document.getElementById("similar");
		var content = similar.innerHTML;
		content = "<img src='<?=base_url();?>/dist/img/header.jpg'/>" + content;
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(content);
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
      });
      $("#sem").on('change',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getalldiv/"+$("#sem").val(),
          type:"POST",
          success:function(result){
            //alert(result);
            if(result != '0'){
              $("#divi").html("<option value=\"0\">Select Division</option>"+result);
            }
          }
        });
		 $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getyear/"+$("#sem").val(),
          type:"POST",
          success:function(result){
            //alert(result);
            if(result != '0'){
              $("#cla").html("Class: "+result);
            }
          }
        });
      });
	  $("#divi").on('change',function(){
		  $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getyear/"+$("#sem").val(),
          type:"POST",
          success:function(result){
            if(result != '0'){
              $("#cla").html("Class: "+result + $("#divi option:selected").html());
            }
          }
        });
      });
    });
  </script>
</html>
