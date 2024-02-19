<div id="alerts"></div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    @foreach (session('success', []) as $message)
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ $message }}'
        })
    @endforeach

    @foreach (session('error', []) as $error)
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ $error }}'
        })
    @endforeach
})
</script>