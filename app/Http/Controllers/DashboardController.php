<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Session;
use function Ramsey\Collection\offer;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home.index');
    }

    public function testMail(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            $data['email'] = $request->email;

            Mail::send('emails.test-mail', ['data' => $data], function ($message) use ($data){
                $message->to($data['email'])->subject('test mail');
            });
        }

        flash()->success('Test Mail', 'Test mail send successfull');
        return redirect()->back();
    }

    public function customer()
    {
        $customers = Customer::latest()->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function customerLogin(Request $request,$id)
    {
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        $customer = Customer::find($id);

        Session::put('customer_id', $customer->id);
        Session::put('customer_name', $customer->name);

        return redirect()->route('customer.dashboard')->with('success', 'You are logged in as a customer');
    }

    public function customerDelete($id)
    {
        $customer = Customer::find($id);
        if (file_exists($customer->profile_img))
        {
            unlink($customer->profile_img);
        }
        foreach ($customer->orders as $customerOrder)
        {
            foreach ($customerOrder->orderDetails as $orderDetail)
            {
                $orderDetail->delete();
            }
            $customerOrder->delete();
        }
        $customer->delete();

        return redirect()->back()->with('success', 'Customer Delete successfully');
    }

    public function contactFormShow()
    {
        $contactForms = ContactForm::latest()->paginate(20);
        return view('admin.contact-form.index', compact('contactForms'));
    }

    public function contactFormDetail($id)
    {
        $contactFormDetail = ContactForm::find($id);
        if ($contactFormDetail->read_status == 2)
        {
            $contactFormDetail->read_status = 1;
            $contactFormDetail->save();
        }
        return view('admin.contact-form.detail', compact('contactFormDetail'));
    }

    public function contactFormReplay(Request $request, $id)
    {
        $contactFormDetail = ContactForm::find($id);
        if ($contactFormDetail->replay_status == 2)
        {
            $contactFormDetail->replay_status = 1;
            $contactFormDetail->replay = $request->replay;
            $contactFormDetail->save();
            if (env('MAIL_USERNAME') != null) {
                $data['email'] = $request->toEmail;
                $data['replay'] = $request->replay;
                $data['subject'] = $request->subject;

                Mail::send('emails.replay-mail', ['data' => $data], function ($message) use ($data){
                    $message->to($data['email'])->subject($data['subject']);
                });
                flash()->success('Contact form replay', 'Contact form replay send successfull');
            }
        }
        flash()->success('Contact form replay', 'Contact form replay save successfull');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        // Delete the selected property queries
        ContactForm::whereIn('id', $request->contact_form_ids)->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Selected queries deleted successfully!');
    }

    public function loginAsSeller(Request $request, $id)
    {
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        $seller = Seller::find($id);
        if ($seller)
        {
            Session::put('seller_id', $seller->id);
            Session::put('seller_name', $seller->name);
        }
        return redirect()->route('seller.dashboard')->with('success', 'You are login as a seller');
    }


}
