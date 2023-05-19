<!DOCTYPE html>  
<html>  
<style>  
.container {  
  display: block;  
  position: relative;  
  padding-left: 40px;  
  margin-bottom: 20px;  
  cursor: pointer;  
  font-size: 25px;  
}  
  
/* Hide the default radio button */  
.container input {  
  position: absolute;  
  opacity: 0;  
  cursor: pointer;  
}  
  
/* custom radio button */  
.check {  
  position: absolute;  
  top: 0;  
  left: 0;  
  height: 30px;  
  width: 30px;  
  background-color: lightgray;  
  border-radius: 50%;  
}  
  
.container:hover input ~ .check {  
  background-color: gray;  
}  
  
.container input:checked ~ .check {  
  background-color: blue;  
}  
  
.check:after {  
  content: "";  
  position: absolute;  
  display: none;  
}  
  
.container input:checked ~ .check:after {  
  display: block;  
}  
  
.container .check:after {  
    top: 8px;  
    left: 8px;  
    width: 15px;  
    height: 15px;  
    border-radius: 50%;  
    background: white;  
}  
</style>  
<body>  
  
<h1> Example of Custom Radio Buttons</h1>  
<h2> Select your category </h2>  
<label class="container">GEN  
  <input type="radio" name="radio" checked>  
  <span class="check"></span>  
</label>  
<label class="container">OBC  
  <input type="radio" name="radio">  
  <span class="check"></span>  
</label>  
<label class="container">SC  
  <input type="radio" name="radio">  
  <span class="check"></span>  
</label>  
<label class="container">ST  
  <input type="radio" name="radio">  
  <span class="check"></span>  
</label>  
  
</body>  
</html>