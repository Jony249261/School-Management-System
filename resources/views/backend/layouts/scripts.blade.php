<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backend/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('public/backend/plugins')}}/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public/backend/plugins')}}/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('public/backend/plugins')}}/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backend/plugins')}}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backend/plugins')}}/moment/moment.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backend/plugins')}}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('public/backend/plugins')}}/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend/plugins')}}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist')}}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend/dist')}}/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backend/dist')}}/js/pages/dashboard.js"></script>

<script src="{{asset('public/backend/plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- jquery-validation -->
<script src="{{asset('public/backend/plugins')}}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('public/backend/plugins')}}/jquery-validation/additional-methods.min.js"></script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
    <script>
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        {{-- expr --}}
        @endif
        @if (Session::has('warning'))
        toastr.info("{{Session::get('info')}}")
        {{-- expr --}}
        @endif
        @if (Session::has('error'))
        toastr.error("{{Session::get('error')}}")
        {{-- expr --}}
        @endif
    </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    <script>

	$(document).on("click", "#delete", function(e){
	   e.preventDefault();
	   var link = $(this).attr("href");
	    swal({
		title: "Are You Sure Want to Delete?",
	        text: "If you delete this, it will be gone forever.",
            	icon: "warning",
            	buttons: true,
            	dangerMode: true,
            })
	    .then((willDelete) => {
            if (willDelete) {
            window.location.href = link;
            } else{
		swal("Safe Data!");
	}

    });
});

 $(document).on("click", "#accept", function(e){
	   e.preventDefault();
	   var link = $(this).attr("href");
	    swal({
		title: "Are You Sure Want to Accept?",
	        text: "If you Accept this, it can't be Deleted.",
            	icon: "warning",
            	buttons: true,
            	dangerMode: true,
            })
	    .then((willDelete) => {
            if (willDelete) {
            window.location.href = link;
            }

      });
    });

</script>

<script>
$(function () {
  $('#myForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      name: {
        required: true,
      },
      usertype: {
        required: true,
      },
      password2: {
        required: true,
        equalTo: '#password'
      },
      password: {
        required: true,
        minlength: 6
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      name: {
        required: "Please Enter User name",
      },
      usertype: {
        required: "Please Select User Type",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters or Numbers"
      },
      password2: {
        required: "Please provide a confirm password",
        equalTo: "confirm password does not match"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script>
  $(document).ready(function(){
    $('#image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>