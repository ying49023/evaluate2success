<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Text Area Test</title>  
    </head>
    <body>
        
<script type="text/javascript">

function FitToContent(id, maxHeight) 
{ 
   var text = id && id.style ? id : document.getElementById(id); 
   if ( !text ) 
      return; 
   var adjustedHeight = text.clientHeight; 
   if ( !maxHeight || maxHeight > adjustedHeight ) 
   { 
      adjustedHeight = Math.max(text.scrollHeight, adjustedHeight); 
      if ( maxHeight ) 
         adjustedHeight = Math.min(maxHeight, adjustedHeight); 
      if ( adjustedHeight > text.clientHeight ) 
         text.style.height = adjustedHeight   "px"; 
   } 
} 
window.onload = function() { 
    document.getElementById("ta").onkeyup = function() { 
      FitToContent( this, 500 ) 
    }; 
} 
</script>


<textarea name=""
style="width:440px; height: 21px; overflow-y:hidden;"
onkeyup=" FitToContent(this,300)"></textarea>

    </body>
</html>