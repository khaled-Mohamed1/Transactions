<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Attachment;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:مرفقات-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:مرفقات-اظهار', ['only' => ['show']]);
        $this->middleware('permission:مرفقات-حذف', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Customer $customer)
    {
        return view('customers.attachments',['customer' => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ],[
                'file.required' => 'يجب ادخال الصورة',
            ]
        );



        DB::beginTransaction();
        try {

            $customer = Customer::findOrFail($request->customer_id);

            $imageName = Str::random(32) . "." . $request->file->getClientOriginalExtension();

            $customer = Attachment::create([
                'customer_id' => $request->customer_id,
                'user_id'    => auth()->user()->id,
                'title'     => $request->title,
                'attachment'         => 'https://sadaqa-co.com/storage/app/public/attachments/' . $imageName,
            ]);

            Storage::disk('public')->put('attachments/' . $imageName, file_get_contents($request->file));


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.show',['customer' => $request->customer_id])->with('success','تم اضافة المرفق للعميل');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return Application|Factory|View
     */
    public function show(Attachment $attachment)
    {
        return view('customers.attachment-show',['attachment' => $attachment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attachment $attachment): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        try {

            // Public storage
            $storage = Storage::disk('public');

            // Iamge delete
            if ($storage->exists('attachments/' . $attachment->attachment))
                $storage->delete('attachments/' . $attachment->attachment);


            // Delete attachment
            Attachment::whereId($attachment->id)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'تم حذف المرفق بنجاح!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }    }
}
