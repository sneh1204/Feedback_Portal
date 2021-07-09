<style>
	#loader {
	  border: 16px solid #f3f3f3; /* Light grey */
	  border-top: 16px solid #3498db; /* Blue */
	  border-radius: 50%;
	  width: 30px;
	  height: 30px;
	  position: fixed;
	  top: 50%;
	  left: 50%;
	  z-index: 1;
	  animation: spin 2s linear infinite;
	}
	#changeText {
	  position: fixed;
	  top:60%;
	  left: 49.5%;
	}
	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
</style>
<div id="loader" style="display: none;"></div> 
<div id="changeText" style="display: none;"></div> 
<script>
var text = ["Calculating... Please wait.", "Loading...", "Be patient", "Almost done!"];
var counter = 0;
var elem = document.getElementById("changeText");
var inst = setInterval(change, 2200);

function change() {
  elem.innerHTML = "<b>" + text[counter] + "</b>";
  counter++;
  if (counter >= text.length) {
    counter = 0;
    // clearInterval(inst); // uncomment this if you want to stop refreshing after one cycle
  }
}
</script>