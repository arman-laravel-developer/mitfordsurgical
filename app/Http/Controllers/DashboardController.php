<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Session;
use function Nette\Utils\match;
use function Ramsey\Collection\offer;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrder =Order::where('order_status', 'pending')->count();
        $cancelOrder =Order::where('order_status', 'cancel')->count();
        $shippedOrder =Order::where('order_status', 'shipped')->count();
        $deliveredOrder =Order::where('order_status', 'delivered')->count();
        $returnedOrder =Order::where('order_status', 'returned')->count();
        $proccessingOrder =Order::where('order_status', 'proccessing')->count();
        $allOrder =Order::count();
        $newOrders = Order::where('order_status', 'pending')->latest()->limit(10)->get();
        $totalSeller = Seller::count();
        $totalCustomer = Customer::count();
        return view('admin.home.index', compact(
            'pendingOrder',
            'cancelOrder',
            'shippedOrder',
            'deliveredOrder',
            'newOrders',
            'returnedOrder',
            'allOrder',
            'proccessingOrder',
            'totalCustomer',
            'totalSeller'
        ));
    }

    public function getCreditData(Request $request)
    {
        Carbon::setLocale('en');
        $timezone = 'Asia/Dhaka';

        $paymentMethods = ['bkash(01709925764)', 'nagad(01709925764)', 'bank', 'cod'];

        $totals = [];

        $startDate = match ($request->period) {
        'yesterday' => Carbon::yesterday($timezone)->startOfDay(),
        'last_week' => Carbon::now($timezone)->subDays(7)->startOfDay(),
        'last_month' => Carbon::now($timezone)->subDays(30)->startOfDay(),
        default => Carbon::today($timezone)->startOfDay(),
        };

        $endDate = match ($request->period) {
        'yesterday' => Carbon::yesterday($timezone)->endOfDay(),
            default => Carbon::now($timezone)->endOfDay(),
        };

        foreach ($paymentMethods as $method) {
            $methodName = preg_replace('/\(.*/', '', $method);

            $totals[$method] = Order::where('order_status', 'delivered')
                ->where('payment_method', $methodName)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->reduce(function ($carry, $order) {
                    return $carry + ($order->grand_total + $order->shipping_cost - $order->coupon_discount);
                }, 0);
        }

        return response()->json($totals);
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
