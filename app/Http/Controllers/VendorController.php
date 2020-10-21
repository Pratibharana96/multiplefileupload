<?php

namespace App\Http\Controllers;
use File;
use App\Vendor;
use App\vendorpicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use DB;

class VendorController extends Controller
{
    public function show()
    {
 //  echo"hi";exit;
        return view('vendor.documentadd');
    }
    public function store(Request $request)
    {

        if($request->File('ownerpersonaldoc')){
            // return $request->filename;exit;
          $image3 = $request->file('ownerpersonaldoc');
         // return $request->image1;exit;
          $fourRandom = hexdec(uniqid());
          $fourRandomDigit =$fourRandom; 
          $username = Auth::user()->name;
          $userid=Auth::user()->id;
          foreach ($image3 as $key => $i)
          {
             // $filename1 =  Auth::user()->id.'_'.$key.'.'.$i->getClientOriginalExtension();
              $filename3 =  $request->ownername.'_'.$i->getClientOriginalName();
     
              $i->move(storage_path('app/public/documents/'.'client_id-'.$username), $filename3);

              $images3[] = $filename3; 
           } 
           vendor::updateOrCreate( ['id' =>$userid],
           ['ownerpersonaldoc'=>serialize($images3) ]);
              
           return response()
          ->json(["message" => "Media added successfully.", "images" => $images3]);   
      }
      
        if($request->File('vendorgst')){
            // return $request->filename;exit;
           $image1 = $request->file('vendorgst');
           //return $request->image1;
           $fourRandom = hexdec(uniqid());
           $fourRandomDigit =$fourRandom; 
           $username = Auth::user()->name;
           $userid=Auth::user()->id;
           foreach ($image1 as $key => $i)
           { 
               $filename1 =  $request->ownername.'_'.$i->getClientOriginalName();
               $i->move(storage_path('app/public/documents/'.'client_id-'.$username), $filename1);
               $images1[] = $filename1; 
            } 
            vendor::updateOrCreate( ['id' =>$userid],
            ['vendorgst'=>serialize($images1) ]);
               
            return response()
           ->json(["message" => "Media added successfully.", "images" => $images1]);
         }



           if($request->File('filename')){
              // return $request->filename;exit;
            $image2 = $request->file('filename');
           // return $request->image1;exit;
            $fourRandom = hexdec(uniqid());
            $fourRandomDigit =$fourRandom; 
            $username = Auth::user()->name;
            $userid=Auth::user()->id;
            foreach ($image2 as $key => $i)
            {
               // $filename1 =  Auth::user()->id.'_'.$key.'.'.$i->getClientOriginalExtension();
                $filename2 =  $request->ownername.'_'.$i->getClientOriginalName();
       
                $i->move(storage_path('app/public/documents/'.'client_id-'.$username), $filename2);

                $images2[] = $filename2; 
             } 
             vendor::updateOrCreate( ['id' =>$userid],
             ['vendorpicture'=>serialize($images2) ]);
                
             return response()
            ->json(["message" => "Media added successfully.", "images" => $images2]);   
        }
        
       
        return view('admin.vendor.vendor')->with('success', 'Data Added successfully.');
        
    }


    public function vendordata (Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'company_name' => 'required',
          
        // ]);
        // if ($validator->passes()) {
            // $user=Vendor::create($request->all());

            //$data = $request->all();
           // return $data;
           // $check = Vendor::insert($data);
       $fourRandom = hexdec(uniqid());
       $fourRandomDigit =$fourRandom; 
       $username = Auth::user()->name;
       $userid=Auth::user()->id;
     //return($userid);
       Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'user_id'=>$userid,
            'company_name'=>$request->company_name,
            'company_cin'=>$request->company_cin,
            'pan_no'=>$request->pan_no,
            'ownername'=>$request->ownername,
            'gstno'=>$request->gstno]);
    // }
 }
    /////upload image ********************* ////// 
    public function vendorpicture (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
          
        ]);
        if ($validator->passes()) {
       $fourRandom = hexdec(uniqid());
       $fourRandomDigit =$fourRandom; 
       $username = Auth::user()->name;
       $userid=Auth::user()->id;
    //    return($userid);
       Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'user_id'=>$userid,
            'company_name'=>$request->company_name,
            'company_cin'=>$request->company_cin,
            'pan_no'=>$request->pan_no,
            'ownername'=>$request->ownername,
            'gstno'=>$request->gstno]);
    // return(Auth::user()->id ); 
    //    $Vendor = Vendor::findOrFail(Auth::user()->id);    
    //    $Vendor->company_name = request()->input('company_name');
    //    $Vendor->company_cin = request()->input('company_cin');
    //    $Vendor->pan_no = request()->input('pan_no');
    //    $Vendor->ownername = request()->input('ownername');
    //    $Vendor->gstno = request()->input('gstno');
    //    $Vendor->save();
      // return($Vendor); 
       //saving for vendorgst   
       if($request->ownerpersonaldoc > 0)
       {   
          
        for ($x = 0; $x < $request->ownerpersonaldoc; $x++) {   
           
         if ($request->hasFile('ownerpersonaldocimages'.$x)) {   
               
         $file2      = $request->file('ownerpersonaldocimages'.$x);
         $filename2  = $request->ownername.'_'.$file2->getClientOriginalName();
         $extension2 = $file2->getClientOriginalExtension();
        
         $ownerpersonaldoc   = date('His').'-'.$filename2;
         $file2->move(storage_path('app/public/documents/'.'client_id-'.$username), $ownerpersonaldoc);
         $ownerpersonaldocs[] = $ownerpersonaldoc ;
          }
       }
       Vendor::updateOrCreate(
         ['id' =>$userid],
         [     
             'ownerpersonaldoc'=>serialize($ownerpersonaldocs)
 
         ]);
         }
         
       if($request->TotalImages > 0)
       {
          for ($x = 0; $x < $request->TotalImages; $x++) {     
          if ($request->hasFile('images'.$x)) {
           
          $file      = $request->file('images'.$x);
          $filename  = $request->ownername.'_'.$file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
       
          $picture   = date('His').'-'.$filename;
          $file->move(storage_path('app/public/documents/'.'client_id-'.$username), $picture);
          $pictures[] = $picture ;
            }
        }
          Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'vendorpicture'=>serialize($pictures)
    
            ]);
            }
    
        //saving for vendorgst   
        if($request->vendorgst > 0)
        {
            
           for ($x = 0; $x < $request->vendorgst; $x++) {     
           if ($request->hasFile('vendorgstimages'.$x)) {                 
           $file1      = $request->file('vendorgstimages'.$x);
           $filename1  = $file1->getClientOriginalName();
           $extension1 = $file1->getClientOriginalExtension();
        
           $vendorgst   = date('His').'-'.$filename1;
           $file1->move(storage_path('app/public/documents/'.'client_id-'.$username), $vendorgst);
           $vendorgsts[] = $vendorgst ;
            }
         }
         Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'vendorgst'=>serialize($vendorgsts)
    
            ]);
          }
       
     

        if($request->cinphoto > 0)
        { 
      //upload img for cinphoto
       for ($x = 0; $x < $request->cinphoto; $x++) {     
        if ($request->hasFile('cinphotoimages'.$x)) {           
        $file3      = $request->file('cinphotoimages'.$x);
        $filename3  = $request->ownername.'_'.$file3->getClientOriginalName();
        $extension3 = $file3->getClientOriginalExtension();
     
        $cinphoto   = date('His').'-'.$filename3;
        $file3->move(storage_path('app/public/documents/'.'client_id-'.$username), $cinphoto);
        $cinphotos[] = $cinphoto ;
         }
      }
      Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'cinphoto'=>serialize($cinphotos)

        ]);
        }
        
      //upload for panimage
      if($request->panimage > 0)
      { 
       // return ($request->panimage);
        for ($x = 0; $x < $request->panimage; $x++) {     
        if ($request->hasFile('panimageimages'.$x)) {           
        $file4      = $request->file('panimageimages'.$x);
        $filename4  = $request->ownername.'_'.$file4->getClientOriginalName();
        $extension4 = $file4->getClientOriginalExtension();
      // echo "hi" ;exit;
        $panimage   = date('His').'-'.$filename4;
        $file4->move(storage_path('app/public/documents/'.'client_id-'.$username), $panimage);
        $panimages[] = $panimage ;
         }
      }
      Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'panimage'=>serialize($panimages)

        ]);
        }
       
        if($request->gstupload > 0)
        { 
        //upload for gstupload
        for ($x = 0; $x < $request->gstupload; $x++) {     
            if ($request->hasFile('gstuploadimages'.$x)) {           
            $file5      = $request->file('gstuploadimages'.$x);
            $filename5  = $request->ownername.'_'.$file5->getClientOriginalName();
            $extension5 = $file5->getClientOriginalExtension();
        
            $gstupload   = date('His').'-'.$filename5;
            $file5->move(storage_path('app/public/documents/'.'client_id-'.$username), $gstupload);
            $gstuploads[] = $gstupload ;
            }
        }
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'gstupload'=>serialize($gstuploads)
    
            ]);
            }
           
            if($request->companydoc > 0)
            { 
        //upload for companydoc
        for ($x = 0; $x < $request->companydoc; $x++) {     
            if ($request->hasFile('companydocimages'.$x)) {           
            $file6      = $request->file('companydocimages'.$x);
            $filename6  = $request->ownername.'_'.$file6->getClientOriginalName();
            $extension6 = $file6->getClientOriginalExtension();
        
            $companydoc   = date('His').'-'.$filename6;
            $file6->move(storage_path('app/public/documents/'.'client_id-'.$username), $companydoc);
            $companydocs[] = $companydoc ;
            }
        }
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'companydoc'=>serialize($companydocs)
    
            ]);
            }
         
        if($request->otherdoc > 0)
        { 
          //otherdoc
          for ($x = 0; $x < $request->otherdoc; $x++) {     
            if ($request->hasFile('otherdocimages'.$x)) {           
            $file7      = $request->file('otherdocimages'.$x);
            $filename7  = $request->ownername.'_'.$file7->getClientOriginalName();
            $extension7 = $file7->getClientOriginalExtension();
        
            $otherdoc   = date('His').'-'.$filename7;
            $file7->move(storage_path('app/public/documents/'.'client_id-'.$username), $otherdoc);
            $otherdocs[] = $otherdoc ;
            }
        } 
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'otherdoc'=>serialize($otherdocs)
    
            ]);
            }
            

        // $userid = Auth::id();
        // $flight = vendor::updateOrCreate(
        //                ['id' =>  $userid],
        //                ['vendorpicture'=>serialize($pictures),
        //                 'vendorgst'=>serialize($vendorgsts),
        //                 'ownerpersonaldoc'=>serialize($ownerpersonaldocs),
        //                 'cinphoto'=>serialize($cinphotos),
        //                 'panimage'=>serialize($panimages),
        //                 'gstupload'=>serialize($gstuploads),
        //                 'companydoc'=>serialize($companydocs),
        //                 'otherdoc'=>serialize($otherdocs),
        //                 'company_name'=>$request->company_name,
        //                 'company_cin'=>$request->company_cin,
        //                 'pan_no'=>$request->pan_no,
        //                 'ownername'=>$request->ownername,
        //                 'gstno'=>$request->gstno]
        //             );
     
		return response()->json(['success'=>'Added new records.']);
       }

    	return response()->json(['error'=>$validator->errors()->all()]);




        // if($request->hasFile('TotalImages ')){
        //     $image1 = $request->file('images');  
        //     $fourRandom = hexdec(uniqid());
        //     $fourRandomDigit =$fourRandom; 
        //     foreach ($image1 as $key => $i)
        //     {
        //        // $filename1 =  Auth::user()->id.'_'.$key.'.'.$i->getClientOriginalExtension();
        //         $filename1 =  897 .'_'.$key.'.'.$i->getClientOriginalExtension();
       
        //         $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit), $filename1);

        //         $images1[] = $filename1; 
        //      } 
        //      vendor::create(['vendorpicture'=>serialize($images1),'company_name'=>$request->company_name]);
        //     return response()
        //     ->json(["message" => "Media added successfully.", "images" => $images1]);
 
         
        }
       
    
}
