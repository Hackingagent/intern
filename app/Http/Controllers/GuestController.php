<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacancy;

class GuestController extends Controller
{
    public function welcome(){
        $vacancies = Vacancy::all();
        return view('Guest.welcome', compact('vacancies'));
    }

    public function seeMore(Request $request){

        $vacancy = Vacancy::findOrFail($request->vacancy_id);

        $company = $vacancy->company;

        return view('Guest.seemore', compact('vacancy', 'company'));
    }

    public function login(){
        return view('Guest.login');
    }
    public function selectAccType(){
        return view('Guest.AccType');
    }
    public function createComAcc(){
        return view('Guest.CreateCompanyAcc');
    }
    public function createStuAcc(){
        return view('Guest.CreateStudentAcc');
    }

    public function CreateNewStudent(Request $request){
        // dd($request->all());
        $this -> validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'university' => 'required',
            'degree' => 'required',
            'profilePicture' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'linkedIn' => 'required',
            'username' => ['required', Rule::unique('students', 'username')],
            'password' => 'required'
        ]);

        $student = new Student;
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->address = $request->address;
        $student->email = $request->email;
        $student->tel = $request->phone;
        $student->university = $request->university;
        $student->degree = $request->degree;
        $student->linkedin = $request->linkedIn;
        $student->username = $request->username;
        $student->password = $request->password;
        $student->profilePic = $request->file('profilePicture')->store('StudentProfilePictures','public');

        $student->save();

        return redirect('login')->with('message', 'Student Account Created Successfully!');
    }

    public function CreateNewCompany(Request $request){
        //dd($request->all());

        $this->validate($request,[
            'companyname' => 'required',
            'companyDescription' => 'required',
            'regnumber' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'Address' => 'required',
            'profilePicture' =>  ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'comlinkedin' => 'required',
            'username' => ['required', Rule::unique('companies', 'username')],
            'password' => 'required'
        ]);

        $company = new Company;

        $company->name = $request->companyname;
        $company->companyDescription = $request->companyDescription;
        $company->regNumber = $request->regnumber;
        $company->address = $request->Address;
        $company->email = $request->email;
        $company->tel = $request->phone;
        $company->linkedin = $request->comlinkedin;
        $company->username = $request->username;
        $company->password = $request->password;
        $company->profilePic = $request->file('profilePicture')->store('CompanyProfilePictures','public');


        $company->save();
        return redirect('login')->with('message', 'Company Account Created Successfully!');

    }

    public function LoginCheck(Request $request){
        $request->validate([
            'acctype'=> 'required',
            'username' => 'required',
            'password' => 'required | min:5 | max:20'
        ],[
            'acctype.required' => 'Account type must be selected.'
        ]);

        $acctype = $request->acctype;
        if($acctype=='student'){
            $request->validate([
                'username' => 'required | exists:students,username',
                'password' => 'required | min:5 | max:20'
            ],[
                'username.exists'=>'This username is not exists in Student details table'
            ]);

            $creds = $request-> only('username', 'password');

            if(Auth::guard('student')->attempt($creds)){
                return redirect()->route('Student.StuFeed');
            }else{
                return redirect('login')->with('message','Invalid Credentials');
            }



        }else if($acctype=='company'){
            $request->validate([
                'username' => 'required | exists:companies,username',
                'password' => 'required | min:5 | max:20'
            ],[
                'username.exists'=>'This username is not exists in Company details table'
            ]);

            $creds = $request-> only('username', 'password');

            if(Auth::guard('company')->attempt($creds)){
                return redirect()->route('Company.home');
            }else{
                return redirect('login')->with('message','Invalid Credentials');
            }


        }
    }





}
