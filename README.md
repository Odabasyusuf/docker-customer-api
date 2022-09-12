# Docker - Customer API Projesi


## Proje Hakkında

Projeyi Docker kullanılarak, tek Container üzerinde birden fazla laravel projesi çalıştırabilecek şekilde kurguladım.

'api' projesi API kaynağımız, 'customer-project' ise önyüz diyebileceğimiz kullanının gördüğü projedir.

Database işlemlerinin tamamı 'api' projesinde işlenmektedir. 'customer-project' in herhangi bir database bağlantısı bulunmamaktadır ve Tek sayfada işlem yapabilmek adına Ajax istekleri için  Livewire kullanılmıştır.

Test domaini: customer-project.test

Api kaynağı: api.customer-project.test

## Kurulum

Proje Klonlanır;

>   git clone https://github.com/Odabasyusuf/docker-customer-api

Proje klasörü (docker-customer-api dizininde) terminalinde;

>   docker-compose up

ile Container ayağa kaldırılır.

------------

Tarayıcıdan,

127.0.0.1:8080 ile phpmyadmin’e girilir. (Kullanıcı: root , şifre: root)
Yeni bir tablo oluşturulmalıdır.

Tablo adı: customer-project

------------
Docker Üzerinde;

customer-api-php8 container’i terminaline girilir.

Sırası ile;

>   cd api

>   composer install

>   php artisan migrate —seed

>   cd ..

>   cd customer-project

>   composer install

Adımları ile projeye composer ve database eklemeleri yapılır.


Daha sonra kendi Mac sisteminizin terminalinde;

>   sudo nano /etc/hosts

hosts dosyasına aşağıdaki domainler eklenmeli.

>127.0.0.1 customer-project.test
>
>127.0.0.1 api.customer-project.test

Kaydedip çıkabilirsiniz. 

Tüm ayarlamalar tamamlandı.

Artık tarayıcıdan customer-project.test adresine girip test edebilirsiniz.
