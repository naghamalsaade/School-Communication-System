<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register STUDENT routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::group(['prefix' => 'student'], function () {

        //login student
        Route::post('login', [App\Http\Controllers\Auth\Student\AuthController::class, 'login']);

        //for logged in student
        Route::group(['middleware' => ['auth:sanctum', 'abilities:student-api'] ], function () {

            //logout student
            Route::post('logout', [App\Http\Controllers\Auth\Student\AuthController::class, 'logout']);
    
            //show all educational content for subject
            Route::get('educational-contents/all/{subject_id}', [App\Http\Controllers\User\EducationalContentController::class, 'all']);
            
            //show all events
            Route::get('events/all', [App\Http\Controllers\User\EventController::class, 'all']);
            
            //show all justifications
            Route::get('justifications/all', [App\Http\Controllers\User\JustificationController::class, 'all']);
            
            //show justification of specific attendance
            Route::get('justifications/{attendance_check_id}', [App\Http\Controllers\User\JustificationController::class, 'showJustification']);

            //show all Exam schedules
            Route::get('exam-scheduales/all/{semester_id}', [App\Http\Controllers\User\ScheduleController::class, 'allExamScheduales']);

            //show all work schedules
            Route::get('work-scheduales/all/{semester_id}', [App\Http\Controllers\User\ScheduleController::class, 'allWorkScheduales']);
    
            //show all subjects
            Route::get('subjects/all', [App\Http\Controllers\User\SubjectController::class, 'all']);
            
            //show all marks
            Route::get('marks/all/{semester_id}', [App\Http\Controllers\User\MarkController::class, 'all']);

            //add justification
            Route::post('justifications/add/{attendance_check_id}', [App\Http\Controllers\User\JustificationController::class, 'store']);

            //show all attendances for one student 
            Route::get( 'attendances',[App\Http\Controllers\User\AttendanceCheckController::class, 'Attendances']);
    
            //show type attendances for student 
            Route::get( '/attendancestype/{type}',[App\Http\Controllers\User\AttendanceCheckController::class, 'AttendancesType']);
    
            //show all sent complaints for student
            Route::get( 'complaints/sent',[App\Http\Controllers\User\ComplaintController::class, 'StudentSentComplaints']);
   
            //show all received complaints for student
            Route::get( 'complaints/received',[App\Http\Controllers\User\ComplaintReceiverController::class, 'StudentReceivedComplaints']);
    
            //add student complaint
            Route::post( 'complaints/add',[App\Http\Controllers\User\ComplaintController::class, 'AddStudentComplaint']);
    
        });
    
    });





