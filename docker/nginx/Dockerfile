ARG TAG
FROM mcakmak123/erp-immobilien-php:${TAG} as php

FROM nginx:alpine

COPY default.conf /etc/nginx/conf.d/default.conf

COPY --from=php /var/www/public /var/www/public

EXPOSE 80
