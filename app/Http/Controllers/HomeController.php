<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Customer;
use App\Models\Draft;
use App\Models\Form;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:رفع-نماذج', ['only' => ['import','storeImport']]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

//        $adverser = Customer::whereHas('transactions')->latest();
//        $adverser = $adverser->whereHas('payments',function ($query) {
//            return $query->where('created_at', '<=', Carbon::now()->subDays(10)->toDateTimeString());
//        })->update([
//            'status'=> 'متعسر'
//        ]);

//        dd($adverser);


        $customers = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        $customers_adverser = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('status','متعسر')->get()->count();
        $customers_new = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('status','جديد')->get()->count();
        $customers_tasks = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
        $customers_follow = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('repeater',true)->get()->count();
        $customers_rejects = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('status','مرفوض')->get()->count();
        $customers_committed = Customer::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->where('status','ملتزم')->get()->count();
        $transaction_amount = Transaction::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->sum('transaction_amount');
        $transactions = Transaction::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        $drafts = Draft::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        $drafts_tasks = Draft::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
        $issues = Issue::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();

        $forms = Form::latest()->get();

        return view('home',['customers' => $customers,
                                'customers_adverser' => $customers_adverser,
                                'transaction_amount' => $transaction_amount,
                                'transactions' => $transactions,
            'customers_new' => $customers_new,
            'customers_tasks'=>$customers_tasks,
            'customers_rejects'=>$customers_rejects,
            'customers_follow'=>$customers_follow,
            'customers_committed'=>$customers_committed,
            'drafts'=>$drafts,
            'issues'=>$issues,
            'drafts_tasks'=>$drafts_tasks,
            'forms'=>$forms]);
    }

    /**
     * User Profile
     * @param Nill
     * @return View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @author Shani Singh
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Update Profile
     * @param $profileData
     * @return \Illuminate\Http\RedirectResponse With Success Message
     * @author Shani Singh
     */
    public function updateProfile(Request $request)
    {
        #Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        try {
            DB::beginTransaction();

            #Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'تم تعديل الملف الشخصي بنجاح');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Change Password
     * @param Old Password, New Password, Confirm New Password
     * @return \Illuminate\Http\RedirectResponse With Success Message
     * @author Shani Singh
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'تم تغيير كلمة السر بنجاح');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }


    public function state(Request $request){

        if($request->state == 'شهري'){
            $customers = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->get()->count();
            $customers_adverser = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->where('status','متعسر')->get()->count();
            $customers_new = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->where('status','جديد')->get()->count();
            $customers_tasks = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
            $customers_follow = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->where('repeater',true)->get()->count();
            $customers_rejects = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->where('status','مرفوض')->get()->count();
            $customers_committed = Customer::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->where('status','ملتزم')->get()->count();
            $transaction_amount = Transaction::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->get()->sum('transaction_amount');
            $transactions = Transaction::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->get()->count();
            $drafts = Draft::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->get()->count();
            $drafts_tasks = Draft::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
            $issues = Issue::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))->get()->count();
        }else{
            $customers = Customer::whereYear('created_at', date('Y'))->get()->count();
            $customers_adverser = Customer::whereYear('created_at', date('Y'))->where('status','متعسر')->get()->count();
            $customers_new = Customer::whereYear('created_at', date('Y'))->where('status','جديد')->get()->count();
            $customers_tasks = Customer::whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
            $customers_follow = Customer::whereYear('created_at', date('Y'))->where('repeater',true)->get()->count();
            $customers_rejects = Customer::whereYear('created_at', date('Y'))->where('status','مرفوض')->get()->count();
            $customers_committed = Customer::whereYear('created_at', date('Y'))->where('status','ملتزم')->get()->count();
            $transaction_amount = Transaction::whereYear('created_at', date('Y'))->get()->sum('transaction_amount');
            $transactions = Transaction::whereYear('created_at', date('Y'))->get()->count();
            $drafts = Draft::whereYear('created_at', date('Y'))->get()->count();
            $drafts_tasks = Draft::whereYear('created_at', date('Y'))->whereNotNull('updated_by')->get()->count();
            $issues = Issue::whereYear('created_at', date('Y'))->get()->count();
        }


        return response()->json([
        'status' => 'success',
            'state' => $request->state,
            'customers' => $customers,
            'customers_adverser' => $customers_adverser,
            'transaction_amount' => $transaction_amount,
            'transactions' => $transactions,
            'customers_new' => $customers_new,
            'customers_tasks'=>$customers_tasks,
            'customers_rejects'=>$customers_rejects,
            'customers_follow'=>$customers_follow,
            'customers_committed'=>$customers_committed,
            'drafts'=>$drafts,
            'issues'=>$issues,
            'drafts_tasks'=>$drafts_tasks
        ]);
    }

    public function import(){
        return view('import');
    }

    public function storeImport(Request $request){

        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlsx',
            'name' => 'required'

        ],[
                'file.required' => 'يجب ادخال النموذج',
                'name.required' => 'يجب ادخال اسم النموذج',
            ]
        );


        DB::beginTransaction();
        try {
            $file = $request->file('file');

            $name = $file->getClientOriginalName();

            $form = Form::create([
                'name' => $request->name,
                'path' => 'http://transaction.sellbuyltd.com/storage/app/public/forms/' . $name,
//                'path'         => $name,
            ]);

//            Storage::disk('public')->put('forms/' . $name, file_get_contents($request->file));
            $request->file->move(public_path('/forms'), $name);


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('home')->with('success','تم اضافة النموذج بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }

    }


}
