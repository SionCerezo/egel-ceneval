@extends('admin.admin-master')

@section('body')
<div class="blog-item post-item">
    ADMIN
    @dump(auth()->user())
    @dump(auth()->user()->isAdmin())
</div>
@endsection

