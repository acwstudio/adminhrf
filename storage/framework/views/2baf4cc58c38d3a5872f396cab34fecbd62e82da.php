<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add an Article</h1>
            <div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><br />
                <?php endif; ?>
                <form method="post" action="<?php echo e(route('article.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="title">First Name:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>

                    <div class="form-group">
                        <label for="slug">Last Name:</label>
                        <input type="text" class="form-control" name="slug"/>
                    </div>

                    <div class="form-group">
                        <label for="url">Email:</label>
                        <input type="text" class="form-control" name="url"/>
                    </div>
                    <div class="form-group">
                        <label for="announce">City:</label>
                        <input type="text" class="form-control" name="announce"/>
                    </div>
                    <div class="form-group">
                        <label for="body">Country:</label>
                        <input type="text" class="form-control" name="body"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_title">Job Title:</label>
                        <input type="text" class="form-control" name="seo_title"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_description">Job Title:</label>
                        <input type="text" class="form-control" name="seo_description"/>
                    </div>
                    <div class="form-group">
                        <label for="seo_keywords">Job Title:</label>
                        <input type="text" class="form-control" name="seo_keywords"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_rss">Job Title:</label>
                        <input type="text" class="form-control" name="show_in_rss"/>
                    </div>
                    <div class="form-group">
                        <label for="yatextid">Job Title:</label>
                        <input type="radio" class="form-control" name="yatextid"/>
                    </div>
                    <div class="form-group">
                        <label for="status">Job Title:</label>
                        <input type="text" class="form-control" name="status"/>
                    </div>
                    <div class="form-group">
                        <label for="image_id">Job Title:</label>
                        <input type="text" class="form-control" name="image_id"/>
                    </div>
                    <div class="form-group">
                        <label for="show_in_main">Job Title:</label>
                        <input type="text" class="form-control" name="show_in_main"/>
                    </div>
                    <div class="form-group">
                        <label for="close_commentations">Job Title:</label>
                        <input type="text" class="form-control" name="close_commentations"/>
                    </div>
                   <!-- <div class="form-group">
                        <label for="gallery_id">Job Title:</label>
                        <input type="text" class="form-control" name="gallery_id"/>
                    </div> -->
                    <button type="submit" class="btn btn-primary-outline">Add contact</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/articles/create.blade.php ENDPATH**/ ?>