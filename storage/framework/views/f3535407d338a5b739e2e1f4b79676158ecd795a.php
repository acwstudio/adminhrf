<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit an Article</h1>
            <div>

                <form method="post" action="<?php echo e(route('articles.update',$article->id)); ?>">
                    <?php echo method_field('PATCH'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="title">title:</label>
                        <input type="text" class="form-control" name="title" value="<?php echo e($article->title); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="slug">slug:</label>
                        <input type="text" class="form-control" name="slug" value="<?php echo e($article->slug); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="url">url:</label>
                        <input type="text" class="form-control" name="url" value="<?php echo e($article->url); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="announce">announce:</label>
                        <input type="text" class="form-control" name="announce" value="<?php echo e($article->announce); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="body">body:</label>
                        <input type="text" class="form-control" name="body" value="<?php echo e($article->body); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_title">seo_title:</label>
                        <input type="text" class="form-control" name="seo_title" value="<?php echo e($article->seo_title); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_description">seo_description:</label>
                        <input type="text" class="form-control" name="seo_description" value="<?php echo e($article->seo_description); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_keywords">seo_keywords:</label>
                        <input type="text" class="form-control" name="seo_keywords" value="<?php echo e($article->keywords); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_rss">show_in_rss:</label>
                        <input type="number" class="form-control" name="show_in_rss" value="<?php echo e($article->show_in_rss); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="yatextid">yatextid:</label>
                        <input type="number" class="form-control" name="yatextid" value="<?php echo e($article->yatextid); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="status">status:</label>
                        <input type="number" class="form-control" name="status" value="<?php echo e($article->status); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="image_id">image_id:</label>
                        <input type="file" class="form-control" name="image_id" value="<?php echo e($article->image_id); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_main">Jshow_in_main:</label>
                        <input type="number" class="form-control" name="show_in_main" value="<?php echo e($article->show_in_main); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="close_commentations">close_commentations:</label>
                        <input type="number" class="form-control" name="close_commentations" value="<?php echo e($article->close_commentation); ?>"/>
                    </div>
                    <!-- <div class="form-group">
                         <label for="gallery_id">Job Title:</label>
                         <input type="text" class="form-control" name="gallery_id"/>
                     </div> -->
                    <button type="submit" class="btn btn-primary-outline">Update article</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/artembondar/hitsrf-api/resources/views/articles/edit.blade.php ENDPATH**/ ?>