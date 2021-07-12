# Project setup
1. Clone the repository
2. Run the following code <pre>composer install</pre>
3. Setup your Environment variables. This project comes with Google analytics integrated dashboard. So update your environment variables accordingly for Google Analytics widget to work
    <pre>
    APP_NAME=APP_NAME
    APP_ENV=local
    APP_KEY='GENERATE_APPLICATION_KEY'
    APP_DEBUG=true
    APP_URL=YOUR_APP_URL
    ADMIN_URL_SECRET='url_after_admin'

    LOG_CHANNEL=stack
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_name
    DB_USERNAME=yourusername
    DB_PASSWORD=yourpassword

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    MEMCACHED_HOST=127.0.0.1

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.com
    MAIL_PORT=587
    MAIL_USERNAME='YOUR MAIL_USERNAME'
    MAIL_PASSWORD='YOUR MAIL_PASSWORD'
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS='YOUR MAIL_FROM_ADDRESS'
    MAIL_TO_ADDRESS='YOUR MAIL_TO_ADDRESS'
    MAIL_FROM_NAME="YOUR MAIL_FROM_NAME"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=

    ANALYTICS_VIEW_ID="######"  

    GA_TYPE="YOUR GA TYPE"
    GA_PROJECT_ID="YOUR GA PROJECT ID"
    GA_PRIVATE_KEY_ID="YOUR GA PRIVATE KEY ID"
    GA_PRIVATE_KEY= "YOUR GA PRIVATE KEY"
    GA_CLIENT_ID="YOUR GA CLINET ID"
    GA_AUTH_URI="GA_AUTH_URI"
    GA_TOKEN_URI= "GA_TOKEN_URI"
    GA_AUTH_PROVIDER_x509_CERT_URL= "GA_AUTH_PROVIDER_x509_CERT_URL"
    GA_CLIENT_x509_CERT_URL= "GA_CLIENT_x509_CERT_URL"

    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1

    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    </pre>
5. Run <pre>php artisan migrate</pre>
6. Seed Systems Module for required Settings to work <pre>php artisan module:seed System</pre>
7. Seed User Module for ACL to work <pre>php artisan module:seed User</pre>
8. Create a Symlink <pre>php artisan storage:link</pre>

## For Analytics Widget to work follow these steps
1. Go to https://console.cloud.google.com/ and search for Google Analytics Reporting API
2. Generate oAuth credentials and OAuth 2.0 Client IDs and publish your app
3. Create a service account and navigate to keys section within the created service acount
4. Download the json file after you create new keys
5. Add the data provided in json file in your corressponding .env values


## This project uses the following packages
1. <pre>nwidart/laravel-modules</pre>
2. <pre>rap2hpoutre/laravel-log-viewer</pre>
3. <pre>spatie/laravel-activitylog</pre>
4. <pre>spatie/laravel-analytics</pre>
5. <pre>spatie/laravel-permission</pre>
6. <pre>stevebauman/location</pre>
7. <pre>magyarandras/amp-converter</pre>

