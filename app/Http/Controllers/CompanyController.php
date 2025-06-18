<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Student;
use App\Models\Vacancy;
use App\Models\Message;
use App\Models\CompanyNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function logout(){
        Auth::guard('company')->logout();
        return redirect('/login');
    }

    public function AddVacancy(Request $request){
        // dd($request->all());


        $request->validate([
            'jobfield'=>'required',
            'jobpost'=>'required',
            'salary'=>'required',
            'location'=>'required',
            'flyerimg'=>['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ],[
            'jobfield.required' => 'Enter a valid Job Field for this vacancy.',
            'jobpost.required' => 'Enter a valid Job Title for this vacancy.',
            'salary.required' => 'Enter an approximate Salary value/range for this vacancy.',
            'location.required' => 'Enter the Working Location for this vacancy.',
            'flyerimg.required' => 'Upload a Flyer Image to show in vacancy post.',
            'flyerimg.max' => 'The Flyer Image Size may not be greater than 2MB.',
            'flyerimg.mimes' => 'The Flyer Image must be a .jpg .png or .jpeg file.'
        ]); 


        $vacancy = new Vacancy;
        $vacancy->jobField = $request->jobfield;
        $vacancy->jobPost = $request->jobpost;
        $vacancy->salary = $request->salary;
        $vacancy->location = $request->location;
        $vacancy->flyer =  $request->file('flyerimg')->store('FlyerImages','public');
        $vacancy->company_id = Auth::guard('company')->user()->id;

        $vacancy->save();
        return redirect('Company/home')->with('message', 'Vacancy Added Successfully!');

    }

    public function MyPosts(){
        $user = Auth::guard('company')->user(); // Retrieve the authenticated company user

        $vacancies = Vacancy::where('company_id', $user->id)->get();

        return view('Company.myposts', compact('vacancies'));
        
    }

    public function EditVacancy($vacancy_id){
        $vacancy = Vacancy::findOrFail($vacancy_id);

        // Perform any necessary logic and pass the vacancy to the edit_post view
        return view('Company.editpost', compact('vacancy'));
    }

    public function UpdateVacancy(Request $request, $vacancy_id){
        $vacancy = Vacancy::findOrFail($vacancy_id);
        if ($vacancy->company_id !== Auth::guard('company')->user()->id) {
            return back()->with('error', 'You are not authorized to update this vacancy.');
        }
        $request->validate([
            'jobfield'=>'required',
            'jobpost'=>'required',
            'salary'=>'required',
            'location'=>'required',
            'flyerimg'=>['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ],[
            'jobfield.required' => 'Enter a valid Job Field for this vacancy.',
            'jobpost.required' => 'Enter a valid Job Title for this vacancy.',
            'salary.required' => 'Enter an approximate Salary value/range for this vacancy.',
            'location.required' => 'Enter the Working Location for this vacancy.',
            'flyerimg.required' => 'Upload a Flyer Image to show in vacancy post.',
            'flyerimg.max' => 'The Flyer Image Size may not be greater than 2MB.',
            'flyerimg.mimes' => 'The Flyer Image must be a .jpg .png or .jpeg file.'
        ]);
        
        $filePath = 'storage/' . $vacancy->flyer;
        File::delete($filePath);

        $vacancy->jobField = $request->jobfield;
        $vacancy->jobPost = $request->jobpost;
        $vacancy->salary = $request->salary;
        $vacancy->location = $request->location;
        $vacancy->flyer =  $request->file('flyerimg')->store('FlyerImages','public');

        $vacancy->save();

        return redirect('Company/home')->with('message', 'Vacancy Updated Successfully!');

    }

    public function DeleteVacancy($vacancy_id){
        $vacancy = Vacancy::findOrFail($vacancy_id);
        if ($vacancy->company_id !== Auth::guard('company')->user()->id) {
            return back()->with('error', 'You are not authorized to delete this vacancy.');
        }

        $filePath = 'storage/' . $vacancy->flyer;
        File::delete($filePath);

        $vacancy->delete();
        return redirect()->route('Company.myposts')->with('success', 'Vacancy deleted successfully.');
    }

    public function AboutMyCompany(){
        $user = Auth::guard('company')->user();
        return view('Company.AboutMe', compact('user'));
    }

    public function EditCompanyData(Request $request){
        $company = Auth::guard('company')->user();

        $this->validate($request,[
            'companyname' => 'required',
            'companyDescription' => 'required',
            'regnumber' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'Address' => 'required',
            'profilePicture' =>  ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'comlinkedin' => 'required'
        ],[
            'companyname.required' => 'Enter the company name.',
            'companyDescription.required' => 'Enter discription about your company.',
            'regnumber.required' => 'Enter your company register number.',
            'email.required' => 'Enter your company email address.',
            'phone.required' => 'Enter your company phone number.',
            'Address.required' => 'Enter physical address of your company.',
            'comlinkedin.required' => 'Enter LinkedIn or other company profile URL.',
            'profilePicture.required' => 'Enter Profile picture for your company.',
            'profilePicture.max' => 'The Profile picture image size may not be greater than 2MB.',
            'profilePicture.mimes' => 'The Profile picture image must be a .jpg .png or .jpeg file.'
        ]);

        $filePath = 'storage/' . $company->profilePic;
        File::delete($filePath);

        $company->name = $request->companyname;
        $company->companyDescription = $request->companyDescription;
        $company->regNumber = $request->regnumber;
        $company->address = $request->Address;
        $company->email = $request->email;
        $company->tel = $request->phone;
        $company->linkedin = $request->comlinkedin;
        $company->profilePic = $request->file('profilePicture')->store('CompanyProfilePictures','public');

        $company->save();
        return redirect('Company/home')->with('message', 'Company Account Updated Successfully!');
    }
    
    public function DeleteMyAccount(){
        $user = Auth::guard('company')->user();
        $filePath = 'storage/' . $user->profilePic;
        File::delete($filePath);
        $user->delete();
        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    }

    public function AllMessages(){
        $userid = Auth::guard('company')->user()->id;
        
        $messages = Message::where('recipient_type', 'company')
            ->where('recipient_id', $userid)
            ->where('is_seen', false)
            ->get();

            foreach ($messages as $message) {
                $senderType = $message->sender_type;
    
                if ($senderType === 'student') {
                    $sender = Student::find($message->sender_id);
                    $message->heading = $sender->firstname. ' ' . $sender->lastname;
                } elseif ($senderType === 'company') {
                    $sender = Company::find($message->sender_id);
                    $message->heading = $sender->name;
                }
            }


        $oldmessages = Message::where('recipient_type', 'company')
        ->where('recipient_id', $userid)
        ->where('is_seen', true)
        ->get();

        foreach ($oldmessages as $oldmessage) {
            $senderType = $oldmessage->sender_type;

            if ($senderType === 'student') {
                $sender = Student::find($oldmessage->sender_id);
                $oldmessage->heading = $sender->firstname. ' ' . $sender->lastname;
            } elseif ($senderType === 'company') {
                $sender = Company::find($oldmessage->sender_id);
                $oldmessage->heading = $sender->name;
            }
        }

        return view('Company.commsg', compact('messages', 'oldmessages'));
        //dd($newmsgdb);
    }


    public function SeenMsg(Request $request){
        $message = Message::findOrFail($request->msg_id);
        $message->update(['is_seen' => 1]);
        return redirect()->back();
    }

    public function MsgBody(Request $request){
        $user = Auth::guard('company')->user();
        $sender_id = $request->sender_id;
        $sender_type = $request->sender_type;

        $messages = Message::where(function ($query) use ($user, $sender_id) {
            $query->where('sender_id', $user->id)
                  ->where('recipient_id', $sender_id);
        })->orWhere(function ($query) use ($user, $sender_id) {
            $query->where('sender_id', $sender_id)
                  ->where('recipient_id', $user->id);
        })->get();

        foreach ($messages as $msg) {
            $senderType = $msg->sender_type;

            if ($senderType === 'student') {
                $sender = Student::find($msg->sender_id);
                $msg->heading = $sender->firstname. ' ' . $sender->lastname;
            } elseif ($senderType === 'company') {
                $sender = Company::find($msg->sender_id);
                $msg->heading = $sender->name;
            }
        }

        return view('Company.msgbody', compact('messages', 'sender_id', 'sender_type'));

    }

    public function SendMsg(Request $request){
        $user = Auth::guard('company')->user();

        $request->validate([
            'newmsg' => 'required|string',
        ]);

        $message = new Message([
            'message' => $request->input('newmsg'),
            'sender_id' => $user->id,
            'recipient_id' => $request->sender_id, 
            'sender_type' => 'company',
            'recipient_type' => $request->sender_type,
        ]);

        $now = Carbon::now('Asia/Kolkata'); 
        $message->created_at = $now;
        $message->updated_at = $now;
        $message->save();
        return redirect()->back();
    }

    public function Notification(){
        $user = Auth::guard('company')->user();
        $newNotifications = CompanyNotifications::where('company_id', $user->id)
        ->where('is_read', false)
        ->get();

        $oldNotifications = CompanyNotifications::where('company_id', $user->id)
        ->where('is_read', true)
        ->get();

        return view('Company.comnotification', compact('newNotifications', 'oldNotifications'));

    }
    

    public function ReadNotification(Request $request){
        $notification = CompanyNotifications::findOrFail($request->notification_id);
        $notification->update(['is_read' => 1]);
        return redirect()->back();
    }


}
