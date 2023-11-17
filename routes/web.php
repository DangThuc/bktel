    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\SinhvienController;
    use App\Http\Controllers\TeacherController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\SubjectController;
    use App\Http\Controllers\ImportController;
    use App\Http\Controllers\TeacherToSubjectController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\SetmarkController;
    use App\Http\Controllers\ExportMarkController;
    //use App\Http\Middleware\CheckNullStudent;

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
    Route::get('/getStudentId', function () {
        $role = Auth::user()->sinhvien_id;
        return response()->json($role);
    });
    Route::get('/getTeacherId', function () {
        $role = Auth::user()->teacher_id;
        return response()->json($role);
    });
    
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();
    Route::group(['prefix' => 'home'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
    Route::group(['prefix' => 'sinhvien'], function() {
    Route::get('/create', [App\Http\Controllers\SinhvienController::class, 'create'])->name('sinhvien.create');
    Route::put('/{id}', [App\Http\Controllers\SinhvienController::class, 'update'])->name('sinhvien.update');
    Route::get('/index', [App\Http\Controllers\SinhvienController::class, 'index'])->name('sinhvien.index');
    Route::get('/{id}', [App\Http\Controllers\SinhvienController::class, 'edit'])->name('sinhvien.edit');
    Route::post('/index', [App\Http\Controllers\SinhvienController::class, 'store'])->name('sinhvien.store');
    Route::delete('/{id}', [App\Http\Controllers\SinhvienController::class, 'destroy'])->name('sinhvien.destroy');
});
    Route::group(['prefix' => 'teacher'], function() {
    Route::get('/create', [App\Http\Controllers\TeacherController::class, 'create'])->name('teacher.create');
    Route::put('/{id}', [App\Http\Controllers\TeacherController::class, 'update'])->name('teacher.update');
    Route::get('/index', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/{id}', [App\Http\Controllers\TeacherController::class, 'edit'])->name('teacher.edit');
    Route::post('/index', [App\Http\Controllers\TeacherController::class, 'store'])->name('teacher.store');
    Route::delete('/{id}', [App\Http\Controllers\TeacherController::class, 'destroy'])->name('teacher.destroy');
   
});
Route::group(['prefix' => 'import'], function() {

    Route::get('/teacher', [App\Http\Controllers\ImportController::class, 'importTeacher'])->name('importteacher.create');
    Route::post('/teacher', [App\Http\Controllers\ImportController::class, 'storeTeacher'])->name('importteacher.store');
    Route::get('/student', [App\Http\Controllers\ImportController::class, 'importSinhvien'])->name('importsinhvien.create');
    Route::post('/student', [App\Http\Controllers\ImportController::class, 'storeSinhvien'])->name('importsinhvien.store');
    Route::get('/subject', [App\Http\Controllers\ImportController::class, 'importSubject'])->name('importsubject.create');
    Route::post('/subject', [App\Http\Controllers\ImportController::class, 'storeSubject'])->name('importsubject.store');
});
Route::group(['prefix' => 'subject'], function() {
    Route::get('/create', [App\Http\Controllers\SubjectController::class, 'create'])->name('subject.create');
    Route::post('/index', [App\Http\Controllers\SubjectController::class, 'store'])->name('subject.store');
    Route::get('/index', [App\Http\Controllers\SubjectController::class, 'index'])->name('subject.index');
   
});
Route::group(['prefix' => 'teachertosubject'], function() {
    Route::get('/create', [App\Http\Controllers\TeacherToSubjectController::class, 'create'])->name('teachertosubject.create');
    Route::post('/index', [App\Http\Controllers\TeacherToSubjectController::class, 'store'])->name('teachertosubject.store');
    Route::get('/index', [App\Http\Controllers\TeacherToSubjectController::class, 'index'])->name('teachertosubject.index');
    
    
});

Route::group(['prefix' => 'uploadStudentReport'], function (){
	Route::get('/main', [ReportController::class, 'index'])->name('main');
	Route::post('/search', [ReportController::class, 'postSearch'])->name('search');
	Route::post('/addnew', [ReportController::class, 'confirmation'])->name('addnew');
	Route::post('/imp', [ReportController::class, 'store'])->name('imp.report');
});
Route::group(['prefix' => 'setmark'], function() {
    Route::get('/form-upload-mark', [App\Http\Controllers\SetmarkController::class, 'ShowformUploadMark'])->name('ShowformUploadMark');
    Route::post('/search-report', [App\Http\Controllers\SetmarkController::class, 'SearchReport']);
    Route::post('/search-all-report', [App\Http\Controllers\SetmarkController::class, 'SearchAllReport']);
    Route::get('/download-file-report', [App\Http\Controllers\SetmarkController::class, 'DowloadfileReport']);
    Route::post('/set-mark-report', [App\Http\Controllers\SetmarkController::class, 'SetMarkReport']);
   
});
Route::group(['prefix' => 'exportmark'], function() {
Route::get('/form-export-file-mark', [App\Http\Controllers\ExportMarkController::class, 'FormExportFileMark'])->name('teacher.export.mark.form');
Route::post('/export-file-mark-csv', [App\Http\Controllers\ExportMarkController::class, 'ExportFileMarkCsv'])->name('teacher.export.mark');
Route::post('/search-all-report', [App\Http\Controllers\ExportMarkController::class, 'SearchAllReport']);
});
Route::group(['prefix' => 'profile'], function() {
Route::put('/uploadImg', [App\Http\Controllers\ProfileController::class, 'uploadImg'])->name('profile.uploadImg');
Route::get('/index', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.update');
    
});



Route::get('/api/teachers', [App\Http\Controllers\TeacherToSubjectController::class, 'fetchAllTeacher']);
Route::get('/api/subjects', [App\Http\Controllers\TeacherToSubjectController::class, 'fetchAllSubject']);
  





