<?php

// MIDDLEWARES ------------------------------------------------------------

Route::group(['middleware' => 'guest'], function () {

// Guest Users ============================================================

        // Login
        Route::get('/', 'LoginController@index')->name('login');
        Route::post('/login','LoginController@login')->name('login.submit');
        
        Route::view('request', 'authenticate.register')->name('showRegister');
        Route::post('request', 'RequestController@store')->name('request.submit');
        
});
        // Logout
        Route::post('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'home'], function () {
        Route::get('/home','HomeController@latestPost')->name('home');   
        Route::resource('jobPosts','JobPostController')->except('create');
        Route::resource('announcements','AnnouncementController')->except('create');
    }); 


    // Student
    Route::group(['middleware' => 'student'], function () {  
        Route::get('/student/profile', 'StudentController@index')->name('student.profile');
        Route::view('/student/class', 'user.student.class')->name('students');
        Route::patch('/student/description', 'DescriptionController@update')->name('student.description.update');
        Route::post('student/skill', 'UserSkillController@store')->name('student.skill.add');
        Route::post('student/achievement', 'AchievementController@store')->name('student.achievement.add');
        

    });
    // Alumnus
    Route::group(['middleware' => 'alumnus'], function () {  
      
        Route::view('/alumnus/profile', 'user.alumnus.profile');
        Route::view('/alumnus/jobs', 'user.alumnus.jobs');
        Route::view('/alumnus/communicate', 'user.alumnus.communicate');
        Route::view('/alumnus/form', 'user.alumnus.form');  

        Route::view('/alumnus/maptest', 'user.alumnus.map');        

    });
   
    // Alumnus
    Route::group(['middleware' => 'alumnus'], function () {  
      
        Route::get('/alumnus/profile', 'AlumnusController@alumnusProfile')->name('alumnus.profile');
        Route::get('/alumnus/jobs', 'AlumnusController@alumnusJobs')->name('alumnus.jobs');
        Route::get('/alumnus/communicate', 'AlumnusController@alumnusCommunicate')->name('alumnus.communicate');
        Route::patch('alumnus/description', 'DescriptionController@update')->name('alumnus.description.update');
        Route::post('alumnus/skill', 'UserSkillController@store')->name('alumnus.skill.add');
        Route::post('alumnus/achievement', 'AchievementController@store')->name('alumnus.achievement.add');
        //Alumnus Form Routes
        Route::get('/alumnus/form', 'GTSController@alumnusForm')->name('alumnus.form');  
        Route::get('/alumnus/form/{id}/edit','GTSController@edit')->name('alumnus.form.edit');
        Route::post('/alumnus/form','GTSController@store')->name('alumnus.form.store');
        Route::patch('/alumnus/form/{id}/update','GTSController@update')->name('alumnus.form.update');;

    });

    
    // Teacher
    Route::group(['middleware' => 'teacher'], function () {

        Route::get('/teacher/profile', 'TeacherController@index')->name('teacher.profile');
        Route::patch('/teacher/description', 'DescriptionController@update')->name('teacher.description.update');
        Route::post('/teacher/achievement', 'AchievementController@store')->name('teacher.achievement.add');
        
    });
    

    // Admin
    Route::group(['middleware' => 'admin'], function () { 
        // Admin Index
        Route::view('/admin', 'user.admin.index')->name('admins');
        // User Controller
        Route::get('/user/students', 'Admin\UserController@students')->name('ShowStudents');
        Route::get('/user/alumni', 'Admin\UserController@alumni')->name('ShowAlumni');
        Route::get('/user/teachers', 'Admin\UserController@teachers')->name('ShowTeachers');
        Route::get('/user/coordinators', 'Admin\UserController@coordinators')->name('ShowCoordinators');
        Route::get('/user/chairs', 'Admin\UserController@chairs')->name('ShowChairs');
        Route::get('/user/admins', 'Admin\UserController@admins')->name('ShowAdmins');
        Route::post('/user/store', 'Admin\UserController@store')->name('StoreUser');
        Route::patch('/user/update', 'Admin\UserController@update')->name('UpdateUser');
        Route::delete('/user/delete', 'Admin\UserController@destroy')->name('DeleteUser');
        // School Management Controller
        Route::get('/SM/classes', 'Admin\SchoolMgmtController@classes')->name('ShowClasses');
        Route::post('/SM/store', 'Admin\SchoolMgmtController@storeClass')->name('StoreClass');
        Route::patch('/SM/update', 'Admin\SchoolMgmtController@updateClass')->name('UpdateClass');
        Route::delete('/SM/destroy', 'Admin\SchoolMgmtController@destroyClass')->name('DeleteClass');
        Route::post('/SM/students', 'Admin\SchoolMgmtController@studentClass')->name('StudentClass');
        Route::post('/SM/store/student', 'Admin\SchoolMgmtController@storeStudent')->name('StoreStudent');
        Route::delete('/SM/remove/student', 'Admin\SchoolMgmtController@removeStudent')->name('RemoveStudent');
        Route::get('/SM/school', 'Admin\SchoolMgmtController@school')->name('ShowSchool');
        Route::post('/SM/school/store', 'Admin\SchoolMgmtController@storeSchool')->name('StoreSchool');
        Route::post('/SM/department/store', 'Admin\SchoolMgmtController@storeDepartment')->name('StoreDepartment');
        Route::post('/SM/course/store', 'Admin\SchoolMgmtController@storeCourse')->name('StoreCourse');
        Route::patch('/SM/school/update', 'Admin\SchoolMgmtController@updateSchool')->name('UpdateSchool');
        Route::patch('/SM/department/update', 'Admin\SchoolMgmtController@updateDepartment')->name('UpdateDepartment');
        Route::patch('/SM/course/update', 'Admin\SchoolMgmtController@updateCourse')->name('UpdateCourse');
        Route::delete('/SM/school/delete', 'Admin\SchoolMgmtController@destroySchool')->name('DeleteSchool');
        Route::delete('/SM/department/delete', 'Admin\SchoolMgmtController@destroyDepartment')->name('DeleteDepartment');
        Route::delete('/SM/course/delete', 'Admin\SchoolMgmtController@destroyCourse')->name('DeleteCourse');
        // Bulletin Controller
        Route::get('/bulletin', 'Admin\BulletinController@index')->name('ShowPosts');
        Route::get('/bulletin/create', 'Admin\BulletinController@create')->name('CreatePost');
        Route::post('/bulletin/store', 'Admin\BulletinController@store')->name('StorePost');
        // Tracking Controller
        Route::get('/track/nation', 'Admin\TrackController@nationwide')->name('ShowNation');
        Route::get('/track/unitedstates', 'Admin\TrackController@unitedstates')->name('ShowUS');
        Route::get('/track/world', 'Admin\TrackController@worldwide')->name('ShowWorld');
    });
    

// Resources ==============================================================

    //Student


    // Teacher

    // Admin
    Route::resource('registration', 'Admin\UserRegistrationController', 
    ['only' => ['index', 'edit', 'update', 'destroy']]);

   

});