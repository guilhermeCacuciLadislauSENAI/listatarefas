FROM richarvey/nginx-php-fpm:latest

# Copia todos os arquivos do seu projeto para dentro do servidor
COPY . /var/www/html

# Define que a pasta pública do Laravel é a raiz do site
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# Instala as dependências ignorando travas de plataforma/extensões do PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Garante as permissões necessárias para o Laravel salvar logs e arquivos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
