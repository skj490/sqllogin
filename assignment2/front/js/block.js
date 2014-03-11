function fun(but1,but2,but3,but4){
            document.getElementById(but1).style.display = 'block';
            document.getElementById(but2).style.display = 'none';
            document.getElementById(but3).style.display = 'none';
			document.getElementById(but4).style.display = 'none';
        }
		
function fun2(but1,but2,but3){
		document.getElementById(but1).style.display = 'block';
    	document.getElementById(but2).style.display = 'none';
		document.getElementById(but3).style.display = 'none';
}

function getRadioCheckedValue(answer)
{
   var oRadio = document.forms[0].elements[answer];
 
   for(var i = 0; i < oRadio.length; i++)
   {
      if(oRadio[i].checked)
      {
         return oRadio[i].value;
      }
   }
 
   return '';
}
