<?php

use App\Http\Controllers\Admin\Answer\AdminAnswerController;
use App\Http\Controllers\Admin\Answer\AdminAnswersQuestionRelatedController;
use App\Http\Controllers\Admin\Answer\AdminAnswersQuestionRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelationshipsController;
use App\Http\Controllers\Admin\Author\AdminAuthorController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyController;
use App\Http\Controllers\Admin\Comment\AdminCommentController;
use App\Http\Controllers\Admin\Document\AdminDocumentController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelationshipsController;
use App\Http\Controllers\Admin\Image\AdminImageController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelationshipsController;
use App\Http\Controllers\Admin\Question\AdminQuestionAnswersRelatedController;
use App\Http\Controllers\Admin\Question\AdminQuestionAnswersRelationshipsController;
use App\Http\Controllers\Admin\Question\AdminQuestionController;
use App\Http\Controllers\Admin\Question\AdminQuestionsTestsRelatedController;
use App\Http\Controllers\Admin\Question\AdminQuestionsTestsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagController;
use App\Http\Controllers\Admin\Tag\AdminTagsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestsQuestionsRelationshipsController;
use App\Http\Controllers\Admin\TestCategory\AdminTCategoryController;
use App\Http\Controllers\Admin\TestMessage\AdminMessageController;
use App\Http\Controllers\Admin\TestResult\AdminResultController;

/*****************  ANSWERS ROUTES **************/
Route::apiResource('/answers', AdminAnswerController::class, ['as' =>'admin']);

// Answer to Questions relations
//Route::get('/answers/{answer}/relationships/question', [
//    AdminAnswersQuestionRelationshipsController::class, 'index'
//])->name('answers.relationships.question');

//Route::patch('/answers/{answer}/relationships/question', [
//    AdminAnswersQuestionRelationshipsController::class, 'update'
//])->name('answers.relationships.question');

Route::get('/answers/{answer}/question', [
    AdminAnswersQuestionRelatedController::class, 'index'
])->name('answers.question');

/*****************  ARTICLES ROUTES **************/
Route::apiResource('/articles', AdminArticleController::class, ['as' =>'admin']);

// Articles to Authors relations
Route::get('/articles/{article}/relatioships/authors', [
    AdminArticlesAuthorsRelationshipsController::class, 'index'
])->name('articles.relationships.authors');

Route::patch('/articles/{article}/relatioships/authors', [
    AdminArticlesAuthorsRelationshipsController::class, 'update'
])->name('articles.relationships.authors');

Route::get('articles/{article}/authors', [
    AdminArticlesAuthorsRelatedController::class, 'index'
])->name('articles.authors');

// Articles to Bookmarks relations
Route::get('/articles/{article}/relatioships/bookmarks', [
    AdminArticleBookmarksRelationshipsController::class, 'index'
])->name('article.relationships.bookmarks');

Route::patch('/articles/{article}/relatioships/bookmarks', [
    AdminArticleBookmarksRelationshipsController::class, 'update'
])->name('article.relationships.bookmarks');

Route::get('/articles/{article}/bookmarks', [
    AdminArticleBookmarksRelatedController::class, 'index'
])->name('article.bookmarks');

// Article to Comments relations
Route::get('/articles/{article}/relatioships/comments', [
    AdminArticleCommentsRelationshipsController::class, 'index'
])->name('article.relationships.comments');

Route::patch('/articles/{article}/relatioships/comments', [
    AdminArticleCommentsRelationshipsController::class, 'update'
])->name('article.relationships.comments');

Route::get('admin/articles/{article}/comments', [
    AdminArticleCommentsRelatedController::class, 'index'
])->name('article.comments');

// Article to Images relations
Route::get('/articles/{article}/relatioships/images', [
    AdminArticleImagesRelationshipsController::class, 'index'
])->name('article.relationships.images');

Route::patch('/articles/{article}/relatioships/images', [
    AdminArticleImagesRelationshipsController::class, 'update'
])->name('article.relationships.images');

Route::get('admin/articles/{article}/images', [
    AdminArticleImagesRelatedController::class, 'index'
])->name('article.images');

// Articles to Tags relations
Route::get('/articles/{article}/relatioships/tags', [
    AdminArticlesTagsRelationshipsController::class, 'index'
])->name('articles.relationships.tags');

Route::patch('/articles/{article}/relatioships/tags', [
    AdminArticlesTagsRelationshipsController::class, 'update'
])->name('articles.relationships.tags');

Route::get('admin/articles/{article}/tags', [
    AdminArticlesTagsRelatedController::class, 'index'
])->name('articles.tags');

/*****************  AUTHORS ROUTES **************/

Route::get('/authors', [AdminAuthorController::class, 'index']);
Route::get('/authors/{author}', [AdminAuthorController::class, 'show'])
    ->name('admin.authors.show');
Route::post('/authors', [AdminAuthorController::class, 'store']);
Route::patch('/authors/{author}', [AdminAuthorController::class, 'update']);
Route::delete('/authors/{author}', [AdminAuthorController::class, 'destroy']);

Route::get('/authors/{author}/relatioships/articles', [
    AdminAuthorsArticlesRelationshipsController::class, 'index'
])->name('authors.relationships.articles');

Route::patch('/authors/{author}/relatioships/articles', [
    AdminAuthorsArticlesRelationshipsController::class, 'update'
])->name('authors.relationships.articles');

Route::get('admin/authors/{author}/articles', [
    AdminAuthorsArticlesRelatedController::class, 'index'
])->name('authors.articles');

/*****************  BIOGRAPHIES ROUTES **************/

Route::get('/biographies', [AdminBiographyController::class, 'index']);
Route::get('/biographies/{biography}', [AdminBiographyController::class, 'show'])
    ->name('admin.biographies.show');
Route::post('/biographies', [AdminBiographyController::class, 'store']);
Route::patch('/biographies/{biography}', [AdminBiographyController::class, 'update']);
Route::delete('/biographies/{biography}', [AdminBiographyController::class, 'destroy']);

// Biography to Comments relations
Route::get('/biographies/{biography}/relationships/comments', [
    AdminBiographyCommentsRelationshipsController::class, 'index'
])->name('biography.relationships.comments');

Route::patch('/biographies/{biography}/relationships/comments', [
    AdminBiographyCommentsRelationshipsController::class, 'update'
])->name('biography.relationships.comments');

Route::get('/biographies/{biography}/comments', [
    AdminBiographyCommentsRelatedController::class, 'index'
])->name('biography.comments');

/*****************  COMMENTS ROUTES **************/

Route::get('/comments', [AdminCommentController::class, 'index']);
Route::get('/comments/{comment}', [AdminCommentController::class, 'show'])
    ->name('admin.comments.show');
//                Route::post('admin/comments', [AdminCommentController::class, 'store']);
//                Route::patch('admin/comments/{comment}', [AdminCommentController::class, 'update']);
//                Route::delete('admin/comments/{comment}', [AdminCommentController::class, 'delete']);

/*****************  DOCUMENTS ROUTES **************/

Route::apiResource('/documents', AdminDocumentController::class, ['as' => 'admin']);

// Documents to Tags relations
Route::get('/documents/{document}/relationships/tags', [
    AdminDocumentsTagsRelationshipsController::class, 'index'
])->name('documents.relationships.tags');

Route::patch('/documents/{document}/relationships/tags', [
    AdminDocumentsTagsRelationshipsController::class, 'update'
])->name('documents.relationships.tags');

Route::get('/documents/{document}/tags', [
    AdminDocumentsTagsRelatedController::class, 'index'
])->name('documents.tags');

/*****************  IMAGES ROUTES **************/

Route::get('/images', [AdminImageController::class, 'index']);
Route::get('/images/{image}', [AdminImageController::class, 'show'])
    ->name('admin.images.show');
Route::post('/images', [AdminImageController::class, 'store']);
Route::patch('/images/{image}', [AdminImageController::class, 'update']);
Route::delete('/images/{image}', [AdminImageController::class, 'destroy']);
Route::post('/images/loader', [AdminImageController::class, 'loadImage']);

/*****************  MESSGES ROUTES **************/

Route::apiResource('/messages', AdminMessageController::class, ['as' => 'admin']);

/*****************  NEWS ROUTES **************/

Route::apiResource('/news', AdminNewsController::class, ['as' => 'admin']);

// News to Tags relations
Route::get('/news/{news}/relationships/tags', [
    AdminNewsTagsRelationshipsController::class, 'index'
])->name('news.relationships.tags');

Route::patch('/news/{news}/relationships/tags', [
    AdminNewsTagsRelationshipsController::class, 'update'
])->name('news.relationships.tags');

Route::get('/news/{news}/tags', [
    AdminNewsTagsRelatedController::class
])->name('news.tags');

// News to Comments relations
Route::get('/news/{news}/relationships/comments', [
    AdminNewsCommentsRelationshipsController::class, 'index'
])->name('news.relationships.comments');

Route::patch('/news/{news}/relationships/comments', [
    AdminNewsCommentsRelationshipsController::class, 'update'
])->name('news.relationships.comments');

Route::get('/news/{news}/comments', [
    AdminNewsCommentsRelatedController::class, 'index'
])->name('news.comments');

// News to Images relations
Route::get('/news/{news}/relationships/images', [
    AdminNewsImagesRelationshipsController::class, 'index'
])->name('news.relationships.images');

Route::patch('/news/{news}/relationships/images', [
    AdminNewsImagesRelationshipsController::class, 'update'
])->name('news.relationships.images');

Route::get('/news/{news}/images', [
    AdminNewsImagesRelatedController::class, 'index'
])->name('news.images');

/*****************  QUESTIONS ROUTES **************/

Route::apiResource('/questions', AdminQuestionController::class, ['as' => 'admin']);

// Questions to Tests relations
Route::get('/questions/{question}/relationships/tests', [
    AdminQuestionsTestsRelationshipsController::class, 'index'
])->name('questions.relationships.tests');

Route::patch('/questions/{question}/relationships/tests', [
    AdminQuestionsTestsRelationshipsController::class, 'update'
])->name('questions.relationships.tests');

Route::get('/questions/{question}/tests', [
    AdminQuestionsTestsRelatedController::class, 'index'
])->name('questions.tests');

// Question to Answers relations
Route::get('/questions/{question}/relationships/answers', [
    AdminQuestionAnswersRelationshipsController::class, 'index'
])->name('question.relationships.answers');

Route::patch('/questions/{question}/relationships/answers', [
    AdminQuestionAnswersRelationshipsController::class, 'update'
])->name('question.relationships.answers');

Route::get('/questions/{question}/answers', [
    AdminQuestionAnswersRelatedController::class, 'index'
])->name('question.answers');

/*****************  RESULTS ROUTES **************/

Route::apiResource('/results', AdminResultController::class, ['as' =>'admin']);

/*****************  TAGS ROUTES **************/

Route::apiResource('/tags', AdminTagController::class, ['as' =>'admin']);

// Tags to Articles relations
Route::get('/tags/{tag}/relatioships/articles', [
    AdminTagsArticlesRelationshipsController::class, 'index'
])->name('tags.relationships.articles');

Route::patch('/tags/{tag}/relatioships/articles', [
    AdminTagsArticlesRelationshipsController::class, 'update'
])->name('tags.relationships.articles');

Route::get('/tags/{tag}/articles', [
    AdminArticlesTagsRelatedController::class, 'index'
])->name('tags.articles');

/*****************  TESTS ROUTES **************/

Route::apiResource('/tests', AdminTestController::class, ['as' =>'admin']);

// Test to Comments relations
Route::get('/tests/{test}/relationships/comments', [
    AdminTestCommentsRelationshipsController::class, 'index'
])->name('test.relationships.comments');

Route::patch('/tests/{test}/relationships/comments', [
    AdminTestCommentsRelationshipsController::class, 'update'
])->name('test.relationships.comments');

Route::get('/tests/{test}/comments', [
    AdminTestCommentsRelatedController::class, 'index'
])->name('test.comments');

// Test to Images relations
Route::get('/tests/{test}/relationships/images', [
    AdminTestImagesRelationshipsController::class, 'index'
])->name('test.relationships.images');

Route::patch('/tests/{test}/relationships/images', [
    AdminTestImagesRelationshipsController::class, 'update'
])->name('test.relationships.images');

Route::get('/tests/{test}/images', [
    AdminTestImagesRelatedController::class, 'index'
])->name('test.images');

// Test to Messages relations
Route::get('/tests/{test}/relationships/messages', [
    AdminTestMessagesRelationshipsController::class, 'index'
])->name('test.relationships.messages');

Route::patch('/tests/{test}/relationships/messages', [
    AdminTestMessagesRelationshipsController::class, 'update'
])->name('test.relationships.messages');

Route::get('/tests/{test}/messages', [
    AdminTestMessagesRelatedController::class, 'index'
])->name('test.messages');

// Tests to Questions relations
Route::get('/tests/{test}/relationships/questions', [
    AdminTestsQuestionsRelationshipsController::class, 'index'
])->name('tests.relationships.questions');

Route::patch('/tests/{test}/relationships/questions', [
    AdminTestsQuestionsRelationshipsController::class, 'update'
])->name('tests.relationships.questions');

Route::get('/tests/{test}/questions', [
    AdminTestImagesRelatedController::class, 'index'
])->name('tests.questions');

// Tests to Results relations
Route::get('/tests/{test}/relationships/results', [
    AdminTestResultsRelationshipsController::class, 'index'
])->name('test.relationships.results');

Route::patch('/tests/{test}/relationships/results', [
    AdminTestResultsRelationshipsController::class, 'update'
])->name('test.relationships.results');

Route::get('/tests/{test}/results', [
    AdminTestResultsRelatedController::class, 'index'
])->name('test.results');

/*****************  TESTS CATEGORIES ROUTES **************/

Route::apiResource('/test-categories', AdminTCategoryController::class, ['as' => 'admin']);


