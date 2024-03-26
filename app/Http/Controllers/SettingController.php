<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $general = gs();
        return view('admin.setting.index', compact('general'));
    }
    
    public function seoSetting()
    {
        $general = gs();
        return view('admin.setting.seo', compact('general'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function emailSetting()
    {
        $general = gs();
        return view('admin.setting.email_seeting', compact('general'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function emailSettingUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $general = gs();
            $general->mail_host = $request->mail_host;
            $general->mail_port = $request->mail_port;
            $general->mail_username = $request->mail_username;
            $general->mail_password = $request->mail_password;
            $general->mail_from_name = $request->mail_from_name;
            $general->mail_from_address = $request->mail_from_address;
            $general->mail_status = $request->mail_status;
            $general->mail_encryption = $request->mail_encryption;
            $general->save();

            $this->setEnv('MAIL_HOST', $request->mail_host);
            $this->setEnv('MAIL_PORT', $request->mail_port);
            $this->setEnv('MAIL_USERNAME', $request->mail_username);
            $this->setEnv('MAIL_PASSWORD', $request->mail_password);
            $this->setEnv('MAIL_FROM_ADDRESS', $request->mail_from_address);
            $this->setEnv('MAIL_FROM_NAME', $request->mail_from_name);
            $this->setEnv('MAIL_ENCRYPTION', $request->mail_encryption);

            \Artisan::call('config:clear');
            
            DB::commit();
            return redirect()->route('setting')->with('success','Setting saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('setting')->with('error','Something went wrong');
        }
        
    }

    private function setEnv($key, $value)
    {
        $envFilePath = app()->environmentFilePath();
        $envContents = File::get($envFilePath);
        $newEnvContents = preg_replace(
            "/^$key=.*/m",
            "$key=$value",
            $envContents
        );
    
        File::put($envFilePath, $newEnvContents);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function emailTesting()
    {
        try {
            Mail::to(gs()->business_email)->send(new TestEmail());
            return redirect()->route('setting')->with('success', 'Email send successfully');
        } catch (\Exception $e) {
            return redirect()->route('setting')->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required',
            'business_address' => 'required',
            'business_number' => 'required',
            'business_email' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
            'favicon' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $general = gs();
            if ($request->hasFile('logo')) {
                $old = $general->logo;
                $logo = fileUploader($request->logo, getFilePath('logo'), getFileSize('logo'), $old);
                $general->logo = $logo;
            }

            if ($request->hasFile('favicon')) {
                $old = $general->favicon;
                $favicon = fileUploader($request->favicon, getFilePath('fav_icon'), getFileSize('fav_icon'), $old);
                $general->favicon = $favicon;
            }

            if($request->stripe_key && $request->stripe_secret){
                $this->setEnv('STRIPE_KEY', $request->stripe_key);
                $this->setEnv('STRIPE_SECRET', $request->stripe_secret);
                Artisan::call('config:clear');
                $general->stripe_payment = $request->stripe_payment;
                $general->stripe_key = $request->stripe_key;
                $general->stripe_secret = $request->stripe_secret;
            }


            $general->business_name         = $request->business_name;
            $general->business_address      = $request->business_address;
            $general->business_number       = $request->business_number;
            $general->business_email        = $request->business_email;
            $general->save();
            
            DB::commit();
            return redirect()->route('setting')->with('success','Data updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('setting')->with('error',$e->getMessage());
        }
    }
    
    public function updateSeoSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }

        DB::beginTransaction();
        try {
            $general = gs();
            if ($request->hasFile('meta_image')) {
                $old = $general->meta_image;
                $logo = fileUploader($request->meta_image, getFilePath('meta_image'), getFileSize('meta_image'), $old);
                $general->meta_image = $logo;
            }

            $general->meta_title         = $request->meta_title;
            $general->meta_description      = $request->meta_description;
            $general->save();
            DB::commit();
            return redirect()->route('setting')->with('success','Data updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('setting')->with('error',$e->getMessage());
        }
    }


    public function cachClear(){
        Artisan::call('cache:clear');
        return redirect()->route('setting')->with('success','Cache Clear Successfully');
    }

    public function tax(){        
        $arr = Tax::find(1);
        return view('admin.setting.tax_setting', compact('arr'));
    }

    public function taxUpdate(Request $request, string $id){     
        
        $tax = Tax::find($id);
        $tax->update([
            'tax' => $request->tax
        ]);
        
        if($tax){            
            return redirect()->route('tax')->with('flash_message', 'Updated');
        }
    }
}
