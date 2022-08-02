cd storage
mkdir logs
mkdir framework
mkdir framework/cache && framework/cache/data
mkdir framework/sessions
mkdir framework/testing
mkdir framework/views
chgrp -R www-data ../storage
chown -R www-data ../storage
