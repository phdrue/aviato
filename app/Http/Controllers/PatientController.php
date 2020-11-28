<?php

namespace App\Http\Controllers;

use App\Models\Queue;
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
        return view('patients.day_queues', compact('queues', 'day'));
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
        return response(['user'=>Auth::user(), 'token'=>$token]);
//        return response(['user'=>Auth::user()]);
    }
}
