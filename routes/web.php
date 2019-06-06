<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Routes
Route::get('/home', 'HomeController@index');

// Dashboard Routes
Route::get('/dashboard','DashboardController@index')->name('dashboard');

// Category Routes
Route::post('/category','CategoryController@store');
Route::put('/category/{category}','CategoryController@update');
Route::delete('/category/{category}','CategoryController@destroy')->middleware('auth');
Route::get('/category','CategoryController@index')->name('category');
Route::get('/category/create','CategoryController@create');
Route::get('/category/{id}/edit','CategoryController@edit')->middleware('auth');
Route::get('/category/{category}','CategoryController@show')->middleware('auth');

// Contestant Routes
Route::resource('contestant','ContestantController')->middleware('auth');
Route::get('contestant-selection','ContestantController@contestantSelection')->middleware('auth');

// Criteria Routes
Route::resource('criteria','CriteriaController')->middleware('auth');

// Stages Routes
Route::get('/round','RoundController@home')->middleware('auth');
Route::get('/round/getRounds','RoundController@show')->middleware('auth');
Route::get('/round/getRoundsWithCategories','RoundController@getRoundsWithCategories')->middleware('auth');
Route::get('/round/CategoryRank/{id}','RoundController@getRankPerCategory')->middleware('auth');
Route::get('/round/PercentageStats/{levelid}/{categoryid}','RoundController@getPercentageStats')->middleware('auth');
Route::get('/round/FinakRank/{id}','RoundController@getFinalRanking')->middleware('auth');


// Judges Dashboard
Route::get('/judge-dashboard', 'JudgeDashboard@index')->middleware('auth');
Route::get('/judge-dashboard/getActiveCategory','JudgeDashboard@getActiveCategory');
Route::get('/judge-dashboard/category/{category}', 'JudgeDashboard@show')->middleware('auth');
Route::get('/judge-dashboard/category/criteria/{category}', 'JudgeDashboard@getCriteria')->middleware('auth');
Route::post('/judge-dashboard/rating','JudgeDashboard@createRatingHeader')->middleware('auth');
Route::post('/judge-dashboard/rating-entries','JudgeDashboard@saveRatingEntries')->middleware('auth');

// Judge Preliminary round
//Route::get('/preliminary/{id}', 'PreliminaryCategoryController@index')->middleware('auth');
Route::get('/preliminary/festival-costume', 'PreliminaryCategoryController@festivalcostume')->middleware('auth');
Route::get('/preliminary/cocktail-dress', 'PreliminaryCategoryController@cocktaildress')->middleware('auth');
Route::get('/preliminary/swim-wear', 'PreliminaryCategoryController@swimwear')->middleware('auth');
Route::get('/preliminary/maranao-inspired-gown', 'PreliminaryCategoryController@maranaoinspiredgown')->middleware('auth');
Route::get('/preliminary/prelim-interview', 'PreliminaryCategoryController@preliminterview')->middleware('auth');

// Judges Category
// Route::get('/judge-category/{id}','JudgeCategory@index')->middleware('auth');
Route::get('/judge-category/cocktail-dress','JudgeCategory@CocktailDress')->middleware('auth');
Route::get('/judge-category/festival-costume','JudgeCategory@FestivalCostume')->middleware('auth');
Route::get('/judge-category/swim-wear','JudgeCategory@SwimWear')->middleware('auth');
Route::get('/judge-category/maranao-inspired-gown','JudgeCategory@MaranaoInspiredGown')->middleware('auth');
Route::get('/judge-category/preliminary-interview','JudgeCategory@PreliminaryInterview')->middleware('auth');
Route::get('/judge-category/question-and-answer','JudgeCategory@QA')->middleware('auth');

//Judges Scoreboard
Route::get('/scoreboard','ScoreBoardController@index')->middleware('auth');
Route::get('/scoreboard/getCategories','ScoreBoardController@getScoredCategories')->middleware('auth');
Route::get('/scoreboard/rating-entries/{rating}','ScoreBoardController@getRatingEntries')->middleware('auth');
Route::post('/scoreboard/rating','ScoreBoardController@updateRatings')->middleware('auth');
Route::post('/scoreboard/finalize','ScoreBoardController@finalizeRating')->middleware('auth');
Route::post('/scoreboard/finalizeratings','ScoreBoardController@finalizeRatings')->middleware('auth');
Route::get('/scoreboard/rank','ScoreBoardController@getRank')->middleware('auth');
Route::post('/scoreboard/getCategory/{id}','ScoreBoardController@getCategory')->middleware('auth');

//Judges Individual Rank
Route::post('/scoreboard/question-answer/rank','ScoreBoardController@getQA')->middleware('auth');
Route::post('/scoreboard/preliminary-interview/rank','ScoreBoardController@getPreliminaryInterview')->middleware('auth');
Route::post('/scoreboard/inspired-gown/rank','ScoreBoardController@getInspiredGown')->middleware('auth');
Route::post('/scoreboard/swim-wear/rank','ScoreBoardController@getSwimWear')->middleware('auth');
Route::post('/scoreboard/cocktail-dress/rank','ScoreBoardController@getCocktailDress')->middleware('auth');
Route::post('/scoreboard/festival-costume/rank','ScoreBoardController@getFestivalCostume')->middleware('auth');

//Judges Controller
Route::get('/judges','JudgesController@getJudges')->middleware('auth');
Route::get('/judges/getIndividualRank/{id}','JudgesController@getIndividualRank')->middleware('auth');

Route::get('/judges/qa/{id}','JudgesController@getQA')->middleware('auth');
Route::get('/judges/fc/{id}','JudgesController@getFC')->middleware('auth');
Route::get('/judges/cd/{id}','JudgesController@getCD')->middleware('auth');
Route::get('/judges/sw/{id}','JudgesController@getSW')->middleware('auth');
Route::get('/judges/mi/{id}','JudgesController@getMI')->middleware('auth');
Route::get('/judges/pi/{id}','JudgesController@getPI')->middleware('auth');

//Report Controller
//Route::get('/report/juid/{id}','ReportController@getIndividualRankReportQA')->middleware('auth');
Route::get('/report/qa/{id}','ReportController@getIndividualRankReportQA')->middleware('auth');
Route::get('/report/fc/{id}','ReportController@getIndividualRankReportFC')->middleware('auth');
Route::get('/report/cd/{id}','ReportController@getIndividualRankReportCD')->middleware('auth');
Route::get('/report/sw/{id}','ReportController@getIndividualRankReportSW')->middleware('auth');
Route::get('/report/mi/{id}','ReportController@getIndividualRankReportMI')->middleware('auth');
Route::get('/report/pi/{id}','ReportController@getIndividualRankReportPI')->middleware('auth');

Route::get('/report/final-result/{vwname}','ReportController@getFinalReport')->middleware('auth');
Route::get('/report/festival-costume','ReportController@getFinalReportFC')->middleware('auth');

Route::get('/report/final/{vwname}','ReportController@getFinalRankReport')->middleware('auth');
Route::get('/report/festivalcostume','ReportController@getFinalRankFestivalCostume')->middleware('auth');
Route::get('/report/test','ReportController@testPDF')->middleware('auth');

// Data Controller
Route::get('/data-controller','DataController@index')->middleware('auth');