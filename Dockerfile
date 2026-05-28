# Usa uma imagem oficial super moderna com PHP 8.3 e Nginx já configurados
FROM webdevops/php-nginx:8.3

# Avisa o servidor que a raiz do site é a pasta 'public' do Laravel
ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production

# Define a pasta de trabalho dentro do servidor
WORKDIR /app

# Copia todo o seu projeto para dentro do servidor
COPY . .

# Instala as dependências (agora SEM a flag ignore, pois a versão está correta!)
RUN composer install --no-dev --optimize-autoloader

# Dá as permissões corretas para o Laravel salvar arquivos de log e cache
# (Nessa imagem webdevops, o usuário padrão chama-se 'application')
RUN chown -R application:application /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 80