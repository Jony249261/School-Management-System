<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware'=>'auth'],function(){
 
    
//Users routes
Route::prefix('users')->group(function(){
    Route::get('/view', 'Backend\UserController@view')->name('users.view');
    Route::get('/add', 'Backend\UserController@add')->name('users.add');
    Route::post('/store', 'Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
    Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
});


//profile routes
Route::prefix('profiles')->group(function(){
    Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
    Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
    Route::post('/update', 'Backend\ProfileController@update')->name('profiles.update');
    Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
    Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
});


//Setup Manage
Route::prefix('setups')->group(function(){

    //Student Class
    Route::get('/student/class/view', 'Backend\Setup\StudentClassController@view')->name('setups.student.class.view');
    Route::get('/student/class/add', 'Backend\Setup\StudentClassController@add')->name('setups.student.class.add');
    Route::post('/student/class/store', 'Backend\Setup\StudentClassController@store')->name('setups.student.class.store');
    Route::get('/student/class/edit/{id}', 'Backend\Setup\StudentClassController@edit')->name('setups.student.class.edit');
    Route::post('/student/class/update/{id}', 'Backend\Setup\StudentClassController@update')->name('setups.student.class.update');
    Route::get('/student/class/delete/{id}', 'Backend\Setup\StudentClassController@delete')->name('setups.student.class.delete');

    //Student Year
    Route::get('/student/year/view', 'Backend\Setup\StudentYearController@view')->name('setups.student.year.view');
    Route::get('/student/year/add', 'Backend\Setup\StudentYearController@add')->name('setups.student.year.add');
    Route::post('/student/year/store', 'Backend\Setup\StudentYearController@store')->name('setups.student.year.store');
    Route::get('/student/year/edit/{id}', 'Backend\Setup\StudentYearController@edit')->name('setups.student.year.edit');
    Route::post('/student/year/update/{id}', 'Backend\Setup\StudentYearController@update')->name('setups.student.year.update');
    Route::get('/student/year/delete/{id}', 'Backend\Setup\StudentYearController@delete')->name('setups.student.year.delete');

    //Student Group
    Route::get('/student/group/view', 'Backend\Setup\StudentGroupController@view')->name('setups.student.group.view');
    Route::get('/student/group/add', 'Backend\Setup\StudentGroupController@add')->name('setups.student.group.add');
    Route::post('/student/group/store', 'Backend\Setup\StudentGroupController@store')->name('setups.student.group.store');
    Route::get('/student/group/edit/{id}', 'Backend\Setup\StudentGroupController@edit')->name('setups.student.group.edit');
    Route::post('/student/group/update/{id}', 'Backend\Setup\StudentGroupController@update')->name('setups.student.group.update');
    Route::get('/student/group/delete/{id}', 'Backend\Setup\StudentGroupController@delete')->name('setups.student.group.delete');

    //Student Group
    Route::get('/student/shift/view', 'Backend\Setup\StudentShiftController@view')->name('setups.student.shift.view');
    Route::get('/student/shift/add', 'Backend\Setup\StudentShiftController@add')->name('setups.student.shift.add');
    Route::post('/student/shift/store', 'Backend\Setup\StudentShiftController@store')->name('setups.student.shift.store');
    Route::get('/student/shift/edit/{id}', 'Backend\Setup\StudentShiftController@edit')->name('setups.student.shift.edit');
    Route::post('/student/shift/update/{id}', 'Backend\Setup\StudentShiftController@update')->name('setups.student.shift.update');
    Route::get('/student/shift/delete/{id}', 'Backend\Setup\StudentShiftController@delete')->name('setups.student.shift.delete');


    //Student Fee Category
    Route::get('/fee/category/view', 'Backend\Setup\FeeCategoryController@view')->name('setups.fee.category.view');
    Route::get('/fee/category/add', 'Backend\Setup\FeeCategoryController@add')->name('setups.fee.category.add');
    Route::post('/fee/category/store', 'Backend\Setup\FeeCategoryController@store')->name('setups.fee.category.store');
    Route::get('/fee/category/edit/{id}', 'Backend\Setup\FeeCategoryController@edit')->name('setups.fee.category.edit');
    Route::post('/fee/category/update/{id}', 'Backend\Setup\FeeCategoryController@update')->name('setups.fee.category.update');
    Route::get('/fee/category/delete/{id}', 'Backend\Setup\FeeCategoryController@delete')->name('setups.fee.category.delete');

    //Student Fee Categoryamount
    Route::get('/fee/amount/view', 'Backend\Setup\FeeAmountController@view')->name('setups.fee.amount.view');
    Route::get('/fee/amount/add', 'Backend\Setup\FeeAmountController@add')->name('setups.fee.amount.add');
    Route::post('/fee/amount/store', 'Backend\Setup\FeeAmountController@store')->name('setups.fee.amount.store');
    Route::get('/fee/amount/edit/{id}', 'Backend\Setup\FeeAmountController@edit')->name('setups.fee.amount.edit');
    Route::post('/fee/amount/update/{id}', 'Backend\Setup\FeeAmountController@update')->name('setups.fee.amount.update');
    Route::get('/fee/amount/details/{id}', 'Backend\Setup\FeeAmountController@details')->name('setups.fee.amount.details');
    Route::get('/fee/amount/delete/{id}', 'Backend\Setup\FeeAmountController@delete')->name('setups.fee.amount.delete');


    //Exam Type
    Route::get('/exam/type/view', 'Backend\Setup\ExamTypeController@view')->name('setups.exam.type.view');
    Route::get('/exam/type/add', 'Backend\Setup\ExamTypeController@add')->name('setups.exam.type.add');
    Route::post('/exam/type/store', 'Backend\Setup\ExamTypeController@store')->name('setups.exam.type.store');
    Route::get('/exam/type/edit/{id}', 'Backend\Setup\ExamTypeController@edit')->name('setups.exam.type.edit');
    Route::post('/exam/type/update/{id}', 'Backend\Setup\ExamTypeController@update')->name('setups.exam.type.update');
    Route::get('/exam/type/delete/{id}', 'Backend\Setup\ExamTypeController@delete')->name('setups.exam.type.delete');

    //Subject
    Route::get('/subject/view', 'Backend\Setup\SubjectController@view')->name('setups.subject.view');
    Route::get('/subject/add', 'Backend\Setup\SubjectController@add')->name('setups.subject.add');
    Route::post('/subject/store', 'Backend\Setup\SubjectController@store')->name('setups.subject.store');
    Route::get('/subject/edit/{id}', 'Backend\Setup\SubjectController@edit')->name('setups.subject.edit');
    Route::post('/subject/update/{id}', 'Backend\Setup\SubjectController@update')->name('setups.subject.update');
    Route::get('/subject/delete/{id}', 'Backend\Setup\SubjectController@delete')->name('setups.subject.delete');


    //Assign Subject
    Route::get('/assign/subject/view', 'Backend\Setup\AssignSubjectController@view')->name('setups.assign.subject.view');
    Route::get('/assign/subject/add', 'Backend\Setup\AssignSubjectController@add')->name('setups.assign.subject.add');
    Route::post('/assign/subject/store', 'Backend\Setup\AssignSubjectController@store')->name('setups.assign.subject.store');
    Route::get('/assign/subject/edit/{id}', 'Backend\Setup\AssignSubjectController@edit')->name('setups.assign.subject.edit');
    Route::post('/assign/subject/update/{id}', 'Backend\Setup\AssignSubjectController@update')->name('setups.assign.subject.update');
    Route::get('/assign/subject/details/{id}', 'Backend\Setup\AssignSubjectController@details')->name('setups.assign.subject.details');
    Route::get('/assign/subject/delete/{id}', 'Backend\Setup\AssignSubjectController@delete')->name('setups.assign.subject.delete');


    //Subject
    Route::get('/designation/view', 'Backend\Setup\DesignationController@view')->name('setups.designation.view');
    Route::get('/designation/add', 'Backend\Setup\DesignationController@add')->name('setups.designation.add');
    Route::post('/designation/store', 'Backend\Setup\DesignationController@store')->name('setups.designation.store');
    Route::get('/designation/edit/{id}', 'Backend\Setup\DesignationController@edit')->name('setups.designation.edit');
    Route::post('/designation/update/{id}', 'Backend\Setup\DesignationController@update')->name('setups.designation.update');
    Route::get('/designation/delete/{id}', 'Backend\Setup\DesignationController@delete')->name('setups.designation.delete');

});


//Students routes
Route::prefix('students')->group(function(){

    //Student Registration
    Route::get('/reg/view', 'Backend\Student\StudentRegController@view')->name('students.registration.view');
    Route::get('/reg/add', 'Backend\Student\StudentRegController@add')->name('students.registration.add');
    Route::post('/reg/store', 'Backend\Student\StudentRegController@store')->name('students.registration.store');
    Route::get('/reg/edit/{student_id}', 'Backend\Student\StudentRegController@edit')->name('students.registration.edit');
    Route::get('/reg/promotion/{student_id}', 'Backend\Student\StudentRegController@promotion')->name('students.registration.promotion');
    Route::post('/reg/promotion/store/{student_id}', 'Backend\Student\StudentRegController@promotionStore')->name('students.registration.promotion.store');
    Route::get('/reg/details/{student_id}', 'Backend\Student\StudentRegController@studentDetails')->name('students.registration.details');
    Route::post('/reg/update/{student_id}', 'Backend\Student\StudentRegController@update')->name('students.registration.update');
    //Route::get('/reg/delete/{id}', 'Backend\Student\StudentRegController@delete')->name('students.registration.delete');
    Route::get('/year-class-wise', 'Backend\Student\StudentRegController@searchStudent')->name('students.registration.seach');

    //Student Roll Generate
    Route::get('/roll/view', 'Backend\Student\StudentRollController@view')->name('students.roll.view');
    Route::get('/roll/get-student', 'Backend\Student\StudentRollController@getStudent')->name('students.roll.get-student');
    Route::post('/roll/store', 'Backend\Student\StudentRollController@store')->name('students.roll.store');

    //Student Registration Fee
    Route::get('/reg/fee/view', 'Backend\Student\RegistrationfeeController@view')->name('students.reg.fee.view');
    Route::get('/reg/get-student/view', 'Backend\Student\RegistrationfeeController@getStudent')->name('students.reg.fee.get-student');
    Route::get('/reg/fee/payslip', 'Backend\Student\RegistrationfeeController@paySlip')->name('student.registration.fee.payslip');

    //Student Monthly Fee
    Route::get('/month/fee/view', 'Backend\Student\MonthlyfeeController@view')->name('students.monthly.fee.view');
    Route::get('/month/get-student/view', 'Backend\Student\MonthlyfeeController@getStudent')->name('students.monthly.fee.get-student');
    Route::get('/month/fee/payslip', 'Backend\Student\MonthlyfeeController@paySlip')->name('student.monthly.fee.payslip');

    //Student Monthly Fee
    Route::get('/exam/fee/view', 'Backend\Student\ExamfeeController@view')->name('students.exam.fee.view');
    Route::get('/exam/get-student/view', 'Backend\Student\ExamfeeController@getStudent')->name('students.exam.fee.get-student');
    Route::get('/exam/fee/payslip', 'Backend\Student\ExamfeeController@paySlip')->name('student.exam.fee.payslip');

});


//Employee routes
Route::prefix('employee')->group(function(){

    //Employee Registration
    Route::get('/reg/view', 'Backend\Employee\EmployeeRegController@view')->name('employee.registration.view');
    Route::get('/reg/add', 'Backend\Employee\EmployeeRegController@add')->name('employee.registration.add');
    Route::post('/reg/store', 'Backend\Employee\EmployeeRegController@store')->name('employee.registration.store');
    Route::get('/reg/edit/{id}', 'Backend\Employee\EmployeeRegController@edit')->name('employee.registration.edit');
    Route::get('/reg/details/{id}', 'Backend\Employee\EmployeeRegController@employeetDetails')->name('employee.registration.details');
    Route::post('/reg/update/{id}', 'Backend\Employee\EmployeeRegController@update')->name('employee.registration.update');
    //Route::get('/reg/delete/{id}', 'Backend\Employee\EmployeeRegController@delete')->name('employee.registration.delete');
    
    //Salary
    Route::get('/salary/view', 'Backend\Employee\EmployeeSalaryController@view')->name('employee.salary.view');
    Route::get('/salary/increment/{id}', 'Backend\Employee\EmployeeSalaryController@increment')->name('employee.salary.increment');
    Route::get('/salary/details/{id}', 'Backend\Employee\EmployeeSalaryController@employeetDetails')->name('employee.salary.details');
    Route::post('/salary/increment/store/{id}', 'Backend\Employee\EmployeeSalaryController@store')->name('employee.salary.store');
    //Route::get('/salary/delete/{id}', 'Backend\Employee\EmployeeSalaryController@delete')->name('employee.salary.delete');

    //Employee Leave
    Route::get('/leave/view', 'Backend\Employee\EmployeeLeaveController@view')->name('employee.leave.view');
    Route::get('/leave/add', 'Backend\Employee\EmployeeLeaveController@add')->name('employee.leave.add');
    Route::post('/leave/store', 'Backend\Employee\EmployeeLeaveController@store')->name('employee.leave.store');
    Route::get('/leave/edit/{id}', 'Backend\Employee\EmployeeLeaveController@edit')->name('employee.leave.edit');
    Route::post('/leave/update/{id}', 'Backend\Employee\EmployeeLeaveController@update')->name('employee.leave.update');

    //Employee Leave
    Route::get('/attendence/view', 'Backend\Employee\EmployeeAttendenceController@view')->name('employee.attendence.view');
    Route::get('/attendence/add', 'Backend\Employee\EmployeeAttendenceController@add')->name('employee.attendence.add');
    Route::post('/attendence/store', 'Backend\Employee\EmployeeAttendenceController@store')->name('employee.attendence.store');
    Route::get('/attendence/edit/{date}', 'Backend\Employee\EmployeeAttendenceController@edit')->name('employee.attendence.edit');
    Route::get('/attendence/details/{date}', 'Backend\Employee\EmployeeAttendenceController@details')->name('employee.attendence.details');

    //Employee Monthly Salary
    Route::get('/monthly/salary/view', 'Backend\Employee\MonthlySalaryController@view')->name('employee.monthly.salary.view');
    Route::get('/monthly/salary/get', 'Backend\Employee\MonthlySalaryController@getSalary')->name('employee.monthly.salary.get');
    Route::get('/monthly/salary/payslip/{employee_id}', 'Backend\Employee\MonthlySalaryController@payslip')->name('employee.monthly.salary.payslip');

});

//Marks Routes
Route::prefix('marks')->group(function(){
    Route::get('/add', 'Backend\Mark\MarksController@add')->name('marks.add');
    Route::post('/store', 'Backend\Mark\MarksController@store')->name('marks.store');
    Route::post('/update', 'Backend\Mark\MarksController@update')->name('marks.update');
    Route::get('/edit', 'Backend\Mark\MarksController@edit')->name('marks.edit');
    Route::get('/get-student-marks', 'Backend\Mark\MarksController@getMarks')->name('get.student.marks');

    //Grade Point

    Route::get('/grade/view', 'Backend\Mark\GradeController@view')->name('marks.grade.view');
    Route::get('/grade/add', 'Backend\Mark\GradeController@add')->name('marks.grade.add');
    Route::post('/grade/store', 'Backend\Mark\GradeController@store')->name('marks.grade.store');
    Route::get('/grade/edit/{id}', 'Backend\Mark\GradeController@edit')->name('marks.grade.edit');
    Route::post('/grade/update/{id}', 'Backend\Mark\GradeController@update')->name('marks.grade.update');
});

//Account Routes
Route::prefix('accounts')->group(function(){
    //Student Fee
    Route::get('/student/fee/view','Backend\Account\StudentFeeController@view')->name('accounts.fee.view');
    Route::get('/student/fee/add','Backend\Account\StudentFeeController@add')->name('accounts.fee.add');
    Route::post('/student/fee/store','Backend\Account\StudentFeeController@store')->name('accounts.fee.store');
    Route::get('/student/getstudent','Backend\Account\StudentFeeController@getStudent')->name('accounts.fee.getstudent');

    //Employee Salary
    Route::get('/employee/salary/view','Backend\Account\SalaryController@view')->name('accounts.salary.view');
    Route::get('/employee/salary/add','Backend\Account\SalaryController@add')->name('accounts.salary.add');
    Route::post('/employee/salary/store','Backend\Account\SalaryController@store')->name('accounts.salary.store');
    Route::get('/employee/get-employee','Backend\Account\SalaryController@getemployee')->name('accounts.salary.get-employee');

    //Employee Salary
    Route::get('/cost/view','Backend\Account\OtherCostController@view')->name('accounts.cost.view');
    Route::get('/cost/add','Backend\Account\OtherCostController@add')->name('accounts.cost.add');
    Route::post('/cost/store','Backend\Account\OtherCostController@store')->name('accounts.cost.store');
    Route::get('/cost/edit/{id}','Backend\Account\OtherCostController@edit')->name('accounts.cost.edit');
    Route::post('/cost/update/{id}','Backend\Account\OtherCostController@update')->name('accounts.cost.update');
    Route::get('/cost/delete/{id}','Backend\Account\OtherCostController@delete')->name('accounts.cost.delete');

});


Route::get('/get-student', 'Backend\DefaultController@getStudent')->name('get.student');
Route::get('/get-subject', 'Backend\DefaultController@getSubject')->name('marks.getSubject');


//Report Routes
Route::prefix('report')->group(function(){
    Route::get('/profit/view', 'Backend\Report\ProfitController@view')->name('report.profit.view');
    Route::get('/profit/get', 'Backend\Report\ProfitController@profit')->name('report.profit.datewise.get');
    Route::get('/profit/pdf', 'Backend\Report\ProfitController@pdf')->name('report.profit.pdf');
    
    //MarkSheet Routes

    Route::get('/marksheet/view', 'Backend\Report\ProfitController@marksheetView')->name('report.marksheet.view');
    Route::get('/marksheet/get', 'Backend\Report\ProfitController@marksheetGet')->name('report.marksheet.get');
    Route::get('/marksheet/get/{id}', 'Backend\Report\ProfitController@marksheetPdf')->name('report.marksheet.pdf');

     //Attendence Routes
    Route::get('/attendence/view', 'Backend\Report\ProfitController@attendenceView')->name('report.attendence.view');
    Route::get('/attendence/get', 'Backend\Report\ProfitController@attendenceGet')->name('report.attendence.get');
    //Id-card Routes

    Route::get('/id-card/view', 'Backend\Report\ProfitController@idCardView')->name('report.id-card.view');
    Route::get('/id-card/get', 'Backend\Report\ProfitController@idCardGet')->name('report.id-card.get');
    
    //Result Route
    Route::get('/result/view', 'Backend\Report\ProfitController@resultView')->name('report.result.view');
    Route::get('/result/get', 'Backend\Report\ProfitController@resultGet')->name('report.result.get');
});



});

