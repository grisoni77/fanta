FantaCalcio
========================

Gestione di una lega di fantacalcio

1) Installation
------------------------

a) git clone https://github.com/grisoni77/fanta.git <your_local_path>
b) copy app/config/parameters.yml.dist into app/config/parameters.yml and configure it along with your system
c) install vendors through composer (you need to download composer at http://getcomposer.org/) from within <your_local_path>
php composer.phar install
d) install database from within <your_local_path>
php app/console doctrine:schema:update
