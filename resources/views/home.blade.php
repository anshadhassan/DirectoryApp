@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> List of Directories and Files</div>


                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>

                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="topnav">
                        <div class="search-container">
                            <input type="text" placeholder="Search.." name="search" class="form-control">
                            <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <input type="file" name="file" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                            </form>
                        </div>
                        <form action="/update-page">
                            <button class="btn btn-success">
                                Refresh Directory
                            </button>
                        </form>
                    </div>

                    <div class="container">
                        <table class="table">
                            <tr>
                                <th>
                                    Files
                                </th>
                                @if($files)
                                @foreach($files as $file)
                            </tr>
                            <td>
                                {{ $file->file_name }}
                            </td>
                            <td>
                                <a href="delete-file/{{$file->file_id}}">
                                    delete
                                </a>
                            </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                        {{ $files->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
