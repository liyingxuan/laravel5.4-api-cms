var gulp = require('gulp');
var elixir = require('laravel-elixir');

gulp.task('copy', function () {
    // jQuery
    gulp.src("vendor/bower/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js").pipe(gulp.dest("resources/assets/js/"));

    // BootStarp
    gulp.src("vendor/bower/AdminLTE/bootstrap/css/bootstrap.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/bootstrap/js/bootstrap.min.js").pipe(gulp.dest("resources/assets/js/"));

    // AdminLTE
    gulp.src("vendor/bower/AdminLTE/dist/css/AdminLTE.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/dist/css/skins/skin-blue.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/dist/js/app.min.js").pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower/AdminLTE/dist/img/*").pipe(gulp.dest("public/assets/img/"));

    // FontAwesome
    gulp.src("vendor/bower/font-awesome/css/font-awesome.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/font-awesome/fonts/*").pipe(gulp.dest("public/assets/fonts/"));

    // Ion-icons
    gulp.src("vendor/bower/Ionicons/css/ionicons.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/Ionicons/fonts/*").pipe(gulp.dest("public/assets/fonts/"));

    // SlimScroll
    gulp.src("vendor/bower/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js").pipe(gulp.dest("resources/assets/js/"));

    // iCheck
    gulp.src("vendor/bower/AdminLTE/plugins/iCheck/icheck.min.js").pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower/AdminLTE/plugins/iCheck/square/blue.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/plugins/iCheck/square/blue.png").pipe(gulp.dest("public/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/plugins/iCheck/square/blue@2x.png").pipe(gulp.dest("public/assets/css/"));

    // select2
    gulp.src("vendor/bower/AdminLTE/plugins/select2/select2.full.min.js").pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower/AdminLTE/plugins/select2/select2.min.js").pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower/AdminLTE/plugins/select2/select2.min.css").pipe(gulp.dest("resources/assets/css/"));

    // pace
    gulp.src("vendor/bower/AdminLTE/plugins/pace/pace.min.css").pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower/AdminLTE/plugins/pace/pace.min.js").pipe(gulp.dest("resources/assets/js/"));
});

elixir(function(mix) {
    // 合并javascript脚本
    mix.scripts(
        [
            'jquery-2.2.3.min.js',
            'bootstrap.min.js',
            'app.min.js',
            'pace.min.js',
            'jquery.slimscroll.min.js',
            'icheck.min.js',
            'select2.full.min.js',
            'select2.min.js'
        ],
        'public/assets/js/app.js',
        'resources/assets/js/'
    );

    // 合并css脚本
    mix.styles(
        [
            'bootstrap.min.css',
            'pace.min.css',
            'select2.min.css',
            'AdminLTE.min.css',
            'skin-blue.min.css',
            'font-awesome.min.css',
            'ionicons.min.css',
            'blue.css'
        ],
        'public/assets/css/app.css',
        'resources/assets/css/'
    );

    // 运行单元测试
    mix.phpUnit();
});
