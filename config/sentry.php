<?php

return array(
    'dsn' => env('SENTRY_DSN', 'https://032ba17d8d984f99bdc187bb53227026:4f83a20faa7e4308862f36cb84e9f656@sentry.io/252733'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,

    // Capture default user context
    'user_context' => true,
);
