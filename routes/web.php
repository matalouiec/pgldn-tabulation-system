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
Route::get('/round/PercentageStats/{id}','RoundController@getPercentageStats')->middleware('auth');
Route::get('/round/FinakRank/{id}','RoundController@getFinalRanking')->middleware('auth');


// Judges Dashboard
Route::get('/judge-dashboard', 'JudgeDashboard@index')->middleware('auth');
Route::get('/judge-dashboard/getActiveCategory','JudgeDashboard@getActiveCategory');
Route::get('/judge-dashboard/category/{category}', 'JudgeDashboard@show')->middleware('auth');
Route::get('/judge-dashboard/category/criteria/{category}', 'JudgeDashboard@getCriteria')->middleware('auth');
Route::post('/judge-dashboard/rating','JudgeDashboard@createRatingHeader')->middleware('auth');
Route::post('/judge-dashboard/rating-entries','JudgeDashboard@saveRatingEntries')->middleware('auth');

// Judge Preliminary round
Route::get('/preliminary/{id}', 'PreliminartCategoryController@index')->middleware('auth');

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

//Report Controller
Route::get('/report/juid/{id}','ReportController@getIndividualRankReport')->middleware('auth');
Route::get('/report/final-result','ReportController@getFinalReport')->middleware('auth');
Route::get('/report/final','ReportController@getFinalRankReport')->middleware('auth');