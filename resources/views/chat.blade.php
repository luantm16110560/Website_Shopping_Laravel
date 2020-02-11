
  <div  style="z-index: 1000; position: fixed; right: 0; bottom: 0;">
  
    <div style="position:relative; top: 8px;">
        <div style="position: absolute; right: -25%; top: -25%;">
        </div>
    </div>
  <img id="hide" src="source\image\icon\chat.png">
  <div id="show" style="display: none" class="chat-popup" >
    <div class="right"><button id="btnClose" style="height: 25px;width: 19px;font-size: 8px;font-weight: bold;  padding:0;margin:0;border-radius: 0; display: block"  class="btn btn-danger" onclick="handleClick()">X</button></div>
<form autocomplete="off">
 <label style="text-align: center;background-color: cornflowerblue;width: 93.6%;height: 25px;padding:0;margin:0;border-radius: 0; color: azure">Chat</label>
  
  <textarea  style="background-color: azure;display: block"  name="msg" disabled></textarea>

  <div>
    <input class="left" id="input" name="input" style="width: 250px;height:30px;font-weight: bold">
  <button  style="right; height:30px" type="submit" class="btn btn-success">Gửi</button>
</div>
</form>
</div>
</div>    
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#hide").hide();
    $("#show").show();
    $("#input").focus();
  });
  $("#btnClose").click(function(){
    document.getElementById("show").style.display = "none";
    document.getElementById("hide").style.display = "block";
  });



});



</script>

