<?php $__env->startSection('main'); ?>
    <div class="col-sm-12">

        <?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>
    </div>
    <div>
        <a style="margin: 19px;" href="<?php echo e(route('articles.create')); ?>" class="btn btn-primary">New article</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">articles</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Url</td>
                    <td>Slug</td>
                    <td>Listorder</td>
                    <td>Body</td>
                    <td>Seo_title</td>
                    <td>Seo_description</td>
                    <td>Seo_keywords</td>
                    <td>Show_in_rss</td>
                    <td>Yatextid</td>
                    <td>Status</td>
                    <td>Image_ID</td>
                    <td>Show in main</td>
                    <td>Close commentation</td>
                    <td>Galery ID</td>


                    <td colspan = 2>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($article->id); ?></td>
                        <td><?php echo e($article->title); ?></td>
                        <td><?php echo e($article->url); ?></td>
                        <td><?php echo e($article->slug); ?></td>
                        <td><?php echo e($article->listorder); ?></td>
                        <td><?php echo e($article->body); ?></td>
                        <td><?php echo e($article->seo_title); ?></td>
                        <td><?php echo e($article->seo_description); ?></td>
                        <td><?php echo e($article->seo_keywords); ?></td>
                        <td><?php echo e($article->show_in_rss==true?1:0); ?></td>
                        <td><?php echo e($article->yatextid); ?></td>
                        <td><?php echo e($article->status==true?1:0); ?></td>
                        <td><?php echo e($article->image_id); ?></td>
                        <td><?php echo e($article->show_in_main==true?1:0); ?></td>
                        <td><?php echo e($article->close_commentation==true?0:1); ?></td>
                        <td><?php echo e($article->gallery_id); ?></td>

                        <td>
                            <a href="<?php echo e(route('articles.edit',$article->id)); ?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="<?php echo e(route('articles.destroy', $article->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/artembondar/hitsrf-api/resources/views/articles/index.blade.php ENDPATH**/ ?>