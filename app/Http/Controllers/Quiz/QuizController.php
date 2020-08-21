<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Choose;
use App\Models\Exam;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
class QuizController extends Controller
{
    public function showExamName()
    {
        $exam = Exam::get();
        return view('start',compact('exam'));
    }
    public function getindex()
    {
        return view('quiz');
    }
    public function index(Request $req)
    {
        if($req->method() == 'POST') {
            $request_count = $req->all();
            $request_count = count($request_count);
            if ($request_count == 2)
                return redirect()->back();

            $except = $req->except(['_token', 'Send']);

            if (count($except) > 1)
                return redirect()->back()->with(['Error' => 'You Should select from the ' . count($except) . ' Quiz just one']);

            $count_exam = Exam::select('id')->count();
            $Q_ID = $ExName = '';
            foreach ($except as $key => $value) {
                $Q_ID = $key;
                $ExName = Exam::select('id', 'ExamName')->find($key);
                $user_exist = User::select('id')->find(Auth::id());

                /*
                 *  this query is to get count of users that get the quiz
                 * for example if the user_id = 2 and get 1 quiz and if i have 2 exam in the site then the user
                 * get one and he has one don't take it
                 * */
                $user_id_exam = DB::table('user_exam')->
                where('user_id', Auth::id())->count();
                /*
                 *  in this query we discover that if the user get this quiz or not for example
                 * if the user_id = 2 and get the exam_id = 1 and we have 2 exam in the site then the user
                 * have one quiz to get it and it is the quiz number 2
                 * */
                $exam_exist = DB::table('user_exam')->
                where('user_id', Auth::id())->where('exam_id', $Q_ID)->exists();

                /* if the exam taken before then will redirect back */
                if ($exam_exist) {
                    return redirect()->back()->with(['Take_Quiz_Again' => 'You get this Exam before']);
                }

                /* if the user take the 2 quiz then redirect back
                i don't know why this if i do it the if in the above make the sam functionality
                */
                /*if($user_id_exam >= $count_exam){
                        return  redirect()->back()->with(['Quiz'=>'You get the '.$count_exam.' Exam']);
                }*/
                $query = DB::table('user_exam')->insert([
                    'user_id' => Auth::id(),
                    'exam_id' => $Q_ID
                ]);
                //$ExName = $ExName['ExamName']; // if i make this in the blade not make the access arrow
            }
            $q_id2 = $Q_ID;
            $choose = Choose::with(['question' => function ($q) {
                $q->select('Category', 'id');
            }])->get()->where('question_id', $q_id2);
            return view('quiz', compact('choose', 'ExName'));
        }else
            return redirect()->back();
    }

    public function store(Request $req)
    {

        try {
            $exname = $req->input('exam');
            $exID = $req->input('examID');
            $req = $req->except(['_token', 'Send', 'exam', 'examID']);
            $counter = 0;
            foreach ($req as $key => $value) {
                $test = Choose::find($key);
                if ($test) {
                    if ($test->Answer == $value) {
                        $counter++;
                        $test->Update(['Points' => $counter]);
                    } else {
                        $test->Update(['Points' => $counter]);
                    }
                    $counter = 0;
                }
            }
            $points = Choose::where('Points', '>', '0')->where('question_id', $exID)->count();
            $degree = User::with('exams')->find(Auth::id());
            //$degree = Exam::with('users')->find(Auth::id());
            $deg = $degree->exams;
            $deg = $deg->where('id', $exID);
            foreach ($deg as $dg) {
                if ($dg->ExamName == $exname && $dg->id == $exID)
                     $dg->pivot->Update(['Degree' => $points]);
            }
            foreach ($deg as $gh) {
                $degree = $gh->pivot->Degree;
                Session::put('Sucess', 'Your Answer Saved Successfully');
                return view('degree', compact('degree'));
            }
        }catch (\Exception $ex){
                return $ex->getMessage();
                return redirect()->route('home')->with(['Error'=>'There is an error try later on']);
        }
    }
}
