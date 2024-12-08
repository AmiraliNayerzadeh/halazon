<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;
use Kavenegar ;

class UserController extends Controller
{
    use SEOTools;


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->seo()->setTitle("همه کاربران");

        $title= $request['title'];
        $type= $request['type'];
        $confirm= $request['confirm'];

        $item = User::query();

        if (!is_null($title)) {
            $item->where('name' , 'LIKE' , "%$title%")
                ->orWhere('family' , 'LIKE' , "%$title%")
                ->orWhere('phone' , 'LIKE' , "%$title%");
        }


        if (!is_null($type)) {
            $item->where('is_teacher' , "%$type%");
        }

        if (!is_null($confirm)) {
            $item->where('is_verify' , "%$confirm%");
        }


        $users = $item->latest()->paginate(16)->withQueryString();



        return view('admin.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle("ایجاد کاربر جدید");
        return view('admin.users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'family' => ['required' ,'string'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['required', 'unique:users', 'starts_with:09', 'digits:11', 'numeric'],
            'email' => ['nullable', 'unique:users', 'email', 'lowercase', 'max:255'],
            'birthday' => ['nullable'],
            'nationalCode' => ['nullable', 'numeric', 'unique:users',],
            'address' => ['nullable'],
            'postalCode' => ['nullable', 'numeric'],
            'avatar' => ['nullable'],
            'video' => ['nullable'],
            'description' => ['nullable'],
            'password' => ['required'],
            'is_teacher' => ['required' , 'in:0,1'],
            'is_admin' => ['required' , 'in:1,0'],
            'is_verify' => ['required_if:is_teacher,1' , 'in:0,1'],

        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        $birthday = null;
        if (!is_null($request->birhday)) {
            /*Change ShamsiDate To Miladi*/
            $birthdayTime = $request->deadline;
            $birthday = Jalalian::fromFormat('Y/m/d H:i:s', $birthdayTime)->toCarbon()->toDateTimeString();
        }
        $fullName = $request['name'].' '.$request['family'];
        $slug=$request['slug'] = str_replace([' ','‌'] , '-' ,$fullName);

        $user = User::create([
            'name' => $request->name,
            'family' => $request->family,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $birthday,
            'nationalCode' => $request->nationalCode,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'avatar' => $request->avatar,
            'video' => $request->video,
            'description' => $request->description,
            'password' => Hash::make($request->password),
            'is_teacher' => $request->is_teacher,
            'is_verify' => $request->is_verify,
            'slug' => $slug,

        ]);

        $user->categories()->sync($request->categories);

        Alert::success("کاربر جدید با موفقیت ایجاد شد.");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->seo()->setTitle("مشاهده کاربر $user->name $user->family");

        return view('admin.users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->seo()->setTitle("ویرایش کاربر $user->name $user->family");

        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'family' => ['required_if:type,haghighi', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['required', 'unique:users,phone,'.$user->id, 'starts_with:09', 'digits:11', 'numeric'],
            'email' => ['nullable', 'unique:users,email,'.$user->id, 'email', 'lowercase', 'max:255'],
            'birthday' => ['nullable'],
            'nationalCode' => ['nullable', 'numeric', 'unique:users,nationalCode,'.$user->id,],
            'address' => ['nullable'],
            'postalCode' => ['nullable', 'numeric'],
            'avatar' => ['nullable'],
            'id_card' => ['nullable'],
            'video' => ['nullable'],
            'description' => ['nullable'],
            'password' => ['nullable'],
            'is_teacher' => ['required' , 'in:0,1'],
            'is_admin' => ['required' , 'in:1,0'],
            'is_verify' => ['required_if:is_teacher,1' , 'in:0,1'],
            'categories' => ['nullable' , 'exists:categories,id' , 'array'],
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $birthday = null;
        if (!is_null($request->birthday)) {
            list($year, $month, $day) = explode('/', $request->birthday);
            $birthday = Jalalian::fromFormat('Y/m/d', "$year/$month/$day")->toCarbon()->format('Y-m-d');
        }

        $fullName = $request['name'].' '.$request['family'];
        $slug=$request['slug'] = str_replace([' ','‌'] , '-' ,$fullName);

        $oldStatus = $user->is_verify ;

        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $birthday,
            'nationalCode' => $request->nationalCode,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'avatar' => $request->avatar,
            'id_card' => $request->id_card,
            'video' => $request->video,
            'description' => $request->description,
            'password' => Hash::make($request->password),
            'is_teacher' => $request->is_teacher,
            'is_admin' => $request->is_admin ,
            'is_verify' => $request->is_verify,
            'slug' => $slug,
        ]);

        $user->categories()->sync($request->categories);

        if ($user->is_teacher == 1) {
            if ( $oldStatus == null  || $oldStatus == 0 && $user->is_verify == 1 ) {
                try{
                    $receptor = $user->phone;
                    $token2 = null;
                    $token3 = null;
                    $token20 = $user->name;
                    $token = "عزیز";
                    $template= "TeacherConfirmInformation";
                    $type = 'sms';

                    $result = Kavenegar::VerifyLookup($receptor, $token, $token2, $token3,$token20 ,  $template, $type);
                }
                catch(\Kavenegar\Exceptions\ApiException $e){
                    var_dump($e->getMessage());
                }
                catch(\Kavenegar\Exceptions\HttpException $e){
                    var_dump($e->getMessage());
                }
            }

        }



        Alert::success(" کاربر $user->name $user->family  با موفقیت بروز رسانی شد. ");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
