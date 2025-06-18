@extends('Guest.layout')
@section('title', 'Select Account Type')
@section('content')


    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div id="selectbox">
            <br><br><h3>Select Your Account Type:</h3>
           
            <div >
          
              <div class="radio-title-group">
    
                <div class="input-container">
                  <input id="com" type="radio" name="radio" onclick="location.href='/CreateCompanyAcc';">
                  <div class="radio-tile">
                    <ion-icon name="home"></ion-icon>
                    <label for="com">Company</label><br><br>
                  </div>
                </div>
             
                <div class="input-container">
                  <input id="stu" type="radio" name="radio" onclick="location.href='/CreateStudentAcc';">
                  <div class="radio-tile">
                    <ion-icon name="contacts"></ion-icon>
                    <label for="stu">Student</label><br><br>
                  </div>
                </div>
    
              </div>
            </div>
            <br><br><br><br>
            <a href="/login"><input type="button" value="Back" id="acctypebackBtn" /></a>
    
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
    

  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    
@endsection
    