function validate(){
      var x = document.forms["myform"]["email"].value;
      if(x==""){
        alert("E-Mail ID cannot be empty");
        return false;
      }
      var x = document.forms["myform"]["Password"].value;
      if(x==""){
        alert("Password cannot be empty");
        return false;
      }
}
function myFunction() {
 document.getElementById("demo").setAttribute("class", "hello0");
 document.getElementById("imga0").setAttribute("ID","imga1");
}
function myFunction0() {
 document.getElementById("demo").setAttribute("class", "hello");
 document.getElementById("imga1").setAttribute("ID","imga0");
}