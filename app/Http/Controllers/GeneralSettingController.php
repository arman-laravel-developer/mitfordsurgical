<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\HomeCategory;
use App\Models\SiteSeo;
use Illuminate\Http\Request;
use ZipArchive;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $generalSetting = GeneralSetting::with('siteSeo')->latest()->first();
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        return view('admin.setting.index', compact('generalSetting', 'categories'));
    }
    public function header()
    {
        $generalSetting = GeneralSetting::with('siteSeo')->latest()->first();
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        return view('admin.setting.header', compact('generalSetting', 'categories'));
    }
    public function footer()
    {
        $generalSetting = GeneralSetting::with('siteSeo')->latest()->first();
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        return view('admin.setting.footer', compact('generalSetting', 'categories'));
    }

    public function getSiteSeoImageUrl($request)
    {
        $slug = $request->meta_title;
        $SiteSeoImage = $request->file('site_seo_image');
        $SiteSeoImageName = $slug.'-'.time().'.'.$SiteSeoImage->getClientOriginalExtension();
        $directory = 'site-seo-images/';
        $SiteSeoImage->move($directory, $SiteSeoImageName);
        $SiteSeoImageUrl = $directory.$SiteSeoImageName;
        return $SiteSeoImageUrl;
    }
    public function getHeaderLogoUrl($request)
    {
        $headerLogo = $request->file('header_logo');
        $headerLogoName = 'header-logo'.'-'.time().'.'.$headerLogo->getClientOriginalExtension();
        $directory = 'header-logo/';
        $headerLogo->move($directory, $headerLogoName);
        $headerLogoUrl = $directory.$headerLogoName;
        return $headerLogoUrl;
    }
    public function getFooterLogoUrl($request)
    {
        $footerLogo = $request->file('footer_logo');
        $footerLogoName = 'footer-logo'.'-'.time().'.'.$footerLogo->getClientOriginalExtension();
        $directory = 'footer-logo/';
        $footerLogo->move($directory, $footerLogoName);
        $footerLogoUrl = $directory.$footerLogoName;
        return $footerLogoUrl;
    }
    public function getPaymentMethodUrl($request)
    {
        $payment = $request->file('payment_method_image');
        $paymentName = 'payment-logo'.'-'.time().'.'.$payment->getClientOriginalExtension();
        $directory = 'payment-method-images/';
        $payment->move($directory, $paymentName);
        $paymentUrl = $directory.$paymentName;
        return $paymentUrl;
    }
    public function getFaviconUrl($request)
    {
        $favicon = $request->file('favicon');
        $faviconName = 'favicon.ico';
        $directory = 'favicon/';
        $favicon->move($directory, $faviconName);
        $faviconUrl = $directory.$faviconName;
        return $faviconUrl;
    }

    public function update(Request $request)
    {
        $generalSetting = GeneralSetting::latest()->first();

        if ($generalSetting) {
            $request->validate([
                'favicon' => 'mimes:ico',
            ], [
                'favicon.mimes' => 'The favicon must be a file of type: .ico.',
            ]);

            // Update only the fields that are provided
            if ($request->has('site_name')) {
                $generalSetting->site_name = $request->site_name;
            }
            if ($request->has('mobile')) {
                $generalSetting->mobile = $request->mobile;
            }
            if ($request->has('email')) {
                $generalSetting->email = $request->email;
            }
            if ($request->has('address')) {
                $generalSetting->address = $request->address;
            }
            if ($request->has('about_us_short')) {
                $generalSetting->about_us_short = $request->about_us_short;
            }
            if ($request->has('facebook_url')) {
                $generalSetting->facebook_url = $request->facebook_url;
            }
            if ($request->has('instagram_url')) {
                $generalSetting->instagram_url = $request->instagram_url;
            }
            if ($request->has('youtube_url')) {
                $generalSetting->youtube_url = $request->youtube_url;
            }
            if ($request->has('twitter_url')) {
                $generalSetting->twitter_url = $request->twitter_url;
            }
            if ($request->has('pinterest_url')) {
                $generalSetting->pinterest_url = $request->pinterest_url;
            }
            if ($request->has('linkedin_url')) {
                $generalSetting->linkedin_url = $request->linkedin_url;
            }

            // Update logos and files only if they are provided
            if ($request->file('header_logo')) {
                if (file_exists($generalSetting->header_logo)) {
                    unlink($generalSetting->header_logo);
                }
                $generalSetting->header_logo = $this->getHeaderLogoUrl($request);
            }
            if ($request->file('footer_logo')) {
                if (file_exists($generalSetting->footer_logo)) {
                    unlink($generalSetting->footer_logo);
                }
                $generalSetting->footer_logo = $this->getFooterLogoUrl($request);
            }
            if ($request->file('favicon')) {
                if (file_exists($generalSetting->favicon)) {
                    unlink($generalSetting->favicon);
                }
                $generalSetting->favicon = $this->getFaviconUrl($request);
            }
            if ($request->file('payment_method_image')) {
                if (file_exists($generalSetting->payment_method_image)) {
                    unlink($generalSetting->payment_method_image);
                }
                $generalSetting->payment_method_image = $this->getPaymentMethodUrl($request);
            }

            // Save changes to the generalSetting
            $generalSetting->save();
        } else {
            // Create a new GeneralSetting if it doesn't exist
            $request->validate([
                'favicon' => 'mimes:ico',
            ], [
                'favicon.mimes' => 'The favicon must be a file of type: .ico.',
            ]);

            $generalSetting = new GeneralSetting();

            if ($request->has('site_name')) {
                $generalSetting->site_name = $request->site_name;
            }
            if ($request->has('mobile')) {
                $generalSetting->mobile = $request->mobile;
            }
            if ($request->has('email')) {
                $generalSetting->email = $request->email;
            }
            if ($request->has('address')) {
                $generalSetting->address = $request->address;
            }
            if ($request->has('about_us_short')) {
                $generalSetting->about_us_short = $request->about_us_short;
            }
            if ($request->has('facebook_url')) {
                $generalSetting->facebook_url = $request->facebook_url;
            }
            if ($request->has('instagram_url')) {
                $generalSetting->instagram_url = $request->instagram_url;
            }
            if ($request->has('youtube_url')) {
                $generalSetting->youtube_url = $request->youtube_url;
            }
            if ($request->has('twitter_url')) {
                $generalSetting->twitter_url = $request->twitter_url;
            }
            if ($request->has('pinterest_url')) {
                $generalSetting->pinterest_url = $request->pinterest_url;
            }
            if ($request->has('linkedin_url')) {
                $generalSetting->linkedin_url = $request->linkedin_url;
            }

            if ($request->file('header_logo')) {
                $generalSetting->header_logo = $this->getHeaderLogoUrl($request);
            }
            if ($request->file('footer_logo')) {
                $generalSetting->footer_logo = $this->getFooterLogoUrl($request);
            }
            if ($request->file('favicon')) {
                $generalSetting->favicon = $this->getFaviconUrl($request);
            }
            if ($request->file('payment_method_image')) {
                $generalSetting->payment_method_image = $this->getPaymentMethodUrl($request);
            }

            // Save the newly created setting
            $generalSetting->save();
        }

        return redirect()->back()->with('success', 'General Setting Update Successful');
    }

    public function backup()
    {
        // Database configuration
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database_name = env('DB_DATABASE');

        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");

        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQL script for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";

            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQL script for dumping data for each table
            for ($i = 0; $i < $columnCount; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if (!empty($sqlScript)) {
            // Define the directory path within the public folder
            $backupDir = 'backups';
            if (!file_exists($backupDir)) {
                mkdir($backupDir, 0777, true);
            }

            // Define the backup file name
            $backupFileName = $backupDir . '/' . $database_name . '_backup_' . time() . '.sql';

            // Save the SQL script to the backup file
            file_put_contents($backupFileName, $sqlScript);

            // Create a zip file of the backup
            $zipFileName = $backupDir . '/' . $database_name . '_backup_' . time() . '.zip';
            $zip = new ZipArchive();
            if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->addFile($backupFileName, basename($backupFileName));
                $zip->close();

                // Optionally delete the .sql file after zipping
                unlink($backupFileName);
            }

            // Return the URL of the zip file
            return redirect('backups/' . basename($zipFileName));
        }

        return response()->json(['error' => 'No backup generated'], 500);
    }

    public function smtp()
    {
        return view('admin.setting.smtp');
    }

    public function payment()
    {
        return view('admin.setting.payment');
    }

    public function smtpUpdate(Request $request)
    {
        $this->validate($request, [
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|integer',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
            'MAIL_FROM_ADDRESS' => 'required|string|email',
            'MAIL_FROM_NAME' => 'required|string',
        ]);

        $data = [
            'MAIL_MAILER' => $request->input('MAIL_MAILER'),
            'MAIL_HOST' => $request->input('MAIL_HOST'),
            'MAIL_PORT' => $request->input('MAIL_PORT'),
            'MAIL_USERNAME' => $request->input('MAIL_USERNAME'),
            'MAIL_PASSWORD' => $request->input('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => $request->input('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => $request->input('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => $request->input('MAIL_FROM_NAME'),
        ];

        updateEnv($data);

        return redirect()->back()->with('success', 'SMTP settings updated successfully!');
    }
    public function paymentUpdate(Request $request)
    {
        $this->validate($request, [
            'BKASH_APP_KEY' => 'required|string',
            'BKASH_APP_SECRET' => 'required|string',
            'BKASH_USERNAME' => 'required',
            'BKASH_PASSWORD' => 'required|string',
        ]);

        $data = [
            'BKASH_APP_KEY' => $request->input('BKASH_APP_KEY'),
            'BKASH_APP_SECRET' => $request->input('BKASH_APP_SECRET'),
            'BKASH_USERNAME' => $request->input('BKASH_USERNAME'),
            'BKASH_PASSWORD' => $request->input('BKASH_PASSWORD'),
        ];

        $setting = GeneralSetting::find($request->setting_id);
        if ($request->sandbox_mode)
        {
            $setting->sandbox_mode = $request->sandbox_mode;
        }
        else
        {
            $setting->sandbox_mode = 2;
        }
        $setting->save();
        updateEnv($data);

        return redirect()->back()->with('success', 'Payment Method settings updated successfully!');
    }

    public function updateSiteSeo(Request $request)
    {
        $siteSeo = SiteSeo::first();
        if (empty($siteSeo))
        {
            $siteSeo = new SiteSeo();
            $siteSeo->general_setting_id = $request->general_setting_id;
            $siteSeo->meta_title = $request->meta_title;
            $siteSeo->meta_description = $request->meta_description;
            $siteSeo->keywords = $request->tags;
            if ($request->file('site_seo_image')) {
                $siteSeo->meta_image = $this->getSiteSeoImageUrl($request);
            }
            $siteSeo->save();

            return redirect()->back()->with('success', 'Site Seo Save Successfully');
        }
        else
        {
            $siteSeo->general_setting_id = $request->general_setting_id;
            $siteSeo->meta_title = $request->meta_title;
            $siteSeo->meta_description = $request->meta_description;
            $siteSeo->keywords = $request->tags;
            if ($request->file('site_seo_image'))
            {
                if (file_exists($siteSeo->image))
                {
                    unlink($siteSeo->image);
                }
                $siteSeoImageUrl = $this->getSiteSeoImageUrl($request);
            }
            else
            {
                $siteSeoImageUrl = $siteSeo->image;
            }
            $siteSeo->meta_image = $siteSeoImageUrl;
            $siteSeo->save();

            return redirect()->back()->with('success', 'Site Seo Update Successfully');
        }
    }
}
