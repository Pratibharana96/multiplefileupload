@extends('admin.layouts.dashboard')
@section('content')
<style>
.tick1,.tick2,.tick3,.tick4,.tick5,.tick6,.tick7,.tick8{
  display: none;
}
</style>
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="container">
    <div class="row">
    <div class="alert alert-danger print-error-msg" style="display: {{ count($errors) > 0 ? 'block' : 'none' }}">
        <ul>
        @foreach($errors as $error)
          <li>{{$error['error']}}</li> 
        @endforeach
        </ul>
    </div>
    <!-- <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div> -->

        <form  id="post_form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12"><h2>Vendor Document  Detail</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Vendor Name">Company name.</label>
                    <input type="text" id="company_name" name="company_name" class="form-control"  placeholder="Vendor Name" >
                </div>
                <div class="form-group">
                    <label for="Vendor Name">Company CIN.</label>
                    <input type="text" id="company_cin" name="company_cin" class="form-control"  placeholder="Vendor Name" >
                </div>
                <div class="form-group">
                <label for="Vendor Name">Pan No.</label>
                <input type="text" id="pan_no"  name="pan_no" class="form-control"  placeholder="Vendor Name" >
                </div>
                <div class="form-group">
                <label for="Vendor Name">Owner's Name</label>
                <input type="text" id="ownername" name="ownername" class="form-control"  placeholder="Vendor Name" >
                </div>
                <div class="form-group">
                <label for="Vendor Name">GST No.</label>
                <input type="text" id="gstno" name="gstno" class="form-control"  placeholder="Vendor Name" >
                </div>
                <div class="alert alert-success" style="display:none">
                    <p></p>
                </div>
              
                <div class="form-group">
                <label for="Vendor PIcture">Vendor PIcture (only one):</label>
                <br />
                <span id="loadimg"> 
                <img class="tick1" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="vendorpicture" name="vendorpicture[]" multiple />
               
                </div>
                <div class="form-group">
                <label for="Vendor GST">Vendor GST (only one):</label>
                <br />
                <span id="loadimg"> 
                <img class="tick2" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="vendorgst" name="vendorgst[]" multiple />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="Vendor Pan">Owner Personal  Doc. :</label>
                <span id="loadimg"> 
                <img class="tick3" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="ownerpersonaldoc" name="ownerpersonaldoc[]" multiple />
                </div>
                <div class="form-group">
                <label for="Vendor Pan">CIN  Photo :</label>
                <br />
                <span id="loadimg"> 
                <img class="tick4" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="cinphoto" name="cinphoto[]" multiple />
                </div>
                <div class="form-group">
                <label for="Vendor Name">Pan No. Upload file </label>
                <span id="loadimg"> 
                <img class="tick5" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="panimage" name="panimage[]" multiple />
                </div>
                <div class="form-group">
                <label for="Vendor Name">GST Upload file </label>
                <span id="loadimg"> 
                <img class="tick6" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="gstupload" name="gstupload[]" multiple />
                </div>   
                <div class="form-group">
                <label for="Vendor Pan">Company Doc. :</label>
                <span id="loadimg"> 
                <img class="tick7" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="companydoc" name="companydoc[]" multiple />
                </div>
                <div class="form-group">
                <label for="Vendor Pan">Other Doc. :</label>
                <span id="loadimg"> 
                <img class="tick8" src="http://icons.iconarchive.com/icons/icojam/blue-bits/24/symbol-check-icon.png" />
                </span>
                <input type="file" class="form-control" id="otherdoc" name="otherdoc[]" multiple />
                </div>
               
        <br />
        </div>
        <div class="form-group text-center">
        <button type="submit" class="btn btn-primary input-lg">Save</button>
     


           <!-- <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" /> -->
       
        <!-- <button type="button1" class="btn btn-primary">Next</button> -->
           <!-- <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" /> -->
        </div>
        </form>
        
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //validation
    // Full Ajax request
    $('#vendorpicture').on('change',function(ev){
        console.log("here inside");
        var filedata=this.files;
        console.log(filedata);
              // Stops the form from reloading
            ev.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
            });
      $('#mgs_ta').empty();
        //upload
        var formData = new FormData();
        var filname =[];
        for (var i = 0; i < this.files.length; i++) {

        var filname = this.files[i];
        
        formData.append('filename[]', filname, filname.name);
        }
        console.log(filname);
        var url="{{route('vendor.store')}}";
        type: 'POST',
        
        // if (!confirm("are you sure?")) {
        //    }
        swal({
          title: "Are you sure?",
          text: "You want to submit the document!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            // swal({
            //   title: 'Document Saved!',
            //   text: 'Your Document is successfully submitted!',
            //   icon: 'success'
            // }).then(function() {
            //   form.submit();  //submitting multiple images 
            $.ajax({
            async:true,
            type:"post",
            contentType:false,
            url:url,
            data:formData,
            processData:false,
            success:function(data){
            console.log("success");
            document.getElementById("post_form").reset();
                 swal({
              title: 'Document Saved!',
              text: 'Your Document is successfully submitted!',
              icon: 'success'
            })
                // $('#loadimg').hide();
                //     document.getElementById("post-form").reset();
                //     if($.isEmptyObject(data.error)){
                //             alert(data.success);
                //         }else{
                //         printErrorMsg(data.error);
                //     }
            
            }
            });
            //close
            // });
          } else {
            swal("Cancelled", "You Have Cancelled Your Documents :)", "error");
          }
        });
    });
   //code for submitting image vendorgst
     // Full Ajax request
     $('#vendorgst').on('change',function(ev){
        console.log("here inside vendorgst");
        var filedata=this.files;
        //console.log(filedata);
              // Stops the form from reloading
            ev.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
            });
      $('#mgs_ta').empty();
        //upload
        var formData = new FormData();
        var vendorgst =[];
        for (var i = 0; i < this.files.length; i++) {

        var vendorgst = this.files[i];
        
        formData.append('vendorgst[]', vendorgst, vendorgst.name);
        }
        console.log(vendorgst);
        var url="{{route('vendor.store')}}";
        type: 'POST',
        // if (!confirm("are you sure?")) {
        //    }
        swal({
          title: "Are you sure?",
          text: "You want to submit the document!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            $.ajax({
            async:true,
            type:"post",
            contentType:false,
            url:url,
            data:formData,
            processData:false,
            success:function(data){
            console.log("success");
            document.getElementById("post_form").reset();
                 swal({
              title: 'Document Saved!',
              text: 'Your Document is successfully submitted!',
              icon: 'success'
            })
                // $('#loadimg').hide();
                //     document.getElementById("post-form").reset();
                //     if($.isEmptyObject(data.error)){
                //             alert(data.success);
                //         }else{
                //         printErrorMsg(data.error);
                //     }
            
            }
            });
            //close
            // });
          } else {
            swal("Cancelled", "You Have Cancelled Your Documents :)", "error");
          }
        });
    });
    //end of image submission vendorgst
     //code for submitting image ownerpersonaldoc
     // Full Ajax request
     $('#ownerpersonaldoc').on('change',function(ev){
        console.log("here inside ownerpersonaldoc");
        var filedata=this.files;
            ev.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
            });
        $('#mgs_ta').empty();
        //upload
        var formData = new FormData();
        var ownerpersonaldoc =[];
        for (var i = 0; i < this.files.length; i++) {

        var ownerpersonaldoc = this.files[i];
        
        formData.append('ownerpersonaldoc[]', ownerpersonaldoc, ownerpersonaldoc.name);
        }
        console.log(ownerpersonaldoc);
        var url="{{route('vendor.store')}}";
        type: 'POST',
        // if (!confirm("are you sure?")) {
        //    }
        swal({
          title: "Are you sure?",
          text: "You want to submit the document!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            $.ajax({
            async:true,
            type:"post",
            contentType:false,
            url:url,
            data:formData,
            processData:false,
            success:function(data){
            console.log("success");
            document.getElementById("post_form").reset();
                 swal({
              title: 'Document Saved!',
              text: 'Your Document is successfully submitted!',
              icon: 'success'
            })
                // $('#loadimg').hide();
                //     document.getElementById("post-form").reset();
                //     if($.isEmptyObject(data.error)){
                //             alert(data.success);
                //         }else{
                //         printErrorMsg(data.error);
                //     }
            
            }
            });
            //close
            // });
          } else {
            swal("Cancelled", "You Have Cancelled Your Documents :)", "error");
          }
        });
       });
    //end of image submission vendorgst

    //code for another form submission 
         // Full Ajax request
          $("#post_form").on('submit',function(e) {
                e.preventDefault();   
            $.ajax({
                    url: "{{ route('store.vendordata') }}",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                      success: function(data) {
                        $('#loadimg').hide();
                    document.getElementById("post_form").reset();
                    if($.isEmptyObject(data.error)){
                          swal({
                        title: 'Document Saved!',
                        text: 'Your Document is successfully submitted!',
                        icon: 'success'
                          })
                        }else{
                          swal("Cancelled", "Your Document Not submitted! Try again  :)", "error");
                        }
                    }      
                });
          });
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
   

//closing outer 
});

//code for ajax multiple data submit 
//     $( "#vendorpicture").change(function() {
//                 $('.tick1').show();
//                 });
//     $( "#vendorgst").change(function() {
//     $('.tick2').show();
//     });
//     $( "#ownerpersonaldoc").change(function() {
//                 $('.tick3').show();
//                 });
//     $( "#cinphoto").change(function() {
//     $('.tick4').show();
//     });
//     $( "#panimage").change(function() {
//     $('.tick5').show();
//     });
//     $( "#gstupload").change(function() {
//     $('.tick6').show();
//     });
//     $( "#companydoc").change(function() {
//     $('.tick7').show();
//     });
//     $( "#otherdoc").change(function() {
//     $('.tick8').show();
//     });
    
//     // Full Ajax request
//     $(".btn").click(function(e) {
//             // Stops the form from reloading
//             e.preventDefault();
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': "{{ csrf_token() }}"
//                 }
//             });
//     let image_upload = new FormData();
//     let TotalImages = $('#vendorpicture')[0].files.length; //Total Images
//    // console.log(TotalImages);
//     let images = $('#vendorpicture')[0];
//    // console.log(images);
//     for (let i = 0; i < TotalImages; i++) {
//         image_upload.append('images' + i, images.files[i]);
//     }
//     //code for gst img
//     let vendorgst = $('#vendorgst')[0].files.length; //Total Images
//     let vendorgstimages = $('#vendorgst')[0];
//     for (let i = 0; i < vendorgst; i++) {
//         image_upload.append('vendorgstimages' + i, vendorgstimages.files[i]);
//     }
//      //code for ownerpersonaldoc img
//      let ownerpersonaldoc = $('#ownerpersonaldoc')[0].files.length; //Total Images
//     let ownerpersonaldocimages = $('#ownerpersonaldoc')[0];
//     for (let i = 0; i < ownerpersonaldoc; i++) {
//         image_upload.append('ownerpersonaldocimages' + i, ownerpersonaldocimages.files[i]);
//     }
//      //code for cinphoto img
//      let cinphoto = $('#cinphoto')[0].files.length; //Total Images
//     let cinphotoimages = $('#cinphoto')[0];
//     for (let i = 0; i < cinphoto; i++) {
//         image_upload.append('cinphotoimages' + i, cinphotoimages.files[i]);
//     }
//      //code for panimage img
//      let panimage = $('#panimage')[0].files.length; //Total Images
//     let panimageimages = $('#panimage')[0];
//     for (let i = 0; i < panimage; i++) {
//         image_upload.append('panimageimages' + i, panimageimages.files[i]);
//     }
//      //code for gstupload img
//      let gstupload = $('#gstupload')[0].files.length; //Total Images
//     let gstuploadimages = $('#gstupload')[0];
//     for (let i = 0; i < gstupload; i++) {
//         image_upload.append('gstuploadimages' + i, gstuploadimages.files[i]);
//     }
//      //code for companydoc img
//      let companydoc = $('#companydoc')[0].files.length; //Total Images
//     let companydocimages = $('#companydoc')[0];
//     for (let i = 0; i < companydoc; i++) {
//         image_upload.append('companydocimages' + i, companydocimages.files[i]);
//     }
//      //code for otherdoc img
//      let otherdoc = $('#otherdoc')[0].files.length; //Total Images
//     let otherdocimages = $('#otherdoc')[0];
//     for (let i = 0; i < otherdoc; i++) {
//         image_upload.append('otherdocimages' + i, otherdocimages.files[i]);
//     }
//     image_upload.append('TotalImages', TotalImages);
//     image_upload.append('vendorgst', vendorgst);
//     image_upload.append('ownerpersonaldoc', ownerpersonaldoc);
//     image_upload.append('cinphoto', cinphoto);
//     image_upload.append('panimage', panimage);
//     image_upload.append('gstupload', gstupload);
//     image_upload.append('companydoc', companydoc);
//     image_upload.append('otherdoc', otherdoc);
//     image_upload.append("company_name",$('#company_name').val());
//     image_upload.append("company_cin",$('#company_cin').val());
//     image_upload.append("pan_no",$('#pan_no').val());
//     image_upload.append("ownername",$('#ownername').val());
//     image_upload.append("gstno",$('#gstno').val());
//     //vendorgst
//     //console.log(images);


//     $.ajax({
//                 url: "{{ route('store.vendorpicture') }}",
//                 type: 'POST',
//                 contentType: false,
//                 processData: false,
//                 data: image_upload,
//                 success: function(data) {
//                     $('#loadimg').hide();
//                  document.getElementById("post-form").reset();
//                  if($.isEmptyObject(data.error)){
//                         alert(data.success);
//                     }else{
//                         printErrorMsg(data.error);
//                     }
//                 }
                
//             });
//         });
//         function printErrorMsg (msg) {
//             $(".print-error-msg").find("ul").html('');
//             $(".print-error-msg").css('display','block');
//             $.each( msg, function( key, value ) {
//                 $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
//             });
//         }
//     });
    </script>
    <style>
    .swal-button--confirm {
      background-color: #DD6B55;
    }
   </style>
@endsection