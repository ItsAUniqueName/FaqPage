## Gyik tesztprojekt

Az alkalmazás Laravel keretrendszer segítségével készült és a feladatkiírás alapfunkcióit teljesíti:

- kérdések létrehozása, törlése, módosítása
- válaszok létrehozása egy bizonyos kérdéshez
- válaszok törlése, frissítése
- válaszok értékelése(like, dislike), ezen adatok megjelenítése
- kérdésekre adott válaszok megjelenítése a kérdéseknél
- kezdetleges frontoldalak elkészítése blade segítségével

Megvalósításomban törekedtem mindent a lehető legegyértelműbben elkészíteni, tiszteletben tartva az MVC szemléletet. Az alkalmazáshoz MySql adatbázist használtam a fejlesztés során Xampp segítségével.

## Beüzemelés

- git repository letöltése
- a letöltött könyvtár gyökerében terminál indítása
- composer install parancs kiadása
- .env file létrehozása a .env.example file másolásával
- php artisan key:generate parancs kiadása
- üres adatbázis létrehozása az alkalmazás számára
- a .env fájlban a 11-116. sorban a db adatok megadása
- php artisan migrate parancs futtatása
- php artisan serve paranccsal az alkalmazás indítása

## Template-k

Az alkalmazás összesen hat template-t használ:

- layout.blade.php - a többi templatenek alapként szolgáló fájl, ebben találhatóak a külső fájlok linkjei
- welcome.blade.php - kérdések listázása, nyitó oldal
- create_question.blade.php - kérdés létrehozása
- updateQuestion.blade.php - kérdés frissítése
- questionDetails.blade.php - a kérdéshez tartozó válaszok listája, emellett itt lehet választ felvinni, törölni, illetve like-olni is
- updateAnswer.blade.php - válasz frissítésére szolgáló felület

## A web.php file

A web.php fájlban kerül lekezelésre az egyes hívások közvetítése a controller-ek felé. A tíz hívás nevét igyekeztem minél arulkodóbbra megválasztani, hogy tükrözze annak funkcionalitását.

## Controllerek

Az alkalmazás két controller-t használ, az egyik a kérdések, a másik a válaszok kezelését végzi.

A QuestionController.php az alábbi feladatokat végzi el:

- kérdések létrehozása, model-en keresztül azok adatbázisba tárolása
- létező kérdések törlése és frissítése
- kérdések listázása (public function index())
- egy kérdés részletes megnyitása, itt kiemelve látható a kérdés, illetve itt olvashatók a válaszok is

Az AnswerController.php a válaszokat kezeli:

- válaszok létrehozása
- válaszok törlése
- válaszok frissítése
- válaszokra adott visszajelzések kezelése

A controller-ek az adatbázisműveleteket a Question és az Answer model-eken keresztül végzik. Sajnos a krédések kategorizálását és a felhasználókezelést nem volt időm elkészíteni, így az ezekhez tartozó modeletet a rendszer jelen állapotában nem használja.