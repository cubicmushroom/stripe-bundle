var gulp    = require('gulp'),
    phpspecTasks  = require('gulp-cm-phpspec-tasks'),
    versionTasks = require('./gulp/version-tasks');

var namespace = 'CubicMushroom\\Symfony\\StripeBundle\\';

/**
 * PHPSpec tasks
 */
phpspecTasks.addTasks(gulp, namespace);

/**
 * Versioning tasks
 */
versionTasks.addTasks();