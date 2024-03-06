**HÁZIFELADATOK:**

2. Alkalom (**2024/02/24**):
Bővítsük ki a felhasználó feltöltését a következő mezőkkel:

* telefonszám (külön országhívó kód, külön szám) (text típusú mezők)
* email (email típusú mező)
* utca (text típusú mező)
* házszám (text típusú mező)
* ország (text típusú mező)
* feltételeket elfogadó checkbox (checkbox típusú mező)
* neme (radio típusú mező)

**VALIDÁCIÓT IS ÍRJUNK RÁ** (a validateUserData függvényben)

* Ha van ötletetek más mezőkre, nyugodtan rakjátok bele, következő óra elején megnézzük együtt.

* Ha nem sikerül minden, nem gond, következő óra elején azt is megnézzük.


3. Alkalom (**2024/03/02**):
   
Egészítsétek ki a jelenlegi validációs szabályokat kb ugyanúgy, mint ahogy a felhasználónévnél a minimum és maximum szabályt megcsináltuk, csak most a jelszónak, és a telefonszám mezőnek fejlesszünk oda 1 kis validációt (extrának az emailhez is lehet). Van akinek ez már részlegesen meg volt, az picit előrébb jár, de próbáljunk jelszót határok közé szorítani, minimum és maximum karakterszám, tartalmazzon legalább egy nagybetűt, egy számot, és egy szimbólumot, a telefonszám validációját pedig próbáljuk ez alapján értelmezni: https://en.wikipedia.org/wiki/Telephone_numbers_in_Hungary Ezzel is kicsit "élesben" kipróbálva, hogy ki hogy értelmezni, mire van szükség. Egy munkahelyen ugyanennyit kapnátok, vagy kevesebbet. Felhívom a figyelmetek, hogy itt csak magánszám, vagy vonalas szám formátumot kell tudni ellenőrizni.
