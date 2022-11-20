<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Draft;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
        $transaction_amount = Transaction::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->sum('transaction_amount');
        $transactions = Transaction::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        $drafts = Draft::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        $issues = Issue::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->get()->count();
        return view('home',['customers' => $customers,
                                'customers_adverser' => $customers_adverser,
                                'transaction_amount' => $transaction_amount,
                                'transactions' => $transactions,
            'customers_new' => $customers_new,
            'customers_tasks'=>$customers_tasks,
            'customers_rejects'=>$customers_rejects,
            'customers_follow'=>$customers_follow,
            'drafts'=>$drafts,
            'issues'=>$issues]);
    }

    /**
     * User Profile
     * @param Nill
     * @return View Profile
     * @author Shani Singh
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Update Profile
     * @param $profileData
     * @return Boolean With Success Message
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
     * @return Boolean With Success Message
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
}
