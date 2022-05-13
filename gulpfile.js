const gulp = require('gulp')
const browserify = require('browserify')
const source = require('vinyl-source-stream')
const tsify = require('tsify')
const uglify = require('gulp-uglify')
const sourcemaps = require('gulp-sourcemaps')
const buffer = require('vinyl-buffer')
const sass = require('gulp-sass')
const cleanCss = require('gulp-clean-css')
const rename = require('gulp-rename')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const gcPub = require('gulp-gcloud-publish')
const eslint = require('gulp-eslint')
const ts = require('gulp-typescript')

const tsconfig = require('./tsconfig.json')
const tsProject = ts.createProject('./tsconfig.json')

const names = {
  bundleName: 'ftmo-ui.bundle',
  bundleNameDemo: 'ftmo-ui-demo.bundle',
  bundleNameIcons: 'icons.bundle',
  declarationsName: 'ftmo-ui'
}

const paths = {
  cssSrc: 'src/styles/index.scss',
  cssSrcProd: 'src/styles/index-prod.scss',
  cssDist: 'dist/ftmo-ui/styles/',
  jsSrc: 'src/scripts/index.ts',
  jsDist: 'dist/ftmo-ui/scripts/',
  jsSrcDeclare: 'src/scripts/**/*.ts',
  jsDistDeclare: 'dist/types/',
  jsSrcDemo: 'src_demo/scripts/index.ts',
  jsDistDemo: 'dist/ftmo-ui-demo/scripts/',
  cssSrcDemo: 'src_demo/styles/index.scss',
  cssDistDemo: 'dist/ftmo-ui-demo/styles/',
  iconsSrc: 'src/styles/index-icons.scss',
  iconsDist: 'dist/ftmo-ui/styles/',
  gcSecret: 'gc_key.secret.json'
}

function minifyJs (src, out, name, debug) {
  return browserify({
    basedir: '.',
    debug: debug,
    entries: src,
    cache: {},
    packageCache: {}
  })
    .plugin(tsify)
    .bundle()
    .on('error', swallowError)
    .pipe(source(name + '.min.js'))
    // .pipe(eslint())
    // .pipe(eslint.format())
    // .pipe(eslint.failAfterError())
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(out))
    .pipe(gulp.dest('public/' + out))
    .on('error', swallowError)
}

function scriptsDeclarations (src, out, name) {
  return gulp.src(src)
    .pipe(tsProject()).dts
    .pipe(gulp.dest(out))
}

function scripts (src, out, name, debug, minify) {
  const stream = browserify({
    basedir: '.',
    debug: debug,
    entries: src,
    cache: {},
    packageCache: {}
  })
    .plugin(tsify)
    .bundle()
    .on('error', swallowError)
    .pipe(source(name + '.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(out))
    .pipe(gulp.dest('public/' + out))

  if (minify) {
    minifyJs(src, out, name, debug)
  }

  return stream
}

function styles (src, out, name, minify) {
  const stream = gulp.src(src)
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: ['node_modules']
    }).on('error', sass.logError))
    .pipe(postcss([autoprefixer]))
    .pipe(sourcemaps.write())
    .pipe(rename({ basename: name }))
    .pipe(gulp.dest(out))
    .pipe(gulp.dest('public/' + out))

  if (minify) {
    stream.pipe(cleanCss())
      .pipe(rename({ suffix: '.min' }))
      .pipe(gulp.dest(paths.cssDist))
      .pipe(gulp.dest('public/' + paths.cssDist))
  }
  return stream
}

// TODO: bucket config should go to evn or something...
function upload (filePath, bucketBase) {
  // => File will be uploaded to /bucket-name/<bucketBase>/example.css
  return gulp.src(filePath)
    .pipe(gcPub({
      bucket: 'petrak-tmp-css-js-storage',
      keyFilename: paths.gcSecret,
      projectId: 'ethereal-accord-263421',
      base: bucketBase,
      public: true,

      transformDestination: function (path) {
        return path.toLowerCase()
      },
      metadata: {
        cacheControl: 'max-age=60, no-transform, public'
      }
    }))
}

function swallowError (error) {
  console.log(error.toString())
  this.emit('end')
}

function declareStructure () {
  return scriptsDeclarations(paths.jsSrcDeclare, paths.jsDistDeclare, names.declarationsName)
}

function stylesApp () {
  return styles(paths.cssSrc, paths.cssDist, names.bundleName, false)
}

function scriptsApp () {
  return scripts(paths.jsSrc, paths.jsDist, names.bundleName, true, false)
}

function icons () {
  return styles(paths.iconsSrc, paths.iconsDist, names.bundleNameIcons, false)
}

function iconsProd () {
  return styles(paths.iconsSrc, paths.iconsDist, names.bundleNameIcons, true)
}

function publishStyles () {
  return upload(paths.cssDist + names.bundleName + '.min.css', '')
}

function publishScripts () {
  return upload(paths.jsDist + names.bundleName + '.min.js', '')
}

function stylesAppProd () {
  return styles(paths.cssSrcProd, paths.cssDist, names.bundleName, true)
}

function scriptsAppProd () {
  return scripts(paths.jsSrc, paths.jsDist, names.bundleName, false, true)
}

function stylesDemo () {
  return styles(paths.cssSrcDemo, paths.cssDistDemo, names.bundleNameDemo, false)
}

function scriptsDemo () {
  return scripts(paths.jsSrcDemo, paths.jsDistDemo, names.bundleNameDemo, true, false)
}

function stylesDemoProd () {
  return styles(paths.cssSrcDemo, paths.cssDistDemo, names.bundleNameDemo, false)
}

function scriptsDemoProd () {
  return scripts(paths.jsSrcDemo, paths.jsDistDemo, names.bundleNameDemo, false, false)
}

function watchJS () {
  gulp.watch(['src/scripts/**/*.ts'], gulp.series(scriptsApp))
}

function watchCSS () {
  gulp.watch([
    'src/styles/**/*.scss',
    '!src/styles/components/icons.scss',
    '!src/styles/variables/icons.scss',
    '!src/styles/index-icons.scss'
  ], gulp.series(stylesApp))
}

function watchIcons () {
  gulp.watch([
    'src/styles/components/icons.scss',
    'src/styles/variables/icons.scss',
    'src/styles/variables/svg.scss',
    'src/styles/index-icons.scss'
  ], gulp.series(icons))
}

function watchDemoJS () {
  gulp.watch(['src_demo/scripts/**/*.ts'], gulp.series(scriptsDemo))
}

function watchDemoCSS () {
  gulp.watch(['src_demo/styles/**/*.scss'], gulp.series(stylesDemo))
}

// APP
exports.buildCSS = gulp.series(stylesApp)
exports.buildIcons = gulp.series(icons)
exports.buildJS = gulp.series(scriptsApp)
exports.buildApp = gulp.series(exports.buildCSS, exports.buildJS, exports.buildIcons)

exports.watchCSS = gulp.parallel(watchCSS)
exports.watchJS = gulp.parallel(watchJS)
exports.watchIcons = gulp.parallel(watchIcons)
exports.watch = gulp.parallel(exports.watchCSS, exports.watchJS, exports.watchIcons)

// DEMO
exports.buildDemoCSS = gulp.series(stylesDemo)
exports.buildDemoJS = gulp.series(scriptsDemo)
exports.buildDemo = gulp.series(exports.buildDemoCSS, exports.buildDemoJS)

exports.watchDemoCSS = gulp.parallel(watchDemoCSS)
exports.watchDemoJS = gulp.parallel(watchDemoJS)
exports.watchDemo = gulp.parallel(exports.watchDemoCSS, exports.watchDemoJS)

// PUBLISH
exports.publishCSS = gulp.parallel(publishStyles)
exports.publishJS = gulp.parallel(publishScripts)
exports.upload = gulp.parallel(exports.publishCSS, exports.publishJS)

// PROD
exports.declare = gulp.series(declareStructure)
exports.buildProd = gulp.series(
  stylesAppProd,
  scriptsAppProd,
  stylesDemoProd,
  scriptsDemoProd,
  iconsProd,
  declareStructure
)

// GLOBAL
exports.buildAll = gulp.series(exports.buildApp, exports.buildDemo)

exports.watchAll = gulp.parallel(exports.watch, exports.watchDemo)

exports.default = gulp.series(exports.buildAll)
