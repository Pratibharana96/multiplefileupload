<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\User;
use DataTables;
use Auth;
use File;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function vendorlist()
    {
        $vendor=Vendor::all();
        return view('admin.vendorview.view',compact('vendor'));
    }
    public function vendorlistview(Request $request)
    {
     
    if($request->ajax())
    {
         
      // $car = Car_Model::find(1)->Brand;  // For single company
     
       //dd($cars);exit;
        $data = Vendor::with('User')->latest()->get();
         //dd($data);exit;
        
         $username = Auth::user()->name;
         $userid=Auth::user()->id;
         return DataTables::of($data)
        //  ->editColumn('vendorpicture', function ($highlights) use ($destinationPath) {
        //     if (!empty($highlights->attachment)) {
        //         return '<a target="_blank" href="' . $destinationPath . '/' . $highlights->attachment . '" >' . $highlights->attachment . '</a>';
        //     } else {
        //         return '';
        //     }
        // })

        //  ->editColumn('vendorpicture',function($data){
        //     $username = Auth::user()->name;
        //     $unseriliaze_imageArray = unserialize($data->vendorpicture);
        //     foreach($unseriliaze_imageArray as $image)
        //     {
        //     if ($photo = $image->vendorpicture) {
        //     $url= asset('storage/app/public/documents/'.'client_id-'.$username.$data->vendorpicture);
          
        //     return sprintf( 
        //          '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'  
        //             );
        //         }

        //         return '';
        //     }
        //     })
        ->addColumn('action', function($data){
            $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">View</button>';
           
            return $button;
        })
        ->rawColumns(['vendorpicture','action'])
        ->toJson();

    }
   
    }

       //edit car data
       public function vendorviewimg(Request $request)
       {
           $imageview = $request->id;
           if(request()->ajax())
           {
               $data = Vendor::findOrFail($imageview);
               $unseriliaze_imageArray = unserialize($data->vendorpicture);
               $unseriliaze_imageArray1 = unserialize($data->vendorgst);
               $unserialize_imageArray2 = unserialize($data->ownerpersonaldoc);
               $unserialize_imageArray3 = unserialize($data->cinphoto);
               $unserialize_imageArray4 = unserialize($data->panimage);
               $unserialize_imageArray5 = unserialize($data->gstupload);
               $unserialize_imageArray6 = unserialize($data->companydoc);
               $unserialize_imageArray7 = unserialize($data->otherdoc);
               $unserialize_imageArray8 = unserialize($data->doc_uploaded);
               return response()->json(['data' => $data,'vendorImgArr'=>$unseriliaze_imageArray,
                                         'vendorgst'=>$unseriliaze_imageArray1,'ownerpersonaldoc'=>$unserialize_imageArray2,
                                          'cinphoto'=>$unserialize_imageArray3,'panimage'=>$unserialize_imageArray4 ,
                                          'gstupload'=>$unserialize_imageArray5 ,'companydoc'=>$unserialize_imageArray6,
                                          'otherdoc'=>$unserialize_imageArray7 ,'doc_uploaded'=>$unserialize_imageArray8]);
           }
       }
}
