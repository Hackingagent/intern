<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Message;
use App\Models\CompanyNotifications;
use App\Models\StudentNotifications;
use App\Models\StudentFavorite;
use App\Models\StudentApply;
use App\Models\File as Files;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;


class StudentController extends Controller
{
     function logout(){
        Auth::guard('student')->logout();
        return redirect('/login');
    }

    function StuFeed(){

        $vacancies = Vacancy::get();
        return view('Student.Feed', compact('vacancies'));
    }

    function AboutMe(){
        $user = Auth::guard('student')->user();
        return view('Student.AboutMe', compact('user'));
    }

    function EditStudentData(Request $request){
        $student = Auth::guard('student')->user();
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'university' => 'required',
            'degree' => 'required',
            'email' => ['required', 'email'],
            'linkedIn' => 'required',
            'profilePicture' =>  ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ],[
            'firstname.required' => 'Enter your first name.',
            'lastname.required' => 'Enter your last name.',
            'address.required' => 'Enter your home address.',
            'email.required' => 'Enter your email address.',
            'phone.required' => 'Enter your contact phone number.',
            'university.required' => 'Enter universities you attended.',
            'degree.required' => 'Enter your degree qualifications.',
            'linkedIn.required' => 'Enter your degree qualifications.',
            'profilePicture.max' => 'The Profile picture image size may not be greater than 2MB.',
            'profilePicture.mimes' => 'The Profile picture image must be a .jpg .png or .jpeg file.'
        ]);

        $filePath = 'storage/' . $student->profilePic;
        File::delete($filePath);

        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->university = $request->university;
        $student->address = $request->address;
        $student->email = $request->email;
        $student->tel = $request->phone;
        $student->degree = $request->degree;
        $student->linkedin = $request->linkedIn;
        $student->profilePic = $request->file('profilePicture')->store('StudentProfilePictures','public');

        $student->save();
        return redirect('Student/feed')->with('message', 'Your Student Details Updated Successfully!');

    }

    function DeleteMyAccount (){
        $student = Auth::guard('student')->user();
        $filePath = 'storage/' . $student->profilePic;
        File::delete($filePath);
        $student->delete();
        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    }

    function AddToFav(Request $request){
        $student_id = Auth::guard('student')->user()->id;
        $vacancy_id = $request->get('vacancy_id');

        $exists = StudentFavorite::where('student_id', $student_id)
                ->where('post_id', $vacancy_id)
                ->exists();

        if($exists){
            return redirect('Student/feed')->with('message', 'This vacancy already added to favorites!');
        }else{
            $favorite = new StudentFavorite();
            $favorite->student_id = $student_id;
            $favorite->post_id = $vacancy_id;
            $favorite->save();
            return redirect('Student/feed');
        }
    }

    function Favorite(){
        $student_id = Auth::guard('student')->user()->id;

        $favoriteVacancies = Vacancy::join('student_favorites', 'vacancies.id', '=', 'student_favorites.post_id')
            ->where('student_favorites.student_id', $student_id)
            ->select('vacancies.*')
            ->get();

        return view('Student.favorite', compact('favoriteVacancies'));
    }

    function Removefavorite(Request $request){
        $student_id = Auth::guard('student')->user()->id;
        StudentFavorite::where('student_id', $student_id)
        ->where('post_id', $request->vacancy_id)
        ->delete();
        return redirect('Student/favorite');
    }

    function SeeMore(Request $request){
        $vacancy = Vacancy::findOrFail($request->vacancy_id);

        $company = $vacancy->company;

        return view('Student.AboutVacancy', compact('vacancy', 'company'));
    }

    public function AllMessages(){
        $userid = Auth::guard('student')->user()->id;

        $messages = Message::where('recipient_type', 'student')
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


        $oldmessages = Message::where('recipient_type', 'student')
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

        return view('Student.stumsg', compact('messages', 'oldmessages'));
        //dd($newmsgdb);
    }

    public function SeenMsg(Request $request){
        $message = Message::findOrFail($request->msg_id);
        $message->update(['is_seen' => 1]);
        return redirect()->back();
    }


    public function MsgBody(Request $request){
        $user = Auth::guard('student')->user();
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

        return view('Student.msgbody', compact('messages', 'sender_id', 'sender_type'));

    }


    public function SendMsg(Request $request){
        $user = Auth::guard('student')->user();

        $request->validate([
            'newmsg' => 'required|string',
        ]);

        $message = new Message([
            'message' => $request->input('newmsg'),
            'sender_id' => $user->id,
            'recipient_id' => $request->sender_id,
            'sender_type' => 'student',
            'recipient_type' => $request->sender_type,
        ]);

        $now = Carbon::now('Asia/Kolkata');
        $message->created_at = $now;
        $message->updated_at = $now;
        $message->save();
        return redirect()->back();
    }


    public function showApply($id){

        return view('Student.apply', compact('id'));
    }



    public function Apply(Request $request, $id){


        $request->validate([
            'cv'=>['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'id'=>['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'cover'=>['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'additional'=>['image', 'mimes:jpg,png,jpeg', 'max:2048'],
        ],[
            'cv.required' => 'CV file is required',
            'id.required' => 'ID file is required',
            'cover.required' => 'Cover Letter file is required.',

        ]);

        $student = Auth::guard('student')->user();

        if(!$student){
            return redirect()->route('login');
        }
        $student_id = $student->id;
        // $vacancy_id = $request->get('vacancy_id');

        $vacancy = Vacancy::where('id', $id)->first();

        $company = Company::where('id', $vacancy->company_id)->first();
        $companyName = $company->name;

        //dd($vacancy->company_id);

        $exists = StudentApply::where('student_id', $student_id)
                ->where('post_id', $id)
                ->exists();

        if($exists){
            return redirect('Student/feed')->with('message', 'You already applied for this vacancy!');
        }else{
            $apply = new StudentApply();
            $apply->student_id = $student_id;
            $apply->post_id = $id;
            $apply->save();


            if($request->hasFile('cv') && $request->hasFile('cover') && $request->hasFile('id') ){

                $file1 = $request->cv;
                $file2 = $request->cover;
                $file3 = $request->id;


                $name = date('d-m=y-H-m-i');
                $folder = 'files';


                if(!Storage::disk('public')->exists($folder)){
                    Storage::disk('public')->makeDirectory($folder);
                }

                if ($request->hasFile('additional')){
                    $file4 = $request->additional;
                    $ext4 = $file4->getClientOriginalExtension();

                    $path4 = $name. Str::random(10). '.' . $ext4;
                    $file4->storeAs($folder, $path4, 'public');


                    $additional =  $folder. '/' . $path4;

                }else{
                    $additional = null;
                }

                $ext1 = $file1->getClientOriginalExtension();
                $ext2 = $file2->getClientOriginalExtension();
                $ext3 = $file3->getClientOriginalExtension();



                $path1 = $name. Str::random(10). '.' . $ext1;
                $path2 = $name. Str::random(10). '.' . $ext2;
                $path3 = $name. Str::random(10). '.' . $ext3;
                $file1->storeAs($folder, $path1, 'public');
                $file2->storeAs($folder, $path2, 'public');
                $file3->storeAs($folder, $path3, 'public');
            }

            $file = Files::create([
                'cv' => $folder. '/' . $path1,
                'cover' => $folder. '/' . $path2,
                'id_card' => $folder. '/' . $path3,
                'additional' => $additional,
                'student_apply_id' => $apply->id,
            ]);


            $applymessage = new Message();
            $applymessage->sender_id = $student_id;
            $applymessage->recipient_id = $vacancy->company_id;
            $applymessage->sender_type = 'student';
            $applymessage->recipient_type = 'company';
            $applymessage->message = 'I want to apply for the vacancy that you had posted on ' . $vacancy->jobPost. ' in the ' . $vacancy->jobField . ' field at ' . $vacancy->updated_at->timezone('+05:30') ;
            $applymessage->save();

            $applynotification = new CompanyNotifications();
            $applynotification->company_id = $vacancy->company_id;
            $applynotification->notification = $student->firstname .' ' . $student->lastname .' has applied to your vacancy on '. $vacancy->jobPost. ' in the ' . $vacancy->jobField . ' field that you posted at ' . $vacancy->updated_at->timezone('+05:30'). '.' ;
            $applynotification->save();

            $stuNotification = new StudentNotifications();
            $stuNotification->student_id = $student_id;
            $stuNotification->notification = 'You have applied to the vacancy on '. $vacancy->jobPost. ' in the ' . $vacancy->jobField . ' field that posted by '.$companyName .' at ' . $vacancy->updated_at->timezone('+05:30'). '.';
            $stuNotification->save();

            return redirect('Student/feed')->with('message', 'You applied for the vacancy successfully!');
        }
    }

    public function Notification(){
        $user_id = Auth::guard('student')->user()->id;
        $newNotifications = StudentNotifications::where('student_id', $user_id)
        ->where('is_read', false)
        ->get();

        $oldNotifications = StudentNotifications::where('student_id', $user_id)
        ->where('is_read', true)
        ->get();

        return view('Student.stuNotifications', compact('newNotifications', 'oldNotifications'));
    }

    public function ReadNotification(Request $request){
        $notification = StudentNotifications::findOrFail( $request->notification_id);
        $notification->update(['is_read' => 1]);
        return redirect()->back();
    }


}
