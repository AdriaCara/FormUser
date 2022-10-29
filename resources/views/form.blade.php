@extends('layouts.master')


@section('titel')
form
@endsection


@section('content')
<!-- Form -->
<div class="overlay">
  <form method="post" class="form" action="saveData">
    <div class="con">
    <header class="head-form">
      <h2>FORM</h2>
      <p>This is a school project</p>
    </header>
      @csrf
      <div class="">
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <input type="text" id="name" class="form-control" name="name" placeholder="Name" onchange="validateData()" required>
            <label style="display: block;" class="text-danger" id="messageName">El Nombre esta en blanc</label>
          </div>
        </div>
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <input type="text" id="lastName" class="form-control" name="lastName" placeholder="Cognoms" onchange="validateData()"  required>
            <label style="display: block;" class="text-danger" id="messageLastName">El cognom no es correcte</label>
          </div>
        </div>
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <input type="text" id="NIF" class="form-control" name="NIF" onchange="validateData()" placeholder="NIF" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required>
            <label style="display: block;" class="text-danger" id="messageNIF">El DNI no es correcte</label>
          </div>
        </div>
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <select id="gender" name="gender">
              <option value="Male">Hombre</option>
              <option value="Famale">Mujer</option>
              <option value="Other">Otro</option>
            </select required>
          </div>
        </div>
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <select id="maritalStatus" name="maritalStatus">
              <option value="Alone">Soltere/soltera/solter</option>
              <option value="Married">Casade/casada/casat</option>
              <option value="FreeUnion">Unió Lliure</option>
              <option value="Separat">Separade/Separada/Separat</option>
              <option value="">Divorciade/Divorciada/Divorciat</option>
              <option value="">viude/Viuda/Viudu</option>
            </select required>
          </div>
        </div>
        <button class="log-in" type="submit" class="btn btn-success" id="btn">Success</button>
      </div>
    </div>
  </form>
</div>

<!-- Script -->
<script language="javascript">

  function validateData() {
    if(document.getElementById("name").value!==""){
      document.getElementById("messageName").style.display = "none";
      document.getElementById("btn").disabled = false;
    }else{
      document.getElementById("messageName").style.display = "block";
      document.getElementById("btn").disabled = true;
    }

    if(document.getElementById("lastName").value!==""){
      document.getElementById("messageLastName").style.display = "none";  
      document.getElementById("btn").disabled = false;
    }else{
      document.getElementById("messageLastName").style.display = "block";
      document.getElementById("btn").disabled = true;
    }

    if (!validateNIF()){
      document.getElementById("messageNIF").style.display = "block";
      document.getElementById("btn").disabled = true;
    }else{
      document.getElementById("messageNIF").style.display = "none";  
      document.getElementById("btn").disabled = false;
    }
  }

  // Acepta NIEs (Extranjeros con X, Y o Z al principio)
  function validateNIF() {
      var nif=document.getElementById("NIF").value; 
      var numero, let, letra;
      var expresion_regular_nif = /^[XYZ]?\d{5,8}[A-Z]$/;

      nif = nif.toUpperCase();

      if(expresion_regular_nif.test(nif) === true){
          numero = nif.substr(0,nif.length-1);
          numero = numero.replace('X', 0);
          numero = numero.replace('Y', 1);
          numero = numero.replace('Z', 2);
          let = nif.substr(nif.length-1, 1);
          numero = numero % 23;
          letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
          letra = letra.substring(numero, numero+1);
          if (letra != let) {
              //alert('Dni erroneo, la letra del NIF no se corresponde');
              return false;
          } else {
            return true;
          }
      }else{
          //alert('Dni erroneo, formato no válido');
          return false;
      }
  }

</script>
<style>
  @import url('https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur');
  * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
  }
  body {
      background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
  background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
  background-attachment: fixed;
    background-repeat: no-repeat;

      font-family: 'Vibur', cursive;
      font-family: 'Abel', sans-serif;
  opacity: .95;
  }

  form {
      width: 450px;
      min-height: 500px;
      height: auto;
      border-radius: 5px;
      margin: 2% auto;
      box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
      padding: 2%;
      background-image: linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%);
  }
  form .con {
      display: -webkit-flex;
      display: flex;
    
      -webkit-justify-content: space-around;
      justify-content: space-around;
    
      -webkit-flex-wrap: wrap;
      flex-wrap: wrap;
    
        margin: 0 auto;
  }

  header {
      margin: 2% auto 10% auto;
      text-align: center;
  }
  header h2 {
      font-size: 250%;
      font-family: 'Playfair Display', serif;
      color: #3e403f;
  }
  header p {letter-spacing: 0.05em;}

  .input-item {
      background: #fff;
      color: #333;
      padding: 14.5px 0px 15px 9px;
      border-radius: 5px 0px 0px 5px;
  }

  #eye {
      background: #fff;
      color: #333;
    
      margin: 5.9px 0 0 0;
      margin-left: -20px;
      padding: 15px 9px 19px 0px;
      border-radius: 0px 5px 5px 0px;
    
      float: right;
      position: relative;
      right: 1%;
      top: -.2%;
      z-index: 5;
      
      cursor: pointer;
  }
  input[class="form-input"]{
      width: 240px;
      height: 50px;
    
      margin-top: 2%;
      padding: 15px;
      
      font-size: 16px;
      font-family: 'Abel', sans-serif;
      color: #5E6472;
    
      outline: none;
      border: none;
    
      border-radius: 0px 5px 5px 0px;
      transition: 0.2s linear;
      
  }
  input[id="txt-input"] {width: 250px;}
  input:focus {
      transform: translateX(-2px);
      border-radius: 5px;
  }

  button {
      display: inline-block;
      color: #252537;
    
      width: 280px;
      height: 50px;
    
      padding: 0 20px;
      background: #fff;
      border-radius: 5px;
      
      outline: none;
      border: none;
    
      cursor: pointer;
      text-align: center;
      transition: all 0.2s linear;
      
      margin: 7% auto;
      letter-spacing: 0.05em;
  }
  .submits {
      width: 48%;
      display: inline-block;
      float: left;
      margin-left: 2%;
  }

  .frgt-pass {background: transparent;}

  .sign-up {background: #B8F2E6;}

  button:hover {
      transform: translatey(3px);
      box-shadow: none;
  }

  button:hover {
      animation: ani9 0.4s ease-in-out infinite alternate;
  }
  @keyframes ani9 {
      0% {
          transform: translateY(3px);
      }
      100% {
          transform: translateY(5px);
      }
  }
</style>
@endsection