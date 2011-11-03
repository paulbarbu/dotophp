ask: tab-index, what order?


*_ERR_DB
*_ERR_DB_CONNECTION

ask: how to avoid reassigning the same value to global vs module constants

do not add a user twice in the pending table when resetting passwords

2011-10-22 12:23:38	+flavius	daca pui folding markers face vim treaba
2011-10-22 12:23:57	+flavius	vezi ca mai trebuie ceva setari si la sfarsitul fiecarui fisier
2011-10-22 12:24:09	+flavius	ai exemplu prin phpmeta

2011-10-22 12:26:16	paullik	o sa urmeze oricum o intrebare pe ML despre constante dar intai sa mai reflectez eu asupra ei...

2011-10-22 12:27:10	+flavius	paullik: in isUser() ai o mica greseala de logica cred, verifici disjunctiv, si returnezi TRUE daca exista de la 1 in sus
2011-10-22 12:27:24	+flavius	nu am urmarit felul in care ai combinat functiile, dar e smelly situation
2011-10-22 12:27:35	+flavius	depinde puternic de ce faci la inregistrare
2011-10-22 12:28:23	+flavius	si daca la inregistrare faci ceva gresit (nu neaparat acum, dar mai ales mai incolo cand vei fi uitat ca cele doua sunt legate una de alta), se poate intampla sa te alegi cu useri dubli
2011-10-22 12:29:53	paullik	flavius, notat, ma uit mai tarziu ca trebui sa testez, stiu ca am avut o motivatie sa verific disjunctiv
2011-10-22 12:30:57	+flavius	verificarea in sine e ok
2011-10-22 12:31:11	+flavius	dar poti avea efecte secundare in exterior, in apelant
2011-10-22 12:31:21	paullik	flavius, de ce?
2011-10-22 12:31:42	+flavius	paullik: pentru ca trece timpul si poti uita ce si cum faci in acea functie :)
2011-10-22 12:32:11	paullik	flavius, aaaaaa tu te referi ca returnez FALSE/TRUE in loc de TRUE/FALSE?
2011-10-22 12:32:37	+flavius	nu, ca returnezi TRUE daca fetch_all ti-a dat mai mult de 1 rezultat
2011-10-22 12:33:08	paullik	pai da, isUser -> deci am un user cu acel nick sau mail in DB
2011-10-22 12:33:08	+flavius	daca ti-a dat 2 rezultate, unul la care se potriveste username si altul la care se potriveste email?
2011-10-22 12:33:17	+flavius	deci :)
2011-10-22 12:33:22	+flavius	ai doi user in DB:
2011-10-22 12:33:31	+flavius	foo foo@host.tld
2011-10-22 12:33:37	+flavius	bar bar@host.tld
2011-10-22 12:33:47	+flavius	si eu vin tralala si vreau sa ma inregistrez
2011-10-22 12:33:49	+flavius	introduc:
2011-10-22 12:33:53	+flavius	nick: foo
2011-10-22 12:34:01	+flavius	mail: bar@host.tld
2011-10-22 12:34:05	+flavius	ce se intampla?
2011-10-22 12:34:14	paullik	dap, isUser _> TRUE
2011-10-22 12:35:05	paullik	eu ma gandeam asa daca in cadrul aceluiasi ROW din DB am sau nick-ul sau mail-ul introdus sa imi returneze TRUE
2011-10-22 12:35:10	+flavius	felul in care e implementat distorsioneaza realitatea...
2011-10-22 12:35:37	paullik	de asta pusesem OR
2011-10-22 12:36:01	+flavius	ok
2011-10-22 12:36:17	paullik	trebuie sa ma gandesc cum repar
2011-10-22 12:36:31	+flavius	pai e ok atunci, dar ai o problema
2011-10-22 12:36:43	+flavius	ce ii spui userului care tocmai vrea sa se inregistreze?
2011-10-22 12:37:03	paullik	pai nu stiu daca mail-ul sau nick-ul e duplicat :D
2011-10-22 12:37:34	paullik	functii diferite
2011-10-22 12:37:41	paullik	una pt nick
2011-10-22 12:37:44	paullik	si una pt mail
2011-10-22 12:37:57	+flavius	si doua cereri SQL? overkill
2011-10-22 12:38:04	+flavius	hai ca vezi tu


doxygen: document dotophp/bin also

mysql_real_escape_string()


writeLog when connection fails in other modules too


 starlays | paullik: ca sa poata php sa trimita e-mail trebuie sa imi configurez ceva anume?                                          │
22:25:28    starlays | daca ma poate ajuta cineva as fi recunosctor, ce recomandati mta sau mail server dedicat pentru a fi folosit cu php?      │
22:34:35 +misterjinx | încearcă să instalezi sendmail și pe urmă modifică în php.ini caleacătre sendmail                                         │
22:35:21    starlays | am citit ca sendmail are niste gaurele de securitate                                                                      │
22:35:48 +misterjinx | asta era varianta cea mai simplă                                                                                          │
22:36:03 +misterjinx | dacă ar fi să-ți recomand un server de smtp atunci ți-aș recomanda postfix                                                │
22:36:03    starlays | misterjinx: ook, mersi                                                                                                    │
22:36:22    starlays | parca as tinde catre un mta pentru teste
starlays | am gasit pe wiki cica ar fi ssmtp pentru arch                                                                             │ flavius  
22:36:56 +misterjinx | după ce-l instalezi încearcă un simplu echo "test mail" | sendmail mailultău@domain.com




+misterjinx | tu ai o funcție addUser unde am văzut că faci atât verificarea formularului cât și construirea query-ului                 │
22:39:17    starlays | paullik: ooook.                                                                                                           │
22:39:26 +misterjinx | nu-mi prea place acest lucru, este cam inestetic                                                                          │
22:39:54     paullik | misterjinx, da, verific un camp si il bag in query daca e ok si tot asa                                                   │
22:39:55 +misterjinx | propunerea mea arfi să faci întâi o funcție la modul validateUser unde să te ocupi doar de validarea formularului și să   │
                     | întorci erorile                                                                                                           │
22:40:11 +misterjinx | și pe urmă faci funcția addUser unde direct construiești query-ul                                                         │
22:40:23     paullik | inteleg ce-mi zici





 +misterjinx | tot la partea de înregistrare, dacă nu-ți reușește trimiterea mail-ului de activare tu ștergi userul abia creat  ?        │
22:46:39     paullik | da                                                                                                                        │
22:46:56    starlays | paullik: daca pentru todo: comment linia #10 din register.php                                                             │
22:47:00     paullik | m-am gandit asa: sa nu am leftovers                                                                                       │
22:47:48 +misterjinx | nu e în regulă asta, adică eu ca user aș fi supărat să se întâmple asta                                                   │
22:48:20 +misterjinx | propunerea mea ar fi să nu ștergi respectivul user ci să faci o funcționalitate de tipul „nu ai primit mail-ul de         │
                     | actiovare?”                                                                                                               │
22:48:35 +misterjinx | unde userul să intre și să-și bage adresa de email și să i se retirmită acest mail                                        │
22:48:44 +misterjinx | *retrimită                                                                                                                │
22:49:09     paullik | da, suna bine


+misterjinx | am văzut că zicea starlays mai sus că-l irită faptul că formularul nu-i salvează datele introduse și în caz de erori îl   │
                     | pune să recompleteze                                                                                                      │
22:58:02     paullik | da, asa face                                                                                                              │
22:58:52 +misterjinx | păi cred că soluția cea mai simplă în acest caz ar fi să reții într-o variabilă din sesiune toate valorile introduse în   │
                     | formular iarîn caz de erori să precompletezi formularul cu ce ai salvat acolo                                             │
22:59:22 +misterjinx | iar dacă este totul în regulă, de exemplu după ce ai făcut insertul în baza de date, golsești această variabilă (unset)

#10 register.php

on not recovering fields show all errors at once

rem|phpro | paullik in register/functions aseara m-am legat de  = "'" . $first_name . "'" si toate atribuirile de genu                │
20:48:27     paullik | rem|phpro, dap                                                                                                            │
20:48:43   rem|phpro | mi s-ar parea mai curat sa adaugi apostrofurile undeva chiar inainte sa faci query-ul                                     │
20:49:05   rem|phpro | practic pui datele in forma corecta                                                                                       │
20:49:29   rem|phpro | pana atunci ar trebui sa ramane curate, cel putin asa as face eu:)
