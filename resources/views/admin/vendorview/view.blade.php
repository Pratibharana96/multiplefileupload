@extends('admin.layouts.dashboard')
@section('content')

<div class="container">    
     <br />
     <h3 align="center">Vendor Documents Details </h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
               <th width="10%">S.No.</th>
               <th width="10%">User Name</th>
                <th width="35%">Comapny Name</th>
                <th width="35%">Comapny CIN</th>
                <th width="35%">Pan No.	</th>
                <th width="35%">Owner Name	</th>
                <th width="35%">GST No.</th>
                <th width="35%">Vendor Picture</th>
                <th width="35%">Vendor GST</th>
                <th width="35%">Owner Personal Doc.</th>
                <th width="35%">Cin Photo</th>
                <th width="35%">Pan Image</th>
                <th width="35%">Vendor GST</th>
                <th width="35%">Gst pload.</th>
                <th width="35%">Company Doc.</th>
                <th width="35%">Other Doc.</th>
               <th width="30%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg" style="width:100%">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Vendor Picture: </label>
            <div class="col-md-8">
                <span id ="vendor_picture"></span>
            </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-4" >Vendor GST : </label>
            <div class="col-md-8">
                <span id ="vendorgst"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Owner Personaldoc : </label>
            <div class="col-md-8">
                <span id ="ownerpersonaldoc"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Cin Image: </label>
            <div class="col-md-8">
                <span id ="cinphoto"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Pan image: </label>
            <div class="col-md-8">
                <span id ="panimage"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">GST Upload: </label>
            <div class="col-md-8">
                <span id ="gstupload"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Company Doc: </label>
            <div class="col-md-8">
                <span id ="companydoc"></span>
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Other Doc: </label>
            <div class="col-md-8">
                <span id ="otherdoc"></span>
            </div>
           </div>
  
            
           

         
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <!-- <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" /> -->
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('vendorlistview') }}",
  },
  columns:[
    {
    data: 'id',
    name: 'id'
   },
   {
    data: 'user_id',
    name: 'user_id'
   },
   {
    data: 'company_name',
    name: 'company_name'
   },
   {
    data: 'company_cin',
    name: 'company_cin'
   },
   {
    data: 'pan_no',
    name: 'pan_no'
   },
   {
    data: 'ownername',
    name: 'ownername'
   },
   {
    data: 'gstno',
    name: 'gstno'
   },
   {
    data: 'vendorpicture',
    name: 'vendorpicture',
    html: true,
            orderable: false
     },
   {
    data: 'vendorgst',
    name: 'vendorgst'
   },
   {
    data: 'ownerpersonaldoc',
    name: 'ownerpersonaldoc'
   },
   {
    data: 'cinphoto',
    name: 'cinphoto'
   },
   {
    data: 'panimage',
    name: 'panimage'
   },
   {
    data: 'gstupload',
    name: 'gstupload'
   },
   {
    data: 'companydoc',
    name: 'companydoc'
   },
   {
    data: 'otherdoc',
    name: 'otherdoc'
   },
   {
    data: 'doc_uploaded',
    name: 'doc_uploaded'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ],
  'columnDefs': [ {
        'searchable'    : false,
        'targets': [0], /* column index */
     }]
 });

 //view crud


$(document).on('click','.edit',function(){
    var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"{{route('vendor.viewimg')}}",
   data:{id:id},
   dataType:"json",
   success:function(html){
       //console.log(html.vendorImgArr);
       //var specification_id = html.data.specification;
       var username = "{{Auth::user()->name}}";
       var vendorImgArr = html.vendorImgArr;
       var vendorgst = html.vendorgst;
       var ownerpersonaldoc =html.ownerpersonaldoc;
       var cinphoto = html.cinphoto;
       var panimage = html.panimage;
       var gstupload = html.gstupload;
       var companydoc = html.companydoc;
       var otherdoc =html.otherdoc;
       var doc_uploaded = html.doc_uploaded;
      // console.log(vendorImgArr);
       for(i=0;i< vendorImgArr.length; i++)
       {
            var vImgArr = vendorImgArr[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${vImgArr}')}}" width='70' class='img-thumbnail' />`;

            $('#vendor_picture').append(url);
         // console.log(vImgArr);
       }

         //Fetch data for console.log(vendorgst);
         for(i=0;i< vendorgst.length;i++)
       {
            var gstimg= vendorgst[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#vendorgst').append(url);
         // console.log(vImgArr);
       }
        //Fetch data for ownerpersonaldoc  console.log(ownerpersonaldoc);
        for(i=0;i< ownerpersonaldoc.length;i++)
       {
            var gstimg= ownerpersonaldoc[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#ownerpersonaldoc').append(url);
         // console.log(vImgArr);
       }
       //for cinphoto
        //Fetch data for ownerpersonaldoc  console.log(ownerpersonaldoc);
        for(i=0;i< cinphoto.length;i++)
       {
            var gstimg= cinphoto[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#cinphoto').append(url);
         // console.log(vImgArr);
       }
        //for panimage
        //Fetch data for panimage  console.log(panimage);
        for(i=0;i< panimage.length;i++)
       {
            var gstimg= panimage[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#panimage').append(url);
         // console.log(vImgArr);
       }
        //Fetch data for gstupload  console.log(gstupload);
        for(i=0;i< gstupload.length;i++)
       {
            var gstimg= gstupload[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#gstupload').append(url);
         // console.log(vImgArr);
       }
        //Fetch data for companydoc  console.log(companydoc);
        for(i=0;i< companydoc.length;i++)
       {
            var gstimg= companydoc[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#companydoc').append(url);
         // console.log(vImgArr);
       }
        //Fetch data for otherdoc  console.log(otherdoc);
        for(i=0;i< otherdoc.length;i++)
       {
            var gstimg= otherdoc[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#otherdoc').append(url);
         // console.log(vImgArr);
       }
        //Fetch data for otherdoc  console.log(otherdoc);
        for(i=0;i< doc_uploaded.length;i++)
       {
            var gstimg= doc_uploaded[i];

            var url = `<img src="{{ asset('/storage/documents/client_id-${username}/${gstimg}')}}" width='70' class='img-thumbnail' />`;

            $('#doc_uploaded').append(url);
         // console.log(vImgArr);
       }



    $('#brand_id').val(html.data.brand_id);
    $('#model_name').val(html.data.name);
    $('#price').val(html.data.price);
    $('#year').val(html.data.manufacturing);
    $('#model_name').val(html.data.name);
    $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image_name + " width='70' class='img-thumbnail' />");
    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.image_name+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("View All Record");
    // $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
});


});

</script>


@endsection