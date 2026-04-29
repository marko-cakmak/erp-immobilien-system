FROM nginx:alpine

COPY default.conf /etc/nginx/conf.d/default.conf

COPY --from=mcakmak123/erp-immobilien-php:latest /var/www/public /var/www/public

EXPOSE 80
