</div> <!-- page-wrapper -->
        <!-- Jquery JS-->
        <script src="vendor/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="vendor/slick/slick.min.js">
        </script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="vendor/animsition/animsition.min.js"></script>
        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script>
        <script src="vendor/vector-map/jquery.vmap.js"></script>
        <script src="vendor/vector-map/jquery.vmap.min.js"></script>
        <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
        <script src="vendor/vector-map/jquery.vmap.world.js"></script>
        <script src="vendor/dropify/dist/js/dropify.min.js"></script>
        <!-- Main JS-->
        <script src="js/main.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script>
        $(document).ready(function(){






            $('#forLogout').click(function(e){
            e.preventDefault();
            swal({
            title: "Logout",
            text: "Yakin Logout?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
            }, function(isConfirm) {
            if (isConfirm) {
            window.location.href="?logout";
            }
        });
        });
        })
        </script>
        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        $('.dropify').dropify();
        </script>
        <?php include "config/alert.php";?>
    </body>
</html>