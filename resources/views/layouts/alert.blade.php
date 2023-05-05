@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show position-absolute" style="top:2%; right:2%" role="alert">
    <strong>{{ session('success') }}!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif