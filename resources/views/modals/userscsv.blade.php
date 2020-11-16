{{-- See snipeit_modals.js for what powers this --}}

<div class="modal-dialog" id="the-modal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Upload Csv</h4>
              <h3 id="ajaxResponse" class="msg"></h3>
              <h3 id="total"></h3>
        </div>
        <form method="post" enctype="multipart/form-data" id="addNewDoctorInList">
           <div class="modal-body">
               <div class="row">
                   
                   <div class='col-md-3'>
                       <div class='form-group'>
                           
                           <input type="file" class="form-control" name="clinic_logo" accept=".csv" style="width:auto;" required>
                       </div>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <input type="submit" class="btn btn-primary" value="SUBMIT"/>
           </div>
       </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



<script>
    $("#addNewDoctorInList").submit(function(e) {
       e.preventDefault();
       var errors = 0;
       var form_data = new FormData();

       
       $("input[name='clinic_logo']").each(function() {
           form_data.append("clinic_logo", $(this).prop("files")[0]);
       });
       
       $.ajax({
           type: "POST",
           url:  "{{ route('api.userscsv.users_store') }}",
           headers: {
                    "X-Requested-With": 'XMLHttpRequest',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                _token: "{{ csrf_token() }}",
           data: form_data,
           cache: false,
           contentType: false,
           processData: false,
           success: function(data) {
              $("#ajaxResponse").html(data.msg);
              $("#total").html(data.Total);
              setTimeout(function(){
        $("#the-modal").hide();
    }, 6000);
           }
       });
   });
</script>




















