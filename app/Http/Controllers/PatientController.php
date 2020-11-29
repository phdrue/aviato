<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Queue;
use App\Models\Queues_users;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class PatientController extends Controller
{
    //
    public function start()
    {
        //$qr_code = QrCode::size(250)->gradient(2, 0, 36, 0, 212, 255, 'vertical')->generate('link');
        $specialties = Specialty::pluck('name', 'id')->toArray();
        return view('patients.start', compact('specialties'));
    }

    //Очереди на опрделенный день
    public function queues_day()
    {
        \request()->validate([
            'day'=>'required|date'
        ]);

        $day = \request('day');
        $queues = Queue::where('real_day', $day)->get();
        $day = Carbon::parse($day)->format('d.m.Y');
        $days = Day::all();
        return view('patients.day_queues', compact('queues', 'day', 'days'));
    }


    public function testapi()
    {
        return "sdfasdf";
    }


    public function login(Request $request)
    {
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($login)){
            //return response(['message'=>'Invalid credentrials', 'status'=>422, 'error'=>'incorrect_credentials']);
            /*return response()->json([
                "error"=>"invalid credentials", 500
            ]);*/
            abort(401);
        }
        $user = Auth::user();
        $token = $user->createToken('Token Name')->accessToken;
        $userdata = $user->userdata;
        return response(['user'=>Auth::user(), 'token'=>$token, 'userdata'=>$userdata]);
//        return response(['user'=>Auth::user()]);
    }

    public function toqueue(Queue $queue)
    {
        $user = Auth::user();

        if ($queue->people()->where('user_id', $user->id)->first() != null){
            abort(404);
        } else{
            $position = count($queue->people()->where('status_id', '!=', 5)->get());
            $position++;
            $new_item = [
                'user_id'=>$user->id,
                'queue_id'=>$queue->id,
                'status_id'=>1,
                'position'=>$position
            ];
            Queues_users::create($new_item);
            $message = 'Вы были записаны на прием, ваше место в очереди ' . $position;
            return response(['message'=>$message], 200);
        }

    }

    public function mystatus(Queue $queue)
    {
        $user = Auth::user();
        $status = $queue->people()->where('user_id', $user->id)->first()->status->name;
        $message = 'Ваш статус в очереди: ' . $status;
        return response(['message'=> $message]);
    }

    public function reject(Queue $queue)
    {
        $user = Auth::user();
    }
}
