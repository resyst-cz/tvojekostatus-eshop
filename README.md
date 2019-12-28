# tvojekostatus-eshop

New eshop created in Prestashop

## Jak pouzivat GIT

- Prvotni inicializace pres `git clone` - moznost SSH/HTTPS (doporucuju SSH, jinak budes muset vzdycky zadavat jmeno + heslo).
- Pred zacatkem prace `git pull`, abys natahl nejnovejsi zmeny
- Jakmile mas hotovy nejaky celek prace, tak dej `git add` a nazev souboru (slozky, wildcard...), ktery chces pridat. 
Nasledne `git commit -m "nejaka zprava popisujici co se delalo"`
- Kdyz mas vsechno commitnute, dej `git push` a vsechny commity se nahrajou do repozitare, odkud si je pak muzeme pullovat
- Kdykoliv muzes dat `git status` abys videl v jakych souborech mas zmeny, co je pripravene ke commitu apod.
- Po kazdem prikazu ti git napise moznosti co delat dal, tak snad se neztratis
- pokud chces neco z commitu vyradit, tak muzes dat `git checkout -- <file>`

## Jak deploynout na staging/produkci

### Soubory

- ujisti se, ze mas pullnute veci z gitu, svoji praci jsi commitnul a pushnul
- bud v rootu projektu a zadej prikaz `composer deploy:staging` nebo `composer deploy:production`
- sleduj jak se vsechny zmenene veci nahrajou bez problemu na server :wink:

### Databaze

- ve slozce `_sql` bude soubor `changes.sql`, do ktereho se vzdy nahoru budou davat prikazy ktere je potreba spustit, aby byly databaze zesynchronizovane
- po nejakych zasadnich zmenach dej do `_sql` slozky zazipovany dump cele databaze (format `<env>_<Y-m-d-H-i-s>_<db_name>` - `env` je jedno z production/staging/localhost)

-------

## Inicializace dev prostredi

Budes potrebovat par vychytavek, abys mohl pohodlne vyvijet :wink: 

### nainstaluj si 

- git
- [git bash](https://www.techoism.com/how-to-install-git-bash-on-windows/)  - lepsi command line, nez klasicky CMD.exe :wink:
- [composer](https://getcomposer.org/doc/00-intro.md#installation-windows)
- [node.js](https://nodejs.org/en/download/)
- npm (je soucasti nodejs)

### Inicializace projektu

- spust `git bash` nebo `cmd`
- Nejdriv naclonuj repozitar k sobe. Nejjednodussi bude, kdyz das `git clone` do nejake docasne slozky mimo projekt a az se ti vsechno stahne tak presunes vsechny (i skryte soubory) do slozky kde mas projekt rozbehanej. Pak se v CMD prepni do slozky s projektem a dej `git status` a uvidis jestli to funguje 
- proved prikazy v `_sql/changes.sql` souboru, ktery jeste nemas u sebe (poznas podle znacky). Pripadne si nahraj dump
- spust `composer install`
- spust `npm install`

-----

## Jak vyvijet

- spust `git bash` nebo `cmd`
- prepni se do slozky s projektem
- pro sledovani zmen v CSS spust prikaz `npm run sass-watch` - vsechny zmeny co provedes v `resources/sass` se automaticky projevi v patricnych CSS souborech
- pro pripraveni CSS souboru k deployi spust prikaz `npm run pre-deploy`
- pro nahrani zmen na staging server si bud nastav automaticky upload na FTP nebo spust `composer deploy:staging` 
- commitni a pushni zmeny do gitu
