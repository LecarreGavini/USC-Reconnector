@extends('_layouts.admin')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/extra/vendors/DataTables/datatables.min.css') }}" />

@endsection

@section('title')

Alumni

@endsection

@section('content')

<?php $userType="Alumnus"; ?>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title text-info">
            Number of Alumni:<b><i> @if(isset($users)){{$users->count()}}@endif</i></b>
        </div>
        <span data-toggle="modal" data-target="#create" data-type="Alumnus">
            <button class="btn btn-info" data-toggle="tooltip" data-original-title="Create A New User">
                Add <i class="ti-plus"></i>                            
            </button>
        </span>
    </div>
    <div class="ibox-body">
    <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Picture</th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Email Address</th>
                <th>Job Title</th>
                <th>Option</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Picture</th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Email Address</th>
                <th>Job Title</th>
                <th>Option</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><center>
                    <img src="/storage/user_img/{{ $user->picture }}" height="28" style="border-radius: 50%;" alt="User Default">
                </center></td>
                <td>{{ $user->idnumber }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->sex }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(count($user->occupations) > 0)
                        {{-- LO short for Latest Occupation --}}
                        <?php $LO=count($user->occupations)-1; ?>
                        {{ $user->occupations[$LO]['title'] }}
                    @else
                        No occupation
                    @endif
                </td>
                <td>

                    {{-- Show User --}}
                    <span   data-toggle="modal"                 data-target="#show-user" 
                            {{-- User Basic Data --}}
                            data-id="{{ $user->id }}"           data-status="{{ $user->userStatus}}"
                            data-n="{{ $user->full_name }}"     data-type="{{ $user->userType }}"
                            data-idnum="{{ $user->idnumber }}"  data-sex="{{ $user->sex }}"
                            data-email="{{ $user->email }}"     data-desc="{{ $user->description }}"
                            data-updt="{{$user->updateStatus}}" data-emply="{{ $user->employmentStatus }}"
                            {{-- Occupation and Company  --}}
                            @if(count($user->occupations) > 0)
                                data-title="{{ $user->occupations[$LO]['title'] }}"                 data-addr="{{ $user->occupations[$LO]['address'] }}"
                                data-salar1="{{ $user->occupations[$LO]['salaryRangeOne'] }}"       data-salar2="{{ $user->occupations[$LO]['salaryRangeTwo'] }}"
                                data-jobstr="{{ $user->occupations[$LO]['jobStart'] }}"             data-jobend="{{ $user->occupations[$LO]['jobEnd'] }}"
                                data-compname="{{ $user->occupations[$LO]->company['name'] }}"      data-compaddr="{{ $user->occupations[$LO]->company['address'] }}"
                                data-compdesc="{{$user->occupations[$LO]->company['description']}}" data-linkage="{{ $user->occupations[$LO]->company->linkage['code'] }}" 
                                data-country="{{$user->occupations[$LO]->company->country['name']}}"data-area="{{$user->occupations[$LO]->company->area['name']}}" 
                            @endif >
                        <button class="btn btn-xs" data-toggle="tooltip" data-original-title="Show">   
                            <i class="ti-eye"></i>                              
                        </button>
                    </span>

                    {{-- Edit User --}}
                    <span   data-toggle="modal" data-target="#edit-user"   
                            {{-- User Basic Data     --}}
                            data-id="{{ $user->id }}"           data-status="{{ $user->userStatus}}"
                            data-fn="{{ $user->firstName }}"    data-mn="{{ $user->middleName }}"   
                            data-ln="{{ $user->lastName }}"     data-type="{{ $user->userType }}"   
                            data-idnum="{{ $user->idnumber }}"  data-sex="{{ $user->sex }}"         
                            data-email="{{ $user->email }}"     data-desc="{{ $user->description }}"
                            data-updt="{{$user->updateStatus}}" data-emply="{{ $user->employmentStatus }}">
                        <button class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="Edit">
                            <i class="ti-pencil"></i>                                
                        </button>
                    </span>

                    {{-- Delete User --}}
                    <span data-toggle="modal" data-target="#delete" data-id="{{ $user->id }}">
                        <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete">   
                            <i class="ti-trash"></i>                              
                        </button>
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<!-- Show Modal -->
<div class="modal fade" id="show-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Showing Alumnus</h4>
    </div>
    <div class="modal-body">
        @include('_inc.admin.userShowUserModal')
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Creating New Alumnus</h4>
    </div>
    {!! Form::open(['route' => 'StoreUser', 'method' => 'POST', 
                    'style' => 'display:inline-block;', 'files' => TRUE]) !!}
    @csrf
    <div class="modal-body">
            @include('_inc.admin.userCreateUserModal')
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
    {!! Form::open(['route' => 'UpdateUser', 'method' => 'PATCH', 
    'style' => 'display:inline-block;', 'files' => TRUE]) !!}
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Form::file('picture') }}
        <h4 class="modal-title" id="myModalLabel">Editing Alumnus</h4>
    </div>
    <div class="modal-body">
        @include('_inc.admin.userEditUserModal')
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{Form::submit('Save Changes', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>
    
<!-- Delete Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Alumnus Confirmation</h4>
    </div>
    {!! Form::open(['route' => 'DeleteUser', 'method' => 'DELETE', 
                    'style' => 'display:inline-block;']) !!}
    @csrf
    <div class="modal-body">
        <p class="text-center">
            Are you sure you want to delete this?
        </p>
        {{ Form::hidden('id', '', array('id' => 'id')) }}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
        {{Form::submit('Yes, Delete', ['class' => 'btn btn-warning'])}}
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/unique/crud_user.js') }}"></script>
<script type="text/javascript" src="{{ asset('css/extra/vendors/DataTables/datatables.min.js') }}"></script>

@endsection