<?php 

use Carbon\Carbon;
use App\Models\User;
use App\Lib\FileManager;
use App\Models\RatingModel;
use Illuminate\Support\Str;
use App\Models\ProductModel;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

function dateFormat($dateString){
    $timestamp = strtotime($dateString);
    $formattedDate = date('d F Y', $timestamp);
    return $formattedDate;
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null)
{
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager()
{
    return new FileManager();
}

function getFilePath($key)
{
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getFileExt($key)
{
    return fileManager()->$key()->extensions;
}

function gs(){
    $setting = ApplicationSetting::latest()->first();
    return $setting;
}

function sendEmail($to, $subject, $view, $data = []) {
    Mail::send($view, $data, function ($message) use ($to, $subject) {
        $message->to($to)
            ->subject($subject);
    });
}


function getPaginate($paginate = 20)
{
    return $paginate;
}


function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function strLimit($title = null, $length = 10)
{
    return Str::limit($title, $length);
}

function diffForHumans($date)
{
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}


function getRatings($productId){
    $ratings = RatingModel::where('product_id', $productId)->get();
    $averageRating = $ratings->avg('review_count');
    return $averageRating;
}

function getOrderbyProduct($productId) {
    
    if(!Auth::check()){
        return false;
    }
    $user = User::find(auth()->user()->id);
    $orders = $user->orders()->get();

    $productsArray = [];
    foreach ($orders as $order) {
        $productsArray = json_decode($order->product_arr);
    }

    $result = findProductIdInArray($productId, $productsArray);
    return $result;
}

function findProductIdInArray($productId, $productsArray) {
    foreach ($productsArray as $product) {
        if ($product->product_id == $productId) {
            return true;
        }
    }

    return false;
}