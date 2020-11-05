<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\response;
use Illuminate\Support\Facades\Validator;
use App\Mail\activeAccount;
use App\Models\Student\student;
use Auth;
use Mail;
class authController extends Controller
{
    use response;

    protected $status = true;

    protected $message = '';

    protected $data = [];

    /// login Function

    public function login(Request $request){

        if($request->exists('email') && $request->has('password')){

            $data = [
                'email' => request('email'),
                'password' => request('password')
            ];

            $dataValidated = [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ];

            $errors = Validator::make($data,$dataValidated);

            if($errors->fails()){

                $this->message = 'failed login';

                $this->data = [
                    'error' => $errors->errors()
                ];

                $this->status = false;

            }else{


                if($token = Auth::guard('admin')->attempt($data)){

                    $this->message = 'success login';

                    $this->data = [
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'type' => 'admin',
                        'expire' => Auth::guard('admin')->factory()->getTTL() * 60
                    ];
                }

                else if(!student::where('email',request('email'))->count()){

                    $this->status = false;

                    $this->message = 'faild login';

                    $this->data = [
                        'message' => 'Account Not Found'
                    ];

                }

                else if(student::where('email',request('email'))->where('confirmed',false)->first()){

                    $this->status = false;

                    $this->message = 'failed login';

                    $this->data = [
                        'message' => 'please Active Your Account'
                    ];

                }

                else if($token = Auth::guard('student')->attempt($data)){

                    $this->message = 'success login';

                    $this->data = [
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'type' => 'student',
                        'expire' => Auth::guard('admin')->factory()->getTTL() * 60
                    ];

                }else{

                    $this->message = 'failed login';

                    $this->data = [
                        'error' => 'Email Or Password Not Failed'
                    ];

                    $this->status = false;
                }
            }

        }else{

            $this->message = 'failed login';

            $this->data = [
                'error' => 'Both valid Are Required'
            ];
        }

        return response::returnData($this->status,$this->message,$this->data);
    }

    public function register(Request $request){

        if($request->method('POST') && $request->has('email') && $request->exists('password')){

            $dataValidated = [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ];

            $error = Validator::make($request->all(),$dataValidated);

            if($error->fails()){

                $this->status = false;

                $this->message = 'Failed Register';

                $this->data = [
                    'message' => $error->errors()
                ];

            }else{


                if(student::where('email',request('email'))->count()){

                    $this->status = false;

                    $this->message = 'Failed register';

                    $this->data = [
                        'message' => 'This Account Already Found'
                    ];

                }else{

                    $verify = rand(3242353453, 46456546546456);

                    $activeAccount = new activeAccount($request->all(), $verify);

                    $mailer = Mail::to(request('email'))->send($activeAccount);

                    $send = student::create([
                                'name' => request('name'),
                                'email' => request('email'),
                                'password' => bcrypt(request('password')),
                                'verify_account' => $verify
                            ]);


                    $this->status = false;

                    $this->message = 'Success register';

                    $this->data = [
                        'message' => 'Please Go to Account To Active Your Account'
                    ];
                }
            }

        }

        else{
            $this->status = false;

            $this->message = 'Failed register';

            $this->data = [
                'message' => 'Please Enter Valid Data'
            ];
        }

        return response::returnData($this->status, $this->message, $this->data);
    }

    public function verify($id){

        $student = student::where('verify_account', $id);

        if($student->count()){

            $student->update([
                'confirmed' => true,
                'verify_account' => null
            ]);

            $this->status = true;

            $this->message = 'Success Verify';

            $this->data = [
                'message' => 'Success Verify'
            ];

        }else{

            $this->status = false;

            $this->message = 'Failed register';

            $this->data = [
                'message' => 'This Account Not Found'
            ];
        }

        return response::returnData($this->status, $this->message, $this->data);
    }
}
