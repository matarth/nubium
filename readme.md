
## Naborový projekt pro Nubium.

### PHP
spustíme příkaz
````
    sudo docker-compose up -d
````
následně vstoupíme do contraineru `nubium_php` příkazem

````
    sudo docker exec -it nubium_php bash
````

a nainstalujeme knihovny příkazem

````
    composer install
````

### Databáze
Pro vytvoření databáze máme soubor se strukturou a základními daty `tests/testDump.sql`
Ten importujeme do databáze, která běží v kontejneru `nubium_db` na portu `3306` pomocí PHPstormu nebo jiné db aplikace.

Údaje pro přihlášení k db:
````
    host: 0.0.0.0
    port: 3306
    database: nubium
    user: root
    password: root
````


### Spuštění
Pro spuštení je nutné vytvořit adresář `temp/` a `log/` a upravit jim práva přikazem:
````
    sudo chmod 777 -R temp log
````

Po nainstalování knihoven a vytvoření databáze bude web dostupný na adrese `http://localhost` nebo `https://localhost`.
V připadě HTTPS bude nutné v prohlížeči odsouhlasit vstup na nedůvěryhodnou stránku nebo přidat do prohlížeče certifikační autoritu ze souboru `docker/nginx/CA.pem`

### Testy

Pro zprovoznení testů je nutné následovat tento postup.

 - zakomentovat v souboru `tests/Support/AcceptanceTester.php` řádek`use _generated\AcceptanceTesterActions;`.
 - spustit příkaz `php vendor/bin/codecept build`.
 - odkomentovat řádek z bodu 1.
 - spustit příkaz `composer tests` 



### Nedotažené věci

Aplikace není plně otestována. Narazil jsem na problém, kde sqlite3 nevyplňuje ID pole s příznakem AUTO_INREMENT a tudíž nejdou otestovat opětovné registrace apod.
Řešením by asi bylo spustit druhý mysql kontejner pro testovací DB.