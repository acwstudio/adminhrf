<?php

use App\Http\Controllers\Admin\AllContent\AdminAllContentController;
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
use App\Http\Controllers\Admin\Article\AdminArticlesArticleCategoryRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesArticleCategoryRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleTimlineRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleTimlineRelationshipsController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryArticlesRelatedController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryArticlesRelationshipsController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryController;
use App\Http\Controllers\Admin\Author\AdminAuthorController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyController;
use App\Http\Controllers\Admin\Bookmark\AdminBookmarkController;
use App\Http\Controllers\Admin\Bookmark\AdminBookmarksBookmarkCroupRelatedController;
use App\Http\Controllers\Admin\BookmarkGroup\AdminBookmarkGroupBookmarksRelatedController;
use App\Http\Controllers\Admin\BookmarkGroup\AdminBookmarkGroupController;
use App\Http\Controllers\Admin\Comment\AdminCommentController;
use App\Http\Controllers\Admin\Document\AdminDocumentController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightBookmarksRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightImagesRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightImagesRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightsTagsRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightsTagsRelationshipsController;
use App\Http\Controllers\Admin\Image\AdminImageController;
use App\Http\Controllers\Admin\News\AdminNewsBookmarksRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsBookmarksRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelationshipsController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastImagesRelatedController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastImagesRelationshipsController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastsBookmarksRelatedController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastsBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastsTagsRelatedController;
use App\Http\Controllers\Admin\Podcast\AdminPodcastsTagsRelationshipsController;
use App\Http\Controllers\Admin\Question\AdminQuestionAnswersRelatedController;
use App\Http\Controllers\Admin\Question\AdminQuestionAnswersRelationshipsController;
use App\Http\Controllers\Admin\Question\AdminQuestionController;
use App\Http\Controllers\Admin\Question\AdminQuestionsTestsRelatedController;
use App\Http\Controllers\Admin\Question\AdminQuestionsTestsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagController;
use App\Http\Controllers\Admin\Tag\AdminTagsArticlesRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagsBiographiesRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsDocumentsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsDocumentsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestsQuestionsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestsQuestionsRelationshipsController;
use App\Http\Controllers\Admin\TestCategory\AdminTCategoryController;
use App\Http\Controllers\Admin\TestMessage\AdminMessageController;
use App\Http\Controllers\Admin\TestResult\AdminResultController;
use App\Http\Controllers\Admin\Tag\AdminTagsNewsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsNewsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagsBiographiesRelationshipsController;
use App\Http\Controllers\Admin\BookmarkGroup\AdminBookmarkGroupBookmarksRelationshipsController;
use App\Http\Controllers\Admin\TestResult\AdminResultsTestRelatedController;
use App\Http\Controllers\Admin\TestResult\AdminResultsTestRelationshipsController;
use App\Http\Controllers\Admin\TestResult\AdminResultsUserRelatedController;
use App\Http\Controllers\Admin\Timeline\AdminTimelineArticleRelatedController;
use App\Http\Controllers\Admin\Timeline\AdminTimelineArticleRelationshipsController;
use App\Http\Controllers\Admin\Timeline\AdminTimelineBiographyRelatedController;
use App\Http\Controllers\Admin\Timeline\AdminTimelineController;
use App\Http\Controllers\Admin\Timeline\AdminTimelineBiographyRelationshipsController;
use App\Http\Controllers\Admin\TestResult\AdminResultsUserRelationshipsController;

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

/*****************  ALL CONTENT **************/

Route::apiResource('/all-content', AdminAllContentController::class, ['as' => 'admin']);

/*****************  ARTICLES ROUTES **************/
Route::apiResource('/articles', AdminArticleController::class, ['as' =>'admin']);

// Articles to Article category relations
Route::get('/articles/{article}/relationships/article-category', [
    AdminArticlesArticleCategoryRelationshipsController::class, 'index'
])->name('articles.relationships.article-category');

Route::patch('/articles/{article}/relationships/article-category', [
    AdminArticlesArticleCategoryRelationshipsController::class, 'update'
])->name('articles.relationships.article-category');

Route::get('/articles/{article}/article-category', [
    AdminArticlesArticleCategoryRelatedController::class, 'index'
])->name('articles.article-category');

// Articles to Authors relations
Route::get('/articles/{article}/relationships/authors', [
    AdminArticlesAuthorsRelationshipsController::class, 'index'
])->name('articles.relationships.authors');

Route::patch('/articles/{article}/relationships/authors', [
    AdminArticlesAuthorsRelationshipsController::class, 'update'
])->name('articles.relationships.authors');

Route::get('articles/{article}/authors', [
    AdminArticlesAuthorsRelatedController::class, 'index'
])->name('articles.authors');

// Articles to Bookmarks relations
Route::get('/articles/{article}/relationships/bookmarks', [
    AdminArticleBookmarksRelationshipsController::class, 'index'
])->name('article.relationships.bookmarks');

Route::patch('/articles/{article}/relationships/bookmarks', [
    AdminArticleBookmarksRelationshipsController::class, 'update'
])->name('article.relationships.bookmarks');

Route::get('/articles/{article}/bookmarks', [
    AdminArticleBookmarksRelatedController::class, 'index'
])->name('article.bookmarks');

// Article to Comments relations
Route::get('/articles/{article}/relationships/comments', [
    AdminArticleCommentsRelationshipsController::class, 'index'
])->name('article.relationships.comments');

Route::patch('/articles/{article}/relationships/comments', [
    AdminArticleCommentsRelationshipsController::class, 'update'
])->name('article.relationships.comments');

Route::get('/articles/{article}/comments', [
    AdminArticleCommentsRelatedController::class, 'index'
])->name('article.comments');

// Article to Images relations
Route::get('/articles/{article}/relatioships/images', [
    AdminArticleImagesRelationshipsController::class, 'index'
])->name('article.relationships.images');

Route::patch('/articles/{article}/relatioships/images', [
    AdminArticleImagesRelationshipsController::class, 'update'
])->name('article.relationships.images');

Route::get('/articles/{article}/images', [
    AdminArticleImagesRelatedController::class, 'index'
])->name('article.images');

// Articles to Tags relations
Route::get('/articles/{article}/relationships/tags', [
    AdminArticlesTagsRelationshipsController::class, 'index'
])->name('articles.relationships.tags');

Route::patch('/articles/{article}/relationships/tags', [
    AdminArticlesTagsRelationshipsController::class, 'update'
])->name('articles.relationships.tags');

Route::get('/articles/{article}/tags', [
    AdminArticlesTagsRelatedController::class, 'index'
])->name('articles.tags');

// Article to Timeline relations
Route::get('/articles/{article}/relationships/timeline', [
    AdminArticleTimlineRelationshipsController::class, 'index'
])->name('article.relationships.timeline');

Route::patch('/articles/{article}/relationships/timeline', [
    AdminArticleTimlineRelationshipsController::class, 'update'
])->name('article.relationships.timeline');

Route::get('/articles/{article}/timeline', [
    AdminArticleTimlineRelatedController::class, 'index'
])->name('article.timeline');

/*****************  ARTICLE CATEGORIES ROUTES **************/

Route::apiResource('/article-categories', AdminArticleCategoryController::class, ['as' => 'admin']);

// ArticleCategories to Article relations
Route::get('/article-categories/{article_category}/relationships/articles', [
    AdminArticleCategoryArticlesRelationshipsController::class, 'index'
])->name('article-category.relationships.articles');

Route::patch('/article-categories/{article_category}/relationships/articles', [
    AdminArticleCategoryArticlesRelationshipsController::class, 'update'
])->name('article-category.relationships.articles');

Route::get('/article-categories/{article_category}/articles', [
    AdminArticleCategoryArticlesRelatedController::class, 'index'
])->name('article-category.articles');

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

/*****************  BOOKMARKS ROUTES **************/

Route::apiResource('/bookmarks', AdminBookmarkController::class, ['as' => 'admin']);

// Bookmarks to BookmarkGroup relations
Route::get('/bookmarks/{bookmark}/bookmark-groups', [
    AdminBookmarksBookmarkCroupRelatedController::class, 'index'
])->name('bookmarks.bookmarkgroup');

/*****************  BOOKMARKGROUPS ROUTES **************/

Route::apiResource('/bookmark-groups', AdminBookmarkGroupController::class, ['as' => 'admin']);

// BookmarkGroup to Bookmarks relation
Route::get('/bookmark-groups/{bookmark_groups}/bookmarks', [
    AdminBookmarkGroupBookmarksRelatedController::class, 'index'
])->name('bookmark-group.bookmarks');

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

/*****************  HIGHLIGHTS ROUTES **************/

Route::apiResource('/highlights', AdminHighlightController::class, ['as' => 'admin']);

// Highlight to Images relations
Route::get('/highlights/{highlight}/relationships/images', [
    AdminHighlightImagesRelationshipsController::class, 'index'
])->name('highlight.relationships.images');

Route::patch('/highlights/{highlight}/relationships/images', [
    AdminHighlightImagesRelationshipsController::class, 'update'
])->name('highlight.relationships.images');

Route::get('/highlights/{highlight}/images', [
    AdminHighlightImagesRelatedController::class
])->name('highlight.images');

// Highlights to Tags relations
Route::get('/highlights/{highlight}/relationships/tags', [
    AdminHighlightsTagsRelationshipsController::class, 'index'
])->name('highlights.relationships.tags');

Route::patch('/highlights/{highlight}/relationships/tags', [
    AdminHighlightsTagsRelationshipsController::class, 'update'
])->name('highlights.relationships.tags');

Route::get('/highlights/{highlight}/tags', [
    AdminHighlightsTagsRelatedController::class
])->name('highlights.tags');

// Highlight to Bookmarks relations
Route::get('/highlights/{highlight}/relationships/bookmarks', [
    AdminHighlightBookmarksRelationshipsController::class, 'index'
])->name('highlight.relationships.bookmarks');

Route::patch('/highlights/{highlight}/relationships/bookmarks', [
    AdminHighlightBookmarksRelationshipsController::class, 'update'
])->name('highlight.relationships.bookmarks');

Route::get('/highlights/{highlight}/bookmarks', [
    AdminHighlightBookmarksRelatedController::class
])->name('highlight.bookmarks');

/*****************  MESSAGES ROUTES **************/

Route::apiResource('/messages', AdminMessageController::class, ['as' => 'admin']);

/*****************  NEWS ROUTES **************/

Route::apiResource('/news', AdminNewsController::class, ['as' => 'admin']);

// News to Bookmarks relations
Route::get('/news/{news}/relationships/bookmarks', [
    AdminNewsBookmarksRelationshipsController::class, 'index'
])->name('news.relationships.bookmarks');

Route::patch('/news/{news}/relationships/bookmarks', [
    AdminNewsBookmarksRelationshipsController::class, 'update'
])->name('news.relationships.bookmarks');

Route::get('/news/{news}/bookmarks', [
    AdminNewsBookmarksRelatedController::class, 'index'
])->name('news.bookmarks');

// News to Tags relations
Route::get('/news/{news}/relationships/tags', [
    AdminNewsTagsRelationshipsController::class, 'index'
])->name('news.relationships.tags');

Route::patch('/news/{news}/relationships/tags', [
    AdminNewsTagsRelationshipsController::class, 'update'
])->name('news.relationships.tags');

Route::get('/news/{news}/tags', [
    AdminNewsTagsRelatedController::class, 'index'
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

/*****************  PODCASTS ROUTES **************/

Route::apiResource('/podcasts', AdminPodcastController::class, ['as' => 'admin']);

// Podcasts to Bookmarks relations
Route::get('/podcasts/{podcast}/relationships/bookmarks', [
    AdminPodcastsBookmarksRelationshipsController::class, 'index'
])->name('podcasts.relationships.bookmarks');

Route::patch('/podcasts/{podcast}/relationships/bookmarks', [
    AdminPodcastsBookmarksRelationshipsController::class, 'update'
])->name('podcasts.relationships.bookmarks');

Route::get('/podcasts/{podcast}/bookmarks', [
    AdminPodcastsBookmarksRelatedController::class, 'index'
])->name('podcasts.bookmarks');

// Podcasts to Images relations
Route::get('/podcasts/{podcast}/relationships/images', [
    AdminPodcastImagesRelationshipsController::class, 'index'
])->name('podcast.relationships.images');

Route::patch('/podcasts/{podcast}/relationships/images', [
    AdminPodcastImagesRelationshipsController::class, 'update'
])->name('podcast.relationships.images');

Route::get('/podcasts/{podcast}/images', [
    AdminPodcastImagesRelatedController::class, 'index'
])->name('podcast.images');

// Podcasts to Tags relations
Route::get('/podcasts/{podcast}/relationships/tags', [
    AdminPodcastsTagsRelationshipsController::class, 'index'
])->name('podcasts.relationships.tags');

Route::patch('/podcasts/{podcast}/relationships/tags', [
    AdminPodcastsTagsRelationshipsController::class, 'update'
])->name('podcasts.relationships.tags');

Route::get('/podcasts/{podcast}/tags', [
    AdminPodcastsTagsRelatedController::class, 'index'
])->name('podcasts.tags');

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

// Results to Test relations
Route::get('/results/{result}/relationships/test', [
    AdminResultsTestRelationshipsController::class, 'index'
])->name('results.relationships.test');

Route::patch('/results/{result}/relationships/test', [
    AdminResultsTestRelationshipsController::class, 'update'
])->name('results.relationships.test');

Route::get('/results/{result}/test', [
    AdminResultsTestRelatedController::class, 'index'
])->name('results.test');

// Results to Test relations
Route::get('/results/{result}/relationships/user', [
    AdminResultsUserRelationshipsController::class, 'index'
])->name('results.relationships.user');

Route::patch('/results/{result}/relationships/user', [
    AdminResultsUserRelationshipsController::class, 'update'
])->name('results.relationships.user');

Route::get('/results/{result}/user', [
    AdminResultsUserRelatedController::class, 'index'
])->name('results.user');

/*****************  TAGS ROUTES **************/

Route::apiResource('/tags', AdminTagController::class, ['as' =>'admin']);

// Tags to Articles relations
Route::get('/tags/{tag}/relationships/articles', [
    AdminTagsArticlesRelationshipsController::class, 'index'
])->name('tags.relationships.articles');

Route::patch('/tags/{tag}/relationships/articles', [
    AdminTagsArticlesRelationshipsController::class, 'update'
])->name('tags.relationships.articles');

Route::get('/tags/{tag}/articles', [
    AdminTagsArticlesRelatedController::class, 'index'
])->name('tags.articles');

// Tags to Biographies relations
Route::get('/tags/{tag}/relationships/biographies', [
    AdminTagsBiographiesRelationshipsController::class, 'index'
])->name('tags.relationships.biographies');

Route::patch('/tags/{tag}/relationships/biographies', [
    AdminTagsBiographiesRelationshipsController::class, 'update'
])->name('tags.relationships.biographies');

Route::get('/tags/{tag}/biographies', [
    AdminTagsBiographiesRelatedController::class, 'index'
])->name('tags.biographies');

// Tags to Documents relations
Route::get('/tags/{tag}/relationships/documents', [
    AdminTagsDocumentsRelationshipsController::class, 'index'
])->name('tags.relationships.documents');

Route::patch('/tags/{tag}/relationships/documents', [
    AdminTagsDocumentsRelationshipsController::class, 'update'
])->name('tags.relationships.documents');

Route::get('/tags/{tag}/documents', [
    AdminTagsDocumentsRelatedController::class, 'index'
])->name('tags.documents');

// Tags to News relations
Route::get('/tags/{tag}/relationships/news', [
    AdminTagsNewsRelationshipsController::class, 'index'
])->name('tags.relationships.news');

Route::patch('/tags/{tag}/relationships/news', [
    AdminTagsNewsRelationshipsController::class, 'update'
])->name('tags.relationships.news');

Route::get('/tags/{tag}/news', [
    AdminTagsNewsRelatedController::class, 'index'
])->name('tags.news');

/*****************  TIMELINE ROUTES **************/

Route::apiResource('/timelines', AdminTimelineController::class, ['as' => 'admin']);

// Timeline to Article relations
Route::get('/timelines/{timeline}/relationships/article', [
    AdminTimelineArticleRelationshipsController::class, 'index'
])->name('timeline.relationships.article');

Route::patch('/timelines/{timeline}/relationships/article', [
    AdminTimelineArticleRelationshipsController::class, 'update'
])->name('timeline.relationships.article');

Route::get('/timelines/{timeline}/article', [
    AdminTimelineArticleRelatedController::class, 'index'
])->name('timeline.article');

// Timeline to Biography relations
Route::get('/timelines/{timeline}/relationships/biography', [
    AdminTimelineBiographyRelationshipsController::class, 'index'
])->name('timeline.relationships.biography');

Route::patch('/timelines/{timeline}/relationships/biography', [
    AdminTimelineBiographyRelationshipsController::class, 'update'
])->name('timeline.relationships.biography');

Route::get('/timelines/{timeline}/biography', [
    AdminTimelineBiographyRelatedController::class, 'index'
])->name('timeline.biography');

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
    AdminTestsQuestionsRelatedController::class, 'index'
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


