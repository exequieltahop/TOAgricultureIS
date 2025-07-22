import './bootstrap';
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js';
import '../../node_modules/jquery/dist/jquery.js';
import '../../node_modules/toastr/build/toastr.min.js';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function(){
    // swal
    window.Swal = Swal;
    // csrf token
    window.token = document.querySelector('meta[name="csrf-token"]').content;

});
