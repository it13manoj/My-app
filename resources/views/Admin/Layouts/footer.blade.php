 <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2017 <a href="#">Nuakriyan</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i> by <a href="https://www.vayuz.com">Vayuz Technologies</a></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  
  <script src="{{asset('admin_assets/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
  <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('admin_assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/morris.js/morris.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/datatables.net/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
  <script src="{{asset('admin_assets/plugins/jquery.avgrund/jquery.avgrund.min.js')}}"></script>
   <script src="{{asset('admin_assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>

  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('admin_assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin_assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin_assets/js/misc.js')}}"></script>
  <script src="{{asset('admin_assets/js/settings.js')}}"></script>
  <script src="{{asset('admin_assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  

  <!-- Custom js for this page-->
  <script src="{{asset('admin_assets/js/formpickers.js')}}"></script>
  <script src="{{asset('admin_assets/js/dashboard.js')}}"></script>
  <script>
     $(function() {
    $('#order-listing').DataTable({
      "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
      "iDisplayLength": 10,
      "language": { search: "" }
    });

    var oTable2=$('#myTable2').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_countries')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "country_name" },
                                    { "data": "country_code" },
                                    { "data": "country_currency_code" },
                                    { "data": "status" },
                                    { "data": "action" },
                                    
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
    var stateTable=$('#stateTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_states')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "state_name" },
                                    { "data": "country_name" },
                                    { "data": "status" },
                                    { "data": "action" },
                                    
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
    var cityTable=$('#cityTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_cities')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "city_name" },
                                    { "data": "country_name" },
                                    { "data": "state_name" },
                                    { "data": "status" },
                                    { "data": "action" },
                                    
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
    var catTable=$('#catTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_jobcategories')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "category_name" },
                                    { "data": "status" },
                                    { "data": "featured" },
                                    { "data": "action" },
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
      var scatTable=$('#scatTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_jobsubcategories')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "subcategory_name" },
                                    { "data": "category_name" },
                                    { "data": "status" },
                                    { "data": "action" },
                                ],columnDefs: [
                                   { orderable: false, targets: -1 },
                                ]
                                });
      var scatTable=$('#employerTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_employers')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "category_id" },
                                    { "data": "subcategory_id" },
                                    { "data": "userimg" },
                                    { "data": "email" },
                                    { "data": "company_name" },
                                    { "data": "user_username" },
                                    { "data": "user_contact" },
                                    { "data": "category_name" },
                                    { "data": "subcategory_name" },
                                    { "data": "featured" },
                                    { "data": "status" },
                                    { "data": "action" },

                                ],columnDefs: [
                                   { orderable: false, targets: -1 },
                                   {visible:false,targets:1},
                                   {visible:false,targets:2}
                                ]
                                });
     $('#industry').on('change',function(){
           scatTable.columns(1).search( this.value ).draw();
        });

       $('#subcategory').on('change',function(){
            scatTable.columns(2).search( this.value ).draw();
        });      
      
    
   
  });


      $("input").on("keypress", function(e) {
         var type=$(this).attr('type');
         if(type!='file'){
    if (e.which === 32 && !this.value.length){
                e.preventDefault();
         
         }
         }
        });
        $("textarea").on("keypress", function(e) {
      if (e.which === 32 && !this.value.length)
                e.preventDefault();
        });
    $("input").on("change", function(e) {
        var type=$(this).attr('type');
         if(type!='file'){
      var n=$.trim($(this).val());
      $(this).val(n);
            if (e.which === 32 && !this.value.length){
                e.preventDefault();
         }}
      });
        $("textarea").on("change", function(e) {
    var n=$.trim($(this).val());
    $(this).val(n);
            if (e.which === 32 && !this.value.length)
                e.preventDefault();
        });
        (function($) {
  'use strict';
  $('.dropify').dropify();
})(jQuery);
  </script>
  @yield('page-footer')
  <!-- End custom js for this page-->
</body>


<!-- Mirrored from www.urbanui.com/victory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Sep 2018 12:21:58 GMT -->
</html>