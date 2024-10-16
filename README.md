# Sistema de envio de emails em massa

### Preparação do Banco de dados

> CREATE DATABASE `envio-de-emails` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
>
> CREATE USER ‘envio-de-emails’@'localhost' IDENTIFIED BY 'envio-de-emails';
>
> GRANT ALL PRIVILEGES ON `envio-de-emails`.* TO 'envio-de-emails'@'localhost' WITH GRANT OPTION;
>
> FLUSH PRIVILEGES;

### Preparação da aplicação

> composer install
>
> npm install
>
> php artisan migrate
>
> php artisan db:seed

### Recarregar as Permissões

> php artisan cache:clear
>
> php artisan db:seed --class=PermissionSeeder
>
> php artisan db:seed --class=RoleSeeder

### Configure os seu servidor de envio de emails em .env

>MAIL_MAILER=smtp
>MAIL_HOST=HostDeServiço
>MAIL_PORT=PortaDeAcesso
>MAIL_USERNAME=SeuUsername
>MAIL_PASSWORD=SeuPassword
>MAIL_ENCRYPTION=TipoDeCriptografia
>MAIL_FROM_ADDRESS=EndereçoDeEmail
>MAIL_FROM_NAME="${APP_NAME}"

### Configure o email para receber notificações do backup caso queira utilizar

>   config/backup.php  
>   'mail' => [ 
>       'to' => 'email@email.com', //instira o email aqui

### Configure o crontab para ficar monitorando os comandos

> crontab -e
>
> * * * * * php /var/www/envio-de-emails/artisan schedule:run >> /dev/null 2>&1
