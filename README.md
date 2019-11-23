# tvojekostatus-eshop

New eshop created in Prestashop

## Jak pouzivat GIT

- Prvotni inicializace pres `git clone` - moznost SSH/HTTPS
- Pred zacatkem prace `git pull`, abys natahl nejnovejsi zmeny
- Jakmile mas hotovy nejaky celek prace, tak dej `git add` a nazev souboru, ktery chces pridat. 
Nasledne `git commit -m "nejaka zprava popisujici co se delalo"`
- Kdyz mas vsechno commitnute, dej `git push` a vsechny commity se nahrajou do repozitare, odkud si je pak muzeme pullovat
- Kdykoliv muzes dat `git status` abys videl v jakych souborech mas zmeny, co je pripravene ke commitu apod.
- Po kazdem prikazu ti git napise moznosti co delat dal, tak snad se neztratis
- pokud chces neco z commitu vyradit, tak muzes dat `git checkout -- <file>`

## Jak deploynout na staging/produkci

### Soubory

- ujisti se, ze mas pullnute veci z gitu, svoji praci jsi commitnul a pushnul
- bud v rootu projektu a zadej prikaz `php vendor/dg/ftp-deployment/deployment deployment-staging.ini` nebo `php vendor/dg/ftp-deployment/deployment deployment-production.ini`, muzes za to pridat parameter `-t` pro simulaci (test)
- sleduj jak se vsechny zmenene veci nahrajou bez problemu na server :wink:

### Databaze

- ve slozce `_sql` bude soubor `changes.sql`, do ktereho se vzdy nahoru budou davat prikazy ktere je potreba spustit, aby byly databaze zesynchronizovane
- po nejakych zasadnich zmenach dej do `_sql` slozky zazipovany dump cele databaze (format `<env>_<Y-m-d-H-i-s>_<db_name>` - `env` je jedno z production/staging/localhost)

## Inicializace dev prostredi

- Nejdriv naclonuj repozitar k sobe
- pres `composer install` nainstalujes potrebne veci k vyvoji (vcetne deploy skriptu)
- proved prikazy v `_sql/changes.sql` souboru, ktery jeste nemas u sebe (poznas podle znacky). Pripadne si nahraj dump

