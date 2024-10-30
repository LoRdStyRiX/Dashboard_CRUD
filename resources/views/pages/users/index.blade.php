@extends('layouts.app')

@section('title', 'Posts')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Posts</h1>
                <div class="section-header-button">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Posts</a></div>
                    <div class="breadcrumb-item">All Posts</div>
                </div>
            </div>

            @include('layouts.alert')
            <div class="section-body">



                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="table-responsive">
                                    <table class="table-striped table">


                                        <tr>

                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Account type</th>
                                            <th>Phone no.</th>
                                        </tr>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}
                                                    <div class="table-links">
                                                        <a href="#">View</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                        <div class="bullet"></div>

                                                        {{-- you cant make a form in <a> and to destroy an item you need the <form> tag, so instead we use onclick --}}
                                                        <a href="#"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"
                                                            class="text-danger">Trash</a>

                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST" id="delete-form-{{ $user->id }}">

                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>

                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    <nav>
                                        {{ $users->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
