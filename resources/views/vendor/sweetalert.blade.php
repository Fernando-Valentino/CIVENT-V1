<!-- SweetAlert Success and Error Handling -->
@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log('Success message: {{ session('success') }}');
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<!-- SweetAlert for Errors -->
@if (session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log('Error message:', '{{ session('error') }}');
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    </script>
@endif

<!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-form').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default button action

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the logout form
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

<script>
    function confirmDelete(eventId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + eventId).submit();
            }
        })
    }
</script>
