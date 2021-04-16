<?php

use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialBookmarksRelatedController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialImagesRelatedController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialImagesRelationshipsController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialsTagsRelatedController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialsTagsRelationshipsController;
use App\Http\Controllers\Admin\Author\AdminAuthorImageRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorImageRelationshipsController;
use App\Http\Controllers\Admin\Author\AdminAuthorsVideomaterialsRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorsVideomaterialsRelationshipsController;
use App\Http\Controllers\Admin\BioCategory\AdminBioCategoriesBiographiesRelatedController;
use App\Http\Controllers\Admin\BioCategory\AdminBioCategoriesBiographiesRelationshipsController;
//use App\Http\Controllers\Admin\BioCategory\AdminBioCategoryController;
use App\Http\Controllers\Admin\Biography\AdminBiographiesTagsRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographiesTagsRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyBookmarksRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyImagesRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyImagesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyTimelineRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyTimelineRelationshipsController;
use App\Http\Controllers\Admin\Document\AdminDocumentBookmarksRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Document\AdminDocumentsDocumentCategoryRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentsDocumentCategoryRelationshipsController;
use App\Http\Controllers\Admin\Image\AdminImageController;
use App\Http\Controllers\Admin\AllContent\AdminAllContentController;
use App\Http\Controllers\Admin\Answer\AdminAnswerController;
use App\Http\Controllers\Admin\Answer\AdminAnswersQuestionRelatedController;
use App\Http\Controllers\Admin\Answer\AdminAnswersQuestionRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelationshipsController;
//use App\Http\Controllers\Admin\Article\AdminArticleController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesArticleCategoryRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesArticleCategoryRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleTimelineRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleTimelineRelationshipsController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryArticlesRelatedController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryArticlesRelationshipsController;
use App\Http\Controllers\Admin\ArticleCategory\AdminArticleCategoryController;
use App\Http\Controllers\Admin\Author\AdminAuthorController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographiesBioCategoriesRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographiesBioCategoriesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyController;
use App\Http\Controllers\Admin\Bookmark\AdminBookmarkController;
use App\Http\Controllers\Admin\Bookmark\AdminBookmarksBookmarkCroupRelatedController;
use App\Http\Controllers\Admin\BookmarkGroup\AdminBookmarkGroupBookmarksRelatedController;
use App\Http\Controllers\Admin\BookmarkGroup\AdminBookmarkGroupController;
//use App\Http\Controllers\Admin\Comment\AdminCommentController;
use App\Http\Controllers\Admin\Document\AdminDocumentController;
use App\Http\Controllers\Admin\Document\AdminDocumentImagesRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentImagesRelationshipsController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelatedController;
use App\Http\Controllers\Admin\Document\AdminDocumentsTagsRelationshipsController;
use App\Http\Controllers\Admin\DocumentCategory\AdminDocumentCategoryDocumentsRelatedController;
use App\Http\Controllers\Admin\DocumentCategory\AdminDocumentCategoryDocumentsRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightHighlightablesRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightHighlightablesRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightImagesRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightImagesRelationshipsController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightsTagsRelatedController;
use App\Http\Controllers\Admin\Highlight\AdminHighlightsTagsRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsBookmarksRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsBookmarksRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsCommentsRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsImagesRelationshipsController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelatedController;
use App\Http\Controllers\Admin\News\AdminNewsTagsRelationshipsController;
use App\Http\Controllers\Admin\Pdf\AdminPdfController;
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
use App\Http\Controllers\Admin\Tag\AdminTagsAudiomaterialsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsAudiomaterialsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagsBiographiesRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsDocumentsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsDocumentsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagsHighlightsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsHighlightsRelationshipsController;
use App\Http\Controllers\Admin\Tag\AdminTagsVideomaterialsRelatedController;
use App\Http\Controllers\Admin\Tag\AdminTagsVideomaterialsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestLikesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestLikesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestMessagesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestResultsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestsQuestionsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestsQuestionsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestsTCategoriesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestsTCategoriesRelationshipsController;
use App\Http\Controllers\Admin\TestCategory\AdminTestCategoriesTestsRelatedController;
use App\Http\Controllers\Admin\TestCategory\AdminTestCategoriesTestsRelationshipsController;
use App\Http\Controllers\Admin\TestCategory\AdminTestCategoryController;
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
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialImagesRelatedController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialImagesRelationshipsController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialsAuthorsRelatedController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialsAuthorsRelationshipsController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialsTagsRelatedController;
use App\Http\Controllers\Admin\Videomaterial\AdminVideomaterialsTagsRelationshipsController;
use App\Http\Controllers\Admin\Audiomaterial\AdminAudiomaterialController;

/*****************  ANSWERS ROUTES **************/
Route::apiResource('/answers', AdminAnswerController::class, ['as' =>'admin']);

// Answer to Questions relations
Route::get('/answers/{answer}/relationships/question', [
    AdminAnswersQuestionRelationshipsController::class, 'index'
])->name('answers.relationships.question');

Route::patch('/answers/{answer}/relationships/question', [
    AdminAnswersQuestionRelationshipsController::class, 'update'
])->name('answers.relationships.question');

Route::get('/answers/{answer}/question', [
    AdminAnswersQuestionRelatedController::class, 'index'
])->name('answers.question');

/*****************  ALL CONTENT **************/

Route::apiResource('/all-content', AdminAllContentController::class, ['as' => 'admin']);

/*****************  ARTICLES ROUTES **************/
Route::apiResource('/articles', \App\Http\Controllers\Admin\Article\AdminArticleController::class, ['as' =>'admin']);

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
    AdminArticleTimelineRelationshipsController::class, 'index'
])->name('article.relationships.timeline');

Route::patch('/articles/{article}/relationships/timeline', [
    AdminArticleTimelineRelationshipsController::class, 'update'
])->name('article.relationships.timeline');

Route::get('/articles/{article}/timeline', [
    AdminArticleTimelineRelatedController::class, 'index'
])->name('article.timeline');

/*****************  ARTICLE CATEGORIES ROUTES **************/

Route::apiResource('/article-categories', AdminArticleCategoryController::class, ['as' => 'admin']);

Route::get('/article-categories-light', [AdminArticleCategoryController::class, 'light']);

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

/*****************  AUDIOMATERIALS ROUTES **************/

Route::apiResource('/audiomaterials', AdminAudiomaterialController::class, ['as' => 'admin']);

// Audiomaterials to Tags relations
Route::get('/audiomaterials/{audiomaterial}/relationships/tags', [
    AdminAudiomaterialsTagsRelationshipsController::class, 'index'
])->name('audiomaterials.relationships.tags');

Route::patch('/audiomaterials/{audiomaterial}/relationships/tags', [
    AdminAudiomaterialsTagsRelationshipsController::class, 'update'
])->name('audiomaterials.relationships.tags');

Route::get('/audiomaterials/{audiomaterial}/tags', [
    AdminAudiomaterialsTagsRelatedController::class, 'index'
])->name('audiomaterials.tags');

// Audiomaterial to Images relations
Route::get('/audiomaterials/{audiomaterial}/relationships/images', [
    AdminAudiomaterialImagesRelationshipsController::class, 'index'
])->name('audiomaterial.relationships.images');

Route::patch('/audiomaterials/{audiomaterial}/relationships/images', [
    AdminAudiomaterialImagesRelationshipsController::class, 'update'
])->name('audiomaterial.relationships.images');

Route::get('/audiomaterials/{audiomaterial}/images', [
    AdminAudiomaterialImagesRelatedController::class, 'index'
])->name('audiomaterial.images');

// Audiomaterial to Bookmarks relations
Route::get('/audiomaterials/{audiomaterial}/relationships/bookmarks', [
    AdminAudiomaterialBookmarksRelationshipsController::class, 'index'
])->name('audiomaterial.relationships.bookmarks');

Route::patch('/audiomaterials/{audiomaterial}/relationships/bookmarks', [
    AdminAudiomaterialBookmarksRelationshipsController::class, 'update'
])->name('audiomaterial.relationships.bookmarks');

Route::get('/audiomaterials/{audiomaterial}/bookmarks', [
    AdminAudiomaterialBookmarksRelatedController::class, 'index'
])->name('audiomaterial.bookmarks');

/*****************  AUTHORS ROUTES **************/

Route::apiResource('/authors', AdminAuthorController::class, ['as' => 'admin']);

Route::get('/authors-light', [AdminAuthorController::class, 'light']);

// Authors to Articles relations
Route::get('/authors/{author}/relatioships/articles', [
    AdminAuthorsArticlesRelationshipsController::class, 'index'
])->name('authors.relationships.articles');

Route::patch('/authors/{author}/relatioships/articles', [
    AdminAuthorsArticlesRelationshipsController::class, 'update'
])->name('authors.relationships.articles');

Route::get('/authors/{author}/articles', [
    AdminAuthorsArticlesRelatedController::class, 'index'
])->name('authors.articles');

// Author to Image relations
Route::get('/authors/{author}/relatioships/image', [
    AdminAuthorImageRelationshipsController::class, 'index'
])->name('author.relationships.image');

Route::patch('/authors/{author}/relatioships/image', [
    AdminAuthorImageRelationshipsController::class, 'update'
])->name('author.relationships.image');

Route::get('/authors/{author}/image', [
    AdminAuthorImageRelatedController::class, 'index'
])->name('author.image');

// Authors to Videomaterials relations
Route::get('/authors/{author}/relatioships/videomaterials', [
    AdminAuthorsVideomaterialsRelationshipsController::class, 'index'
])->name('authors.relationships.videomaterials');

Route::patch('/authors/{author}/relatioships/videomaterials', [
    AdminAuthorsVideomaterialsRelationshipsController::class, 'update'
])->name('authors.relationships.videomaterials');

Route::get('/authors/{author}/videomaterials', [
    AdminAuthorsVideomaterialsRelatedController::class, 'index'
])->name('authors.videomaterials');

/*****************  BIOCATEGORIES ROUTES **************/

Route::apiResource(
    '/biocategories',
    \App\Http\Controllers\Admin\BioCategory\AdminBioCategoryController::class,
    ['as' => 'admin']
);

// Biocategory to Biographies relations
Route::get('/biocategories/{biocategory}/relationships/biographies', [
    AdminBioCategoriesBiographiesRelationshipsController::class, 'index'
])->name('biocategories.relationships.biographies');

Route::patch('/biocategories/{biocategory}/relationships/biographies', [
    AdminBioCategoriesBiographiesRelationshipsController::class, 'update'
])->name('biocategories.relationships.biographies');

Route::get('/biocategories/{biocategory}/biographies', [
    AdminBioCategoriesBiographiesRelatedController::class, 'index'
])->name('biocategories.biographies');

/*****************  BIOGRAPHIES ROUTES **************/

Route::apiResource('/biographies', AdminBiographyController::class, ['as' => 'admin']);

// Biography to Biocategory relations
Route::get('/biographies/{biography}/relationships/biocategories', [
    AdminBiographiesBioCategoriesRelationshipsController::class, 'index'
])->name('biographies.relationships.biocategories');

Route::patch('/biographies/{biography}/relationships/biocategories', [
    AdminBiographiesBioCategoriesRelationshipsController::class, 'update'
])->name('biographies.relationships.biocategories');

Route::get('/biographies/{biography}/biocategories', [
    AdminBiographiesBioCategoriesRelatedController::class, 'index'
])->name('biographies.biocategories');

// Biography to Bookmarks relations
Route::get('/biographies/{biography}/relationships/bookmarks', [
    AdminBiographyBookmarksRelationshipsController::class, 'index'
])->name('biography.relationships.bookmarks');

Route::patch('/biographies/{biography}/relationships/bookmarks', [
    AdminBiographyBookmarksRelationshipsController::class, 'update'
])->name('biography.relationships.bookmarks');

Route::get('/biographies/{biography}/bookmarks', [
    AdminBiographyBookmarksRelatedController::class, 'index'
])->name('biography.bookmarks');

// Biography to Images relations
Route::get('/biographies/{biography}/relationships/images', [
    AdminBiographyImagesRelationshipsController::class, 'index'
])->name('biography.relationships.images');

Route::patch('/biographies/{biography}/relationships/images', [
    AdminBiographyImagesRelationshipsController::class, 'update'
])->name('biography.relationships.images');

Route::get('/biographies/{biography}/images', [
    AdminBiographyImagesRelatedController::class, 'index'
])->name('biography.images');

// Biography to Tags relations
Route::get('/biographies/{biography}/relationships/tags', [
    AdminBiographiesTagsRelationshipsController::class, 'index'
])->name('biographies.relationships.tags');

Route::patch('/biographies/{biography}/relationships/tags', [
    AdminBiographiesTagsRelationshipsController::class, 'update'
])->name('biographies.relationships.tags');

Route::get('/biographies/{biography}/tags', [
    AdminBiographiesTagsRelatedController::class, 'index'
])->name('biographies.tags');

// Biography to Timeline relations
Route::get('/biographies/{biography}/relationships/timeline', [
    AdminBiographyTimelineRelationshipsController::class, 'index'
])->name('biography.relationships.timeline');

Route::patch('/biographies/{biography}/relationships/timeline', [
    AdminBiographyTimelineRelationshipsController::class, 'update'
])->name('biography.relationships.timeline');

Route::get('/biographies/{biography}/timeline', [
    AdminBiographyTimelineRelatedController::class, 'index'
])->name('biography.timeline');

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

Route::apiResource(
    '/comments',
    \App\Http\Controllers\Admin\Comment\AdminCommentController::class,
    ['as' => 'admin']
);

/*****************  DOCUMENT CATEGORIES ROUTES **************/

Route::apiResource(
    '/document-categories',
    \App\Http\Controllers\Admin\DocumentCategory\AdminDocumentCategoryController::class,
    ['as' => 'admin']
);

Route::get('/document-categories-light', [
    \App\Http\Controllers\Admin\DocumentCategory\AdminDocumentCategoryController::class, 'light'
]);

// Document Category to Documents relations
Route::get('/document-categories/{document_category}/relationships/documents', [
    AdminDocumentCategoryDocumentsRelationshipsController::class, 'index'
])->name('document-category.relationships.documents');

Route::patch('/document-categories/{document_category}/relationships/documents', [
    AdminDocumentCategoryDocumentsRelationshipsController::class, 'update'
])->name('document-category.relationships.documents');

Route::get('/document-categories/{document_category}/documents', [
    AdminDocumentCategoryDocumentsRelatedController::class, 'index'
])->name('document-category.documents');

/*****************  DOCUMENTS ROUTES **************/

Route::apiResource('/documents', AdminDocumentController::class, ['as' => 'admin']);

Route::post('/documents/pdf', [AdminPdfController::class, 'store'])->name('document.pdf.store');
Route::post('/documents/pdf/{document}', [AdminPdfController::class, 'update'])->name('document.pdf.update');

// Documents to Document Category relations
Route::get('/documents/{document}/relationships/document-category', [
    AdminDocumentsDocumentCategoryRelationshipsController::class, 'index'
])->name('document.relationships.document-category');

Route::patch('/documents/{document}/relationships/document-category', [
    AdminDocumentsDocumentCategoryRelationshipsController::class, 'update'
])->name('document.relationships.document-category');

Route::get('/documents/{document}/document-category', [
    AdminDocumentsDocumentCategoryRelatedController::class, 'index'
])->name('document.document-category');


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

// Document to Images relations
Route::get('/documents/{document}/relationships/images', [
    AdminDocumentImagesRelationshipsController::class, 'index'
])->name('document.relationships.images');

Route::patch('/documents/{document}/relationships/images', [
    AdminDocumentImagesRelationshipsController::class, 'update'
])->name('document.relationships.images');

Route::get('/documents/{document}/images', [
    AdminDocumentImagesRelatedController::class, 'index'
])->name('document.images');

// Document to Bookmarks relations
Route::get('/documents/{document}/relationships/bookmarks', [
    AdminDocumentBookmarksRelationshipsController::class, 'index'
])->name('document.relationships.bookmarks');

Route::patch('/documents/{document}/relationships/bookmarks', [
    AdminDocumentBookmarksRelationshipsController::class, 'update'
])->name('document.relationships.bookmarks');

Route::get('/documents/{document}/bookmarks', [
    AdminDocumentBookmarksRelatedController::class, 'index'
])->name('document.bookmarks');

/*****************  IMAGES ROUTES **************/

Route::get('/images/{image}', [AdminImageController::class, 'show'])->name('image.show');
Route::post('/images', [AdminImageController::class, 'store'])->name('image.store');
Route::post('/images/{image}', [AdminImageController::class, 'update'])->name('image.update');
Route::delete('/images/{image}', [AdminImageController::class, 'destroy'])->name('image.destroy');

/*****************  Likes ROUTES **************/

Route::apiResource('/likes', \App\Http\Controllers\Admin\Like\AdminLikeController::class,['as' => 'admin']);

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
Route::get('/highlights/{highlight}/relationships/highlightables', [
    AdminHighlightHighlightablesRelationshipsController::class, 'index'
])->name('highlights.relationships.highlightables');

Route::patch('/highlights/{highlight}/relationships/highlightables', [
    AdminHighlightHighlightablesRelationshipsController::class, 'update'
])->name('highlights.relationships.highlightables');

Route::get('/highlights/{highlight}/highlightables', [
    AdminHighlightHighlightablesRelatedController::class
])->name('highlights.highlightables');

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
])->name('podcast.relationships.bookmarks');

Route::patch('/podcasts/{podcast}/relationships/bookmarks', [
    AdminPodcastsBookmarksRelationshipsController::class, 'update'
])->name('podcast.relationships.bookmarks');

Route::get('/podcasts/{podcast}/bookmarks', [
    AdminPodcastsBookmarksRelatedController::class, 'index'
])->name('podcast.bookmarks');

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

Route::get('/tags-light', [AdminTagController::class, 'light']);

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

// Tags to Audiomaterials relations
Route::get('/tags/{tag}/relationships/audiomaterials', [
    AdminTagsAudiomaterialsRelationshipsController::class, 'index'
])->name('tags.relationships.audiomaterials');

Route::patch('/tags/{tag}/relationships/audiomaterials', [
    AdminTagsAudiomaterialsRelationshipsController::class, 'update'
])->name('tags.relationships.audiomaterials');

Route::get('/tags/{tag}/audiomaterials', [
    AdminTagsAudiomaterialsRelatedController::class, 'index'
])->name('tags.audiomaterials');

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

// Tags to Highlights relations
Route::get('/tags/{tag}/relationships/highlights', [
    AdminTagsHighlightsRelationshipsController::class, 'index'
])->name('tags.relationships.highlights');

Route::patch('/tags/{tag}/relationships/highlights', [
    AdminTagsHighlightsRelationshipsController::class, 'update'
])->name('tags.relationships.highlights');

Route::get('/tags/{tag}/highlights', [
    AdminTagsHighlightsRelatedController::class, 'index'
])->name('tags.highlights');

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

// Tags to Videomaterials relations
Route::get('/tags/{tag}/relationships/videomaterials', [
    AdminTagsVideomaterialsRelationshipsController::class, 'index'
])->name('tags.relationships.videomaterials');

Route::patch('/tags/{tag}/relationships/videomaterials', [
    AdminTagsVideomaterialsRelationshipsController::class, 'update'
])->name('tags.relationships.videomaterials');

Route::get('/tags/{tag}/videomaterials', [
    AdminTagsVideomaterialsRelatedController::class, 'index'
])->name('tags.videomaterials');

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

// Test to Likes relations
Route::get('/tests/{test}/relationships/likes', [
    AdminTestLikesRelationshipsController::class, 'index'
])->name('test.relationships.likes');

Route::patch('/tests/{test}/relationships/likes', [
    AdminTestLikesRelationshipsController::class, 'update'
])->name('test.relationships.likes');

Route::get('/tests/{test}/likes', [
    AdminTestLikesRelatedController::class, 'index'
])->name('test.likes');

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

// Tests to Tests Categories relations
Route::get('/tests/{test}/relationships/test-categories', [
    AdminTestsTCategoriesRelationshipsController::class, 'index'
])->name('tests.relationships.test-categories');

Route::patch('/tests/{test}/relationships/test-categories', [
    AdminTestsTCategoriesRelationshipsController::class, 'update'
])->name('tests.relationships.test-categories');

Route::get('/tests/{test}/test-categories', [
    AdminTestsTCategoriesRelatedController::class, 'index'
])->name('tests.test-categories');

/*****************  TESTS CATEGORIES ROUTES **************/

Route::apiResource('/test-categories', AdminTestCategoryController::class, ['as' => 'admin']);

Route::get('/test-categories-light', [AdminTestCategoryController::class, 'light']);

// Tests Categories to Tests relations
Route::get('/test-categories/{test_category}/relationships/tests', [
    AdminTestCategoriesTestsRelationshipsController::class, 'index'
])->name('test-categories.relationships.tests');

Route::patch('/test-categories/{test_category}/relationships/tests', [
    AdminTestCategoriesTestsRelationshipsController::class, 'update'
])->name('test-categories.relationships.tests');

Route::patch('/test-categories/{test_category}/tests', [
    AdminTestCategoriesTestsRelatedController::class, 'index'
])->name('test-categories.tests');

/*****************  VIDEOMATERIALS ROUTES **************/

Route::apiResource('/videomaterials', AdminVideomaterialController::class, ['as' => 'admin']);

// Videomaterials to Authors relations
Route::get('/videomaterials/{videomaterial}/relationships/authors', [
    AdminVideomaterialsAuthorsRelationshipsController::class, 'index'
])->name('videomaterials.relationships.authors');

Route::patch('/videomaterials/{videomaterial}/relationships/authors', [
    AdminVideomaterialsAuthorsRelationshipsController::class, 'update'
])->name('videomaterials.relationships.authors');

Route::get('/videomaterials/{videomaterial}/authors', [
    AdminVideomaterialsAuthorsRelatedController::class, 'index'
])->name('videomaterials.authors');

// Videomaterial to Images relations
Route::get('/videomaterials/{videomaterial}/relationships/images', [
    AdminVideomaterialImagesRelationshipsController::class, 'index'
])->name('videomaterial.relationships.images');

Route::patch('/videomaterials/{videomaterial}/relationships/images', [
    AdminVideomaterialImagesRelationshipsController::class, 'update'
])->name('videomaterial.relationships.images');

Route::get('/videomaterials/{videomaterial}/images', [
    AdminVideomaterialImagesRelatedController::class, 'index'
])->name('videomaterial.images');

// Videomaterials to Tags relations
Route::get('/videomaterials/{videomaterial}/relationships/tags', [
    AdminVideomaterialsTagsRelationshipsController::class, 'index'
])->name('videomaterials.relationships.tags');

Route::patch('/videomaterials/{videomaterial}/relationships/tags', [
    AdminVideomaterialsTagsRelationshipsController::class, 'update'
])->name('videomaterials.relationships.tags');

Route::get('/videomaterials/{videomaterial}/tags', [
    AdminVideomaterialsTagsRelatedController::class, 'index'
])->name('videomaterials.tags');
