{{ Form::hidden('userType', null, array('id' => 'type')) }}
{{ Form::hidden('userStatus', 'Approved') }}
{{ Form::hidden('employmentStatus', 'Unemployed(Never)') }}
{{ Form::hidden('updateStatus', 'Outdated') }}
{{ Form::hidden('department_id', Auth::user()->department_id ) }}
{{ Form::hidden('course_id', null ) }}

<center>
<i>{{Form::label('userDetails', '~ User Details ~')}}</i><br><br>
{{-- Profile Picture and ID Number --}}
<div class="row">
    <div class="col-md-6 form-group">
        <b>{{Form::label('pic', 'Profile Picture')}}</b>
        {{ Form::file('picture') }}
    </div>

    <div class="col-md-6 form-group">
        <b>{{Form::label('idnumber', 'ID Number')}}</b>
        {{Form::number('idnumber', '', ['class' => 'form-control input-rounded', 
        'placeholder' => 'Add ID Number', 'required', 'min' => 10000000, 'max' => 99999999])}}
    </div>
</div>

{{-- First, Middle, and Last Name --}}
<div class="row">
    <div class="col-md-4 form-group">
        <b>{{Form::label('firstName', 'First Name')}}</b>
        {{Form::text('firstName', '', ['class' => 'form-control input-rounded', 
        'placeholder' => 'Type First Name', 'required'])}}
    </div>

    <div class="col-md-4 form-group">
        <b>{{Form::label('middleName', 'Middle Name')}}</b>
        {{Form::text('middleName', '', ['class' => 'form-control input-rounded', 
        'placeholder' => 'Type Middle Name'])}}
    </div>

    <div class="col-md-4 form-group">
        <b>{{Form::label('lastName', 'Last Name')}}</b>
        {{Form::text('lastName', '', ['class' => 'form-control input-rounded', 
        'placeholder' => 'Type Last Name', 'required'])}}
    </div>
</div>

{{-- Email Address --}} 
<div class="form-group">
    <b>{{Form::label('email', 'Email Address')}}</b>
    <div class="input-group">
        {{Form::email('email', '', 
        ['class' => 'form-control input-rounded', 'placeholder' => 'Type Email Address', 'required'])}}
        <div class="input-rounded input-group-addon">@example.com</div>
    </div>
</div>

{{-- Deparment Code and Sex --}}
<div class="row">  
    <div class="col-md-6 form-group">
        <b>{{Form::label('department_code', 'Department Code')}}</b>
        <select name="department_id" id="did" class = "form-control input-rounded text-center" disabled>
            @foreach ($departments as $department) 
                <option value={{$department->id}}>{{$department->code}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 form-group">
        <b>{{Form::label('sex', 'Sex')}}</b>
        {{Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], null, 
                              ['class' => 'form-control input-rounded', 'placeholder' => 'Choose Sex', 'required'])}}
    </div>
</div>

{{-- User Type Details --}}
@if($userType == "Student")
    <br><i>{{Form::label('studentDetails', '~ Student Details ~')}}</i><br><br>
    <div class="row">
        {{-- Course Code and Year Level --}}            
        <div class="col-md-6 form-group">
            <b>{{Form::label('course_id', 'Course Code')}}</b>
            <select name="course_id" class = "form-control input-rounded text-center" required>
                <option value="" disabled selected>Choose Course</option>
                @foreach ($courses as $course) 
                    <option value={{$course->id}}>{{$course->code}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 form-group">
            <b>{{Form::label('yearLevel', 'Year Level')}}</b>
            {{Form::selectRange('yearLevel', 1, 5, null, ['class' => 'form-control input-rounded text-center',
            'id' => 'year',  'placeholder' => 'Input Year Level', 'required'])}}
        </div>
    </div>
@elseif($userType == "Teacher")
    <br><i>{{Form::label('teacherDetails', '~ Teacher Details ~')}}</i><br><br>
    <div class="row">
        <div class="col-md-6 form-group">
            <b>{{Form::label('position', 'Position')}}</b>
            {{Form::text('position', '', ['class' => 'form-control input-rounded text-center', 
            'placeholder' => 'Input Teacher Position', 'required'])}}
        </div>

        <div class="col-md-6 form-group">
        <b>{{Form::label('employmentStatus', 'Employment Status')}}</b>
            {{Form::select('employmentStatus', ['Employed'         => 'Employed', 'Unemployed(Now)'    => 'Unemployed(Now)',
                                                'Unemployed(Never)' => 'Part-Time Job'], null, 
                                               ['class' => 'form-control input-rounded', 'placeholder' => 'Choose Employment Status',
                                                'required'])}}</div>
    </div>
@elseif($userType == "Admin")
    <br><i>{{Form::label('adminDetails', '~ Admin Details ~')}}</i><br><br>
    <div class="row">
        <div class="col-md-6 form-group">
            <b>{{Form::label('position', 'Position')}}</b>
            {{Form::text('position', '', ['class' => 'form-control input-rounded text-center', 
            'placeholder' => 'Input Teacher Position', 'required'])}}
        </div>

        <div class="col-md-6 form-group">
        <b>{{Form::label('employmentStatus', 'Employment Status')}}</b>
        {{Form::select('employmentStatus', ['Employed'         => 'Employed', 'Unemployed(Now)'    => 'Unemployed(Now)',
                                            'Unemployed(Never)' => 'Part-Time Job'], null, 
                                            ['class' => 'form-control input-rounded', 'placeholder' => 'Choose Employment Status',
                                            'required'])}}</div>
    </div>
@elseif($userType == "Coordinator")
    <br><i>{{Form::label('coordinatorDetails', '~ Coordinator Details ~')}}</i><br><br>
    <div class="row">
        <div class="col-md-6 form-group">
            <b>{{Form::label('position', 'Position')}}</b>
            {{Form::text('position', '', ['class' => 'form-control input-rounded text-center', 
            'placeholder' => 'Input Teacher Position', 'required'])}}
        </div>

        <div class="col-md-6 form-group">
        <b>{{Form::label('employmentStatus', 'Employment Status')}}</b>
        <b>{{Form::label('employmentStatus', 'Employment Status')}}</b>
            {{Form::select('employmentStatus', ['Employed'         => 'Employed', 'Unemployed(Now)'    => 'Unemployed(Now)',
                                                'Unemployed(Never)' => 'Part-Time Job'], null, 
                                               ['class' => 'form-control input-rounded', 'placeholder' => 'Choose Employment Status',
                                                'required'])}}</div>
    </div>
@elseif($userType == "Chair")
    <br><i>{{Form::label('chairDetails', '~ Chair Details ~')}}</i><br><br>
    <div class="row">
        <div class="col-md-6 form-group">
            <b>{{Form::label('position', 'Position')}}</b>
            {{Form::text('position', '', ['class' => 'form-control input-rounded text-center', 
            'placeholder' => 'Input Teacher Position', 'required'])}}
        </div>

        <div class="col-md-6 form-group">
        <b>{{Form::label('employmentStatus', 'Employment Status')}}</b>
        {{Form::select('employmentStatus', ['Employed'         => 'Employed', 'Unemployed(Now)'    => 'Unemployed(Now)',
                                            'Unemployed(Never)' => 'Part-Time Job'], null, 
                                            ['class' => 'form-control input-rounded', 'placeholder' => 'Choose Employment Status',
                                            'required'])}}</div>
    </div>
@elseif($userType == "Alumnus")
    {{ Form::hidden('course_id', null) }}
    {{ Form::hidden('department_id', 1) }}
@endif
</center>